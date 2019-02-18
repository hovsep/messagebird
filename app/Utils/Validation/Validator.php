<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 0:30
 */

namespace App\Utils\Validation;

use App\Utils\Validation\Rule\Factory;
use App\Utils\Validation\Rule\IRule;

/**
 * Simple validator
 *
 * Class Validator
 * @package App\Utils\Validation
 */
class Validator {

    /**
     * Array of string rules
     *
     * @var array
     */
    private $rules = [];

    /**
     * Data under validation
     *
     * @var array
     */
    private $data = [];

    /**
     * First error message
     *
     * @var string
     */
    private $errorMessage = '';

    function __construct(array $rules, array $data)
    {
        $this->rules = $rules;
        $this->data = $data;
    }

    /**
     * Returns true when some attributes have errors
     *
     * @return bool
     */
    public function fails()
    {
        foreach ($this->rules as $attribute => $attributeRules) {
            foreach ($attributeRules as $attributeRule) {
                try {
                    $this->validateAttribute($attribute, $attributeRule);
                } catch (\Exception $e) {
                    $this->errorMessage = $e->getMessage();
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Checks single rule
     *
     * @param $attribute
     * @param $rule
     */
    private function validateAttribute($attribute, $rule)
    {
        $value = $this->getAttributeValue($attribute);

        /* @var $ruleInstance IRule */
        $ruleInstance = Factory::make($rule);

        if ($ruleInstance instanceof IRule) {
            if (!$ruleInstance->isValid($value)) {
                throw new \RuntimeException($attribute . ' ' . $ruleInstance->getErrorMessage());
            }
        }
    }

    /**
     * Extracts attribute value by name
     *
     * @param $attribute
     * @return mixed|null
     */
    private function getAttributeValue($attribute)
    {
        return array_key_exists($attribute, $this->data) ? $this->data[$attribute] : null;
    }

    /**
     * Returns validator first error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }



}