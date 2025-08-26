<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran Hotel Mermoura</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Added modern styling and animations -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        
        .receipt-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideUp 0.6s ease-out;
            overflow: hidden;
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
        
        .receipt-header {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .receipt-header::before {
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
        
        .hotel-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
        }
        
        .receipt-subtitle {
            font-size: 1.2rem;
            margin: 10px 0 5px 0;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .hotel-address {
            font-size: 0.95rem;
            opacity: 0.8;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        
        .receipt-body {
            padding: 40px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .detail-row:hover {
            background: rgba(33, 150, 243, 0.05);
            padding-left: 10px;
            border-radius: 8px;
        }
        
        .detail-label {
            font-weight: 600;
            color: #333;
            font-size: 1rem;
        }
        
        .detail-value {
            font-weight: 500;
            color: #666;
            font-size: 1rem;
        }
        
        .total-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            margin: 20px -40px -40px -40px;
            padding: 30px 40px;
            border-top: 2px solid #2196F3;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.3rem;
            font-weight: 700;
            color: #2196F3;
            margin-bottom: 20px;
        }
        
        .thank-you {
            text-align: center;
            font-size: 1.1rem;
            color: #666;
            font-style: italic;
            margin: 0;
        }
        
        .download-btn {
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border: none;
            color: white;
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
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        
        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .download-btn:active {
            transform: translateY(0);
        }
        
        @media (max-width: 768px) {
            .receipt-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .hotel-title {
                font-size: 2rem;
            }
            
            .receipt-body {
                padding: 20px;
            }
            
            .total-section {
                margin: 20px -20px -20px -20px;
                padding: 20px;
            }
        }
        
        .print-styles {
            display: none;
        }
        
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            
            .receipt-container {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                background: white !important;
            }
            
            .download-btn {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="receipt-container">
                    <!-- Enhanced header with modern design -->
                    <div class="receipt-header">
                        <h1 class="hotel-title">HOTEL MERMOURA</h1>
                        <h2 class="receipt-subtitle">Payment Receipt</h2>
                        <p class="hotel-address">Jl. Mana aja No 07 California 177854 (+1) 234-1233</p>
                    </div>
                    
                    <!-- Redesigned receipt body with better layout -->
                    <div class="receipt-body">
                        <div class="detail-row">
                            <span class="detail-label">Transaction ID</span>
                            <span class="detail-value">#{{ $data->id }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label">Client Name</span>
                            <span class="detail-value">{{ $data->user->name }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label">Room Numbers</span>
                            <span class="detail-value">{{ $data->nomorKamar }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label">Check In</span>
                            <span class="detail-value">{{ $data->check_in }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label">Check Out</span>
                            <span class="detail-value">{{ $data->check_out }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label">Total Room</span>
                            <span class="detail-value">{{ $data->many_room }}</span>
                        </div>
                        
                        <div class="detail-row">
                            <span class="detail-label">Price/Room</span>
                            <span class="detail-value">@currency($data->room->roomType->price) DA</span>
                        </div>
                    </div>
                    
                    <!-- Enhanced total section with better styling -->
                    <div class="total-section">
                        <div class="total-row">
                            <span>Total Amount</span>
                            <span>@currency($data->payment->price) DA</span>
                        </div>
                        <p class="thank-you">** Thank You for Choosing Hotel Mermoura **</p>
                        
                        @if(app('router')->getRoutes()->match(app('request')->create(URL::current()))->getName() == 'transaction.proof')
                            <div class="text-center">
                                <a href="{{ route('transaction.proof.print', $data->id) }}" class="download-btn">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                    Download PDF
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Added JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading animation to download button
            const downloadBtn = document.querySelector('.download-btn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function(e) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<div style="width: 20px; height: 20px; border: 2px solid #ffffff; border-top: 2px solid transparent; border-radius: 50%; animation: spin 1s linear infinite; margin-right: 10px;"></div>Generating PDF...';
                    
                    // Add spin animation
                    const style = document.createElement('style');
                    style.textContent = '@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }';
                    document.head.appendChild(style);
                    
                    // Reset after 3 seconds (adjust based on your PDF generation time)
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 3000);
                });
            }
            
            // Add print functionality
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'p') {
                    e.preventDefault();
                    window.print();
                }
            });
        });
    </script>
</body>
</html>
