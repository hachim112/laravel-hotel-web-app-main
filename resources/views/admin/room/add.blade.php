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
        background: linear-gradient(135deg, #164e63, #0891b2);
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
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .form-group-modern {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-control-modern {
        background: rgba(255,255,255,0.9);
        border: 2px solid rgba(8, 145, 178, 0.2);
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .form-control-modern:focus {
        border-color: #0891b2;
        box-shadow: 0 0 0 0.2rem rgba(8, 145, 178, 0.25);
        background: white;
        transform: translateY(-2px);
    }
    
    .form-label-modern {
        font-weight: 600;
        color: #164e63;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        min-width: 150px;
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        color: white;
    }
    
    .btn-submit:active {
        transform: translateY(-1px);
    }
    
    .btn-submit.loading {
        pointer-events: none;
    }
    
    .btn-submit.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .breadcrumb-modern {
        background: rgba(8, 145, 178, 0.1);
        border-radius: 10px;
        padding: 10px 15px;
        margin-bottom: 20px;
    }
    
    .breadcrumb-modern a {
        color: #0891b2;
        text-decoration: none;
        font-weight: 500;
    }
    
    .breadcrumb-modern a:hover {
        color: #164e63;
    }
</style>

<div class="container-fluid">
    <!-- Added breadcrumb navigation -->
    <nav class="breadcrumb-modern">
        <a href="{{ route('room.index') }}">← Back to Room List</a>
    </nav>
    
    <div class="modern-card">
        <div class="gradient-header">
            <div class="d-flex align-items-center">
                <div>
                    <h3 class="mb-1" style="font-weight: 700;">🏨 Add New Room</h3>
                    <p class="mb-0 opacity-75">Create a new room in the hotel system</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('room.store') }}" method="post" id="addRoomForm">
                @csrf
                <div class="row">
                    <!-- Enhanced form styling with modern design -->
                    <div class="form-group-modern col-md-6">
                        <label for="type_id" class="form-label-modern">Room Type</label>
                        <select name="type_id" id="type_id" class="form-control form-control-modern @error('type_id') is-invalid @enderror" required>
                            <option disabled selected>Select Type of Room...</option>
                            @foreach ($typeRooms as $type)
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('type_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-modern col-md-6">
                        <label for="number" class="form-label-modern">Room Number</label>
                        <input id="number" name="number" type="text" 
                               class="form-control form-control-modern @error('number') is-invalid @enderror" 
                               value="{{ old('number') }}" 
                               placeholder="Enter room number (e.g., 101, 202)"
                               required>

                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group-modern text-right">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-save mr-2"></i>Create Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addRoomForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<span style="opacity: 0;">Creating Room...</span>';
        
        // Prevent double submission
        submitBtn.disabled = true;
    });
    
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '#10b981';
                this.style.boxShadow = '0 0 0 0.2rem rgba(16, 185, 129, 0.25)';
            } else {
                this.style.borderColor = 'rgba(8, 145, 178, 0.2)';
                this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
            }
        });
    });
});
</script>
@endsection
