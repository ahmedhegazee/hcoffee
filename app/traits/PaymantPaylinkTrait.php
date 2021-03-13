<?php

namespace App\Traits;

use App\Models\Reservation;

trait PaymantPaylinkTrait
{
    //get token then return view and save token in cache
    //pass the products to addinvoice
    private $url = 'https://restapi.paylink.sa/api';
    private function GetTokenPayment()
    {
        $url = $this->url . '/auth';

        $apifields = [
            "apiId" => "APP_ID_1596474965",
            "persistToken" => false,
            "secretKey" => "c33dd197-dfbb-36ab-81ac-265c713e4321",
        ];
        $apifields_string = json_encode($apifields);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $apifields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $apiresult = curl_exec($ch);
        $urldecode = (json_decode($apiresult, true));
        dd($urldecode);
        return $urldecode['id_token'];
    }

    private function AddInvoice(Reservation $reservation, $products)
    {
        $url = $this->url . '/addInvoice';
        $apifields = [
            "amount" => $reservation->total_amount,
            "callBackUrl" => route('welcome', ['payment' => true]),
            "clientEmail" => null,
            "clientMobile" => $reservation->phone,
            "clientName" => $reservation->name,
            "note" => $reservation->notes,
            "orderNumber" => $reservation->id,
            "products" => $products,
        ];
        $apifields_string = json_encode($apifields);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $apifields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $this->GetTokenPayment(),
            "Content-Type: application/json",
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $apiresult = curl_exec($ch);
        $urldecode = (json_decode($apiresult, true));
        $reservation->update([
            'payment_transaction_no' => $urldecode['transactionNo'],
        ]);
        return $urldecode['url'];
    }
    private function GetInvoice($transactionNo)
    {
        $url = $this->url . '/getInvoice/' . $transactionNo;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $this->GetTokenPayment(),
            "Content-Type: application/json",
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $apiresult = curl_exec($ch);

        $urldecode = (json_decode($apiresult, true));

        return $urldecode['orderStatus'];
    }
}