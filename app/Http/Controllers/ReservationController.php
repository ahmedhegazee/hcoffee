<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "الحجوزات";
        $reservations = Reservation::paginate(20);
        return view('dashboard.reservations.index', \compact('reservations', 'title'));
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