@extends('Admin.layout.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ $product->exists ? 'Edit' : 'Create' }} Product</h2>

    {{-- Success / Error Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if($product->exists) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}" class="form-control">
                <small class="text-muted">Separate with commas</small>
            </div>

            <div class="col-12">
                <label class="form-label">Short Description</label>
                <input type="text" name="short_description" value="{{ old('short_description', $product->short_description) }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Price (₹)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" step="0.01">
            </div>

            <div class="col-md-6">
                <label class="form-label">MRP Price (₹)</label>
                <input type="number" name="mrp_price" value="{{ old('mrp_price', $product->mrp_price) }}" class="form-control" step="0.01">
            </div>
 <div class="col-md-6">
                <label class="form-label">Quantity</label>
                <input type="text" name="qnty" value="{{ old('qnty', $product->qnty) }}" class="form-control" placeholder="e.g., 500ml, 1kg, 30 tablets">
                <small class="text-muted">Specify unit type like 500ml, 1kg, 30 capsules etc.</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">Discount (%)</label>
                <input type="number" name="discount" value="{{ old('discount', $product->discount) }}" class="form-control" step="0.01" min="0" max="100">
                <small class="text-muted">Enter discount percentage (e.g., 10 for 10%)</small>
            </div>

            <div class="col-12">
                <label class="form-label">Key Benefits</label>
                <textarea name="key_benefits" class="form-control" rows="3">{{ old('key_benefits', $product->key_benefits) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Ingredients</label>
                <textarea name="ingredient" class="form-control" rows="3">{{ old('ingredient', $product->ingredient) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Upload Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
                <small class="text-muted">You can select multiple images</small>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ $product->exists ? 'Update' : 'Create' }} Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

    {{-- Existing Images --}}
    @if ($product->exists && $product->images->count())
        <hr class="my-4">
        <h5>Existing Images</h5>
        <div class="row g-3 mt-2">
            @foreach ($product->images as $image)
                <div class="col-md-3 text-center">
                    <img src="{{ asset($image->image_path) }}" class="img-fluid rounded mb-2" style="max-height: 150px;">
                    <form method="POST" action="{{ route('admin.products.images.destroy', [$product->id, $image->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger w-100">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => { console.error(error); });
</script>
@endsection
