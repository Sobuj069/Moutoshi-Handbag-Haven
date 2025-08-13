@extends('layouts.app')

@section('content')
<h1>All Products</h1>
<div class="row">
    @foreach ($products as $product)
        <div class="mb-3 col-md-4">
            <div class="card">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" />
                @endif
                <div class="card-body">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->description }}</p>
                    <strong>{{ $product->price }} BDT</strong>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
