@extends('layouts.admin')

@section('title', 'Categories - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Categories</h1>
        <p class="text-muted">Manage product categories</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Category
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($category->image)
                                            <img src="{{ $category->image }}" alt="{{ $category->name }}" 
                                                 class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-primary rounded me-3 d-flex align-items-center justify-content-center text-white" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="bi bi-tag"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <strong>{{ $category->name }}</strong>
                                            <br><small class="text-muted">{{ $category->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">{{ Str::limit($category->description, 100) ?: 'No description' }}</p>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $category->products_count }} Products</span>
                                </td>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.categories.show', $category) }}" 
                                           class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    {{ $category->products_count > 0 ? 'disabled title=Cannot delete category with products' : '' }}>
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
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-tags text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Categories Found</h4>
                <p class="text-muted">Start by creating your first product category.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add First Category
                </a>
            </div>
        @endif
    </div>
</div>
@endsection