@extends('layouts.dashboard')

@section('content')
<div class="row">
    <form action="{{ route('admin.reservation.index') }}" method="GET">
        <input type="text" name="search" placeholder="البحث">
        <input type="date" name="start_date" id="" placeholder="تاريخ البداية">
        <input type="date" name="start_date" id="" placeholder="تاريخ النهاية">
        <button class="btn btn-primary">فلتر</button>
    </form>
</div>
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>رقم الجوال</th>
            <th>حالة الدفع</th>
            <th>المبلغ الاجمالي</th>
            <th>التاريخ</th>
            <th>عدد الاشخاص</th>
            <th>الفترة</th>
            <th>الملاحظات</th>
            <th>حالة الحجز</th>
            <th>الاوامر</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->name }}</td>
            <td>{{ $reservation->phone }}</td>
            <td>{{ $reservation->payment_status }}</td>
            <td>{{ $reservation->total_amount }}</td>
            <td>{{ $reservation->date }}</td>
            <td>{{ $reservation->guests_count }}</td>
            <td>{{ $reservation->interval }}</td>
            <td>{{ $reservation->notes }}</td>
            <td>{{ $reservation->is_accepted }}</td>
            <td>
                <select onchange="changeReservationStatus({{ $reservation->id }})"
                    id="reservation-status-{{ $reservation->id }}">
                    <option disabled> اختر حالة الحجز</option>
                    <option value="0">في الانتظار</option>
                    <option value="1">تمت الموافقة</option>
                    <option value="2">تم الالغاء</option>
                </select>
                <a href="#" class="btn btn-success"
                    onclick="event.preventDefault();updateRecord({{ $reservation->id }})"><i class="fas fa-edit"></i>
                    تغيير حالة الحجز</a>
                <form id="update-form-{{ $reservation->id }}"
                    action="{{ route('admin.reservation.update',$reservation->id) }}" method="POST" class="d-none">
                    @csrf
                    <input type="number" value="0" id="update-{{ $reservation->id }}" name="is_accepted">
                    @method("put")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-center">
    {{ $reservations->appends(['search' => request('search'),'start_date'=>request('start_date'),'end_date'=>request('end_date')]) }}
</div>
@endsection
@push('scripts')
@include('partials.update-script')
@endpush
