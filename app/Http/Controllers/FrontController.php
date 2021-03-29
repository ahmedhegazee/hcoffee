<?php

namespace App\Http\Controllers;

use App\Models\Interval;
use App\Models\Reservation;
use App\Models\Setting;
use App\Traits\PaymantPaylinkTrait as TraitsPaymantPaylinkTrait;
use App\Traits\SMSServiceTrait;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    use TraitsPaymantPaylinkTrait, SMSServiceTrait;
    public function test()
    {
        // dd(asset("images/logo.jpg"));
        // $result  = $this->GetInvoice(1616559834169);
        $result = $this->sendMessage('966596610095', 'مرحبا بكم في هولوود كافيه تم الحجز بتاريخ اليوم ٢٥-٣-٢٠٢١');
        dd($result);
    }
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
        $interval = Interval::where("date", $request->date)->where("type", $request->interval)->first();
        if (is_null($interval)) {
            return \response()->json(["message" => "لا يمكن الحجز في هذا التاريخ"]);
        }
        if (($interval->guests_count + $request->guests_count) <= $interval->max_guests_count) {
            $reservation = $interval->reservations()->create($request->all());
            $products = [
                [
                    "description" => "Making reservation for seats in hollywood cafe",
                    "imageSrc" => \config('app.url') . '/images/logo.jpg',
                    "price" => $reservation->total_amount,
                    "qty" => 1,
                    "title" => "Seats Reservation"
                ]
            ];
            $url = $this->AddInvoice($reservation, $products);
            if ($interval->guests_count == $interval->max_guests_count) {
                $interval->is_completed = 1;
                $interval->save();
            }

            return response()->json(["url" => $url]);
        } else {
            return \response()->json(["message" => "نعتذر لا يمكن الحجز في هذا اليوم العدد مكتمل"]);
        }
    }
    public function showPaymentStatus(Request $request)
    {
        $this->sendMessage("+201019303786", 'تم حجز الموعد بنجاح');
        dd($request->all());
        // $result = $this->GetInvoice($reservation->payment_transaction_id);
        // dd($result);
        return view("welcome");
    }
    public function getPrice()
    {
        return \response()->json(['price' => Setting::first()->value]);
    }
}