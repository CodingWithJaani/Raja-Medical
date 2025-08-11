@extends('layouts.app')

@section('title', 'Medical Products - Raja Medical')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 mb-4">Quality Medical Products</h1>
                <p class="lead mb-4">Discover our comprehensive range of medical equipment and supplies, trusted by healthcare professionals worldwide.</p>
                <a href="#products" class="btn btn-light btn-lg">Browse Products</a>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="bi bi-heart-pulse-fill" style="font-size: 200px; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

@if($featuredProducts->count() > 0)
<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Products</h2>
        <div class="row">
            @foreach($featuredProducts as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ $product->images[0] }}" class="card-img-top" alt="{{ $product->name }}" 
                                 style="height: 200px; object-fit: cover;"
                                 onerror="this.src='/images/products/placeholder.svg'">
                        @else
                            <img src="/images/products/placeholder.svg" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @endif
                        
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-primary">{{ $product->category->name }}</span>
                                @if($product->discount_percentage > 0)
                                    <span class="badge bg-danger">{{ $product->discount_percentage }}% OFF</span>
                                @endif
                            </div>
                            
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->short_description ?: $product->description, 100) }}</p>
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        @if($product->sale_price)
                                            <span class="h5 text-primary">${{ $product->sale_price }}</span>
                                            <small class="text-muted text-decoration-line-through">${{ $product->price }}</small>
                                        @else
                                            <span class="h5 text-primary">${{ $product->price }}</span>
                                        @endif
                                    </div>
                                    @if($product->stock_quantity > 0)
                                        <small class="text-success">In Stock</small>
                                    @else
                                        <small class="text-danger">Out of Stock</small>
                                    @endif
                                </div>
                                
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Categories -->
@if($categories->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Browse by Category</h2>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('products.category', $category->slug) }}" class="text-decoration-none">
                        <div class="card text-center h-100">
                            @if($category->image)
                                <img src="{{ $category->image }}" class="card-img-top" alt="{{ $category->name }}" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-primary text-white" style="height: 150px;">
                                    <i class="bi bi-tag-fill" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $category->name }}</h5>
                                <p class="card-text text-muted small">{{ $category->products_count ?? $category->products->count() }} Products</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- All Products -->
<section class="py-5" id="products">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>All Products</h2>
            <div class="d-flex gap-2">
                <!-- Add search and filter buttons here -->
            </div>
        </div>
        
        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card product-card h-100">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ $product->images[0] }}" class="card-img-top" alt="{{ $product->name }}" 
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.src='/images/products/placeholder.svg'">
                            @else
                                <img src="/images/products/placeholder.svg" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge bg-primary">{{ $product->category->name }}</span>
                                    @if($product->discount_percentage > 0)
                                        <span class="badge bg-danger">{{ $product->discount_percentage }}% OFF</span>
                                    @endif
                                </div>
                                
                                <h6 class="card-title">{{ $product->name }}</h6>
                                <p class="card-text text-muted small">{{ Str::limit($product->short_description ?: $product->description, 80) }}</p>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            @if($product->sale_price)
                                                <span class="fw-bold text-primary">${{ $product->sale_price }}</span>
                                                <small class="text-muted text-decoration-line-through">${{ $product->price }}</small>
                                            @else
                                                <span class="fw-bold text-primary">${{ $product->price }}</span>
                                            @endif
                                        </div>
                                        @if($product->stock_quantity > 0)
                                            <small class="text-success">In Stock</small>
                                        @else
                                            <small class="text-danger">Out of Stock</small>
                                        @endif
                                    </div>
                                    
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary btn-sm w-100">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-box text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Products Found</h4>
                <p class="text-muted">Check back later for new products.</p>
            </div>
        @endif
    </div>
</section>
@endsection