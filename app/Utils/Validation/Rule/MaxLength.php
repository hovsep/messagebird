<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 0:45
 */

namespace App\Utils\Validation\Rule;


class MaxLength extends AbstractRule {
    public function __construct(array $params = [])
    {
        parent::__construct($params);

        if (empty($this->params[0])) {
            throw new \InvalidArgumentException('Max length is not set');
        }
    }


    public function isValid($value)
    {
        return (mb_strlen($value) <= (int) $this->params[0]);
    }

    public function getErrorMessage()
    {
        return 'is longer than ' . $this->params[0];
    }


}