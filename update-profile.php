<?php
require("header.php");
if(isset($_SESSION['login']) && $_SESSION['login']==true){
    if($_SESSION['userrole']=="Admin"){
        header("location:admin/cpanel-index.php");
        die();
    }
}
else{
    header("location:../login.php");
    die();
}
$username = $_SESSION['username'];
$q = "select * from user where username='$username'";
$result = mysqli_query($conn,$q);
$row = $result->fetch_assoc();

$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$addressline1 = $row['addressline1'];
$addressline2 = $row['addressline2'];
$addressline3 = $row['addressline3'];
$pin = $row['pin'];
$city = $row['city'];
$state = $row['state'];
$pic = $row['pic'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; 
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addressline1 = $_POST['addressline1'];
    $addressline2 = $_POST['addressline2'];
    $addressline3 = $_POST['addressline3'];
    $pin = $_POST['pin'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    if($_FILES['pic']['name']!=""){
        $pic = $_FILES['pic']['name'];
        move_uploaded_file($_FILES['pic']['tmp_name'],"media/images/".$pic);
    }
    $q = "update user set name = '$name',email = '$email',phone = '$phone',addressline1 = '$addressline1',addressline2 = '$addressline2',addressline3 = '$addressline3',city = '$city',state = '$state',pin = '$pin',pic = '$pic' where username = '$username'";
    mysqli_query($conn,$q);
    header("location:profile.php");
    die();
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
                <h5 class="background text-light text-center p-2">Update Section</h5>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" <?php echo("value = '$name'")?>>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email Id" <?php echo("value = '$email'")?>>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" <?php echo("value = '$phone'")?>>
                    </div>
                    <div class="mb-3">
                        <label for="addressline1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" name="addressline1" placeholder="Enter House Number or Building Number">
                    </div>
                    <div class="mb-3">
                        <label for="addressline2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" name="addressline2" placeholder="Enter Street Number or Near By">
                    </div>
                    <div class="mb-3">
                        <label for="addressline3" class="form-label">Address Line 3</label>
                        <input type="text" class="form-control" name="addressline3" placeholder="Enter Village or Locality">
                    </div>
                    <div class="mb-3">
                        <label for="pin" class="form-label">Pin Code</label>
                        <input type="text" class="form-control" name="pin" placeholder="Enter Pin Code">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" placeholder="Enter city Name">
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">state</label>
                        <input type="text" class="form-control" name="state" placeholder="Enter state Name">
                    </div>
                    <div class="mb-3">
                        <label for="pic" class="form-label">Profile Pic</label>
                        <input type="file" class="form-control" name="pic">
                    </div>
                    <button type="submit" class="btn background text-light w-100">Update</button>
                </form>
            </div>
            <div class="col-md-3 col-12"></div>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>