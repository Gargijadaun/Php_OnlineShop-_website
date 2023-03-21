<?php
ob_start();
require("header.php");
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    if ($_SESSION['userrole'] == "Admin") {
        header("location:admin/cpanel-index.php");
        die();
    }
} else {
    header("location:../login.php");
    die();
}
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$q = "select * from user where username='$username'";
$result = mysqli_query($conn, $q);
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
?>
<title>OnlineShop | Checkout Page</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <div class="row mt-3">
        <div class="col-md-6 col-sm-12 col-12">
            <h5 class="background text-light text-center p-2">Billing Details</h5>
            <table class="table table-light table-striped table-hover">
                <tr>
                    <th>Name</th>
                    <td><?php echo $name ?></td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td><?php echo $username ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $phone ?></td>
                </tr>
                <tr>
                    <th>Address Line 1</th>
                    <td><?php echo $addressline1 ?></td>
                </tr>
                <tr>
                    <th>Address Line 2</th>
                    <td><?php echo $addressline1 ?></td>
                </tr>
                <tr>
                    <th>Address Line 3</th>
                    <td><?php echo $addressline3 ?></td>
                </tr>
                <tr>
                    <th>Pin</th>
                    <td><?php echo $pin ?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?php echo $city ?></td>
                </tr>
                <tr>
                    <th>State</th>
                    <td><?php echo $state ?></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="update-profile.php" class="btn background text-light w-100">Update Profile</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
            <h5 class="background text-light text-center p-2">Checkout Section</h5>
            <table class="table table-light table-striped table-hover">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
                <?php
                $userid  = $_SESSION['userid'];
                $q = "select * from cart where userid = '$userid'";
                $result = mysqli_query($conn, $q);
                $count = mysqli_num_rows($result);
                $carttotal = 0;
                $shipping = 0;
                $final = 0;
                while ($row = $result->fetch_assoc()) {
                    $pic = $row['pic'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $productid = $row['productid'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $id = $row['id'];
                    $carttotal = $carttotal + $total;

                    echo ("
                    <tr>
                        <td><img src='./media/images/$pic' height='100px' width='100px' class='rounded'>
                        <td>$name</td>
                        <td>&#8377;$price</td>
                        <td>$qty</td>
                        <td>&#8377;$total</td>
                    </tr>
                ");
                }
                if ($carttotal < 1000 && $count != 0)
                    $shipping = 150;
                $final = $carttotal + $shipping;
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $mode = $_POST['mode'];
                    $q = "insert into checkout(userid,total,shipping,final,mode) values('$userid','$carttotal','$shipping','$final','$mode')";
                    mysqli_query($conn, $q);
                    $q = "select * from checkout where userid = '$userid' order by id desc limit 1";
                    $result = mysqli_query($conn, $q);
                    $row = $result->fetch_assoc();
                    $checkid = $row['id'];
                    
                    $q = "select * from cart where userid = '$userid'";
                    $result = mysqli_query($conn, $q);
                    while ($row = $result->fetch_assoc()) {
                        $pic = $row['pic'];
                        $name = $row['name'];
                        $color = $row['color'];
                        $size = $row['size'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];

                        $q = "insert into checkoutproducts(checkoutid,name,pic,color,size,price,qty,total) values('$checkid','$name','$pic','$color','$size','$price','$qty','$total')";
                        mysqli_query($conn, $q);
                    }
                    $q = "delete from cart where userid = '$userid'";
                    mysqli_query($conn, $q);
                    if($mode=="COD")
                    {
                        header("location:confirm.php");
                        die();   
                    }
                    else{
                        header("location:pay.php");
                        die(); 
                    }
                }
                ?>
            </table>
            <table class="table table-light table-striped table-hover">
                <tr>
                    <th>Total Amount</th>
                    <td>&#8377;<?php echo $carttotal ?></td>
                </tr>
                <tr>
                    <th>Shipping Amount</th>
                    <td>&#8377;<?php echo $shipping ?></td>
                </tr>
                <tr>
                    <th>Final Amount</th>
                    <td>&#8377;<?php echo $final ?></td>
                </tr>
                <form action="" method="post">
                    <tr>
                        <th>Mode of Payment</th>
                        <td>
                            <select name="mode" class="form-select">
                                <option value="COD">COD</option>
                                <option value="Net Banking">Net Banking/Card/UPI/Wallet/Pay Later</option>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <?php
                        if ($carttotal != 0) {
                            echo ("<td colspan='2'><button class='btn background text-light w-100'>Place Order</button></td>");
                        }
                        ?>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    <?php
    require("footer.php");
    ob_end_flush();
    ?>