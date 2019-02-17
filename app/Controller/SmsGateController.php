<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 23:46
 */
namespace App\Controller;

use App\Kernel\Request;

class SmsGateController
{

    public function sendSms(Request $request)
    {
        json_response(['stub' => 'from controller']);
    }
}