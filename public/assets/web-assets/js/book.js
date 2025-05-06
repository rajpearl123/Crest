document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('multi-step-form');
    const steps = document.querySelectorAll('.form-step');
    const nextBtns = document.querySelectorAll('.next-step');
    const prevBtns = document.querySelectorAll('.prev-step');
    const summary = document.getElementById('summary');
    let currentStep = 0;

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (validateStep()) {
                steps[currentStep].classList.remove('active');
                currentStep++;
                if (currentStep < steps.length) {
                    steps[currentStep].classList.add('active');
                }
                if (currentStep === steps.length - 1) {
                    displaySummary();
                }
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
        });
    });
    function validateStep() {
        let stepIsValid = true;
        const currentInputs = steps[currentStep].querySelectorAll('input, textarea');
        currentInputs.forEach(input => {
            if (!input.checkValidity()) {
                input.reportValidity();
                stepIsValid = false;
            }
        });
        return stepIsValid;
    }

    function displaySummary() {
        const name = document.getElementById('name').value || 'N/A';
        const email = document.getElementById('email').value || 'N/A';
        const prefs = Array.from(document.querySelectorAll('input[name="pref"]:checked')).map(el => el.value).join(', ') || 'None';
        const comments = document.getElementById('comments').value || 'None';

        summary.innerHTML = `
     <p><strong>Name:</strong> ${name}</p>
     <p><strong>Email:</strong> ${email}</p>
     <p><strong>Preferences:</strong> ${prefs}</p>
     <p><strong>Comments:</strong> ${comments}</p>
 `;
    }

    // Initialize steps
    steps.forEach((step, index) => {
        if (index !== currentStep) {
            step.classList.remove('active');
        } else {
            step.classList.add('active');
        }
    });
});
//    
document.addEventListener("DOMContentLoaded", function() {
    const offerElements = document.querySelectorAll('.offers_content');

    offerElements.forEach(function(offer) {
        offer.addEventListener('click', function() {
            // Get the current background and text color from the computed styles
            const currentBackgroundColor = window.getComputedStyle(offer).backgroundColor;
            const currentTextColor = window.getComputedStyle(offer).color;

            // Check if the background color is #ee4423 (RGB equivalent)
            if (currentBackgroundColor === 'rgb(238, 68, 35)') { // #ee4423 in RGB
                offer.style.backgroundColor = ''; // Reset to initial
                offer.style.color = ''; // Reset to initial text color
            } else {
                offer.style.backgroundColor = '#ee4423'; // Set background color to red
                offer.style.color = '#ffffff'; // Set text color to white
            }
        });
    });
});



//CHOOSE DECORATIONS
document.addEventListener("DOMContentLoaded", function () {
    const formDecoration = document.querySelector('.form_decoration');
    if (formDecoration) {
        const offerElements = formDecoration.querySelectorAll('.offers_content');
        const itemContent = formDecoration.querySelector('.item_content');

        offerElements.forEach(function (offer) {
            offer.addEventListener('click', function () {
                // Remove selection from all offers
                offerElements.forEach(el => {
                    el.classList.remove('selected');
                    el.style.backgroundColor = ''; // Reset background
                });

                // Select the clicked offer
                offer.classList.add('selected');
                offer.style.backgroundColor = 'rgb(238, 68, 35)'; // Highlight selection

                // Show item content
                itemContent.style.display = 'block';
            });
        });
    }
});

// CHOOSE CAKES
document.addEventListener("DOMContentLoaded", function () {
    const cakeOptions = document.querySelector('.item_content');
    const cakeSelections = document.querySelectorAll('.offers_content'); // Each cake option
    const weightOptions = cakeOptions.querySelectorAll('input[name="weight"]');
    const typeOptions = cakeOptions.querySelectorAll('input[name="type"]');

    cakeOptions.style.display = 'none';

    cakeSelections.forEach(function (cake) {
        cake.addEventListener('click', function () {
            cakeSelections.forEach(el => {
                el.classList.remove('selected');
                el.style.backgroundColor = ''; 
            });

            cake.classList.add('selected');
            cake.style.backgroundColor = 'rgb(238, 68, 35)';

            // Reset radio button selections
            weightOptions.forEach(el => el.checked = false);
            typeOptions.forEach(el => el.checked = false);
        });
    });

    // Allow only one selection for weight & type
    weightOptions.forEach(function (option) {
        option.addEventListener('change', function () {
            weightOptions.forEach(el => el.checked = false);
            option.checked = true;
        });
    });

    typeOptions.forEach(function (option) {
        option.addEventListener('change', function () {
            typeOptions.forEach(el => el.checked = false);
            option.checked = true;
        });
    });
});

// REGISTER THE USER IF NOT REGISTERED
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#register_user').on('click', function() {
        console.log("Ajax Load");

        var name = $('input[name="name"]').val();
        var email = $('input[name="email"]').val();
        var phone = $('input[name="number"]').val();
        var theater_id = $('input[name="theater_id"]').val();
        var date = $('input[name="date"]').val();
        var slot_id = $('input[name="slot_id"]').val();
        
        console.log(name, email, phone, theater_id, date, slot_id);

        $.ajax({
            url: registerUrl,
            type: "POST",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'name': name,
                'email': email,
                'phone': phone,
                'theater_id': theater_id,
                'date': date,
                'slot_id': slot_id
            },
            success: function(response) {
                console.log("Success:", response);
            },
            error: function(xhr, status, error) {
                console.log("Error:", xhr.responseText);
            }
        });
    });
    
    
    // // DECORATION IN PREVIEW
    $('.decoration_name').on('click', function () {
        let decorationName = $(this).parent().data('name'); 
        $('#decoration_preview span').text(decorationName); 
    });

    // HANDLING THE DECORATION NAMES AND LABELS DYNAMICALLY STARTS HERE 
    // Define decoration field mappings
    const decorationFields = {
        "birthday": { fields: 1, label1: "Birthday Person Name" },
        "anniversary": { fields: 2, label1: "Your Name", label2: "Partner's Name" },
        "congratulations": { fields: 1, label1: "Name of the Special Person" },
        "baby shower": { fields: 1, label1: "Baby Name" },
        "love proposal": { fields: 2, label1: "Your Nick Name", label2: "Partner's Name" },
        "marriage proposal": { fields: 2, label1: "Your Nick Name", label2: "Partner's Name" },
        "romantic date": { fields: 2, label1: "Your Nick Name", label2: "Partner's Name" },
        "farewell": { fields: 1, label1: "Special Person Name" },
        "mom to be": { fields: 1, label1: "Mom's Name" },
        "groom to be": { fields: 1, label1: "Groom's Name" },
        "bride to be": { fields: 1, label1: "Bride's Name" }
    };

    $('.decoration_name').on('click', function () {
        let decorationName = $(this).parent().data('name').toLowerCase().trim(); // Fixing data retrieval

        console.log("Clicked Decoration:", decorationName); // Debugging

        // Hide all name fields initially
        $('.name-fields').hide();

        if (decorationFields[decorationName]) {
            let config = decorationFields[decorationName];

            // Update label text
            $('label[for="name_1"]').text(config.label1);
            $('#label_1').val(config.label1);
            $('#name_1').attr("placeholder", config.label1).val("");

            if (config.fields === 2) {
                $('label[for="name_2"]').text(config.label2);
                $('#label_2').val(config.label2);
                $('#name_2').attr("placeholder", config.label2).val("").show();
                $('label[for="name_2"]').show();
            } else {
                $('#name_2, label[for="name_2"]').hide();
            }

            // Show the relevant fields
            $('.name-fields').show();
        }
    });
    // HANDLING THE DECORATION NAMES AND LABELS DYNAMICALLY ENDS HERE


    // Handle Step Visibility - Show name fields only on the decoration step
    $('.next-step, .prev-step').on('click', function () {
        let isDecorationStep = $('.form-step:visible').hasClass('form_decoration');

        if (isDecorationStep) {
            $('.item_content').show();
        } else {
            $('.item_content').hide(); // Hide fields on other steps
        }
    });

    // ADDON IN PREVIEW
    $('.addon_item').on('click', function () {
        let addonName = $(this).data('name');
        $('#addon_preview span').text(addonName);
    });
    
    // SELECTED CAKE IN PREVIEW
    $(".offers_content").on("click", function () {
        let weight = $("input[name='weight']:checked").val();
        let type = $("input[name='type']:checked").val();
        let price = $(this).data(`price_${type}_${weight}`);
    
        let capitalizedType = type.charAt(0).toUpperCase() + type.slice(1);
        let capitalizedWeight = weight === "half" ? "1/2" : "1"; 
    
        $("#cake_preview").html(`<i class="fa-solid fa-cake-candles"></i> <span>${$(this).data("name")} - ${capitalizedType} - ${capitalizedWeight} kg - ₹${price}</span>`);
    });
    

    // PRICE PREVIEW IN TOTAL
    let theaterPrice = parseFloat($('#total_price').text()); 
    let totalAddOnPrice = 0;
    let selectedCakePrice = 0;

    // Initially show only the theater price
    $('.payable-amount').text(`Price: ₹${theaterPrice.toFixed(2)}`);

    function updateCakePrice() {
        let weight = $('input[name="weight"]:checked').val();
        let type = $('input[name="type"]:checked').val();
        selectedCakePrice = parseFloat(selectedCake.data(`price_${type}_${weight}`)) || 0;
        let cakeName = selectedCake.data('name');
        let weightText = weight === 'half' ? '1/2 kg' : '1 kg';
        let typeText = type.charAt(0).toUpperCase() + type.slice(1); // Capitalize type
        let previewText = `${cakeName} - ${weightText} (${typeText}) - ₹ ${selectedCakePrice.toFixed(2)}`;
        $('#cake_preview span').text(previewText);
        updateTotalPrice();
    }

    function updateTotalPrice() {
        let totalPrice = theaterPrice + totalAddOnPrice + selectedCakePrice;
        $('#total_price').text(totalPrice.toFixed(2)); 
        $('.payable-amount').text(`Price: ₹${totalPrice.toFixed(2)}`); // Update the price in .payable-amount
    }

    $('.addon_item').on('click', function () {
        let addonPrice = parseFloat($(this).data('price'));
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            totalAddOnPrice -= addonPrice;
        } else {
            $(this).addClass('selected');
            totalAddOnPrice += addonPrice;
        }
        updateTotalPrice();
    });

    let selectedCake = null;
    $('.cake_item').on('click', function () {
        selectedCake = $(this);
        updateCakePrice();
    });

    $('input[name="weight"], input[name="type"]').on('change', function () {
        if (selectedCake) {
            updateCakePrice();
        }
    });

    // RAZORPAY PAYEMNT GATEWAY
    $('#payWithRazorpay').on('click', function () {
        updateTotalPrice();
        setTimeout(payWithRazorpay, 300);
    });
    
    function payWithRazorpay() {
        let totalAmount = parseFloat($('#total_price').text());
        let name = $('#name').val();
        let number = $('#number').val();
        let email = $('#email').val();
        $('#total_amount').val(totalAmount);
    
        if (!name || !number || !email) {
            alert("Please enter your details before proceeding with payment.");
            return;
        }
    
        fetch(initiatePayment, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                amount: 750,
                name: name,
                number: number,
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.order_id) {
                alert("Order ID not received.");
                return;
            }
    
            var options = {
                "key": data.razorpay_key,
                "amount": data.amount * 100,
                "currency": data.currency,
                "order_id": data.order_id,
                "name": name,
                "description": "Advance Payment",
                "prefill": {
                    "name": name,
                    "email": email,
                    "contact": number
                },
                "handler": function (response) {
                    console.log("Payment Successful:", response);
    
                    // Show loader
                    $('.custom-loader').removeClass('d-none');
                    $('body').css('pointer-events', 'none');
    
                    fetch(paymentSuccess, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            ...response,
                            name: name,
                            number: number,
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        $('#multi-step-form').submit();
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        // Hide loader after redirection
                        $(window).on('pageshow', function () {
                            $('.custom-loader').addClass('d-none');
                            $('body').css('pointer-events', 'auto');
                        });
                    });
                }
            };
    
            var rzp = new Razorpay(options);
            rzp.open();
        })
        .catch(error => console.error('Fetch Error:', error));
    }
    
});    

