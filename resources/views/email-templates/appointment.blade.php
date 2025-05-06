<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Package Enquiry</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px;">
        <tr>
            <td style="background-color: #4CAF50; padding: 20px; text-align: center; color: white; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h1>Enquiry Recieved</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 30px;">
                <h2 style="color: #333;">Hello, {{ $name }}!</h2>
                <p style="font-size: 16px; color: #555;">Thank you for your Booking Enquiry with us. Below are your Enquiry details:</p>

                <table cellpadding="8" cellspacing="0" width="100%" style="margin-top: 15px; border-collapse: collapse;">
                    <tr style="background-color: #f2f2f2;">
                        <td style="font-weight: bold;">Contact</td>
                        <td>{{ $contact }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Email</td>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr style="background-color: #f2f2f2;">
                        <td style="font-weight: bold;">Wedding Date</td>
                        <td>{{ $wedding_date }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Wedding Venue</td>
                        <td>{{ $wedding_venue }}</td>
                    </tr>
                    <tr style="background-color: #f2f2f2;">
                        <td style="font-weight: bold;">Type</td>
                        <td>{{ ucfirst($type) }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Package</td>
                        <td>{{ $package_name }} (₹{{ $package_price }})</td>
                    </tr>
                </table>

                <p style="margin-top: 30px; font-size: 16px; color: #333;">We will reach out to you shortly. If you have any questions, feel free to contact us.</p>
                <p style="color: #4CAF50; font-weight: bold;">– The Crest Photography Team</p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f2f2f2; padding: 15px; text-align: center; font-size: 13px; color: #888;">
                &copy; {{ date('Y') }} Crest Photography. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
