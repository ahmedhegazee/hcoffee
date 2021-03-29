<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $title = "الحجوزات";
        $query = Reservation::whereHas("interval", fn ($q) => $q->where(fn ($query) => $query->dateFilter($request->date)->type($request->interval)))
            ->with("interval")
            ->search($request->search);
        $reservationsCount = $query->count();

        $reservations = $query->paginate(20);
        $totalGuestsSum = $query->select(DB::raw('sum(guests_count) as guests_sum'))->first()->guests_sum;
        return view('dashboard.reservations.index', \compact('reservations', 'title', 'reservationsCount', 'totalGuestsSum'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $this->validate($request, ["is_accepted" => "required|numeric|in:0,1,2"]);
        $reservation->update($request->all());
        return \back();
    }
}