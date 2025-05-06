<!DOCTYPE html>
<html>
<head>
    <title>{{$data['subject']}}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            text-align: center;
        }
        .logo-container {
            padding: 20px 0;
        }
        .logo-container img {
            max-width: 170px;
        }
        .content {
            text-align: center;
            color: #333333;
            padding: 15px;
        }
        .content h2 {
            color: #222222;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
        }
        .highlight {
            color: #103f21;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .cta-button {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background-color: #103f21;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }
        .cta-button:hover {
            background-color: #103f21;
        }
        .message-body {
            text-align: left;
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-size: 16px;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header with Logo -->
        <div class="logo-container">
            <img src="{{$data['logoUrl']}}" alt="Your Company Logo">
        </div>

        <!-- Message in Card Body -->
        <div class="content">
            <h2>Hello {{$data['name']}},</h2>
            <p>Thank you for reaching out to <span class="highlight">Your Company Name</span>. We appreciate your inquiry and are happy to assist you.</p>
            <div class="message-body">
                <p>{{$data['message']}}</p>
            </div>
            <p>If you have any further questions or need additional assistance, feel free to contact us.</p>
            
            <!-- Call to Action -->
            <a href="https://test.pearl-developer.com/crest/public/" class="cta-button">Visit Our Website</a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Stay connected for more updates and exclusive offers from <span class="highlight">Crest</span>.</p>
            <p>Best Regards, <br> <strong>Crest</strong></p>
        </div>
    </div>
</body>
</html>