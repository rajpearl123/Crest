$(document).ready(function() {
    $('#password, #confirm-password').on('input', function() {
        let password = $('#password').val();
        let confirmPassword = $('#confirm-password').val();

        // Validate Password Length
        if (password.length < 8) {
            $('#password').css({
                'border-color': 'red',
                'border-width': '2px',
                'border-style': 'solid'
            });
        } else {
            $('#password').css({
                'border-color': 'green',
                'border-width': '2px',
                'border-style': 'solid'
            });
        }

        // Check if Passwords Match
        if (confirmPassword.length > 0) {
            if (password !== confirmPassword) {
                $('#confirm-password').css({
                    'border-color': 'red',
                    'border-width': '2px',
                    'border-style': 'solid'
                });
                $('#confirm-password-message').text('Passwords do not match').css('color', 'red');
                $('.submit-btn').prop('disabled', true);
            } else {
                $('#confirm-password').css({
                    'border-color': 'green',
                    'border-width': '2px',
                    'border-style': 'solid'
                    
                });
                $('#confirm-password-message').text('Passwords match').css('color', 'green');
                $('.submit-btn').prop('disabled', false);

            }
        } else {
            $('#confirm-password-message').text('');
        }
    });
});
