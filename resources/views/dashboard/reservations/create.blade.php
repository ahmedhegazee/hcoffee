@extends('layouts.dashboard')

@section('content')
<form action="{{ route('admin.product.store') }}" id="form" method="POST" enctype="multipart/form-data">
    @csrf
    @include("dashboard.products.form")
    <div class="row justify-content-end mr-2"><button class="btn btn-primary">Add</button></div>
</form>
@endsection
