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
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Partyscape Logo">
        </div>

        <!-- Message in Card Body -->
        <div class="content">
            <h2>Welcome to Partyscape!</h2>
            <p>Congratulations! You have been successfully registered as a staff member at <strong>{{$websiteSetting->name}}</strong>.</p>
            
            <p>Here are your login details:</p>
            <ul>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
            </ul>

            <p>Please log in and change your password for security purposes.</p>

            <p>As a staff member, you will have access to manage bookings, events, and other essential operations.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you have any questions, feel free to reach out to our support team.</p>
            <p>Best Regards, <br> The Partyscape Team</p>
        </div>

    </div>

</body>
</html>
