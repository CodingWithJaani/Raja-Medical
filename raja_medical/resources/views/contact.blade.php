@extends('layouts.app')

@section('title', 'Contact Us - Raja Medical')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-5 mb-3">Contact Us</h1>
                <p class="lead text-muted">Get in touch with our team for any inquiries about our medical products</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select @error('subject') is-invalid @enderror" 
                                            id="subject" name="subject" required>
                                        <option value="">Choose a subject...</option>
                                        <option value="Product Inquiry" {{ old('subject') == 'Product Inquiry' ? 'selected' : '' }}>
                                            Product Inquiry
                                        </option>
                                        <option value="Bulk Order" {{ old('subject') == 'Bulk Order' ? 'selected' : '' }}>
                                            Bulk Order
                                        </option>
                                        <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>
                                            Technical Support
                                        </option>
                                        <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }}>
                                            Partnership Opportunity
                                        </option>
                                        <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-send"></i> Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 bg-primary text-white h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Get in Touch</h5>
                            <p class="card-text">We're here to help you find the right medical equipment for your needs.</p>
                            
                            <div class="mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-geo-alt-fill me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Address</strong><br>
                                        123 Medical Center Drive<br>
                                        Healthcare District, HD 12345
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-telephone-fill me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Phone</strong><br>
                                        +91 6200091023
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-envelope-fill me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Email</strong><br>
                                        info@rajamedical.com
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock-fill me-3" style="font-size: 1.2rem;"></i>
                                    <div>
                                        <strong>Business Hours</strong><br>
                                        Mon - Fri: 8:00 AM - 6:00 PM<br>
                                        Sat: 9:00 AM - 4:00 PM
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-auto">
                                <h6>Why Choose Raja Medical?</h6>
                                <ul class="list-unstyled small">
                                    <li><i class="bi bi-check-circle-fill me-2"></i> Quality assured products</li>
                                    <li><i class="bi bi-check-circle-fill me-2"></i> Competitive pricing</li>
                                    <li><i class="bi bi-check-circle-fill me-2"></i> Fast delivery</li>
                                    <li><i class="bi bi-check-circle-fill me-2"></i> Expert support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection