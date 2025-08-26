@extends('layouts.adminlte')
@section('content')
<style>
    .modern-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        transition: all 0.3s ease;
    }
    
    .gradient-header {
        background: linear-gradient(135deg, #164e63, #0891b2, #f59e0b);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .gradient-header::before {
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
    
    .modern-form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .modern-label {
        font-weight: 600;
        color: #164e63;
        margin-bottom: 8px;
        display: block;
        font-size: 1rem;
    }
    
    .modern-input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.9);
    }
    
    .modern-input:focus {
        outline: none;
        border-color: #0891b2;
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
        transform: translateY(-2px);
    }
    
    .modern-input.is-invalid {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }
    
    .modern-btn {
        background: linear-gradient(135deg, #0891b2, #164e63);
        border: none;
        border-radius: 12px;
        color: white;
        padding: 15px 30px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }
    
    .modern-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(8, 145, 178, 0.4);
        color: white;
    }
    
    .modern-btn:active {
        transform: translateY(-1px);
    }
    
    .modern-btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }
    
    .modern-btn.loading::after {
        content: '';
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 10px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .page-header {
        background: linear-gradient(135deg, #164e63, #0891b2, #f59e0b);
        color: white;
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(50px, -50px);
    }
    
    .breadcrumb-modern {
        background: rgba(255,255,255,0.2);
        padding: 10px 20px;
        border-radius: 25px;
        margin-top: 15px;
    }
    
    .breadcrumb-modern a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-modern a:hover {
        color: white;
    }
    
    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        transition: color 0.3s ease;
    }
    
    .modern-input:focus + .input-icon {
        color: #0891b2;
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-plus-circle mr-3"></i>Add Room Facility</h1>
    <p>Create a new facility for Hotel Hebat rooms</p>
    <div class="breadcrumb-modern">
        <a href="{{ route('roomfacility.index') }}">Room Facilities</a> / Add New
    </div>
</div>

<div class="modern-card">
    <div class="gradient-header">
        <h3 class="card-title mb-0" style="font-size: 1.5rem; font-weight: 600;">
            <i class="fas fa-concierge-bell mr-2"></i>ROOM FACILITY ADD
        </h3>
    </div>
    
    <div class="card-body" style="padding: 40px;">
        <form action="{{ route('roomfacility.store') }}" method="post" id="facilityForm">
            @csrf
            <div class="modern-form-group">
                <label for="facility_name" class="modern-label">
                    <i class="fas fa-tag mr-2"></i>Facility Name
                </label>
                <div style="position: relative;">
                    <input id="facility_name" 
                           name="facility_name" 
                           type="text" 
                           class="modern-input @error('facility_name') is-invalid @enderror" 
                           value="{{ old('facility_name') }}" 
                           required 
                           autocomplete="facility_name" 
                           autofocus
                           placeholder="Enter facility name (e.g., WiFi, Air Conditioning, Mini Bar)">
                    <i class="fas fa-concierge-bell input-icon"></i>
                </div>

                @error('facility_name')
                    <div class="invalid-feedback" style="display: block; color: #ef4444; margin-top: 8px; font-size: 0.875rem;">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="form-group" style="text-align: right; margin-top: 40px;">
                <button type="submit" class="modern-btn" id="submitBtn">
                    <i class="fas fa-save"></i>
                    {{ __('Save Facility') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('facilityForm');
    const submitBtn = document.getElementById('submitBtn');
    const facilityInput = document.getElementById('facility_name');
    
    // Add loading state on form submission
    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    });
    
    // Real-time validation feedback
    facilityInput.addEventListener('input', function() {
        const value = this.value.trim();
        if (value.length > 0) {
            this.style.borderColor = '#10b981';
            this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        } else {
            this.style.borderColor = '#e5e7eb';
            this.style.boxShadow = 'none';
        }
    });
    
    // Auto-focus and smooth animations
    facilityInput.focus();
    
    // Add entrance animation
    document.querySelector('.modern-card').style.opacity = '0';
    document.querySelector('.modern-card').style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        document.querySelector('.modern-card').style.transition = 'all 0.6s ease';
        document.querySelector('.modern-card').style.opacity = '1';
        document.querySelector('.modern-card').style.transform = 'translateY(0)';
    }, 100);
});
</script>

@endsection
