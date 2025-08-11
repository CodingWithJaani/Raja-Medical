@extends('layouts.admin')

@section('title', 'View Category - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Category Details</h1>
        <p class="text-muted">{{ $category->name }}</p>
    </div>
    <div class="btn-group">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Categories
        </a>
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Category
        </a>
        <a href="{{ route('products.category', $category->slug) }}" class="btn btn-info" target="_blank">
            <i class="bi bi-eye"></i> View on Site
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Category Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Category Name:</strong><br>
                        <h4>{{ $category->name }}</h4>
                    </div>
                    <div class="col-md-6">
                        <strong>URL Slug:</strong><br>
                        <p><code>{{ $category->slug }}</code></p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <strong>Description:</strong><br>
                    @if($category->description)
                        <div class="bg-light p-3 rounded">
                            {!! nl2br(e($category->description)) !!}
                        </div>
                    @else
                        <p class="text-muted fst-italic">No description provided</p>
                    @endif
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        @if($category->is_active)
                            <span class="badge bg-success fs-6">Active</span>
                        @else
                            <span class="badge bg-secondary fs-6">Inactive</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Total Products:</strong><br>
                        <span class="badge bg-info fs-6">{{ $category->products()->count() }} Products</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products in this Category -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Products in this Category</h5>
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i> Add Product
                </a>
            </div>
            <div class="card-body">
                @if($category->products()->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->products()->latest()->get() as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($product->images && count($product->images) > 0)
                                                    <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" 
                                                         class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;"
                                                         onerror="this.src='/images/products/placeholder.svg'">
                                                @else
                                                    <img src="/images/products/placeholder.svg" alt="{{ $product->name }}" 
                                                         class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $product->name }}</strong>
                                                    @if($product->is_featured)
                                                        <span class="badge bg-warning badge-sm">Featured</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td><code>{{ $product->sku }}</code></td>
                                        <td>
                                            @if($product->sale_price)
                                                <span class="text-primary fw-bold">${{ $product->sale_price }}</span>
                                                <br><small class="text-muted text-decoration-line-through">${{ $product->price }}</small>
                                            @else
                                                <span class="text-primary fw-bold">${{ $product->price }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock_quantity > 0)
                                                <span class="badge bg-success">{{ $product->stock_quantity }}</span>
                                            @else
                                                <span class="badge bg-danger">Out</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.products.show', $product) }}" 
                                                   class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $product) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-box text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">No Products in this Category</h5>
                        <p class="text-muted">Add some products to this category to get started.</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add First Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Category Image -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Category Image</h5>
            </div>
            <div class="card-body text-center">
                @if($category->image)
                    <img src="{{ $category->image }}" class="img-fluid rounded mb-3" alt="{{ $category->name }}">
                @else
                    <div class="bg-primary rounded d-flex align-items-center justify-content-center text-white mb-3" 
                         style="height: 200px;">
                        <i class="bi bi-tag" style="font-size: 4rem;"></i>
                    </div>
                    <small class="text-muted">No image uploaded</small>
                @endif
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-primary">{{ $category->products()->count() }}</h3>
                        <small class="text-muted">Total Products</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-success">{{ $category->products()->where('is_active', true)->count() }}</h3>
                        <small class="text-muted">Active Products</small>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-warning">{{ $category->products()->where('is_featured', true)->count() }}</h3>
                        <small class="text-muted">Featured</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-danger">{{ $category->products()->where('stock_quantity', 0)->count() }}</h3>
                        <small class="text-muted">Out of Stock</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Timestamps -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <small class="text-muted">
                        {{ $category->created_at->format('M j, Y g:i A') }}<br>
                        ({{ $category->created_at->diffForHumans() }})
                    </small>
                </div>
                
                <div class="mb-0">
                    <strong>Last Updated:</strong><br>
                    <small class="text-muted">
                        {{ $category->updated_at->format('M j, Y g:i A') }}<br>
                        ({{ $category->updated_at->diffForHumans() }})
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection