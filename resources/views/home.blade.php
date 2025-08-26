@extends('layouts.app')

@section('content')
<!-- Enhanced dashboard with modern design and better UX -->
<style>
    .dashboard-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 40px 0;
    }
    
    .dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
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
    
    .dashboard-header {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .dashboard-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }
    
    .dashboard-body {
        padding: 40px;
        text-align: center;
    }
    
    .welcome-message {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 30px;
        animation: fadeIn 1s ease-out 0.5s both;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .success-alert {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        animation: slideIn 0.6s ease-out;
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
    
    .dashboard-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 30px;
        animation: fadeIn 1s ease-out 1s both;
    }
    
    .action-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 15px 30px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-width: 150px;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .action-btn.secondary {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }
    
    .action-btn.secondary:hover {
        box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 40px;
        animation: fadeIn 1s ease-out 1.5s both;
    }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        font-size: 2.5rem;
        color: #2196F3;
        margin-bottom: 15px;
    }
    
    .stat-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2196F3;
    }
    
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 1.5rem;
        }
        
        .dashboard-actions {
            flex-direction: column;
            align-items: center;
        }
        
        .action-btn {
            width: 200px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dashboard-card">
                    <!-- Enhanced header with modern design -->
                    <div class="dashboard-header">
                        <h1 class="dashboard-title">
                            <svg width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                            </svg>
                            Dashboard
                        </h1>
                    </div>
                    
                    <!-- Enhanced body with better content and actions -->
                    <div class="dashboard-body">
                        @if (session('status'))
                            <div class="success-alert" role="alert">
                                <strong>Success!</strong> {{ session('status') }}
                            </div>
                        @endif

                        <div class="welcome-message">
                            <strong>Welcome back!</strong> You are successfully logged in to Hotel Mermoura.
                        </div>
                        
                        <!-- Added quick action buttons -->
                        <div class="dashboard-actions">
                            <a href="/" class="action-btn">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                                </svg>
                                Browse Rooms
                            </a>
                            <a href="/profile" class="action-btn secondary">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                                My Profile
                            </a>
                        </div>
                        
                        <!-- Added stats cards for better dashboard feel -->
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z"/>
                                        <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z"/>
                                    </svg>
                                </div>
                                <div class="stat-title">Active Bookings</div>
                                <div class="stat-value">0</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                    </svg>
                                </div>
                                <div class="stat-title">Total Visits</div>
                                <div class="stat-value">1</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <svg width="40" height="40" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                    </svg>
                                </div>
                                <div class="stat-title">Account Status</div>
                                <div class="stat-value">Active</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Added interactive JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click animations to action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Animate stat values on load
    document.querySelectorAll('.stat-value').forEach(stat => {
        const finalValue = stat.textContent;
        if (!isNaN(finalValue)) {
            let currentValue = 0;
            const increment = finalValue / 20;
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    stat.textContent = finalValue;
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(currentValue);
                }
            }, 50);
        }
    });
});
</script>
@endsection
