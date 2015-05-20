<?php
namespace Acme\DemoDriver;

use Filipac\TwoFactor\Interfaces\SenderInterface;
use Filipac\TwoFactor\Models\Settings;

class DemoSender implements SenderInterface
{

    private $driver;


    public function send($to, $message)
    {
        try {
            $username = Settings::get('elks_username',null);
            $password = Settings::get('elks_password', null);
            $from = Settings::get('elks_from', null);
            // now you can send the sms using an API
            return true;
        } catch(\Exception $e) {
            return $e;
        }
    }


    public function getDriver()
    {
        return $this->driver;
    }


}