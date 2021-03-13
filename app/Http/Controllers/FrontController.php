<?php

namespace App\Http\Controllers;


use App\Models\Reservation;
use App\Traits\PaymantPaylinkTrait as TraitsPaymantPaylinkTrait;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    use TraitsPaymantPaylinkTrait;
    public function makeOrder(Request $request)
    {
        $rules = [
            "name" => "required|string|min:3|max:191",
            "phone" => "required|string|min:3|max:191",
            "notes" => "nullable|string|min:3|max:1000",
            "total_amount" => "required|numeric|min:0",
            "date" => "required|date",
            "guests_count" => "required|numeric|min:1|max:500",
            "interval" => "required|numeric|in:0,1",
        ];
        $validator = \validator($request->all(), $rules);
        if ($validator->fails()) {
            return \response()->json(["errors" => $validator->errors()->toArray()], 500);
        }
        $reservation = Reservation::create($request->all());
        $products = [
            [
                "description" => "Making reservation for seats in hollywood cafe",
                "imageSrc" => \asset("images/logo.jpg"),
                "price" => $reservation->total_amount,
                "qty" => 1,
                "title" => "Seats Reservation"
            ]
        ];
        $url = $this->AddInvoice($reservation, $products);
        return response()->json(["url" => $url]);
    }
    public function showPaymentStatus(Reservation $reservation)
    {
        $result = $this->GetInvoice($reservation->payment_transaction_id);
        dd($result);
        return view("welcome");
    }
}