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
if(isset($_GET['type']) && $_GET['type']=='delete'){
    $id = $_GET['id'];
    $q = "delete from cart where id='$id'";
    mysqli_query($conn,$q);
    header("location:cart.php");
    die();
}
if(isset($_GET['type']) && $_GET['type']=='update'){
    $value = $_GET['value'];
    $id = $_GET['id'];

    $q = "select * from cart where id='$id'";
    $result = mysqli_query($conn,$q);
    $row = $result->fetch_assoc();
    $qty = $row['qty'];
    $price = $row['price'];
    $total = $row['total'];
    if($value=="inc"){
        $qty++;
        $total=$total+$price;
        $q = "update cart set qty='$qty',total = '$total' where id='$id'";
        mysqli_query($conn,$q);
    }
    else if($qty>1){
        $qty--;
        $total=$total-$price;
        $q = "update cart set qty='$qty',total = '$total' where id='$id'";
        mysqli_query($conn,$q);
    }
    header("location:cart.php");
    die();
}
?>
<title>OnlineShop | Cart Page</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <h5 class="background text-light text-center p-2">Cart Section</h5>
    <table class="table table-light table-striped table-hover">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Color</th>
            <th>Size</th>
            <th>Price</th>
            <th></th>
            <th>Qty</th>
            <th></th>
            <th>Total</th>
            <th></th>
        </tr>
        <?php
            $userid  = $_SESSION['userid'];
            $q = "select * from cart where userid = '$userid'";
            $result = mysqli_query($conn,$q);
            $count = mysqli_num_rows($result);
            $carttotal = 0;
            $shipping = 0;
            $final = 0;
            while($row=$result->fetch_assoc()){
                $pic = $row['pic'];
                $name = $row['name'];
                $color = $row['color'];
                $size = $row['size'];
                $price = $row['price'];
                $productid = $row['productid'];
                $qty = $row['qty'];
                $total = $row['total'];
                $id=$row['id'];
                $carttotal = $carttotal+$total;
            
                echo("
                    <tr>
                        <td><img src='./media/images/$pic' height='100px' width='100px' class='rounded'>
                        <td>$name</td>
                        <td>$color</td>
                        <td>$size</td>
                        <td>&#8377;$price</td>
                        <td><a href='cart.php?type=update&value=dec&id=$id'><i class='material-icons'>remove</i></td>
                        <td>$qty</td>
                        <td><a href='cart.php?type=update&value=inc&id=$id'><i class='material-icons'>add</i></td>
                        <td>&#8377;$total</td>
                        <td><a href='cart.php?type=delete&id=$id'><i class='material-icons'>delete_forever</i></td>
                    </tr>
                ");
            }
            if($carttotal<1000 && $count!=0)
                $shipping=150;
            $final = $carttotal+$shipping;
        ?>
    </table>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-12"></div>
        <div class="col-md-6 col-sm-12 col-12">
            <table class="table table-light table-striped table-hover">
                <tr>
                    <th>Total Amount</th>
                    <td>&#8377;<?php echo $carttotal?></td>
                </tr>
                <tr>
                    <th>Shipping Amount</th>
                    <td>&#8377;<?php echo $shipping?></td>
                </tr>
                <tr>
                    <th>Final Amount</th>
                    <td>&#8377;<?php echo $final?></td>
                </tr>
                <tr>
                    <?php
                        if($carttotal!=0){
                            echo("<td colspan='2'><a href='checkout.php' class='btn background text-light w-100'>Checkout</td>");
                        }
                    ?>
                </tr>
            </table>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>