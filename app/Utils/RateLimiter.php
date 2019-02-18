<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 3:54
 */

namespace App\Utils;

/**
 * Simple request rate limiter class
 *
 * Class RateLimiter
 * @package App\Utils
 */
class RateLimiter
{

    /**
     * Very basic rate limiter
     *
     * @param $key
     * @return bool
     */
    public static function tooManyRequests($key)
    {
        if (isset($_SESSION['rateLimiter'][$key])) {
            if ((int) $_SESSION['rateLimiter'][$key] >= time()) {
                return true;
            }
        }

        $_SESSION['rateLimiter'][$key] = time();

        return false;
    }


}