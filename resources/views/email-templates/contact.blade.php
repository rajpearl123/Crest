<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Contacting Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            text-align: center;
            padding: 40px 20px;
            position: relative;
        }
        .header-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
        .logo-container {
            position: relative;
            z-index: 2;
        }
        .logo {
            width: 120px;
            height: auto;
            padding: 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .content h2 {
            color: #222;
            font-size: 26px;
            margin-top: 0;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .message {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .user-message-container {
            background-color: #f9f9f9;
            border-left: 4px solid #2575fc;
            padding: 20px;
            margin: 25px 0;
            text-align: left;
            border-radius: 6px;
        }
        .user-message {
            font-style: italic;
            color: #444;
        }
        .highlight {
            color: #2575fc;
            font-weight: 600;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(37, 117, 252, 0.2);
        }
        .social-icons {
            margin: 25px 0 15px;
        }
        .social-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            background-color: #f0f0f0;
            border-radius: 50%;
            margin: 0 8px;
            font-size: 20px;
            color: #444;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .social-icon:hover {
            background-color: #2575fc;
            color: white;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e0e0e0, transparent);
            margin: 20px 0;
        }
        .footer {
            background: #222;
            color: #ffffff;
            text-align: center;
            padding: 25px 15px;
            font-size: 14px;
        }
        .footer a {
            color: #7fdbff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer a:hover {
            color: white;
        }
        .camera-icon {
            font-size: 22px;
            vertical-align: middle;
            margin-right: 5px;
        }
        .signature {
            font-family: 'Pacifico', cursive;
            font-size: 22px;
            margin-top: 15px;
            color: #2575fc;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header with Gradient Background -->
        <div class="header">
            <div class="header-overlay"></div>
            <div class="logo-container">
                <img src="{{ $logoUrl }}" alt="Photography Logo" class="logo">
            </div>
        </div>
        
        <!-- Email Content -->
        <div class="content">
            <h2>Hello, <span class="highlight">{{ $name }}</span>! 📷</h2>
            <p class="message">Thank you for contacting us! We're excited to hear from you and have received your message. Our team is reviewing it and will get back to you within 24-48 hours.</p>
            
            <div class="divider"></div>
            
            <h3>Your Message:</h3>
            <div class="user-message-container">
                <p class="user-message">"{{ $userMessage }}"</p>
            </div>
            
            <p class="message">While you wait, feel free to explore our latest photography collections and get inspired!</p>
            
            <a href="{{ url('/') }}" class="cta-button">View Our Gallery</a>
            
            <div class="divider"></div>
            
            <p class="message">Stay inspired and keep capturing <span class="highlight">beautiful moments</span>! 📸</p>
            
            <div class="social-icons">
                <a href="https://www.facebook.com/crestphotography/" class="social-icon">
                    <img src="https://cdn-icons-png.flaticon.com/24/733/733547.png" alt="Facebook" width="24" height="24">
                </a>
                <a href="https://www.instagram.com/crest__photography" class="social-icon">
                    <img src="https://cdn-icons-png.flaticon.com/24/2111/2111463.png" alt="Instagram" width="24" height="24">
                </a>
                <a href="https://www.youtube.com/@crestphotography" class="social-icon">
                    <img src="https://cdn-icons-png.flaticon.com/24/1384/1384060.png" alt="YouTube" width="24" height="24">
                </a>
            </div>

            
            <p class="signature">The Photography Team</p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ env('MAIL_FROM_NAME') }} | <a href="{{ url('/') }}">Visit Our Website</a> | <a href="{{ url('/privacy') }}">Privacy Policy</a></p>
            <p>If you have any questions, contact us at <a href="mailto:info@example.com">mail@crestphotography.in</a></p>
        </div>
    </div>
</body>
</html>