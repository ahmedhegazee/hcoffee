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
    <select name="type">
        <option value="" disabled>اختر الفترة</option>
        <option value="0">الفترة الاولى</option>
        <option value="1">الفترة الثانية</option>
    </select>
    <select name="status">
        <option value="" disabled>اختر حالة الفترة</option>
        <option value="0">غير مكتمل</option>
        <option value="1">مكتمل</option>
    </select>
    <input type="date" name="start_date" placeholder="">
    <label for="">تاريخ البداية</label>

    <input type="date" name="start_date" placeholder="">
    <label for="">تاريخ النهاية</label>

    <button class="btn btn-primary">فلتر</button>
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
    {{ $intervals->appends(['start_date'=>request('start_date'),'end_date'=>request('end_date'),'type'=>request('type'),'status'=>request('status')]) }}
</div>
@endsection
