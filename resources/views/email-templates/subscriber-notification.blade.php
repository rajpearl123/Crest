<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 30px;
            text-align: center;
        }
        .email-container {
            max-width: 620px;
            margin: auto;
            background-color: #ffffff;
            padding: 35px 30px;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            text-align: left;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo-container img {
            max-width: 150px;
            height: auto;
        }
        .content h2 {
            font-size: 26px;
            color: #103f21;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            color: #444444;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .highlight {
            color: #0c6430;
            font-weight: 600;
        }
        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #0c6430;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        .cta-button:hover {
            background-color: #094d26;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 14px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ $logoUrl }}" alt="Crest Photography Logo">
        </div>

        <!-- Body Content -->
        <div class="content">
            <h2>Thank You for Subscribing!</h2>
            <p>Welcome to <span class="highlight">Crest Photography</span> – where moments become timeless memories.</p>
            <p>You're now part of our exclusive community. Get ready to receive <span class="highlight">updates</span>, <span class="highlight">photography tips</span>, special offers, and behind-the-scenes insights from our latest shoots.</p>

            <!-- Call-to-Action -->
            <div style="text-align: center;">
                <a href="https://crestphotography.com" class="cta-button">Explore Now</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Stay connected with us and be the first to know about our upcoming sessions and offers.</p>
            <p>Warm regards, <br><strong>The Crest Photography Team</strong></p>
        </div>
    </div>

</body>
</html>
