<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 0:45
 */

namespace App\Utils\Validation\Rule;


interface IRule {

    function __construct(array $params = []);

    public function isValid($value);

    public function getErrorMessage();
}