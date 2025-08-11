@extends('layouts.admin')

@section('title', 'Edit Category - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Edit Category</h1>
        <p class="text-muted">Update category information</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Current slug: <code>{{ $category->slug }}</code></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Brief description of what products belong to this category</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image URL</label>
                        <input type="url" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" value="{{ old('image', $category->image) }}" 
                               placeholder="https://example.com/category-image.jpg">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Optional: URL to category image (leave empty for default icon)</div>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                               value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active Category
                        </label>
                        <div class="form-text">Only active categories will be displayed on the website</div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check"></i> Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Current Category</h5>
            </div>
            <div class="card-body">
                @if($category->image)
                    <img src="{{ $category->image }}" class="img-fluid rounded mb-3" alt="{{ $category->name }}">
                @else
                    <div class="bg-primary rounded d-flex align-items-center justify-content-center text-white mb-3" 
                         style="height: 150px;">
                        <i class="bi bi-tag" style="font-size: 3rem;"></i>
                    </div>
                @endif
                
                <div class="mb-3">
                    <strong>Status:</strong>
                    @if($category->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <strong>Products:</strong>
                    <span class="badge bg-info">{{ $category->products()->count() }} Products</span>
                </div>
                
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <small class="text-muted">{{ $category->created_at->format('M j, Y g:i A') }}</small>
                </div>
                
                <div class="mb-0">
                    <strong>Last Updated:</strong><br>
                    <small class="text-muted">{{ $category->updated_at->format('M j, Y g:i A') }}</small>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('products.category', $category->slug) }}" class="btn btn-info" target="_blank">
                        <i class="bi bi-eye"></i> View Category on Site
                    </a>
                    
                    @if($category->products()->count() == 0)
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete Category
                            </button>
                        </form>
                    @else
                        <button class="btn btn-danger" disabled title="Cannot delete category with products">
                            <i class="bi bi-trash"></i> Delete Category ({{ $category->products()->count() }} products)
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection