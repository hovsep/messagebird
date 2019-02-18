<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 0:44
 */

namespace App\Utils\Validation\Rule;

/**
 * Rules factory
 *
 * Class Factory
 * @package App\Utils\Validation\Rule
 */
class Factory {

    /**
     * Creates rule instance (if can)
     *
     * @param $rule
     * @return null
     */
    public static function make($rule)
    {
        try {
            $ruleParams = '';
            $ruleName = $rule;

            if (strpos($rule, ':')) {
                list($ruleName, $ruleParams) = explode(':', $rule, 2);
            }

            $className = __NAMESPACE__  . '\\'. ucfirst(str_camel_case($ruleName));
            return new $className(explode(',', $ruleParams));
        } catch (\Throwable $e) {
            //Class not found
            return null;
        }

    }
}