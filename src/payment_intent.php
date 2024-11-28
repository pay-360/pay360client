<?php

use pay360\pay360client;
require_once('./vendor/autoload.php');
require_once('./vendor/pay-360/pay360client/src/pay360client.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Invalid request method.');
}

$user = $_POST['user'];
$pass = $_POST['pass'];
$refID = $_POST['ref_id'];
$package = $_POST['prod_name'];
$chargeAmount = (int)$_POST['unit_amount'];
$quantity = (int)$_POST['quantity'];
$line_items =   [   
    [
        'price_data' => [
            'currency' => $_POST['currency'],
            'product_data' => [ 'name' => $package ],
            'unit_amount' => $chargeAmount,
        ],
        'quantity' => $quantity,
    ],
];
$customer_email = $_POST['email'];
$paymentMethod = $_POST['mode'];
$success_url = $_POST['success_url'];
$cancel_url = $_POST['cancel_url'];
$status_url = $_POST['status_url'];

$payment_intent_info = [
    'user'          => $user,
    'pass'          => $pass,
    'refID'         => $refID,
    'line_items'    => $line_items,
    'email'         => $customer_email,
    'mode'          => $paymentMethod,
    'success_url'   => $success_url,
    'cancel_url'    => $cancel_url,
    'status_url'    => $status_url
];

$pay360client = new pay360client($user, $pass);
$pay360client->testingMode = true;

$result = $pay360client->paymentIntent($payment_intent_info);
$myresult = json_decode($result, true);

if ($myresult) {
    $redirect_url = "http://localhost:82/web_checkout/" . $refID;
    header("Location: " . $redirect_url);
}
else {
    echo "result: " . $result . "<br />";
}

exit;

?>