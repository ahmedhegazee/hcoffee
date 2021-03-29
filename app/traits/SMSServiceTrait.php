<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SMSServiceTrait
{
    private function sendMessage($receivedPhone, $message)
    {

        $url = "https://www.hisms.ws/api.php?send_sms" .
            "&username=" . \config('sms.username') .
            "&password=" . config('sms.password') .
            "&numbers=" .  $receivedPhone .
            "&sender=Hollywood" .
            "&message=" . $message;
        $client = new \GuzzleHttp\Client();
        $request = $client->get($url);
        return $request->getStatusCode();
    }
}