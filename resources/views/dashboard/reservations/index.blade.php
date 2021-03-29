@extends('layouts.dashboard')

@section('content')
<div class="row">
    <form action="{{ route('admin.reservation.index') }}" method="GET" style="width: 100%">
        <div class="row">
            <div class="form-group col-md-3" style="direction: rtl">
                <label for="searchFilter" style="width: 100%;text-align: right;">البحث</label>
                <input class="form-control" type="text" name="search" id="searchFilter"
                    placeholder="اسم العميل او رقم الهاتف">
            </div>
            <div class="form-group col-md-3" style="direction: rtl">
                <label for="dateFilter" style="text-align: right;width: 100%;">التاريخ</label>
                <input class="form-control" type="date" name="date" id="dateFilter">
            </div>
            <div class="form-group col-md-3" style="direction: rtl">
                <label for="exampleFormControlSelect1" style="text-align: right;width: 100%;">الفترة</label>
                <select class="form-control" id="exampleFormControlSelect1" name="interval">
                    <option value="" {{ request('interval')==""?'selected':'' }}>اختر فترة</option>
                    <option value="1" {{ request('interval')=="1"?'selected':'' }}>من ٦ الى ١٠ مساء</option>
                    <option value="2" {{ request('interval')=="2"?'selected':'' }}>من ١٠ الى ١٢ مساء</option>
                </select>
            </div>
            <div class="col-md-2 pt-4"><button class="btn btn-primary">فلتر</button></div>
        </div>
    </form>
</div>
<table class="table table-hover text-nowrap" style="text-align: center">
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>رقم الجوال</th>
            <th>حالة الدفع</th>
            <th>المبلغ الاجمالي</th>
            <th>التاريخ</th>
            <th>عدد الاشخاص</th>
            <th>الفترة</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->phone }}</td>
            <td>{{ $reservation->payment_status }}</td>
            <td>{{ $reservation->total_amount }}</td>
            <td>{{ $reservation->interval->date }}</td>
            <td>{{ $reservation->guests_count }}</td>
            <td>{{ $reservation->interval->type }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row justify-content-end mb-3 mt-3" style="border-top:2px solid #aaa;text-align:right">
    <div class="col-4">
        <h3 class="d-inline">اجمالي عدد الحجوزات : {{ $reservationsCount }}</h3>
    </div>
    <div class="col-4">
        <h3 class="d-inline">اجمالي عدد الاشخاص : {{ $totalGuestsSum }}</h3>
    </div>
</div>
<div class="row justify-content-center">
    {{ $reservations->appends(['search' => request('search'),'date'=>request('date'),'interval'=>request('interval')]) }}
</div>
@endsection
@push('scripts')
@include('partials.update-script')
@endpush
