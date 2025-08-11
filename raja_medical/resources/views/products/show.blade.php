@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name . ' - Raja Medical')
@section('description', $product->meta_description ?: $product->short_description ?: Str::limit($product->description, 160))

@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-6">
            <!-- Product Images -->
            <div class="card border-0 shadow-sm">
                @if($product->images && count($product->images) > 0)
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($product->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ $image }}" class="d-block w-100" alt="{{ $product->name }}" 
                                         style="height: 400px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                        @if(count($product->images) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        @endif
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                        <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="ps-lg-4">
                <!-- Product Info -->
                <div class="mb-3">
                    <span class="badge bg-primary">{{ $product->category->name }}</span>
                    @if($product->discount_percentage > 0)
                        <span class="badge bg-danger">{{ $product->discount_percentage }}% OFF</span>
                    @endif
                    @if($product->is_featured)
                        <span class="badge bg-warning">Featured</span>
                    @endif
                </div>
                
                <h1 class="h2 mb-3">{{ $product->name }}</h1>
                
                @if($product->brand)
                    <p class="text-muted mb-2"><strong>Brand:</strong> {{ $product->brand }}</p>
                @endif
                
                <p class="text-muted mb-3"><strong>SKU:</strong> {{ $product->sku }}</p>
                
                <!-- Pricing -->
                <div class="mb-4">
                    @if($product->sale_price)
                        <span class="h3 text-primary">${{ $product->sale_price }}</span>
                        <span class="h5 text-muted text-decoration-line-through ms-2">${{ $product->price }}</span>
                        <div class="text-success">You save ${{ number_format($product->price - $product->sale_price, 2) }}</div>
                    @else
                        <span class="h3 text-primary">${{ $product->price }}</span>
                    @endif
                </div>
                
                <!-- Stock Status -->
                <div class="mb-4">
                    @if($product->stock_quantity > 0)
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> 
                            <strong>In Stock</strong> - {{ $product->stock_quantity }} available
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="bi bi-x-circle"></i> 
                            <strong>Out of Stock</strong>
                        </div>
                    @endif
                </div>
                
                <!-- Short Description -->
                @if($product->short_description)
                    <div class="mb-4">
                        <h5>Overview</h5>
                        <p class="text-muted">{{ $product->short_description }}</p>
                    </div>
                @endif
                
                <!-- Contact for Purchase -->
                <div class="mb-4">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg me-3">
                        <i class="bi bi-envelope"></i> Contact for Purchase
                    </a>
                    <a href="tel:+15551234567" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-telephone"></i> Call Now
                    </a>
                </div>
                
                <!-- Product Features -->
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title">Why Choose This Product?</h6>
                        <ul class="list-unstyled mb-0 small">
                            <li><i class="bi bi-check-circle text-success me-2"></i> Professional grade quality</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Fast and reliable delivery</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Technical support included</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i> Competitive pricing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Description -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Product Description</h4>
                    <div class="mt-3">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="mb-4">Related Products</h4>
                <div class="row">
                    @foreach($relatedProducts as $related)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card product-card h-100">
                                @if($related->images && count($related->images) > 0)
                                    <img src="{{ $related->images[0] }}" class="card-img-top" alt="{{ $related->name }}" 
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ $related->name }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($related->short_description ?: $related->description, 80) }}</p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                @if($related->sale_price)
                                                    <span class="fw-bold text-primary">${{ $related->sale_price }}</span>
                                                    <small class="text-muted text-decoration-line-through">${{ $related->price }}</small>
                                                @else
                                                    <span class="fw-bold text-primary">${{ $related->price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <a href="{{ route('products.show', $related->slug) }}" class="btn btn-primary btn-sm w-100">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection