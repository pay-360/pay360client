<?php
use pay360\pay360client;
require_once('./vendor/autoload.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Invalid request method.');
}

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
    'user'          => 'XdW81wR9YB',
    'pass'          => 'OoB9S7fnjFAyyI2RcVGynkW2fR4N17EqUhdzR9fQ',
    'refID'         => $refID,
    'line_items'    => $line_items,
    'email'         => $customer_email,
    'mode'          => $paymentMethod,
    'success_url'   => $success_url,
    'cancel_url'    => $cancel_url,
    'status_url'    => $status_url
];

$pay360client = new pay360client();
$pay360client->testingMode = true;

$result = $pay360client->paymentIntent($payment_intent_info);
$myresult = json_decode($result, true);

$redirect_url = "http://localhost:82/web_checkout/" . $refID;
header("Location: " . $redirect_url);

exit;

?>