@extends('layouts.dashboard')

@section('content')
<form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include("dashboard.home_images.form")
    <div class="row justify-content-end mr-2"><button class="btn btn-primary" type="submit">Add</button></div>
</form>
@endsection
