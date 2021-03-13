@extends('layouts.dashboard')

@section('content')
<form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row justify-content-center">
        <img src="{{ asset($product->image_src) }}" width="200px" alt="">
    </div>
    @include("dashboard.products.form")
    <div class="row justify-content-end mr-2"><button class="btn btn-primary" type="submit">Edit</button></div>
</form>
@endsection
