<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Hotel Hebat</title>

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

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
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

    .invalid-feedback {
      display: block;
      color: #e53e3e;
      font-size: 0.875rem;
      margin-top: 5px;
      margin-left: 5px;
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .remember-me input[type="checkbox"] {
      width: 18px;
      height: 18px;
      accent-color: #4299e1;
    }

    .remember-me label {
      color: #4a5568;
      font-size: 0.9rem;
      cursor: pointer;
    }

    .btn-login {
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

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(66, 153, 225, 0.3);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .btn-login.loading {
      pointer-events: none;
    }

    .btn-login .spinner {
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

    .register-link {
      text-align: center;
      margin-top: 25px;
      color: #718096;
      font-size: 0.9rem;
    }

    .register-link a {
      color: #4299e1;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .register-link a:hover {
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
      .login-container {
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

  <div class="login-container">
    <div class="logo">
      <h1>Hotel<span class="highlight"> Hebat</span></h1>
    </div>
    
    <p class="welcome-text">Welcome back! Please sign in to your account</p>

    <form action="{{ route('login') }}" method="post" id="loginForm">
      @csrf
      
      <div class="form-group">
        <div class="input-wrapper">
          <input 
            type="email" 
            placeholder="Enter your email" 
            class="form-control @error('email') is-invalid @enderror" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            autocomplete="email" 
            autofocus
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
            type="password" 
            placeholder="Enter your password" 
            class="form-control @error('password') is-invalid @enderror" 
            name="password" 
            required 
            autocomplete="current-password"
          >
          <i class="fas fa-lock input-icon"></i>
        </div>
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="remember-forgot">
        <div class="remember-me">
          <input 
            type="checkbox" 
            name="remember" 
            id="remember" 
            {{ old('remember') ? 'checked' : '' }}
          >
          <label for="remember">Remember me</label>
        </div>
      </div>

      <button type="submit" class="btn-login" id="loginBtn">
        <span class="spinner"></span>
        <span class="btn-text">Sign In</span>
      </button>
    </form>

    <div class="register-link">
      Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
  
  <script>
    $(document).ready(function() {
      // Form validation and submission
      $('#loginForm').on('submit', function(e) {
        const btn = $('#loginBtn');
        const spinner = btn.find('.spinner');
        const btnText = btn.find('.btn-text');
        
        // Show loading state
        btn.addClass('loading');
        spinner.show();
        btnText.text('Signing in...');
      });

      // Input focus animations
      $('.form-control').on('focus', function() {
        $(this).parent().addClass('focused');
      }).on('blur', function() {
        $(this).parent().removeClass('focused');
      });

      // Real-time validation feedback
      $('.form-control').on('input', function() {
        if ($(this).hasClass('is-invalid')) {
          $(this).removeClass('is-invalid');
          $(this).siblings('.invalid-feedback').fadeOut();
        }
      });

      // Enhanced keyboard navigation
      $('.form-control').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
          const inputs = $('.form-control');
          const currentIndex = inputs.index(this);
          
          if (currentIndex < inputs.length - 1) {
            inputs.eq(currentIndex + 1).focus();
          } else {
            $('#loginForm').submit();
          }
        }
      });
    });
  </script>
</body>
</html>
