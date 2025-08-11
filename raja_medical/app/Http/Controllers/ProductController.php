<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ContactQuery;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);
        
        $categories = Category::where('is_active', true)->get();
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->limit(6)
            ->get();

        return view('products.index', compact('products', 'categories', 'featuredProducts'));
    }

    public function show($slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products.category', compact('category', 'products'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        ContactQuery::create($request->all());

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
