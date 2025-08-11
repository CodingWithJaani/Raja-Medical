@extends('layouts.admin')

@section('title', 'View Product - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Product Details</h1>
        <p class="text-muted">{{ $product->name }}</p>
    </div>
    <div class="btn-group">
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Product
        </a>
        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-info" target="_blank">
            <i class="bi bi-eye"></i> View on Site
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Basic Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Product Name:</strong><br>
                        <p>{{ $product->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Brand:</strong><br>
                        <p>{{ $product->brand ?: 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <strong>Category:</strong><br>
                        <p><span class="badge bg-primary">{{ $product->category->name }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <strong>SKU:</strong><br>
                        <p><code>{{ $product->sku }}</code></p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <strong>Short Description:</strong><br>
                    <p>{{ $product->short_description ?: 'No short description provided' }}</p>
                </div>
                
                <div class="mb-0">
                    <strong>Full Description:</strong><br>
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pricing & Inventory -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Pricing & Inventory</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong>Regular Price:</strong><br>
                        <h4 class="text-primary">${{ $product->price }}</h4>
                    </div>
                    <div class="col-md-3">
                        <strong>Sale Price:</strong><br>
                        @if($product->sale_price)
                            <h4 class="text-success">${{ $product->sale_price }}</h4>
                            <small class="text-muted">{{ $product->discount_percentage }}% OFF</small>
                        @else
                            <p class="text-muted">No sale price</p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <strong>Current Price:</strong><br>
                        <h4 class="text-dark">${{ $product->current_price }}</h4>
                    </div>
                    <div class="col-md-3">
                        <strong>Stock Quantity:</strong><br>
                        @if($product->stock_quantity > 0)
                            <h4 class="text-success">{{ $product->stock_quantity }}</h4>
                            <small class="text-success">In Stock</small>
                        @else
                            <h4 class="text-danger">0</h4>
                            <small class="text-danger">Out of Stock</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SEO Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">SEO Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Meta Title:</strong><br>
                    <p>{{ $product->meta_title ?: 'Default: ' . $product->name . ' - Raja Medical' }}</p>
                </div>
                
                <div class="mb-3">
                    <strong>Meta Description:</strong><br>
                    <p>{{ $product->meta_description ?: 'Default: ' . Str::limit($product->short_description ?: $product->description, 160) }}</p>
                </div>
                
                <div class="mb-0">
                    <strong>URL Slug:</strong><br>
                    <p><code>{{ $product->slug }}</code></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Product Image -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Product Image</h5>
            </div>
            <div class="card-body text-center">
                @if($product->images && count($product->images) > 0)
                    <img src="{{ $product->images[0] }}" class="img-fluid rounded mb-3" alt="{{ $product->name }}"
                         onerror="this.src='/images/products/placeholder.svg'">
                @else
                    <img src="/images/products/placeholder.svg" class="img-fluid rounded mb-3" alt="{{ $product->name }}">
                @endif
                
                <div class="d-grid">
                    <small class="text-muted">
                        @if($product->images && count($product->images) > 0)
                            {{ count($product->images) }} image(s) available
                        @else
                            No images uploaded
                        @endif
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Status & Timestamps -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Status & Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Status:</strong><br>
                    @if($product->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                    
                    @if($product->is_featured)
                        <span class="badge bg-warning">Featured</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <small class="text-muted">
                        {{ $product->created_at->format('M j, Y g:i A') }}<br>
                        ({{ $product->created_at->diffForHumans() }})
                    </small>
                </div>
                
                <div class="mb-0">
                    <strong>Last Updated:</strong><br>
                    <small class="text-muted">
                        {{ $product->updated_at->format('M j, Y g:i A') }}<br>
                        ({{ $product->updated_at->diffForHumans() }})
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Product
                    </a>
                    
                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-info" target="_blank">
                        <i class="bi bi-eye"></i> View on Website
                    </a>
                    
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-trash"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection