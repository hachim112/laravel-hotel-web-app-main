@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-5">Our Room Types</h2>
        </div>
    </div>
    
    <div class="row">
        @foreach ($roomTypes as $roomType)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/tipekamar/' . $roomType->foto) }}" 
                         class="card-img-top" 
                         alt="{{ $roomType->name }}"
                         style="height: 250px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $roomType->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($roomType->information, 100) }}</p>
                        
                        <div class="mt-auto">
                            <div class="mb-3">
                                <strong class="text-primary">${{ number_format($roomType->price, 2) }}</strong> <small>/night</small>
                            </div>
                            
                            @if($roomType->facilities)
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <strong>Facilities:</strong> {{ $roomType->facilities }}
                                    </small>
                                </div>
                            @endif
                            
                            <div class="d-grid">
                                <a href="{{ route('detail.room', $roomType->id) }}" 
                                   class="btn btn-primary btn-lg">
                                    <i class="fas fa-calendar-check me-2"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 