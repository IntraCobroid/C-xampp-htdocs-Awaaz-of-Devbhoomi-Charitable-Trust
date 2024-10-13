<?php
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

session_start();

$keyId = ''; 
$keySecret = '';

$api = new Api($keyId, $keySecret);

$attributes = array(
    'razorpay_order_id' => $_POST['razorpay_order_id'],
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
    'razorpay_signature' => $_POST['razorpay_signature']
);

try {
    // Verify payment
    $api->utility->verifyPaymentSignature($attributes);

    // Payment successful
    echo "Payment Successful! Thank you for your donation.";
    
    // Optionally store the payment details in database
    // mysqli_query($conn, "INSERT INTO donations (name, email, amount, payment_id) VALUES ('$name', '$email', '$amount', '$paymentId')");

} catch(SignatureVerificationError $e) {
    // Payment failed
    echo "Payment failed! Please try again.";
}

