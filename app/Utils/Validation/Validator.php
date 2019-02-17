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

class Validator
{
    private $rules = [];

    private $data = [];

    private $errorMessage = null;

    function __construct(array $rules, array $data)
    {
        $this->rules = $rules;
        $this->data = $data;
    }

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
        } else {
           // throw new \InvalidArgumentException('Rule ' . $rule . ' is incorrect');
        }

    }

    private function getAttributeValue($attribute)
    {
        return array_key_exists($attribute, $this->data) ? $this->data[$attribute] : null;
    }

    /**
     * @return null
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }



}