@extends('layouts.admin')

@section('title', 'Customer Queries - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Customer Queries</h1>
        <p class="text-muted">Manage customer inquiries and messages</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($queries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queries as $query)
                            <tr class="{{ !$query->is_read ? 'table-warning' : '' }}">
                                <td>
                                    <div>
                                        <strong>{{ $query->name }}</strong>
                                        <br><small class="text-muted">{{ $query->email }}</small>
                                        @if($query->phone)
                                            <br><small class="text-muted">{{ $query->phone }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <strong>{{ $query->subject }}</strong>
                                </td>
                                <td>
                                    <p class="mb-0">{{ Str::limit($query->message, 100) }}</p>
                                    @if(strlen($query->message) > 100)
                                        <button class="btn btn-sm btn-link p-0" type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#message-{{ $query->id }}">
                                            Read more...
                                        </button>
                                        <div class="collapse" id="message-{{ $query->id }}">
                                            <div class="mt-2 p-2 bg-light rounded">
                                                {{ $query->message }}
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ $query->created_at->format('M j, Y') }}</small>
                                    <br><small class="text-muted">{{ $query->created_at->format('g:i A') }}</small>
                                </td>
                                <td>
                                    @if($query->is_read)
                                        <span class="badge bg-success">Read</span>
                                    @else
                                        <span class="badge bg-warning">Unread</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(!$query->is_read)
                                            <form action="{{ route('admin.queries.read', $query) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success" 
                                                        title="Mark as Read">
                                                    <i class="bi bi-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="mailto:{{ $query->email }}" class="btn btn-sm btn-primary" 
                                           title="Reply via Email">
                                            <i class="bi bi-reply"></i>
                                        </a>
                                        
                                        @if($query->phone)
                                            <a href="tel:{{ $query->phone }}" class="btn btn-sm btn-info" 
                                               title="Call Customer">
                                                <i class="bi bi-telephone"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $queries->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-chat-dots text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">No Customer Queries</h4>
                <p class="text-muted">Customer inquiries will appear here when they submit the contact form.</p>
            </div>
        @endif
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <h3>{{ $queries->where('is_read', false)->count() }}</h3>
                <p class="mb-0">Unread Queries</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h3>{{ $queries->where('is_read', true)->count() }}</h3>
                <p class="mb-0">Read Queries</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h3>{{ $queries->count() }}</h3>
                <p class="mb-0">Total Queries</p>
            </div>
        </div>
    </div>
</div>
@endsection