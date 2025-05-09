<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusher Test with Icons</title>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Pusher JavaScript -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <style>
        /* Custom style for Toastr notifications */
        .toast-info .toast-message {
            display: flex;
            align-items: center;
        }
        .toast-info .toast-message i {
            margin-right: 10px;
        }
        .toast-info .toast-message .notification-content {
            display: flex;
            flex-direction: row;
            align-items: center;
        }
    </style>
    <script>
        Pusher.logToConsole = true;

        // Initialize Pusher
        var pusher = new Pusher('e67c1011d372e6e5e640', {
            cluster: 'ap2',
            useTLS: true
        });

        // Subscribe to the channel
        var channel = pusher.subscribe('notification');

        // Bind to the event
        channel.bind('booking.notification', function(data) {
            console.log('Received data:', data); // Debugging line

            // Display Toastr notification with icons and inline content
            if (data.booking_id && data.created_at) {
                toastr.info(
                    `<div class="notification-content">
                        <i class="fas fa-project-diagram"></i> 
                        <span>Booking ID: ${data.booking_id}</span><br>
                        <i class="fas fa-clock"></i> 
                        <span>Created At: ${new Date(data.created_at).toLocaleString()}</span>
                    </div>`,
                    'New Booking Canceled',
                    {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 5000, // Adjust this as needed
                        extendedTimeOut: 2000,
                        positionClass: 'toast-top-right',
                        enableHtml: true
                    }
                );
            }else {
                console.error('Invalid data received:', data);
            }
        });

        // Debugging line
        pusher.connection.bind('connected', function() {
            console.log('Pusher connected');
        });
    </script>
</head>
<body>
    <h1>Pusher Test with Icons</h1>
    <p>
        Try publishing an event to channel <code>notification</code>
        with event name <code>booking.notification</code>.
    </p>
</body>
</html>