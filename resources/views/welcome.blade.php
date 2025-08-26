<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Hotel Mermoura</title>
    <!-- Added modern welcome page design -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .welcome-container {
            text-align: center;
            color: white;
            animation: fadeInUp 1s ease-out;
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
        
        .welcome-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from {
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3), 0 0 20px rgba(255,255,255,0.2);
            }
            to {
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3), 0 0 30px rgba(255,255,255,0.4);
            }
        }
        
        .welcome-subtitle {
            font-size: 1.5rem;
            margin-bottom: 40px;
            opacity: 0.9;
            animation: slideIn 1s ease-out 0.5s both;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 0.9;
                transform: translateX(0);
            }
        }
        
        .welcome-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: slideIn 1s ease-out 1s both;
        }
        
        .btn {
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            min-width: 150px;
        }
        
        .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            color: white;
            text-decoration: none;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            border: 2px solid transparent;
        }
        
        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
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
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
        
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2.5rem;
            }
            
            .welcome-subtitle {
                font-size: 1.2rem;
            }
            
            .welcome-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Added floating background shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <!-- Created professional welcome page -->
    <div class="welcome-container">
    <h1 class="welcome-title">Welcome to Hotel Mermoura</h1>
        <p class="welcome-subtitle">Experience luxury, comfort, and exceptional service</p>
        
        <div class="welcome-buttons">
            <a href="/login" class="btn btn-primary">Sign In</a>
            <a href="/register" class="btn btn-secondary">Get Started</a>
        </div>
    </div>
    
    <!-- Added interactive JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add click animation to buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
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
        });
    </script>
</body>
</html>
