<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 20:41
 */

namespace App\Kernel;

/**
 * Very simple request class
 *
 * Class Request
 * @package App\Kernel
 */
class Request {

    private $body = [];

    private $params = [];

    private $path = '';

    function __construct()
    {
        $this->boot();
    }

    /**
     * Read request from env
     */
    private function boot()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{str_camel_case($key)} = $value;
        }

        //Read request body
        $this->body = json_decode(file_get_contents('php://input'), true);

        //and params
        foreach ($_GET as $key => $value) {
            $this->params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $this->path = explode('?', $this->requestUri, 2)[0];
    }

    /**
     * Returns http method
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->requestMethod;
    }

    /**
     * Returns decoded json
     *
     * @return mixed|null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return null
     */
    public function getParams()
    {
        return $this->params;
    }


    public function getPath()
    {
        return $this->path;
    }

}