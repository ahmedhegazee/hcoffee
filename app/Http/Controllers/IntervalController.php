<?php

namespace App\Http\Controllers;

use App\Models\Interval;
use Illuminate\Http\Request;

class IntervalController extends Controller
{
    public function index(Request $request)
    {
        $title = "فترات الحجز";
        $intervals = Interval::dateFilter($request->start_date, $request->end_date)
            ->where(function ($queury) use ($request) {
                $queury->type($request->type)
                    ->status($request->status);
            })
            ->paginate(10);
        return view('dashboard.intervals.index', \compact('intervals', 'title'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interval $interval)
    {
        $rules = [
            'max_guests_count' => "required|numeric",
        ];
        $this->validate($request, $rules);
        if ($request->max_guests_count < $interval->guests_count) {
            return \back()->with("errorMessage", "لا يمكن ان يكون اقصى عدد للحاضرين اقل من عدد الحاجزين");
        }
        if ($request->max_guests_count == $interval->guests_count) {
            $request->merge(["is_completed" => 1]);
        } elseif ($request->max_guests_count > $interval->guests_count && $interval->is_completed) {
            $request->merge(["is_completed" => 0]);
        }
        $interval->update($request->all());
        return \back()->with("successMessage", "تم الحفظ بنجاح");
    }
}