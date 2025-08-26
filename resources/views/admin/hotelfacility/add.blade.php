@extends('layouts.adminlte')
@section('content')
<div class="facility-form-container">
    <!-- Enhanced header with modern styling and breadcrumb navigation -->
    <div class="form-header-modern">
        <div class="header-content">
            <div class="header-title-section">
                <div class="header-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Tambah Fasilitas Hotel</h1>
                    <p class="page-subtitle">Tambahkan fasilitas baru untuk hotel</p>
                </div>
            </div>
            <div class="breadcrumb-modern">
                <a href="{{ route('hotelfacility.index') }}" class="breadcrumb-link">
                    <i class="fas fa-list"></i>
                    <span>Daftar Fasilitas</span>
                </a>
                <i class="fas fa-chevron-right breadcrumb-separator"></i>
                <span class="breadcrumb-current">Tambah</span>
            </div>
        </div>
    </div>

    <!-- Modern form card with enhanced styling and validation feedback -->
    <div class="form-card-modern">
        <div class="form-body">
            <form action="{{ route('hotelfacility.store') }}" method="post" class="facility-form">
                @csrf
                
                <div class="form-group-modern">
                    <label for="facility_name" class="form-label-modern">
                        <i class="fas fa-star label-icon"></i>
                        <span>Nama Fasilitas</span>
                        <span class="required-indicator">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input id="facility_name" 
                               name="facility_name" 
                               type="text" 
                               class="form-input-modern @error('facility_name') is-invalid @enderror" 
                               value="{{ old('facility_name') }}" 
                               required 
                               autocomplete="facility_name" 
                               autofocus
                               placeholder="Masukkan nama fasilitas">
                        <div class="input-focus-border"></div>
                    </div>
                    @error('facility_name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group-modern">
                    <label for="detail" class="form-label-modern">
                        <i class="fas fa-align-left label-icon"></i>
                        <span>Deskripsi Fasilitas</span>
                        <span class="required-indicator">*</span>
                    </label>
                    <div class="textarea-wrapper">
                        <textarea name="detail" 
                                  class="form-textarea-modern @error('detail') is-invalid @enderror" 
                                  id="detail" 
                                  rows="4" 
                                  required 
                                  autocomplete="detail" 
                                  placeholder="Masukkan deskripsi detail fasilitas">{{ old('detail') }}</textarea>
                        <div class="textarea-focus-border"></div>
                        <div class="character-count">
                            <span id="charCount">0</span> karakter
                        </div>
                    </div>
                    @error('detail')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('hotelfacility.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Fasilitas</span>
                        <div class="btn-loading">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Modern Form Styles */
.facility-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 1rem;
}

.form-header-modern {
    background: linear-gradient(135deg, #164e63 0%, #0891b2 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(22, 78, 99, 0.3);
    color: white;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.header-title-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
}

.page-subtitle {
    margin: 0.25rem 0 0 0;
    opacity: 0.9;
    font-size: 0.875rem;
}

.breadcrumb-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.breadcrumb-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.breadcrumb-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    text-decoration: none;
}

.breadcrumb-separator {
    opacity: 0.6;
    font-size: 0.75rem;
}

.breadcrumb-current {
    color: white;
    font-weight: 600;
}

.form-card-modern {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(22, 78, 99, 0.1);
    overflow: hidden;
}

.form-body {
    padding: 2.5rem;
}

.facility-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-group-modern {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.form-label-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.label-icon {
    color: #0891b2;
    font-size: 1rem;
}

.required-indicator {
    color: #ef4444;
    font-weight: 700;
}

.input-wrapper,
.textarea-wrapper {
    position: relative;
}

.form-input-modern {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
    color: #374151;
}

.form-input-modern:focus {
    outline: none;
    border-color: #0891b2;
    background: white;
    box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.1);
}

.form-input-modern.is-invalid {
    border-color: #ef4444;
    background: #fef2f2;
}

.form-textarea-modern {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
    color: #374151;
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.form-textarea-modern:focus {
    outline: none;
    border-color: #0891b2;
    background: white;
    box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.1);
}

.form-textarea-modern.is-invalid {
    border-color: #ef4444;
    background: #fef2f2;
}

.character-count {
    position: absolute;
    bottom: 0.75rem;
    right: 1rem;
    font-size: 0.75rem;
    color: #9ca3af;
    background: white;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    border: 1px solid #e5e7eb;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #ef4444;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.5rem 1rem;
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e5e7eb;
}

.btn-cancel,
.btn-submit {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
    position: relative;
    overflow: hidden;
}

.btn-cancel {
    background: #f3f4f6;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-cancel:hover {
    background: #e5e7eb;
    color: #374151;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-submit {
    background: linear-gradient(135deg, #164e63, #0891b2);
    color: white;
    border: 2px solid transparent;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #0f3a4a, #0e7490);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(22, 78, 99, 0.4);
}

.btn-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.btn-submit.loading .btn-loading {
    opacity: 1;
}

.btn-submit.loading span,
.btn-submit.loading > i {
    opacity: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .header-title-section {
        flex-direction: column;
        text-align: center;
    }
    
    .form-body {
        padding: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .btn-cancel,
    .btn-submit {
        width: 100%;
        justify-content: center;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-card-modern {
    animation: fadeInUp 0.6s ease forwards;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.facility-form');
    const submitBtn = document.querySelector('.btn-submit');
    const textarea = document.getElementById('detail');
    const charCount = document.getElementById('charCount');

    // Character counter for textarea
    function updateCharCount() {
        const count = textarea.value.length;
        charCount.textContent = count;
        
        if (count > 500) {
            charCount.style.color = '#ef4444';
        } else if (count > 400) {
            charCount.style.color = '#f59e0b';
        } else {
            charCount.style.color = '#9ca3af';
        }
    }

    textarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count

    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds as fallback
        setTimeout(() => {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }, 3000);
    });

    // Enhanced input focus effects
    const inputs = document.querySelectorAll('.form-input-modern, .form-textarea-modern');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Auto-resize textarea
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.max(120, this.scrollHeight) + 'px';
    });

    // Add loading animation to form
    setTimeout(() => {
        const formGroups = document.querySelectorAll('.form-group-modern');
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                group.style.transition = 'all 0.4s ease';
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 100);
});
</script>
@endsection
