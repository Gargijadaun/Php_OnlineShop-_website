<nav class="navbar navbar-expand-lg navbar-light background fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="index.php">Online Shop</a>
    <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="material-icons text-light" style="font-size: 45px;">menu</i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-light active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pages
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="shop.php?mc=All&sc=All&br=All">Shop</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="contact.php">Contact US</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex w-100">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
        <?php
              if(isset($_SESSION['login']) && $_SESSION['login']==true){
                $name = $_SESSION['username'];
                echo(
                  "<a class='nav-link text-light dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                   $name
                  </a>
                  <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                    <li><a class='dropdown-item' href='profile.php'>Profile</a></li>
                    <li><a class='dropdown-item' href='cart.php'>Cart</a></li>
                    <li>
                      <hr class='dropdown-divider'>
                    </li>
                    <li><a class='dropdown-item' href='logout.php'>Log Out</a></li>
                  </ul>");
              }
              else{
                echo("
                <li class='nav-item'>
                  <a class='nav-link text-light' href='login.php'>Login</a>
                 </li>
                ");
              }
            ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<br>