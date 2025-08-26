<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Hotel Hebat</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .register-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      padding: 40px 30px;
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

    .logo {
      text-align: center;
      margin-bottom: 30px;
    }

    .logo h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #2d3748;
      margin-bottom: 5px;
    }

    .logo .highlight {
      color: #4299e1;
    }

    .welcome-text {
      text-align: center;
      color: #718096;
      font-size: 1rem;
      margin-bottom: 30px;
      font-weight: 400;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .form-control {
      width: 100%;
      padding: 15px 20px 15px 50px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background: #fff;
      color: #2d3748;
    }

    .form-control:focus {
      outline: none;
      border-color: #4299e1;
      box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
      transform: translateY(-1px);
    }

    .form-control.is-invalid {
      border-color: #e53e3e;
      box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
    }

    .form-control.is-valid {
      border-color: #38a169;
      box-shadow: 0 0 0 3px rgba(56, 161, 105, 0.1);
    }

    .input-icon {
      position: absolute;
      left: 18px;
      color: #a0aec0;
      font-size: 1.1rem;
      z-index: 2;
      transition: color 0.3s ease;
    }

    .form-control:focus + .input-icon {
      color: #4299e1;
    }

    .password-toggle {
      position: absolute;
      right: 18px;
      color: #a0aec0;
      cursor: pointer;
      font-size: 1rem;
      z-index: 2;
      transition: color 0.3s ease;
    }

    .password-toggle:hover {
      color: #4299e1;
    }

    .invalid-feedback {
      display: block;
      color: #e53e3e;
      font-size: 0.875rem;
      margin-top: 5px;
      margin-left: 5px;
    }

    .password-strength {
      margin-top: 8px;
      margin-left: 5px;
    }

    .strength-bar {
      height: 4px;
      background: #e2e8f0;
      border-radius: 2px;
      overflow: hidden;
      margin-bottom: 5px;
    }

    .strength-fill {
      height: 100%;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .strength-text {
      font-size: 0.75rem;
      color: #718096;
    }

    .terms-checkbox {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 25px;
      padding: 15px;
      background: #f7fafc;
      border-radius: 12px;
      border: 2px solid #e2e8f0;
      transition: all 0.3s ease;
    }

    .terms-checkbox:hover {
      border-color: #cbd5e0;
    }

    .terms-checkbox input[type="checkbox"] {
      width: 18px;
      height: 18px;
      accent-color: #4299e1;
      margin-top: 2px;
    }

    .terms-checkbox label {
      color: #4a5568;
      font-size: 0.9rem;
      line-height: 1.5;
      cursor: pointer;
    }

    .terms-checkbox a {
      color: #4299e1;
      text-decoration: none;
      font-weight: 500;
    }

    .terms-checkbox a:hover {
      text-decoration: underline;
    }

    .btn-register {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-register:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(66, 153, 225, 0.3);
    }

    .btn-register:active {
      transform: translateY(0);
    }

    .btn-register:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .btn-register.loading {
      pointer-events: none;
    }

    .btn-register .spinner {
      display: none;
      width: 20px;
      height: 20px;
      border: 2px solid transparent;
      border-top: 2px solid white;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin-right: 10px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .login-link {
      text-align: center;
      margin-top: 25px;
      color: #718096;
      font-size: 0.9rem;
    }

    .login-link a {
      color: #4299e1;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .login-link a:hover {
      color: #3182ce;
    }

    .floating-shapes {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .shape {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .shape:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      right: 10%;
      animation-delay: 2s;
    }

    .shape:nth-child(3) {
      width: 60px;
      height: 60px;
      bottom: 20%;
      left: 20%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    @media (max-width: 480px) {
      .register-container {
        padding: 30px 20px;
        margin: 10px;
      }
      
      .logo h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <div class="register-container">
    <div class="logo">
      <h1>Hotel<span class="highlight"> Hebat</span></h1>
    </div>
    
    <p class="welcome-text">Create your account to get started</p>

    <form action="{{ route('register') }}" method="post" id="registerForm">
      @csrf
      
      <div class="form-group">
        <div class="input-wrapper">
          <input 
            type="text" 
            placeholder="Full Name" 
            class="form-control @error('name') is-invalid @enderror" 
            name="name" 
            value="{{ old('name') }}" 
            required 
            autocomplete="name" 
            autofocus
          >
          <i class="fas fa-user input-icon"></i>
        </div>
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <input 
            type="email" 
            placeholder="Email Address" 
            class="form-control @error('email') is-invalid @enderror" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autocomplete="email"
          >
          <i class="fas fa-envelope input-icon"></i>
        </div>
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <input 
            type="tel" 
            placeholder="Phone Number" 
            class="form-control @error('phone') is-invalid @enderror" 
            name="phone" 
            value="{{ old('phone') }}" 
            required 
            autocomplete="tel"
          >
          <i class="fas fa-phone input-icon"></i>
        </div>
        @error('phone')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <input 
            type="password" 
            class="form-control @error('password') is-invalid @enderror" 
            placeholder="Password" 
            name="password" 
            required 
            autocomplete="new-password"
            id="password"
          >
          <i class="fas fa-lock input-icon"></i>
          <i class="fas fa-eye password-toggle" id="togglePassword"></i>
        </div>
        <div class="password-strength" id="passwordStrength" style="display: none;">
          <div class="strength-bar">
            <div class="strength-fill" id="strengthFill"></div>
          </div>
          <div class="strength-text" id="strengthText"></div>
        </div>
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-group">
        <div class="input-wrapper">
          <input 
            type="password" 
            class="form-control" 
            placeholder="Confirm Password" 
            name="password_confirmation" 
            required 
            autocomplete="new-password"
            id="passwordConfirm"
          >
          <i class="fas fa-lock input-icon"></i>
          <i class="fas fa-eye password-toggle" id="togglePasswordConfirm"></i>
        </div>
      </div>

      <div class="terms-checkbox">
        <input type="checkbox" id="agreeTerms" name="terms" required value="agree">
        <label for="agreeTerms">
          I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
        </label>
      </div>

      <button type="submit" class="btn-register" id="registerBtn" disabled>
        <span class="spinner"></span>
        <span class="btn-text">Create Account</span>
      </button>
    </form>

    <div class="login-link">
      Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
  
  <script>
    $(document).ready(function() {
      // Password visibility toggle
      $('#togglePassword, #togglePasswordConfirm').on('click', function() {
        const targetId = $(this).attr('id') === 'togglePassword' ? '#password' : '#passwordConfirm';
        const target = $(targetId);
        const type = target.attr('type') === 'password' ? 'text' : 'password';
        
        target.attr('type', type);
        $(this).toggleClass('fa-eye fa-eye-slash');
      });

      // Password strength checker
      $('#password').on('input', function() {
        const password = $(this).val();
        const strengthIndicator = $('#passwordStrength');
        const strengthFill = $('#strengthFill');
        const strengthText = $('#strengthText');
        
        if (password.length === 0) {
          strengthIndicator.hide();
          return;
        }
        
        strengthIndicator.show();
        
        let strength = 0;
        let feedback = [];
        
        // Length check
        if (password.length >= 8) strength += 1;
        else feedback.push('at least 8 characters');
        
        // Uppercase check
        if (/[A-Z]/.test(password)) strength += 1;
        else feedback.push('uppercase letter');
        
        // Lowercase check
        if (/[a-z]/.test(password)) strength += 1;
        else feedback.push('lowercase letter');
        
        // Number check
        if (/\d/.test(password)) strength += 1;
        else feedback.push('number');
        
        // Special character check
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 1;
        else feedback.push('special character');
        
        const colors = ['#e53e3e', '#ed8936', '#ecc94b', '#38a169', '#38a169'];
        const labels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
        const widths = ['20%', '40%', '60%', '80%', '100%'];
        
        strengthFill.css({
          'background-color': colors[strength - 1] || colors[0],
          'width': widths[strength - 1] || widths[0]
        });
        
        strengthText.text(labels[strength - 1] || labels[0]);
        
        if (feedback.length > 0 && strength < 3) {
          strengthText.text(`Add: ${feedback.slice(0, 2).join(', ')}`);
        }
      });

      // Password confirmation validation
      $('#passwordConfirm').on('input', function() {
        const password = $('#password').val();
        const confirm = $(this).val();
        
        if (confirm.length > 0) {
          if (password === confirm) {
            $(this).removeClass('is-invalid').addClass('is-valid');
          } else {
            $(this).removeClass('is-valid').addClass('is-invalid');
          }
        } else {
          $(this).removeClass('is-valid is-invalid');
        }
      });

      // Form validation
      function validateForm() {
        const name = $('input[name="name"]').val().trim();
        const email = $('input[name="email"]').val().trim();
        const phone = $('input[name="phone"]').val().trim();
        const password = $('#password').val();
        const passwordConfirm = $('#passwordConfirm').val();
        const terms = $('#agreeTerms').is(':checked');
        
        const isValid = name.length >= 2 && 
                       email.includes('@') && 
                       phone.length >= 10 && 
                       password.length >= 8 && 
                       password === passwordConfirm && 
                       terms;
        
        $('#registerBtn').prop('disabled', !isValid);
        return isValid;
      }

      // Real-time validation
      $('input, #agreeTerms').on('input change', validateForm);

      // Form submission
      $('#registerForm').on('submit', function(e) {
        if (!validateForm()) {
          e.preventDefault();
          return;
        }
        
        const btn = $('#registerBtn');
        const spinner = btn.find('.spinner');
        const btnText = btn.find('.btn-text');
        
        // Show loading state
        btn.addClass('loading').prop('disabled', true);
        spinner.show();
        btnText.text('Creating Account...');
      });

      // Enhanced keyboard navigation
      $('.form-control').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
          const inputs = $('.form-control');
          const currentIndex = inputs.index(this);
          
          if (currentIndex < inputs.length - 1) {
            inputs.eq(currentIndex + 1).focus();
          } else if (validateForm()) {
            $('#registerForm').submit();
          }
        }
      });

      // Input focus animations
      $('.form-control').on('focus', function() {
        $(this).parent().addClass('focused');
      }).on('blur', function() {
        $(this).parent().removeClass('focused');
      });

      // Phone number formatting
      $('input[name="phone"]').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length >= 10) {
          value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        }
        $(this).val(value);
      });
    });
  </script>
</body>
</html>
