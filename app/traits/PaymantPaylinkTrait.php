<?php

namespace App\Traits;

use App\Models\Reservation;
use Illuminate\Support\Facades\Http;

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
        $urldecode = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->asJson()->post($url, $apifields)->json();
        return $urldecode['id_token'];
    }

    private function AddInvoice(Reservation $reservation, $products)
    {
        $url = $this->url . '/addInvoice';
        $apifields = [
            "amount" => $reservation->total_amount,
            "callBackUrl" => route('welcome'),
            "clientEmail" => null,
            "clientMobile" => $reservation->phone,
            "clientName" => $reservation->name,
            "note" => $reservation->notes,
            "orderNumber" => $reservation->id,
            "products" => $products,
        ];
        $urldecode = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->GetTokenPayment()
        ])->asJson()->post($url, $apifields)->json();

        $reservation->payment_transaction_no = $urldecode['transactionNo'];
        $reservation->payment_status = $urldecode['orderStatus'];
        $reservation->save();

        // $reservation->update([
        //     'payment_transaction_no' => $urldecode['transactionNo'],
        // ]);
        return $urldecode['url'];
    }
    private function GetInvoice($transactionNo)
    {
        $url = $this->url . '/getInvoice/' . $transactionNo;
        $urldecode = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->GetTokenPayment()
        ])->asJson()->get($url)->json();

        return $urldecode['orderStatus'];
    }
}