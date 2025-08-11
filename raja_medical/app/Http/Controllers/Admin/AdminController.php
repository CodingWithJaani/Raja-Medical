<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ContactQuery;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalCategories = Category::count();
        $unreadQueries = ContactQuery::where('is_read', false)->count();
        
        $recentProducts = Product::with('category')->latest()->limit(5)->get();
        $recentQueries = ContactQuery::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts', 
            'activeProducts', 
            'totalCategories', 
            'unreadQueries',
            'recentProducts',
            'recentQueries'
        ));
    }

    public function queries()
    {
        $queries = ContactQuery::latest()->paginate(20);
        return view('admin.queries', compact('queries'));
    }

    public function markQueryAsRead(ContactQuery $query)
    {
        $query->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Query marked as read');
    }
}