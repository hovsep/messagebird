<?php

namespace App\Kernel;

use App\Kernel\Exception\HttpException;

/**
 * Very simple router
 *
 * Class Router
 * @package App\Kernel
 */
class Router {

    /**
     * @var Request
     */
    private $request = null;

    /**
     * @var array
     */
    private static $supportedMethods = ['get', 'post', 'put', 'patch', 'delete'];

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $name
     * @param $arguments
     */
    function __call($name, $arguments)
    {
        try {

            if (!in_array($name, self::$supportedMethods)) {
                throw new \BadMethodCallException('Method not supported');
            }

            list($route, $handler) = $arguments;

            if (empty($route)) {
                throw new \InvalidArgumentException('Route is empty');
            }

            if (empty($handler)) {
                throw new \InvalidArgumentException('Handler is empty');
            }

            $this->{strtolower($name)}[self::formatRoute($route)] = $handler;

        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to register route. Reason: ' . $e->getMessage());
        }

    }

    /**
     * Returns formatted route
     *
     * @param $route
     * @return string
     */
    public static function formatRoute($route)
    {
        $formatted = rtrim($route, '/');

        return empty($formatted) ? '/' : $formatted;
    }

    /**
     * Call appropriate handler
     *
     * @return mixed
     * @throws HttpException
     */
    public function resolve()
    {
        try {
            $httpMethod = strtolower($this->request->getMethod());

            if (!isset($this->{$httpMethod})) {
                throw new \UnexpectedValueException('No routes for this HTTP method');
            }

            $formattedRoute = self::formatRoute($this->request->getPath());

            if (!isset($this->{$httpMethod}[$formattedRoute])) {
                throw new \UnexpectedValueException('This route is not registered');
            }

            return call_user_func_array($this->{$httpMethod}[$formattedRoute], [$this->request]);
        } catch (\UnexpectedValueException $e) {
            throw new HttpException('Failed to resolve route. Reason: ' . $e->getMessage(), 404);
        }
    }
}