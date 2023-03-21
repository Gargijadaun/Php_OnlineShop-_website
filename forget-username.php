<?php
require("header.php");
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $q = "select * from user where username = '$username'";
    $result = mysqli_query($conn,$q);
    $count = mysqli_num_rows($result);
    if($count==0)
    $message="Invalid User Name";
    else{
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $otp = random_int(100000,999999);
        $_SESSION['resetuser']=$username;
        $_SESSION['otp']=$otp;
        $to = $email;
        $subject="OTP to Reset Password : Team-Online Shop";
        $body="Your OTP to reaset Password is $otp!!!!\nThanks\nTeam : Online Shop";
        $header = "From:gargijadaun1@gmail.com";
        mail($to,$subject,$body,$header);
        header("location:forget-otp.php");
        die();
    }
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
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter User Name to forget Password">
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