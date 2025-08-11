@extends('layouts.admin')

@section('title', 'Add Category - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Add New Category</h1>
        <p class="text-muted">Create a new product category</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">URL slug will be automatically generated</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Brief description of what products belong to this category</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image URL</label>
                        <input type="url" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" value="{{ old('image') }}" 
                               placeholder="https://example.com/category-image.jpg">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Optional: URL to category image (leave empty for default icon)</div>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active Category
                        </label>
                        <div class="form-text">Only active categories will be displayed on the website</div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check"></i> Save Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Category Guidelines</h5>
            </div>
            <div class="card-body">
                <h6>Naming Best Practices:</h6>
                <ul class="small">
                    <li>Use clear, descriptive names</li>
                    <li>Keep names concise (2-3 words max)</li>
                    <li>Use title case (e.g., "Diagnostic Equipment")</li>
                    <li>Avoid special characters</li>
                </ul>
                
                <h6 class="mt-3">Medical Category Examples:</h6>
                <ul class="small text-muted">
                    <li>Diagnostic Equipment</li>
                    <li>Surgical Instruments</li>
                    <li>Patient Monitoring</li>
                    <li>Laboratory Equipment</li>
                    <li>Personal Protective Equipment</li>
                    <li>Rehabilitation Equipment</li>
                </ul>
                
                <h6 class="mt-3">Image Guidelines:</h6>
                <ul class="small">
                    <li>Recommended size: 400x300px</li>
                    <li>Format: JPG, PNG, or WebP</li>
                    <li>Professional, medical-themed images</li>
                    <li>White or clean background preferred</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection