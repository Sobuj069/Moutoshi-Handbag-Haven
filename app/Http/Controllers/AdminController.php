<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Show product creation form
    public function create()
    {
        return view('admin.create_product');
    }

    // Store new product
    public function store(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        // Save to database
        Product::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }

    // Show admin dashboard (optional)
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.dashboard', compact('products'));
    }
       public function showLoginForm()
    {
        return view('admin.login'); // create this blade for admin login form
    }

    public function login(Request $request)
    {
        // validate login data
        $credentials = $request->only('email', 'password');

        // attempt login with admin guard or check admin role
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or not an admin.',
        ]);
    }
      public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

}
