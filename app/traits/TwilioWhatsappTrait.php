<?php

namespace App\Traits;

use Twilio\Rest\Client;

trait TwilioWhatsappTrait
{
    public function sendMessage($receiverNumber, $body)
    {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:" . $receiverNumber, // to
                [
                    // "mediaUrl" => ["https://images.unsplash.com/photo-1545093149-618ce3bcf49d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80"],
                    "from" => "whatsapp:" . getenv("TWILIO_WHATSAPP_NUMBER"),
                    "body" => $body
                ]
            );

        return $message->sid;
    }
}
// Find your Account Sid and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure