<?php
require __DIR__ . "../../vendor/autoload.php";

$stripe = "sk_test_51PbmdYRppTHKHGhk7JJzt5y7PPp50vF7jsvaY4JB8708zO9Qk0vOEQBWxnOnnyJgnjg2F6XpOXuTdO8fOfmvjTkz00LO6QsBtC";

\Stripe\Stripe::setApiKey("$stripe");

$checkout = \Stripe\Checkout\Session::create([
  "mode" => "payment",
  "line_items"=> [
    "quantity"=> 1,
    "price" => [
      "currency" => "lkr",
      "unit_amount"=> 2000,
      "product_data"=> [
        "name" => "fine"
      ]
    ]
  ],
]);
http_response_code(303);
header("Location: " . $checkout_session-> url);
?>