<?php
require("header.php");
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    if($password==$cpassword)
    {
        $username = $_SESSION["resetuser"];
        $q = "update user set password = '$password' where username = '$username'";
        mysqli_query($conn,$q);
        header("location:login.php");
        die();
    }
    else
        $message="Password and confirm Password Does't Matched!!!";
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
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
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