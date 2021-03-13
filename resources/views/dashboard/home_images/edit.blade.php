@extends('layouts.dashboard')

@section('content')
<form action="{{ route('admin.slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row justify-content-center">
        <img src="{{ asset($slider->image_src) }}" width="200px" alt="">
    </div>
    @include("dashboard.home_images.form")
    <div class="row justify-content-end mr-2"><button class="btn btn-primary" type="submit">Edit</button></div>
</form>
@endsection
