@extends('layouts.template')
@section('content')
<style>
    .room-detail-section {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 60px 0;
    }
    
    .room-carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        position: relative;
    }
    
    .room-carousel img {
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .room-carousel:hover img {
        transform: scale(1.05);
    }
    
    .detail-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }
    
    .detail-header {
        background: linear-gradient(135deg, #164e63, #0891b2);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .detail-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .detail-item {
        padding: 15px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .detail-item:hover {
        background: rgba(8, 145, 178, 0.05);
        padding-left: 10px;
        border-radius: 10px;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 600;
        color: #164e63;
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .detail-label i {
        margin-right: 8px;
        color: #0891b2;
    }
    
    .detail-value {
        color: #374151;
        font-size: 1.1rem;
    }
    
    .price-highlight {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 1.2rem;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    
    .booking-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        margin-top: 20px;
    }
    
    .booking-header {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .booking-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }
    
    .form-control {
        border-radius: 15px;
        border: 2px solid rgba(22, 78, 99, 0.1);
        padding: 12px 20px;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.9);
    }
    
    .form-control:focus {
        border-color: #0891b2;
        box-shadow: 0 0 0 0.2rem rgba(8, 145, 178, 0.25);
        transform: translateY(-2px);
    }
    
    .form-label {
        font-weight: 600;
        color: #164e63;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .form-label i {
        margin-right: 8px;
        color: #0891b2;
    }
    
    .book-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 25px;
        padding: 15px 30px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        width: 100%;
    }
    
    .book-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
        color: white;
    }
    
    .login-btn {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        border-radius: 25px;
        padding: 15px 30px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        text-decoration: none;
        display: inline-block;
    }
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
        color: white;
        text-decoration: none;
    }
    
    .alert {
        border-radius: 15px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
    }
    
    .alert-warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.05));
        border-left: 4px solid #f59e0b;
    }
    
    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
        border-left: 4px solid #10b981;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.05));
        border-left: 4px solid #ef4444;
    }
    
    .alert-info {
        background: linear-gradient(135deg, rgba(8, 145, 178, 0.1), rgba(22, 78, 99, 0.05));
        border-left: 4px solid #0891b2;
    }
    
    .availability-badge {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        font-size: 0.9rem;
    }
    
    .unavailable-badge {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        font-size: 0.9rem;
    }
</style>

<section class="room-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="room-carousel">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{asset('images/kamar/' . $data->foto)}}" class="d-block w-100" alt="{{ $data->name }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="detail-card">
                    <div class="detail-header">
                        <h4 class="mb-0">
                            <i class="fas fa-bed mr-2"></i>Room Details
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-tag"></i>Room Type
                            </div>
                            <div class="detail-value">{{ $data->name }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-star"></i>Facilities
                            </div>
                            <div class="detail-value">{{ $data->facilities }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-users"></i>Bed Capacity
                            </div>
                            <div class="detail-value">2 Guests</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-dollar-sign"></i>Price per Night
                            </div>
                            <div class="detail-value">
                                <span class="price-highlight">@currency($data->price)</span>
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-door-open"></i>Rooms Available
                            </div>
                            <div class="detail-value">
                                @if($jumlahTersedia > 0)
                                    <span class="availability-badge">{{ $jumlahTersedia }} rooms available</span>
                                @else
                                    <span class="unavailable-badge">Fully booked</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-info-circle"></i>Room Information
                            </div>
                            <div class="detail-value">
                                <p class="mb-0">{{ $data->information }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="booking-card">
                    <div class="booking-header">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-check mr-2"></i>Book This Room
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @auth
                        @if ($jumlahTersedia == 0)
                            <div class="alert alert-warning text-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <strong>Sorry!</strong> This room type is currently fully booked.
                            </div>
                        @else
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('customer.book.now') }}" method="post" id="bookingForm">
                                @csrf
                                <input type="hidden" name="type_id" value="{{ $data->id }}">
                                <input type="hidden" name="stok" value="{{ $jumlahTersedia }}">

                                <div class="form-group mb-3">
                                    <label for="jumlah" class="form-label">
                                        <i class="fas fa-users"></i>Number of Rooms
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('jumlah') is-invalid @enderror" 
                                           value="{{ old('jumlah', 1) }}" 
                                           min="1" 
                                           max="{{ $jumlahTersedia }}" 
                                           required 
                                           name="jumlah" 
                                           id="jumlah">
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Maximum {{ $jumlahTersedia }} rooms available</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="check_in" class="form-label">
                                        <i class="fas fa-sign-in-alt"></i>Check In Date
                                    </label>
                                    <input type="date" 
                                           min='<?= date('Y-m-d'); ?>' 
                                           class="form-control @error('check_in') is-invalid @enderror" 
                                           value="{{ old('check_in') }}" 
                                           onchange="checkout()" 
                                           required 
                                           name="check_in" 
                                           id="check_in">
                                    @error('check_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="check_out" class="form-label">
                                        <i class="fas fa-sign-out-alt"></i>Check Out Date
                                    </label>
                                    <input type="date" 
                                           disabled 
                                           min='<?= date('Y-m-d', strtotime('+1 day')); ?>' 
                                           class="form-control @error('check_out') is-invalid @enderror" 
                                           value="{{ old('check_out') }}" 
                                           required 
                                           name="check_out" 
                                           id="check_out">
                                    @error('check_out')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="book-btn">
                                    <i class="fas fa-calendar-check mr-2"></i>Book Now
                                </button>
                            </form>
                        @endif
                        @else
                        <div class="text-center">
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle mr-2"></i>
                                Please login to book this room
                            </div>
                            <a href="{{ route('login') }}" class="login-btn">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login First
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function checkout(){
        var checkin = new Date($('#check_in').val());
        var dd = checkin.getDate()+1;
        var mm = checkin.getMonth()+1;
        var yyyy = checkin.getFullYear();
        var lastDayOfMonth = new Date(yyyy, mm, 0);
        if(dd<10){
            dd='0'+dd
        }
        if(dd > lastDayOfMonth.getDate()){
            dd='01'
            mm+=1
        }
        if(mm<10){
            mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        console.log(today);
        document.getElementById("check_out").setAttribute("min", today);
        document.getElementById("check_out").removeAttribute("disabled");
    }

    // Form validation and loading state
    document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
        var checkIn = new Date(document.getElementById('check_in').value);
        var checkOut = new Date(document.getElementById('check_out').value);
        
        if (checkOut <= checkIn) {
            e.preventDefault();
            alert('Check-out date must be after check-in date');
            return false;
        }
        
        // Add loading state
        const submitBtn = this.querySelector('.book-btn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing Booking...';
        submitBtn.disabled = true;
    });
</script>
@endsection
