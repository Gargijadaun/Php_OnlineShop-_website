<?php
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
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $id = $_GET['id'];
    $q = "delete from wishlist where id='$id'";
    mysqli_query($conn, $q);
    header("location:profile.php");
    die();
}
$username = $_SESSION['username'];
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
$pic = $row['pic'];
?>
<title>OnlineShop | User Profile Page</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <div class="row mt-3 mb-2">
        <div class="col-sm-6 col-12">
            <?php
            if ($pic)
                echo ("<img src='./media/images/$pic' height='500px' class='w-100'>");
            else
                echo ("<img src='./static/images/noimage.png' height='500px' class='w-100'>");
            ?>
        </div>
        <div class="col-sm-6 col-12">
            <h5 class="background text-light text-center p-2">User Profile Section</h5>
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
    </div>
    <h5 class="background text-light text-center p-2">Wishlist Section</h5>
    <table class="table table-light table-striped table-hover">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Color</th>
            <th>Size</th>
            <th>Price</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $userid  = $_SESSION['userid'];
        $q = "select * from wishlist where userid = '$userid'";
        $result = mysqli_query($conn, $q);
        while ($row = $result->fetch_assoc()) {
            $pic = $row['pic'];
            $name = $row['name'];
            $color = $row['color'];
            $size = $row['size'];
            $price = $row['price'];
            $productid = $row['productid'];
            $id = $row['id'];
            echo ("
                    <tr>
                        <td><img src='./media/images/$pic' height='100px' width='100px' class='rounded'>
                        <td>$name</td>
                        <td>$color</td>
                        <td>$size</td>
                        <td>$price</td>
                        <td><a href='single-product-page.php?id=$productid'><i class='material-icons'>shopping_cart</i></td>
                        <td><a href='profile.php?type=delete&id=$id'><i class='material-icons'>delete_forever</i></td>
                    </tr>
                ");
        }
        ?>
    </table>
    <h5 class="background text-light text-center p-2">Order History Section</h5>
    <div class='row'>
        <?php
        $q = "select * from checkout where userid = '$userid'";
        $result = mysqli_query($conn, $q);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $total = $row['total'];
            $shipping = $row['shipping'];
            $final = $row['final'];
            $mode = $row['mode'];
            $status = $row['status'];
            $paymentstatus = $row['paymentstatus'];
            $date = $row['date'];
            echo ("
                <div class='col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12'>
                    <table class='table'>
                        <tr>
                            <th>Order Id</th>
                            <td>$id</td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td>$mode</td>
                        </tr>
                        <tr>
                            <th>Order Status</th>
                            <td>$status</td>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <td>
                                $paymentstatus
                                <br>");
                                if ($mode == 'Net Banking' && $paymentstatus == 'Pending')
                                    echo ("<a href='pay.php?type=old&cid=$id' class='btn background text-light btn-sm'>Pay Now</a>");
                                echo ("</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>&#8377;$total</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>&#8377;$shipping</td>
                        </tr>
                        <tr>
                            <th>Final</th>
                            <td>&#8377;$final</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>$date</td>
                        </tr>
                    </table>
                </div>
                <div class='col-xxl-10 col-xl-10 col-lg-9 col-md-8 col-sm-6 col-12'>
                <table class='table'>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                ");
            $q = "select * from checkoutproducts where checkoutid = '$id'";
            $checkresult = mysqli_query($conn, $q);
            while ($checkrow = $checkresult->fetch_assoc()) {
                $name = $checkrow['name'];
                $pic = $checkrow['pic'];
                $price = $checkrow['price'];
                $qty = $checkrow['qty'];
                $total = $checkrow['total'];
                $color = $checkrow['color'];
                $size = $checkrow['size'];
                echo ("
                    <tr>
                        <td><img src='./media/images/$pic' height='100px' width='100px' class='rounded'>
                        <td>$name</td>
                        <td>$color</td>
                        <td>$size</td>
                        <td>&#8377;$price</td>
                        <td>$qty</td>
                        <td>&#8377;$total</td>
                    </tr>
                ");
            }
            echo ("</table></div><hr style='border:3px solid gray'>");
        }
        ?>
    </div>
    <?php
    require("footer.php");
    ?>