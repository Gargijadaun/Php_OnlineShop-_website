<?php
require("header.php");
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $q = "insert into contact(name,email,phone,subject,message) values('$name','$email','$phone','$subject','$message')";
    mysqli_query($conn, $q);
    $to = $email;
    $subject = "Thanks to Share Your Query with US : Team-Online Shop";
    $body = "Thanks to Share Your Query with Us\nOur Team Will Contact You Soon\nShop for Latest Products and Offerse\nThanks\nTeam : Online Shop";
    $header = "From:vishankchauhan2@gmail.com";
    mail($to, $subject, $body, $header);
    header("location:contact.php");
    die();
}
?>
<title>OnlineShop | Contact Page</title>
</head>

<body>
    <?php
    require("navbar.php");
    ?>
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-md-3 col-12"></div>
            <div class="col-md-6 col-12">
                <h5 class="background text-light text-center p-2">Contact Us Section</h5>
                <?php
                if ($message != "") {
                    echo ("<div class='alert alert-danger' role='alert'>
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
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email Id">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Enter Your Subject">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" rows="5" class="form-control" name="message"></textarea>
                    </div>
                    <button type="submit" class="btn background text-light w-100">Send</button>
                </form>
            </div>
            <div class="col-md-3 col-12"></div>
        </div>
    </div>
    <?php
    require("footer.php");
    ?>