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
            "apiId" => \config('paylink.appid'),
            "persistToken" => false,
            "secretKey" => \config('paylink.secret'),
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
            "clientEmail" => 'email@test.com',
            "clientMobile" => $reservation->phone,
            "clientName" => $reservation->name,
            "note" => $reservation->notes ?? "",
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
        // return $urldecode;
        return $urldecode['url'];
    }
    private function GetInvoice($transactionNo)
    {
        $url = $this->url . '/getInvoice/' . $transactionNo;
        $urldecode = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->GetTokenPayment()
        ])->asJson()->get($url)->json();
        return $urldecode;
        // return $urldecode['orderStatus'];
    }
}