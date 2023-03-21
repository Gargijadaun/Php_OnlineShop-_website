<?php
require("header.php");
$mc = $_GET['mc'];
$sc = $_GET['sc'];
$br = $_GET['br'];
?>
<title>OnlineShop | Shop Page</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <div class="row">
        <div class="col-xxl-1 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="list-group">
                <h5 class="background text-light text-center p-2 mt-3">Menu</h5>
                <h6 class="background text-light text-center p-1 mt-1">Main-Category</h6>
                <?php
                $q = "select * from maincategory";
                $result = mysqli_query($conn, $q);
                echo ("<a href='shop.php?mc=All&sc=$sc&br=$br' class='list-group-item list-group-item-action'>All</a>");
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    echo ("<a href='shop.php?mc=$name&sc=$sc&br=$br' class='list-group-item list-group-item-action'>$name</a>");
                }
                ?>
                <h6 class="background text-light text-center p-1 mt-1">Sub-Category</h6>
                <?php
                $q = "select * from subcategory";
                $result = mysqli_query($conn, $q);
                echo ("<a href='shop.php?mc=$mc&sc=All&br=$br' class='list-group-item list-group-item-action'>All</a>");
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    echo ("<a href='shop.php?mc=$mc&sc=$name&br=$br' class='list-group-item list-group-item-action'>$name</a>");
                }
                ?>
                <h6 class="background text-light text-center p-1 mt-1">Brand</h6>
                <?php
                $q = "select * from brand";
                $result = mysqli_query($conn, $q);
                echo ("<a href='shop.php?mc=$mc&sc=$sc&br=All' class='list-group-item list-group-item-action'>All</a>");
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    echo ("<a href='shop.php?mc=$mc&sc=$sc&br=$name' class='list-group-item list-group-item-action'>$name</a>");
                }
                ?>
            </div>
        </div>
        <div class="col-xxl-11 col-xl-10 col-lg-9 col-md-8 col-sm-6 col-12">
            <h5 class="background text-light text-center p-2 mt-3">Shop Section</h5>
            <div class="row">
                <?php
                if($mc=="All" && $sc=="All" && $br=="All")
                    $q = "select * from product order by id desc";
                elseif($mc!="All" && $sc=="All" && $br=="All")
                $q = "select * from product where maincategory = '$mc' order by id desc";
                elseif($mc=="All" && $sc!="All" && $br=="All")
                $q = "select * from product where subcategory = '$sc' order by id desc";
                elseif($mc=="All" && $sc=="All" && $br!="All")
                $q = "select * from product where brand = '$br' order by id desc";
                elseif($mc!="All" && $sc!="All" && $br=="All")
                $q = "select * from product where maincategory = '$mc' and subcategory='$sc' order by id desc";
                elseif($mc!="All" && $sc=="All" && $br!="All")
                $q = "select * from product where maincategory = '$mc' and brand='$br' order by id desc";
                elseif($mc=="All" && $sc!="All" && $br!="All")
                $q = "select * from product where brand = '$br' and subcategory='$sc' order by id desc";
                else
                $q = "select * from product where maincategory='$mc' and brand = '$br' and subcategory='$sc' order by id desc";
                $result = mysqli_query($conn, $q);
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $pic = $row['pic1'];
                    $baseprice = $row['baseprice'];
                    $finalprice = $row['finalprice'];
                    $discount = $row['discount'];
                    $id = $row['id'];
                    echo ("
                <div class='col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 mb-2'>
                    <div class='card'>
                        <a href='single-product-page.php?id=$id'><img src='./media/images/$pic' height='300px' class='card-img-top' alt='...'></a>
                        <div class='card-body'>
                        <h5 class='card-title' style='height:60px'>$name</h5>
                        <p class='card-text'>&#8377;<del>$baseprice</del> $finalprice</p>
                        <p class='card-text'>Discount $discount%</p>
                        </div>
                    </div>
                </div>
                ");
                }
                ?>
            </div>

        </div>

    </div>
    <?php
    require("footer.php");
    ?>