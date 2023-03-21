<?php
require('header.php');
require("navbar.php");
require('config.php');
require('razorpay-php/Razorpay.php');
$userid = $_SESSION['userid'];
if(isset($_GET['type'])){
    $cid = $_GET['cid'];   
    $q = "select * from checkout where id = '$cid'";
    $result = mysqli_query($conn,$q);
    $row = $result->fetch_assoc();
    $finalAmount = $row['final'];
    $_SESSION['checkoutid']=$cid;
    $_SESSION['old']=true;
}
else{
    $q = "select * from checkout where userid = '$userid' order by id desc limit 1";
    $result = mysqli_query($conn,$q);
    $row = $result->fetch_assoc();
    $cid = $row['id'];
    $finalAmount = $row['final'];
}

$q = "select * from user where id = '$userid'";
$result = mysqli_query($conn,$q);
$row = $result->fetch_assoc();
$username = $row['name'];
$useremail = $row['email'];
$userphone = $row['phone'];
// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $cid,
    'amount'          => $finalAmount * 100, 
    'currency'        => $displayCurrency,
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'manual';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "OnlineShop",
    "description"       => "Ecom Website",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => $username,
    "email"             => $useremail,
    "contact"           => $userphone,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("RPcheckout/{$checkout}.php");
require("footer.php");
?>
