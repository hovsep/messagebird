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

    private $body = null;

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
    }

    /**
     * Returns decoded json
     *
     * @return mixed|null
     */
    public function getBody()
    {
        if (is_null($this->body)) {
            if ('POST' == $this->requestMethod) {
                //Our API will always get raw json, so we do not need to read $_POST
                $this->body = json_decode(file_get_contents("php://input"), true);
            }
        }

        return $this->body;

    }

}