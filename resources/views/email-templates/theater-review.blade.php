<!DOCTYPE html>
<html>
<head>
    <title>Subscription Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .logo-container {
            text-align: center;
            padding: 20px 0;
        }
        .logo-container img {
            max-width: 150px;
        }
        .content {
            text-align: center;
            color: #333333;
        }
        .content h2 {
            color: #222222;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp

    <div class="email-container">
        <!-- Header with Logo -->
        <div class="logo-container">
            <img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->header_logo) : asset('assets/images/logo/logo.jpg') }}" alt="Partyscape Logo">
        </div>

        <!-- Message in Card Body -->
        <div class="content">
            <h2>Thank You for Your Review!</h2>
            <p>We appreciate your feedback on <strong>{{$review->theater->name}}</strong>.</p>
            <p>Your support helps us enhance our services and provide the best experience possible.</p>
            <p>We look forward to welcoming you again to our theater events!</p>
        </div>
        <!-- Footer -->
        <div class="footer">
            <p>Stay tuned for updates on our latest events.</p>
            <p>Best Regards, <br> The {{$websiteSetting->name}} Team</p>
        </div>
    </div>

</body>
</html>
