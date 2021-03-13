<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HomePageImage;
use Illuminate\Http\Request;

class HomeImagePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Slider Images Index";
        $images = HomePageImage::paginate(10);
        return view('dashboard.home_images.index', \compact('images', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Slider Images";
        return view('dashboard.home_images.create', \compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            "image" => "required|image|max:20480",
        ];
        $this->validate($request, $rules);
        $image_src = $request->file('image')->store('sliders', ['disk' => 'public']);
        $request->merge(['image_src' => $image_src]);
        HomePageImage::create($request->all());
        return \redirect(route('admin.slider.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HomePageImage $slider)
    {
        $title = "Edit Slider Images";
        return view('dashboard.home_images.edit', \compact('title', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomePageImage $slider)
    {
        $rules = [
            'title' => "required|array",
            'title.*' => "required|string|min:3|max:191",
            'sub_title' => "required|array",
            'sub_title.*' => "required|string|min:3|max:191",
            "image" => "sometimes|image|max:20480",
        ];
        $this->validate($request, $rules);
        if ($request->has('image')) {
            unlink(\public_path('storage/' . $slider->image_src));
            $image_src = $request->file('image')->store('sliders', ['disk' => 'public']);
            $request->merge(['image_src' => $image_src]);
        }

        $slider->update($request->all());
        return \redirect(route('admin.slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomePageImage $slider)
    {
        unlink(\public_path('storage/' . $slider->image_src));
        $slider->delete();
        return \back();
    }
}