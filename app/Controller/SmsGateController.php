<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 23:46
 */
namespace App\Controller;

use App\Controller\Traits\ValidatesRequest;
use App\Kernel\Request;

class SmsGateController
{

    use ValidatesRequest;

    public function sendSms(Request $request)
    {
        $this->validate($request, [
            'recipient'     => ['required'],
            'originator'    => ['required'],
            'message'       => ['required', 'max_length:160']
        ]);
    }
}