<?php
require("header.php");
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];
    $sessionOTP = $_SESSION['otp']; 
    if($otp==$sessionOTP){
        header("location:forget-password.php");
        die();
    }
    else
    $message="Invalid OTP";
}
?>
<title>OnlineShop | Single Product Page</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-md-3 col-12"></div>
            <div class="col-md-6 col-12">
                <h5 class="background text-light text-center p-2">Forget Password Section</h5>
                <?php
                    if($message!=""){
                        echo("<div class='alert alert-danger' role='alert'>
                                $message
                         </div>");
                    }
                ?>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="otp" class="form-label">OTP</label>
                        <input type="text" class="form-control" name="otp" placeholder="Enter OTP which is Sent on Your  Registered Email Id">
                    </div>
                    <button type="submit" class="btn background text-light w-100">Submit</button>
                </form>
            </div>
            <div class="col-md-3 col-12"></div>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>