<?php
require 'vendor/autoload.php'; // Ensure Composer's autoloader is included

use Razorpay\Api\Api;

session_start();

// Razorpay API keys
$keyId = 'rzp_test_IxA7xmqMlOX4EW';  
$keySecret = 'WVdCwnDbdPyqBAwBuQ4WPQfw';  

$api = new Api($keyId, $keySecret);

$donationAmount = $_POST['amount'] * 100;  

$orderData = [
    'receipt'         => (string)rand(1000,9999),
    'amount'          => $donationAmount, 
    'currency'        => 'INR',
    'payment_capture' => 1 
];


$razorpayOrder = $api->order->create($orderData);


$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$data = [
    "key"               => $keyId,
    "amount"            => $donationAmount,
    "name"              => "Awaaz of Devbhoomi Charitable Trust",
    "description"       => "Donation",
    "image"             => "images/index/logo.png", 
    "prefill"           => [
        "name"              => $_POST['name'],
        "email"             => $_POST['email'],
        "contact"           => $_POST['contact'],
    ],
    "theme"             => [
        "color"             => "#528FF0"
    ],
    "order_id"          => $razorpayOrderId
];

$jsonData = json_encode($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Donation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(161, 201, 201); 
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #333;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .logo {
            width: 100px; 
            margin: 0 auto 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }

        .spinner {
            margin: 20px 0;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="images/index/logo2.png" alt="Trust Logo" class="logo"> <!-- Trust logo -->
        <h2>Please wait while we process your donation...</h2>
        <div class="spinner"></div>
        
        <!-- Razorpay Checkout Form -->
        <form action="verify.php" method="POST" id="razorpay-form">
            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="<?php echo $data['key']; ?>"
                data-amount="<?php echo $data['amount']; ?>"
                data-currency="INR"
                data-name="<?php echo $data['name']; ?>"
                data-description="<?php echo $data['description']; ?>"
                data-image="<?php echo $data['image']; ?>"
                data-prefill.name="<?php echo $data['prefill']['name']; ?>"
                data-prefill.email="<?php echo $data['prefill']['email']; ?>"
                data-prefill.contact="<?php echo $data['prefill']['contact']; ?>"
                data-order_id="<?php echo $data['order_id']; ?>"
                data-theme.color="<?php echo $data['theme']['color']; ?>"
                >
            </script>
            <input type="hidden" name="donation_amount" value="<?php echo $_POST['amount']; ?>">
        </form>
    </div>
    
    <div class="footer">
        Thank you for your support!
    </div>
</body>
</html>
