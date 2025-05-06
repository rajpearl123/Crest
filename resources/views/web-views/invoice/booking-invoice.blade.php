<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Invoice</title>
    <style>
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .invoice-heading {
            text-align: right;
        }

        h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        h2 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .content {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .client-details-invoice {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .content .client-details,
        .content .invoice-details {
            width: 100%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
        }

        .content-client th {
            padding: 10px;
            /* border: 1px solid #ddd; */
            text-align: left;
        }

        .payment-info {
            margin-top: 30px;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }

        .payment-info p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp

<body>
    <div class="container">
        <!-- Header with Logo and Invoice Heading -->
        <div class="header">
            @if($websiteSetting->header_logo)
                <img src="{{ asset('assets/images/logo/' . $websiteSetting->header_logo) }}" alt="Logo" style="height: 75px;">
            @else
                <img src="{{ asset('assets/images/logo/default-logo.png') }}" alt="Default Logo" style="height: 75px;">
            @endif
            <div class="invoice-heading">
                <h1>Invoice</h1>

            </div>
        </div>
        <!-- Client Details and Invoice Table -->
        <div class="content">
            <!-- Client Details -->
            <div class="client-details-invoice">
                <table class="content-client">
                    <thead>
                        <tr>
                            <th>
                                <p><strong>Company Name:</strong> {{$websiteSetting->name}}</p>
                                <p><strong>Company Address:</strong> {{$websiteSetting->address}}</p>
                            </th>
                            <th></th>
                            <th>
                                <p><strong>Email Address:</strong> {{$websiteSetting->email}}</p>
                                <p><strong>Phone Number:</strong> {{$websiteSetting->phone}}</p>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Invoice Details -->
            <div class="invoice-details">
                <h2>Invoice Details</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Event Date & Timing</th>
                            <th>Theater</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$booking->booking_id}}</td>
                            <td>
                            <p>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y h:i A') }}</p>
                            <p>{{$booking->slot}}</p>
                            </td>
                            <td>{{$booking->theater->name}}</td>
                            <td>₹ {{$booking->total_amount}}</td>
                        </tr>
                    </tbody>
                </table>
                <p><strong>Paid Amount:</strong>₹ {{$booking->paid_amount}}</p>
                <p class="text-danger"><strong>Pending Amount:</strong>₹ {{$booking->total_amount - $booking->paid_amount }}</p>
                <p><strong>Total Amount:</strong>₹ {{$booking->total_amount}} </p>


            </div>
        </div>

        <!-- Payment Information -->
        <div class="payment-info">
            <h2>Payment Information</h2>
           
            <p><strong>Payment ID:</strong> {{$paymentDetails->razorpay_payment_id}}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for your business! If you have any questions, please contact us at {{$websiteSetting->email}}.</p>
        </div>
    </div>
</body>

</html>