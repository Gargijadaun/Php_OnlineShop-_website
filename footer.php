<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST['email'];
    $q = "select * from newslatter where email = '$email'";
    $result = mysqli_query($conn,$q);
    $count = mysqli_num_rows($result);
    if($count==0){
        $q = "insert into newslatter(email) values('$email')";
    $result = mysqli_query($conn,$q);
    echo("<script>alert('Your Email Id is Registered now you can get Email about our Latest products and Offerse!!!')</script>");
    }
    else
    echo("<script>alert('Your Email Id is already Registered!!!')</script>");
}
?>
<footer class="background text-light text-center p-3">
    <p>copyright@onlineshop.com
    <div class="row">
        <div class="col-md-3 col-sm-12 col-12"></div>
        <div class="col-md-6 col-sm-12 col-12">
            <form action="" method="post">
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Enter Email Id to Subscribe Our Newslatter Service">
                </div>
                <button type="submit" class="btn btn-light w-100">Subscribe</button>
            </form>
        </div>
        <div class="col-md-3 col-sm-12 col-12"></div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>