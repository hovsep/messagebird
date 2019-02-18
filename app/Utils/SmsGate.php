<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 3:04
 */

namespace App\Utils;



use MessageBird\Objects\Message;

/**
 * Implemented as singleton just to keep things simple.
 * In real world Inversion of Control should be used
 *
 * Class SmsGate
 * @package App\Utils
 */
class SmsGate
{
    private static $instance = null;

    private static $messageBird = null;

    /**
     * @return SmsGate
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
        global $config;
        static::$messageBird =  new \MessageBird\Client($config['services']['messageBird']['api_key']);
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }


    /**
     * @param $originator
     * @param $recipient
     * @param $body
     * @return mixed
     */
    public function sendSms($originator, $recipient, $body)
    {
        $message = new Message();
        $message->originator = $originator;
        $message->recipients = [$recipient];
        $message->body = $body;

        return static::$messageBird->messages->create($message);
    }
}