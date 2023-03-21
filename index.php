<?php
require("header.php");
?>
<title>OnlineShop | Home</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7" aria-label="Slide 8"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="8" aria-label="Slide 9"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="static/images/banner1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner4.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner5.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner6.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner7.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner8.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="static/images/banner9.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <h5 class="background text-light text-center p-2">Product Section</h5>
    <div class="row">
        <?php
            $q = "select * from product order by id desc";
            $result = mysqli_query($conn,$q);
            while($row=$result->fetch_assoc()){
                $name = $row['name'];
                $pic = $row['pic1'];
                $baseprice = $row['baseprice'];
                $finalprice = $row['finalprice'];
                $discount = $row['discount'];
                $id = $row['id'];
                echo("
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
    <?php
    require("footer.php");
    ?>