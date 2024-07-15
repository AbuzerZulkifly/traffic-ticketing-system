<?php 
include '../../registration/signup1/connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $action = $_POST['action'];

  if ($action == 'update') {
      $sql = "UPDATE fine SET payment = 'paid' WHERE id = $userid";
  }

  $con->close();
}

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
  <script src="https://js.stripe.com/v3/"></script>

</head>
<body class="bg-secondary">

<div class="container">
  <div class="row">
    <div class="col-md-4" style="margin-left: 420px; margin-top: 150px; padding:20px" >
      <div class="card" style=" padding:20px" >
        <div class="class-header">
          PAYMENT FORM
        </div>
        <div class="card-body">
        <form action="submit.php" method="post" id="payment-form">
  <div class="form-row">
    <label for="card-element" class="mb-2">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display Element errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button class="mt-4 btn btn-primary w-100">Submit Payment</button>
</form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // Set your publishable key: remember to change this to your live publishable key in production
// See your keys here: https://dashboard.stripe.com/apikeys
const stripe = Stripe('pk_test_51PbmdYRppTHKHGhkcu5eS7agbb2PNdfGn0figVYvEKSPSo8YWOlQPlXXIXt6cXmX5Nq1UyVS2xOfQZ2Txu26W8CM00tVmW0F2r');
const elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
const style = {
  base: {
    // Add your base input styles here. For example:
    fontSize: '16px',
    color: '#32325d',
  },
};

// Create an instance of the card Element.
const card = elements.create('card', {style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Create a token or display an error when the form is submitted.
const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {token, error} = await stripe.createToken(card);

  if (error) {
    // Inform the customer that there was an error.
    const errorElement = document.getElementById('card-errors');
    errorElement.textContent = error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(token);
  }
});

const stripeTokenHandler = (token) => {
  // Insert the token ID into the form so it gets submitted to the server
  const form = document.getElementById('payment-form');
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
</body>
</html>