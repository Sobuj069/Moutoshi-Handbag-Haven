<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

public function index()
{
    $products = Product::latest()->get();
    return view('products.index', compact('products'));
}

public function create()
{
    return view('admin.products.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'nullable',
        'image' => 'nullable|image',
    ]);

    $imagePath = $request->file('image')?->store('products', 'public');

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index');
}

// Add edit(), update(), destroy() if needed

}
