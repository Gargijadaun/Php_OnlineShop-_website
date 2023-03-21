<?php
require("header.php");
require("navbar.php");
$to = $email;
$subject="Your Order Has Been Placed : Team-Online Shop";
$body="Thanks to Shop With us!!!!\nThanks\nTeam : Online Shop";
$header = "From:gargijadaun1@gmail.com";
mail($to,$subject,$body,$header);
?>
<div class="background text-center text-light p-5 mt-5 mb-5">
    <h5>Your Order Has Been Placed!!!!!!!!!</h5>
</div>
<?php
require("footer.php");
?>