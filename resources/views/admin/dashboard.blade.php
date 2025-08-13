@extends('layouts.app')

@section('content')
    <h2>Welcome to Admin Dashboard</h2>
    <p>This is your admin dashboard where you can manage products, orders, etc.</p>

    <a href="{{ route('admin.products.create') }}" class="mb-3 btn btn-success">Add New Product</a>

    {{-- Example: list of products passed from controller --}}
    @if(isset($products) && $products->count())
        <div class="list-group">
            @foreach($products as $product)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $product->name }}</strong><br>
                        Price: {{ $product->price }} BDT
                    </div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                </div>
            @endforeach
        </div>
    @else
        <p>No products found.</p>
    @endif
@endsection
