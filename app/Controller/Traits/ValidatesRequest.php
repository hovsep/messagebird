<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 1:01
 */

namespace App\Controller\Traits;

use App\Kernel\Exception\HttpException;
use App\Kernel\Request;
use App\Utils\Validation\Validator;

trait ValidatesRequest {


    /**
     * Validate the request
     *
     * @param Request $request
     * @param array $rules
     * @throws HttpException
     */
    public function validate(Request $request, array $rules)
    {
        $validator = new Validator($rules, $request->getBody());

        if ($validator->fails()) {
            throw new HttpException($validator->getErrorMessage(), 422);
        }
    }
}