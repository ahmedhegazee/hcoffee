@extends('layouts.dashboard')

@section('content')
@if (session('errorMessage'))
<div class="alert alert-danger">
    {{ session('errorMessage') }}
</div>
@endif
@if (session('successMessage'))
<div class="alert alert-success">
    {{ session('successMessage') }}
</div>
@endif
<form action="{{ route('admin.interval.index') }}" method="GET">
    <div class="row">
        <div class="form-group col-md-2" style="direction: rtl">
            <label for="dateFilter" style="text-align: right;width: 100%;">تاريخ </label>
            <input class="form-control" type="date" name="date" id="dateFilter">
        </div>
        <div class="form-group col-md-3" style="direction: rtl">
            <label for="exampleFormControlSelect1" style="text-align: right;width: 100%;">الفترة</label>
            <select class="form-control" id="exampleFormControlSelect1" name="type">
                <option value="" {{ request('type')==""?'selected':'' }}>اختر فترة</option>
                <option value="1" {{ request('type')=="1"?'selected':'' }}>من ٦ الى ١٠ مساء</option>
                <option value="2" {{ request('type')=="2"?'selected':'' }}>من ١٠ الى ١٢ مساء</option>
            </select>
        </div>
        <div class="form-group col-md-3" style="direction: rtl">
            <label for="exampleFormControlSelect1" style="text-align: right;width: 100%;">الفترة</label>
            <select class="form-control" id="exampleFormControlSelect1" name="status">
                <option value="" {{ request('status')==""?'selected':'' }}>اختر حالة الفترة</option>
                <option value="1" {{ request('status')=="1"?'selected':'' }}>غير مكتمل</option>
                <option value="2" {{ request('status')=="2"?'selected':'' }}>مكتمل</option>
            </select>
        </div>
        <div class="col-md-2 pt-4"><button class="btn btn-primary">فلتر</button></div>
    </div>
</form>
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>التاريخ</th>
            <th>الفترة</th>
            <th>مكتمل</th>
            <th>اقصى عدد للحاضرين</th>
            <th>عدد الحاجزين</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($intervals as $interval)
        <tr>
            <td>
                {{ $interval->date }}
            </td>
            <td>{{ $interval->type }}</td>
            <td>{{ $interval->is_completed }}</td>
            <td>
                <form action="{{ route('admin.interval.update',$interval->id) }}" method="POST">
                    <input type="number" name="max_guests_count" value="{{ $interval->max_guests_count }}"
                        min="{{ $interval->guests_count }}" id="">
                    @csrf
                    <button class="btn btn-secondary">حفظ</button>
                    @method("put")
                </form>

            </td>
            <td>{{ $interval->guests_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-center">
    {{ $intervals->appends(['date'=>request('date'),'type'=>request('type'),'status'=>request('status')]) }}
</div>
@endsection
