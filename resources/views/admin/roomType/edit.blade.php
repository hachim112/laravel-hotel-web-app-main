@extends('layouts.adminlte')
@section('content')
<style>
    .modern-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 20px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }
    
    .gradient-header {
        background: linear-gradient(135deg, #164e63, #0891b2, #f59e0b);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
        color: white;
        border-radius: 20px 20px 0 0;
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
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
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
    
    .facility-checkbox {
        background: rgba(255,255,255,0.9);
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 10px;
        border: 2px solid rgba(22, 78, 99, 0.1);
        transition: all 0.3s ease;
    }
    
    .facility-checkbox:hover {
        border-color: #0891b2;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(8, 145, 178, 0.1);
    }
    
    .facility-checkbox.checked {
        border-color: #10b981;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
    }
    
    .facility-checkbox input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 10px;
    }
    
    .facility-checkbox label {
        margin-bottom: 0;
        font-weight: 500;
        color: #164e63;
        cursor: pointer;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.6);
        color: white;
    }
    
    .current-image {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .current-image:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
        margin-top: 10px;
    }
    
    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }
    
    .file-input-label {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        padding: 12px 20px;
        border-radius: 15px;
        cursor: pointer;
        display: block;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px dashed rgba(245, 158, 11, 0.3);
    }
    
    .file-input-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    }
    
    .character-counter {
        font-size: 0.875rem;
        color: #6b7280;
        text-align: right;
        margin-top: 5px;
    }
</style>

<div class="modern-card">
    <div class="gradient-header">
        <div class="card-header border-0">
            <h3 class="card-title mb-0">
                <i class="fas fa-edit mr-2"></i>EDIT ROOM TYPE
            </h3>
        </div>
    </div>
    
    <div class="card-body p-4">
        <form action="{{ route('roomtype.update', $data->id) }}" method="post" enctype="multipart/form-data" id="editRoomTypeForm">
            @csrf
            @method('patch')
            
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-tag"></i>Room Type Name
                </label>
                <input id="name" 
                       value="{{ $data->name }}" 
                       name="name" 
                       type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       required 
                       autocomplete="name" 
                       autofocus
                       placeholder="Enter room type name">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-star"></i>Room Facilities
                </label>
                <div style="max-height: 200px; overflow-y: auto;">
                    @foreach ($roomFacilities as $item)
                        <div class="facility-checkbox {{ in_array($item->facility_name, $data->facilities) ? 'checked' : '' }}">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   {{ in_array($item->facility_name, $data->facilities) ? 'checked' : ''}} 
                                   name="facilities[]" 
                                   value="{{ $item->facility_name }}" 
                                   id="{{$item->id}}"
                                   onchange="toggleFacilityStyle(this)">
                            <label class="form-check-label" for="{{ $item->id }}">
                                {{$item->facility_name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('facilities')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">
                    <i class="fas fa-dollar-sign"></i>Price per Night
                </label>
                <input id="price" 
                       value="{{ $data->price }}" 
                       name="price" 
                       type="number" 
                       class="form-control @error('price') is-invalid @enderror" 
                       required 
                       autocomplete="price"
                       placeholder="Enter price in IDR">

                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto" class="form-label">
                    <i class="fas fa-image"></i>Room Photo
                </label>
                <div class="mb-3">
                    <img src="{{ asset('images/tipekamar/'.$data->foto) }}" 
                         width="200" 
                         class="current-image" 
                         alt="Current room photo">
                    <p class="text-muted mt-2">Current photo</p>
                </div>
                <div class="file-input-wrapper">
                    <input id="foto" 
                           name="foto" 
                           type="file" 
                           class="@error('foto') is-invalid @enderror" 
                           accept="image/*">
                    <label for="foto" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                        Choose New Photo (Optional)
                    </label>
                </div>
                @error('foto')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="information" class="form-label">
                    <i class="fas fa-info-circle"></i>Room Information
                </label>
                <textarea name="information" 
                          class="form-control @error('information') is-invalid @enderror" 
                          id="information" 
                          rows="4" 
                          required 
                          autocomplete="information"
                          placeholder="Describe the room type, amenities, and special features..."
                          maxlength="500">{{ old('information', $data->information) }}</textarea>
                <div class="character-counter">
                    <span id="charCount">{{ strlen($data->information) }}</span>/500 characters
                </div>
                @error('information')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group text-right">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save mr-2"></i>Update Room Type
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for textarea
    const textarea = document.getElementById('information');
    const charCount = document.getElementById('charCount');
    
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
    
    // File input label update
    const fileInput = document.getElementById('foto');
    const fileLabel = document.querySelector('.file-input-label');
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileLabel.innerHTML = '<i class="fas fa-check mr-2"></i>' + this.files[0].name;
            fileLabel.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        }
    });
    
    // Form submission loading state
    document.getElementById('editRoomTypeForm').addEventListener('submit', function() {
        const submitBtn = document.querySelector('.submit-btn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
        submitBtn.disabled = true;
    });
});

function toggleFacilityStyle(checkbox) {
    const facilityDiv = checkbox.closest('.facility-checkbox');
    if (checkbox.checked) {
        facilityDiv.classList.add('checked');
    } else {
        facilityDiv.classList.remove('checked');
    }
}
</script>
@endsection
