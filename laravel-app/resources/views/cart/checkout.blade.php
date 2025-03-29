
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Checkout Integration | Horizontal Buttons </title>
    <style>
        .paypal-button-container
        {
            pointer-events: none;     // <---- key point
            opacity: 0.7;
        }
    </style>
</head>

<body>
<div>You have {{ $countItems }} items in your cart, do you want to pay for its?</div><br>
<div>Just pass require fields</div><br>
<span id="name-error" class="error-message"></span><br>
<label for="name">Name:</label>
<input type="text" title="test" id="name" onfocus="return validateForm()" onblur="return validateForm()"><br>
<span id="address-error" class="error-message"></span><br>
<label for="address">Address:</label>
<input type="text" id="address" onfocus="return validateForm()" onblur="return validateForm()"><br>
<span id="email-error" class="error-message"></span><br>
<label for="email">E-mail Address:</label>
<input type="text" id="email" onfocus="return validateForm()" onblur="return validateForm()"><br><br>

<!-- Set up a container element for the button -->
<div id="paypal-button-container" class="paypal-button-container"></div>


<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.' . config('paypal.mode') . '.client_id') }}&currency={{ config('paypal.currency') }}"></script>

<script>

    function validateForm() {
        const name = document.getElementById("name").value;
        const addr = document.getElementById("address").value;
        const email = document.getElementById("email").value;

        const nameErr = document.getElementById("name-error");
        const addrErr = document.getElementById("address-error");
        const emailErr = document.getElementById("email-error");

        nameErr.textContent = "";
        addrErr.textContent = "";
        emailErr.textContent = "";

        let isValid = true;
        if (name === "" || /\d/.test(name)) {
            nameErr.textContent = "Please enter your name properly.";
            isValid = false;
        }
        if (addr === "") {
            addrErr.textContent = "Please enter your address.";
            isValid = false;
        }
        if (email === "" || !email.includes("@") || !email.includes(".")) {
            emailErr.textContent = "Please enter a valid email address.";
            isValid = false;
        }

        if (isValid) {
            document.getElementById('paypal-button-container').removeAttribute("class")
            return true;
        } else {
            return false;
        }
    }

    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
        style: {
            layout: 'horizontal'
        },

        // Call your server to set up the transaction
        createOrder: function(data, actions) {
            return fetch('/demo/checkout/api/paypal/order/create/', {
                method: 'post',
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },

        // Call your server to finalize the transaction
        onApprove: function(data, actions) {
            return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                method: 'post'
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                // Three cases to handle:
                //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                //   (2) Other non-recoverable errors -> Show a failure message
                //   (3) Successful transaction -> Show confirmation or thank you

                // This example reads a v2/checkout/orders capture response, propagated from the server
                // You could use a different API or structure for your 'orderData'
                var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                    return actions.restart(); // Recoverable state, per:
                    // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                }

                if (errorDetail) {
                    var msg = 'Sorry, your transaction could not be processed.';
                    if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                    if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                    return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                }

                // Successful capture! For demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                // Replace the above to show a success message within this page, e.g.
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }
    }).render('#paypal-button-container');

</script>
</body>

</html>
