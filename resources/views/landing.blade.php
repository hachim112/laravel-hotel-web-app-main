@extends('layouts.template')
@section('content')
<!-- Added modern styling and enhanced UX -->
<style>
    .banner_area {
        position: relative;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    
    .banner_area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('/placeholder.svg?height=1080&width=1920') center/cover;
        z-index: -2;
    }
    
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.8), rgba(118, 75, 162, 0.8));
        z-index: -1;
    }
    
    .banner_content {
        animation: fadeInUp 1s ease-out;
        z-index: 2;
        position: relative;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .banner_content h6 {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 15px;
        animation: slideIn 1s ease-out 0.3s both;
    }
    
    .banner_content h2 {
        font-size: 4rem;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        animation: slideIn 1s ease-out 0.6s both;
    }
    
    .banner_content p {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 30px;
        line-height: 1.6;
        animation: slideIn 1s ease-out 0.9s both;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .theme_btn {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border: none;
        color: white;
        padding: 18px 40px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        animation: slideIn 1s ease-out 1.2s both;
    }
    
    .theme_btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .hotel_booking_area {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        margin-top: 50px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        animation: slideUp 1s ease-out 1.5s both;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hotel_booking_area h2 {
        color: #333;
        font-weight: 700;
        font-size: 2.5rem;
        margin: 0;
    }
    
    .section_title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }
    
    .section_title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #2196F3, #1976D2);
        border-radius: 2px;
    }
    
    .accomodation_item {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        animation: fadeInUp 0.6s ease-out;
    }
    
    .accomodation_item:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .hotel_img {
        position: relative;
        overflow: hidden;
        height: 250px;
    }
    
    .hotel_img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .hotel_img:hover img {
        transform: scale(1.1);
    }
    
    .hotel_img .theme_btn {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .hotel_img:hover .theme_btn {
        opacity: 1;
        bottom: 30px;
    }
    
    .accomodation_item h4 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin: 20px 0 10px 0;
        transition: color 0.3s ease;
    }
    
    .accomodation_item h4:hover {
        color: #2196F3;
    }
    
    .accomodation_item h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #4CAF50;
        margin-bottom: 10px;
    }
    
    .accomodation_item p {
        color: #666;
        font-size: 1rem;
        margin-bottom: 20px;
    }
    
    .facilities_area {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
        position: relative;
        overflow: hidden;
    }
    
    .facilities_area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('/placeholder.svg?height=800&width=1920') center/cover;
        z-index: -1;
    }
    
    .title_w {
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .facilities_item {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
    }
    
    .facilities_item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    
    .facilities_item h4 {
        color: #333;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .facilities_item i {
        color: #2196F3;
        font-size: 1.5rem;
    }
    
    .about_history_area {
        padding: 100px 0;
    }
    
    .about_content {
        animation: fadeInLeft 1s ease-out;
    }
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .about_content h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
    }
    
    .about_content p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #666;
    }
    
    .about_history_area img {
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        animation: fadeInRight 1s ease-out;
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @media (max-width: 768px) {
        .banner_content h2 {
            font-size: 2.5rem;
        }
        
        .section_title h2 {
            font-size: 2rem;
        }
        
        .hotel_booking_area h2 {
            font-size: 2rem;
        }
    }
</style>

<!--================Banner Area =================-->
<section class="banner_area" id="home">
    <div class="booking_table d_flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h6>Away from monotonous life</h6>
                <h2>Hotel Hebat</h2>
                <p>Hotel bersih, aman, nyaman, sehat<br> Harga yang terjangkau anda dapat menginap disini</p>
                <a href="#types" class="btn theme_btn button_hover">Get Started</a>
            </div>
        </div>
    </div>
    <div class="hotel_booking_area position">
        <div class="container">
            <div class="hotel_booking_table">
                <div class="col-md-12">
                    <center>
                        <h2>Enjoy Your<br> Holiday With Us</h2>
                    </center>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Banner Area =================-->

<!--================ Accomodation Area  =================-->
<section class="accomodation_area section_gap" id="types">
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_color">Hotel Types</h2>
        </div>
        <div class="row mb_30">
            @if(isset($roomTypes) && count($roomTypes) > 0)
                @foreach ($roomTypes as $item)
                    <div class="col-lg-4 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <a href="{{ route('detail.room', $item->id) }}">
                                    <img src="{{ asset('images/tipekamar/'.$item->foto) }}" alt="{{ $item->name }}">
                                </a>
                                <a href="{{ route('detail.room', $item->id) }}" class="btn theme_btn button_hover btn-lg">
                                    <i class="fas fa-calendar-check me-2"></i>Book Now
                                </a>
                            </div>
                            <a href="{{ route('detail.room', $item->id) }}"><h4 class="sec_h4">{{ $item->name }}</h4></a>
                            <a href="{{ route('detail.room', $item->id) }}">
                                <h5>@currency($item->price)<small>/night</small></h5>
                            </a>
                            <p>Kamar Tersedia : {{ $item->getTotalRooms->count() }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <div class="alert alert-warning mt-4">No room types available. Please contact the administrator.</div>
                </div>
            @endif
        </div>
    </div>
</section>
<!--================ Accomodation Area  =================-->

<!--================ Facilities Area  =================-->
<section class="facilities_area section_gap" id="facilities">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_w">Hotel Facilities</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem;">Who are in extremely love with eco friendly system.</p>
        </div>
        <div class="row mb_30">
            @if(isset($hotelFacilities) && count($hotelFacilities) > 0)
                @foreach ($hotelFacilities as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-star-empty"></i>{{ $item->facility_name }}</h4>
                        <p>{{ $item->detail }}</p>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <div class="alert alert-warning mt-4">No hotel facilities available. Please contact the administrator.</div>
                </div>
            @endif
        </div>
    </div>
</section>
<!--================ Facilities Area  =================-->

<!--================ About History Area  =================-->
<section class="about_history_area section_gap" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d_flex align-items-center">
                <div class="about_content">
                    <h2 class="title title_color">About Us</h2>
                    <p>Modern accommodations, topped off with an infusion of rustic charm and a residential feel. Combining comfort and functionality, simple's design concept uses warm, rich colors to offer comfort in every room. Accents of warm autumnal fabrics and soft orange hues promote relaxation like spiced pumpkin, tangerine and amber, while modern grays create an understated cool elegance.</p>
                </div>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('template/image/about_bg.jpg') }}" alt="About Hotel Hebat">
            </div>
        </div>
    </div>
</section>
<!--================ About History Area  =================-->

<!-- Added smooth scrolling and enhanced interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);
    
    // Observe all animated elements
    document.querySelectorAll('.accomodation_item, .facilities_item').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
    
    // Add loading states to booking buttons
    document.querySelectorAll('.theme_btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.href && this.href.includes('detail.room')) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                this.style.pointerEvents = 'none';
                
                // Reset after navigation (fallback)
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.pointerEvents = 'auto';
                }, 2000);
            }
        });
    });
});
</script>

@endsection
