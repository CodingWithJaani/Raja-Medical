@extends('layouts.admin')

@section('title', 'Admin Dashboard - Raja Medical')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h3 mb-0">Dashboard</h1>
        <p class="text-muted">Welcome to Raja Medical Admin Panel</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card stats-card text-center">
            <div class="card-body">
                <i class="bi bi-box display-4 mb-2"></i>
                <h3>{{ $totalProducts }}</h3>
                <p class="mb-0">Total Products</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-success text-white text-center">
            <div class="card-body">
                <i class="bi bi-check-circle display-4 mb-2"></i>
                <h3>{{ $activeProducts }}</h3>
                <p class="mb-0">Active Products</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-info text-white text-center">
            <div class="card-body">
                <i class="bi bi-tags display-4 mb-2"></i>
                <h3>{{ $totalCategories }}</h3>
                <p class="mb-0">Categories</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-warning text-white text-center">
            <div class="card-body">
                <i class="bi bi-chat-dots display-4 mb-2"></i>
                <h3>{{ $unreadQueries }}</h3>
                <p class="mb-0">Unread Queries</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Add Product
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-info w-100">
                            <i class="bi bi-tag"></i> Add Category
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-list"></i> View Products
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.queries') }}" class="btn btn-warning w-100">
                            <i class="bi bi-envelope"></i> View Queries
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Products</h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentProducts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProducts as $product)
                                    <tr>
                                        <td>
                                            <strong>{{ $product->name }}</strong>
                                            <br><small class="text-muted">{{ $product->sku }}</small>
                                        </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            @if($product->sale_price)
                                                <span class="text-primary">${{ $product->sale_price }}</span>
                                                <small class="text-muted text-decoration-line-through">${{ $product->price }}</small>
                                            @else
                                                <span class="text-primary">${{ $product->price }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock_quantity > 0)
                                                <span class="badge bg-success">{{ $product->stock_quantity }}</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No products found.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Queries</h5>
                <a href="{{ route('admin.queries') }}" class="btn btn-sm btn-outline-warning">View All</a>
            </div>
            <div class="card-body">
                @if($recentQueries->count() > 0)
                    @foreach($recentQueries as $query)
                        <div class="d-flex mb-3 {{ !$query->is_read ? 'border-start border-primary border-3 ps-2' : '' }}">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $query->name }}</h6>
                                <p class="mb-1 small text-muted">{{ $query->subject }}</p>
                                <small class="text-muted">{{ $query->created_at->diffForHumans() }}</small>
                                @if(!$query->is_read)
                                    <span class="badge bg-primary ms-1">New</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No queries found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection