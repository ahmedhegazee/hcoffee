<?php

namespace App\Http\Controllers;

use App\Models\HomeSetting;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index(Request $request)
    {
        $title = "اعدادات الصفحة الرئيسية";
        $settings = HomeSetting::first();
        return view('dashboard.home_page_settings.index', \compact('settings', 'title'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            "notes" => "required|string",
            "description" => "required|string",
        ]);
        $settings = HomeSetting::first();
        $notes = collect(\explode("\n", $request->notes))->map(fn ($str) => str_replace("\r", "", $str))->toArray();
        $request->merge(["notes" => $notes]);
        $settings->update($request->all());
        return \back();
    }
}