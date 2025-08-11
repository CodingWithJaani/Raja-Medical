@extends('layouts.admin')

@section('title', 'Products - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Products</h1>
        <p class="text-muted">Manage your product catalog</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Product
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($product->images && count($product->images) > 0)
                                            <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" 
                                                 class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <strong>{{ $product->name }}</strong>
                                            <br><small class="text-muted">SKU: {{ $product->sku }}</small>
                                            @if($product->is_featured)
                                                <br><span class="badge bg-warning">Featured</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->category->name }}</td>
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
                                        <form action="{{ route('admin.products.destroy', $product) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-box text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Products Found</h4>
                <p class="text-muted">Start by adding your first product to the catalog.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add First Product
                </a>
            </div>
        @endif
    </div>
</div>
@endsection