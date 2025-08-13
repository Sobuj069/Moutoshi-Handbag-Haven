@extends('layouts.app')

@section('content')
<h2>Add New Product</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required />
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price (BDT)</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required />
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description (optional)</label>
        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Product Image (optional)</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" />
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
@endsection
