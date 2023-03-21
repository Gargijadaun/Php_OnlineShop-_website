<?php
require("header.php");
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $q = "select * from user where username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$q);
    $count = mysqli_num_rows($result);
    if($count==0)
    $message="Invalid User Name or Password";
    else{
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $role = $row['role'];
        $_SESSION['login']=true;
        $_SESSION['userid']=$id;
        $_SESSION['username']=$username;
        $_SESSION['userrole']=$role;
        if($role=="admin")
            header("location:admin/cpanel-index.php");
        else
            header("location:profile.php");
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
                <h5 class="background text-light text-center p-2">Login Section</h5>
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
                        <input type="text" class="form-control" name="username" placeholder="Enter User Name to Login">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <button type="submit" class="btn background text-light w-100">Login</button>
                    <div class="d-flex justify-content-between">
                        <a href="forget-username.php" class="text-decoration-none">Forget Password</a>
                        <a href="signup.php" class="text-decoration-none">New User?Create a Free Account</a>
                    </div>
                </form>
            </div>
            <div class="col-md-3 col-12"></div>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>