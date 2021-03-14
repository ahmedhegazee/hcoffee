@extends('layouts.dashboard')

@section('content')
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>القيمة</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($settings as $setting)
        <tr>
            <td>{{ $setting->name }}</td>

            <td>
                <form id="update-form-{{ $setting->id }}" action="{{ route('admin.setting.update',$setting->id) }}"
                    method="POST">
                    @csrf
                    <input type="number" value="{{ $setting->value }}" name="value">
                    @method("put")
                    <button class="btn btn-secondary">حفظ</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-center">
    {{ $settings->links() }}
</div>
@endsection
@push('scripts')
@include('partials.update-script')
@endpush
