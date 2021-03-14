<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $title = "الاعدادات";
        $settings = Setting::paginate(20);
        return view('dashboard.settings.index', \compact('settings', 'title'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        $this->validate($request, ["value" => "required|numeric"]);
        $setting->update($request->all());
        return \back();
    }
}