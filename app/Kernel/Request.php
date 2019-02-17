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
            $this->{$key} = $value;
        }
    }

    public function getBody()
    {
        //@TODO
    }

}