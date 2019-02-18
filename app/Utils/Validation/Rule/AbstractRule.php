<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 1:15
 */

namespace App\Utils\Validation\Rule;

/**
 * Base rule class
 *
 * Class AbstractRule
 * @package App\Utils\Validation\Rule
 */
abstract class AbstractRule implements IRule {

    protected $params = [];

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

}