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
        background: linear-gradient(135deg, #f59e0b, #d97706);
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
        border: 2px solid rgba(245, 158, 11, 0.2);
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .form-control-modern:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
        background: white;
        transform: translateY(-2px);
    }
    
    .form-label-modern {
        font-weight: 600;
        color: #92400e;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
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
        box-shadow: 0 15px 35px rgba(245, 158, 11, 0.4);
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
        background: rgba(245, 158, 11, 0.1);
        border-radius: 10px;
        padding: 10px 15px;
        margin-bottom: 20px;
    }
    
    .breadcrumb-modern a {
        color: #f59e0b;
        text-decoration: none;
        font-weight: 500;
    }
    
    .breadcrumb-modern a:hover {
        color: #92400e;
    }
    
    .status-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 8px;
    }
    
    .status-available { background: #10b981; }
    .status-reserved { background: #f59e0b; }
    .status-occupied { background: #ef4444; }
    .status-out-of-service { background: #6b7280; }
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
                    <h3 class="mb-1" style="font-weight: 700;">✏️ Edit Room</h3>
                    <p class="mb-0 opacity-75">Update room information and status</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('room.update', $data->id) }}" method="post" enctype="multipart/form-data" id="editRoomForm">
                @csrf
                @method('patch')
                <div class="row">
                    <!-- Enhanced form styling with modern design -->
                    <div class="form-group-modern col-md-6">
                        <label for="type_id" class="form-label-modern">Room Type</label>
                        <select name="type_id" id="type_id" class="form-control form-control-modern @error('type_id') is-invalid @enderror" required>
                            @foreach ($typeRooms as $type)
                                <option {{ ($type->id == $data->type_id) ? 'selected' : '' }} value="{{ $type->id }}">
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
                        <input id="number" value="{{ $data->number }}" name="number" type="text" 
                               class="form-control form-control-modern @error('number') is-invalid @enderror" 
                               placeholder="Enter room number"
                               required>

                        @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <!-- Enhanced status selection with visual indicators -->
                <div class="form-group-modern">
                    <label for="status" class="form-label-modern">Room Status</label>
                    <select name="status" id="status" class="form-control form-control-modern @error('status') is-invalid @enderror" required>
                        <option {{ $data->status == "a" ? 'selected' : ''}} value="a">
                            <span class="status-indicator status-available"></span>Available
                        </option>
                        <option {{ $data->status == "r" ? 'selected' : ''}} value="r">
                            <span class="status-indicator status-reserved"></span>Reserved
                        </option>
                        <option {{ $data->status == "o" ? 'selected' : ''}} value="o">
                            <span class="status-indicator status-occupied"></span>Occupied
                        </option>
                        <option {{ $data->status == "os" ? 'selected' : ''}} value="os">
                            <span class="status-indicator status-out-of-service"></span>Out of Service
                        </option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group-modern text-right">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-save mr-2"></i>Update Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editRoomForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<span style="opacity: 0;">Updating Room...</span>';
        
        // Prevent double submission
        submitBtn.disabled = true;
    });
    
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '#f59e0b';
                this.style.boxShadow = '0 0 0 0.2rem rgba(245, 158, 11, 0.25)';
            } else {
                this.style.borderColor = 'rgba(245, 158, 11, 0.2)';
                this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
            }
        });
    });
});
</script>
@endsection
