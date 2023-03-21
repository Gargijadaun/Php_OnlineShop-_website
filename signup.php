<?php
require("header.php");
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($cpassword == $password) {
        $q = "select * from user where username = '$username'";
        $result = mysqli_query($conn,$q);
        $count = mysqli_num_rows($result);
        if($count==1)
        $message="User Name is Already Taken!!!!!!";
        else{
            $q = "insert into user(name,username,email,phone,password) values('$name','$username','$email','$phone','$password')";
            mysqli_query($conn,$q);
            $to = $email;
            $subject="Thank to create a new account with US : Team-Online Shop";
            $body="Thanks to create a new Account with Us\nShop for Latest Products and Offerse\nThanks\nTeam : Online Shop";
            $header = "From:gargi.jadaun1@gmail.com";
            mail($to,$subject,$body,$header); 
            header("location:login.php");
            die();
        }
    } 
    else
    $message="Password and Confirm Password Doesn not Matched!!!";
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
                <h5 class="background text-light text-center p-2">Signup Section</h5>
                <?php
                    if($message!=""){
                        echo("<div class='alert alert-danger' role='alert'>
                                $message
                         </div>");
                    }
                ?>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter User Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email Id">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn background text-light w-100">Sign Up</button>
                    <div>
                        <a href="login.php" class="text-decoration-none">Already User?Login</a>
                    </div>
                </form>
            </div>
            <div class="col-md-3 col-12"></div>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>