<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 0:45
 */

namespace App\Utils\Validation\Rule;


class Required extends AbstractRule {

    public function isValid($value)
    {
        if (is_null($value)) {
            return false;
        } elseif (is_string($value) && trim($value) === '') {
            return false;
        } elseif (is_array($value) && count($value) < 1) {
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return 'is required';
    }


}