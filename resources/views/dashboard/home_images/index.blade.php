@extends('layouts.dashboard')

@section('content')
<div class="row justify-content-end mb-2 mr-2">
    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary"><i class="fas fa-plus    "></i> Add</a>
</div>
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>Image</th>
            @foreach ($langs as $lang)
            <th>Title {{ $lang }}</th>
            <th>SubTitle {{ $lang }}</th>
            @endforeach

            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($images as $image)
        <tr>
            <td><img src="{{ asset($image->image_src) }}" alt="" width="100px" height="100px"></td>
            @foreach ($langs as $lang)
            <td>{{ $image->title[$lang] }}</td>
            <td>{{ $image->sub_title[$lang] }}</td>
            @endforeach
            <td>
                <a href="{{ route('admin.slider.edit',$image->id) }}" class="btn btn-success"><i class="fas fa-edit"
                        aria-hidden="true"></i>Edit</a>
                <a href="#" class="btn btn-danger" onclick="event.preventDefault();deleteRecord({{ $image->id }})"><i
                        class="fas fa-trash"></i> Delete</a>
                <form id="delete-form-{{ $image->id }}" action="{{ route('admin.slider.destroy',$image->id) }}"
                    method="POST" class="d-none">
                    @csrf
                    @method("delete")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row justify-content-center">
    {{ $images->links() }}
</div>
@endsection
@push('scripts')
@include('partials.delete-script')
@endpush
