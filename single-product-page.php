<?php
require("header.php");
$id = $_GET['id'];
$q = "select * from product where id = '$id'";
$result = mysqli_query($conn,$q);
$row=$result->fetch_assoc();
$name = $row['name'];
$maincategory = $row['maincategory'];
$subcategory = $row['subcategory'];
$brand = $row['brand'];
$color = $row['color'];
$size = $row['size'];
$stock = $row['stock'];
$baseprice = $row['baseprice'];
$discount = $row['discount'];
$finalprice = $row['finalprice'];
$description = $row['description'];
$pic1 = $row['pic1'];
$pic2 = $row['pic2'];
$pic3 = $row['pic3'];
$pic4 = $row['pic4'];
$userid = $_SESSION['userid'];
if(isset($_GET['type']) && $_GET['type']=='cart'){
    $q = "insert into cart(userid,productid,name,color,size,price,qty,total,pic) values('$userid','$id','$name','$color','$size','$finalprice',1,'$finalprice','$pic1')";
    mysqli_query($conn,$q);
    $q = "delete from wishlist where userid = '$userid' and productid = '$id'";
    mysqli_query($conn,$q);
    header("location:cart.php");
    die();
}
if(isset($_GET['type']) && $_GET['type']=='wishlist'){
    $q = "insert into wishlist(userid,productid,name,color,size,price,pic) values('$userid','$id','$name','$color','$size','$finalprice','$pic1')";
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
    <div class="row mt-3 mb-3">
        <div class="col-md-6 col-sm-12 col-12">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php echo("<img src='./media/images/$pic1' height='500px' class='d-block w-100' alt='...'>");?>
                    </div>
                    <div class="carousel-item">
                    <?php echo("<img src='./media/images/$pic2' height='500px' class='d-block w-100' alt='...'>");?>
                    </div>
                    <div class="carousel-item">
                    <?php echo("<img src='./media/images/$pic3' height='500px' class='d-block w-100' alt='...'>");?>
                    </div>
                    <div class="carousel-item">
                    <?php echo("<img src='./media/images/$pic4' height='500px' class='d-block w-100' alt='...'>");?>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <?php echo("<img src='./media/images/$pic1' class='d-block' width='24%' alt='...'>");?>
                <?php echo("<img src='./media/images/$pic2' class='d-block' width='24%' alt='...'>");?>
                <?php echo("<img src='./media/images/$pic3' class='d-block' width='24%' alt='...'>");?>
                <?php echo("<img src='./media/images/$pic4' class='d-block' width='24%' alt='...'>");?>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
            <h5 class="background text-light text-center p-2"><?php echo $name?></h5>
            <table class="table">
                <tr>
                    <th>Main Category</th>
                    <td><?php echo $maincategory?></td>
                </tr>
                <tr>
                    <th>Sub Category</th>
                    <td><?php echo $subcategory?></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td><?php echo $brand?></td>
                </tr>
                <tr>
                    <th>Base Price</th>
                    <td>&#8377;<?php echo $baseprice?></td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td><?php echo $discount?></td>
                </tr>
                <tr>
                    <th>Final Price</th>
                    <td>&#8377;<?php echo $finalprice?></td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td><?php echo $color?></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><?php echo $size?></td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td><?php echo $stock?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $description?></td>
                </tr>
                <tr>
                    <?php echo("<th colspan='2'><a href='single-product-page.php?type=cart&id=$id' class='btn background text-light w-100'>Add to Cart</th>");?>
                </tr>
                <tr>
                <?php echo("<th colspan='2'><a href='single-product-page.php?type=wishlist&id=$id' class='btn background text-light w-100'>Add to Wishlist</th>");?>
                </tr>
            </table>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>