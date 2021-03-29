@extends('layouts.dashboard')

@section('content')
<form id="update-form" action="{{ route('admin.home_page_setting.update') }}" method="POST">
    @csrf
    <h3>وصف الموقع</h3>
    <textarea name="description" id="textarea">
   {{ $settings->description }}
  </textarea>
    <hr>
    <h3>الملاحظات</h3>
    <div class="form-group">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"
            name="notes">{{ implode("\r\n",$settings->notes) }}</textarea>
    </div>
    <button class="btn btn-secondary">حفظ</button>
    @method("put")
</form>


@endsection
@push('scripts')
<script src="https://cdn.tiny.cloud/1/nod6du7iyuvpdzuxyqgraz11mlwq1i7mxnmw9q2sl60zckod/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
          selector: '#textarea',
          plugins: 'lists advlist autolink link charmap  preview hr anchor pagebreak',
          toolbar_mode: 'floating',
          toolbar: 'numlist bullist | undo redo | fontselect fontsizeselect forecolor formatselect | bold italic | alignleft aligncenter alignright alignjustify | formatting | styles',
          advlist_bullet_styles: 'circle'
       });
</script>
@endpush
