<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 3:55
 */

namespace App\Controller\Traits;

use App\Kernel\Exception\HttpException;

/**
 * This trait allows to rate-limit given controller-action
 *
 * Trait ThrottlesRequests
 * @package App\Controller\Traits
 */
trait ThrottlesRequests {

    /**
     * Check if requests limit exceeded
     *
     * @param $key
     * @throws HttpException
     */
    public function throttle($key)
    {
        if (\App\Utils\RateLimiter::tooManyRequests($key)) {
            throw new HttpException('Too many requests', 429);
        }
    }

}