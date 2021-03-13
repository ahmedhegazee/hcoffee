{{-- {{ dd($errors) }} --}}
<div class="row">
    @foreach ($langs as $lang)
    <div class="form-group col-md-6">
        <label for="title">Title {{ $lang }}</label>
        <input type="text" class="form-control @error('title.'.$lang) is-invalid @enderror " id="title"
            placeholder="Enter title" value="{{ $product->title[$lang]??old('title.'.$lang) }}"
            name="title[{{ $lang }}]">
        @error('title.'.$lang)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endforeach

    <div class="col-md-6">
        <!-- select -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror " id="price"
                placeholder="Enter price" value="{{ $product->price??old('price') }}" name="price">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <!-- select -->
        <div class="form-group">
            <label>Category</label>
            <select class="form-control @error('product_category_id') is-invalid @enderror" name="product_category_id"
                id="product_category_id">
                <option disabled> Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{($product->product_category_id??old('product_category_id'))==$category->id?'selected':'' }}>
                    {{ $category->name['en'] }}</option>
                @endforeach

            </select>
            @error('product_category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="image">Main Image</label>
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
