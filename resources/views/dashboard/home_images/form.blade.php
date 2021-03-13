{{-- {{ dd($errors) }} --}}
<div class="row">
    @foreach ($langs as $lang)
    <div class="form-group col-md-6">
        <label for="title">Title {{ $lang }}</label>
        <input type="text" class="form-control @error('title.'.$lang) is-invalid @enderror " id="title"
            placeholder="Enter title" value="{{ $slider->title[$lang]??old('title.'.$lang) }}"
            name="title[{{ $lang }}]">
        @error('title.'.$lang)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endforeach


    @foreach ($langs as $lang)
    <div class="form-group col-md-6">
        <label for="sub_title">Sub Title {{ $lang }}</label>
        <input type="text" class="form-control @error('sub_title.'.$lang) is-invalid @enderror" id="sub_title"
            placeholder="Enter subtitle" value="{{ $slider->sub_title[$lang]??old('sub_title.'.$lang) }}"
            name="sub_title[{{$lang  }}]">
        @error('sub_title.'.$lang)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endforeach
    <div class="form-group col-md-12">
        <label for="image">Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image"
                    name="image" accept="image/*">
                <label class="custom-file-label" for="image">Choose Image</label>
            </div>
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
