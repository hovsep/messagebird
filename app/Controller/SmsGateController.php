<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 23:46
 */
namespace App\Controller;

use App\Controller\Traits\ThrottlesRequests;
use App\Controller\Traits\ValidatesRequest;
use App\Kernel\Request;
use App\Utils\SmsGate;

class SmsGateController
{

    use ValidatesRequest, ThrottlesRequests;

    public function sendSms(Request $request)
    {
        //Limit rate request as 1 RPS (request per second)
        $this->throttle(md5(__FUNCTION__));

        $this->validate($request, [
            'recipient'     => ['required'],
            'originator'    => ['required'],
            'message'       => ['required', 'max_length:160']
        ]);

        try {
            $data = $request->getBody();

            $response = SmsGate::getInstance()->sendSms($data['originator'], $data['recipient'], $data['message']);

            json_response(['message' => 'SMS sent', 'response' => $response]);
        } catch (\Exception $e) {
            json_error_response('Failed to send SMS. Reason: ' . $e->getMessage(), 500);
        }
    }
}