<?php
require('header.php');
require("navbar.php");
require('config.php');
if(isset($_SESSION["old"]) and $_SESSION['old']==true){
    $cid = $_SESSION['checkoutid'];   
    $_SERVER['old']=false;
}
else{
    $userid = $_SESSION['userid'];
    $q = "select * from checkout where userid = '$userid' order by id desc limit 1";
    $result = mysqli_query($conn,$q);
    $row = $result->fetch_assoc();
    $cid = $row['id'];
}
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $orderid = $_SESSION['razorpay_order_id'];
    $razorPayId = $_POST['razorpay_payment_id'];
    $razorPaySignature = $_POST['razorpay_signature'];
    $q = "update checkout set rpoid = '$orderid',rppid = '$razorPayId',rpsid = '$razorPaySignature',paymentstatus='Done' where id = '$cid'";
    $result = mysqli_query($conn,$q);
}   
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

header("location:confirm.php");
die();
require("footer.php");
?>
