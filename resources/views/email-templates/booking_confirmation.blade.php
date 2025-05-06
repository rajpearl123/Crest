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
        <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Dear {{ $booking->user->name }}, Welcome to Partyscape!</h2>
            <p class="text-gray-600 text-center">Thank you for booking! We're thrilled to have you.</p>

            <div class="mt-6">
                <div class="p-4 bg-gray-100 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Booking Details</h3>
                    <p><strong>Booking ID:</strong> {{ $booking->booking_id }}</p>
                    
                    <p> 
                        @php
                            $celebrity = json_decode($booking->celebrity_name, true);
                        @endphp
                        @if(!empty($celebrity['label_1']) && !empty($celebrity['name_1']))
                            <strong class="block text-gray-900 text-lg font-semibold">{{ $celebrity['label_1'] }}:</strong>
                            <span class="text-gray-700 text-base">{{ $celebrity['name_1'] }}</span>
                        @endif
                        @if(!empty($celebrity['label_2']) && !empty($celebrity['name_2']))
                            <strong class="block text-gray-900 text-lg font-semibold mt-2">{{ $celebrity['label_2'] }}:</strong>
                            <span class="text-gray-700 text-base">{{ $celebrity['name_2'] }}</span>
                        @endif
                    </p>
                    <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($booking->event_date)->format('d/m/Y') }}</p>
                    <p><strong>Time:</strong><span class="badge bg-success"> {{ \Carbon\Carbon::parse($booking->slot->start_time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($booking->slot->end_time)->format('h:i A') }}</span></p>
                    <p><strong>Theatre Name:</strong> {{ $booking->theater->name ?? 'N/A' }}</p>
                    <p><strong>Number of People:</strong> {{ $booking->capacity }}</p>
                    <p><strong>Event Type:</strong> {{ $booking->decoration->name }}</p>
                </div>

                <div class="p-4 mt-4 bg-gray-100 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Billing Estimation</h3>
                    <p><strong>Theatre Charges:</strong> ₹{{ $booking->theater->price ?? 'N/A' }}</p>
                    <p><strong>Decoration Charge:</strong> ₹{{ $booking->decoration->price ?? 'N/A' }}</p>
                    <h4 class="font-semibold mt-2">Add-ons:</h4>
                    <p>{{ $addon->name ?? "NONE" }} - ₹{{ $addon->price ?? "NONE" }}</p>
                    @php
                        $cakePrice = 0;
                        if ($booking->cake_id) {
                            if ($booking->weight == 'half' && $booking->type == 'regular') {
                                $cakePrice = $booking->cake->price_regular_half;
                            } elseif ($booking->weight == 'half' && $booking->type == 'eggless') {
                                $cakePrice = $booking->cake->price_eggless_half;
                            } elseif ($booking->weight == 'one' && $booking->type == 'regular') {
                                $cakePrice = $booking->cake->price_regular_one;
                            } elseif ($booking->weight == 'one' && $booking->type == 'eggless') {
                                $cakePrice = $booking->cake->price_eggless_one;
                            }
                        }
                    @endphp
                    @if($booking->cake_id)
                        <div class="p-4 mt-4 bg-white shadow-md rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-800">Cake Details</h4>
                            <p><strong>Name:</strong> {{ $booking->cake->name }}</p>
                            <p><strong>Type:</strong> {{ ucfirst($booking->type) }}</p>
                            <p><strong>Weight:</strong> {{ ucfirst($booking->weight) }}</p>
                            <p><strong>Price:</strong> ₹{{ $cakePrice }}</p>
                        </div>
                    @endif
                    <p><strong>Total Amount:</strong> ₹{{ $booking->total_amount }}</p>
                    <p><strong>Advance Paid:</strong> ₹{{ $booking->paid_amount }}</p>
                    <p><strong>Pending Amount:</strong> ₹{{ $booking->total_amount - $booking->paid_amount }}</p>
                    <p class="text-red-600">(Clear this due at the exit time)</p>
                </div>

                <div class="p-4 mt-4 bg-gray-100 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800">Theatre Location</h3>
                    <p><a href="{{ $theater->address ?? '#' }}" target="_blank" class="text-blue-600 underline">Click Here for Directions</a></p>
                </div>

                <div class="p-4 mt-4 bg-gray-100 rounded-lg">
                    <p><strong>Booked by:</strong> {{ $booking->user->name ?? '' }}</p>
                </div>
            </div>

            <p class="text-center mt-6 text-gray-700">Enjoy seamless booking for theater events, exclusive access to upcoming shows, and a world of unforgettable experiences.</p>
            <p class="text-center font-semibold text-gray-800">Get ready for an exciting journey with <strong>Partyscape</strong>!</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Stay tuned for updates on our latest events.</p>
            <p>Best Regards, <br> The Partyscape Team</p>
        </div>
    </div>

</body>
</html>
