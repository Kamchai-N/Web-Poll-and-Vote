<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - My Poll</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
    <style>
    .parallax-window {
        min-height: 400px;
        background: transparent;
    }
    </style>
   
</head>
<body>
    <nav class= "navbar navbar-expand-md bg-white navbar-dark shadow-sm">
        <div class="container">
         <a class="navbar-brand text-success" href="../../index.php" id="text-lowgo"> <h3>Vote.com</h3> </a>
         <button class="navbar-toggler bg-success" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="../Create-Poll/createPoll.php" id="createPoll">สร้างโพล</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link text-dark" href="../Show-Vote/Show-Vote.php" id= "votePoll">โหวตโพล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="../About/About.php" id="adoutPoll">เกี่ยวกับ Vote.com</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <i class="fa fa-search mt-2 mr-3"></i>
                <?php
                if (isset($_SESSION['id'])) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["Username"] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../My-Poll/My-Poll.php">โพลของฉัน</a>
                            <a class="dropdown-item" href="../../ServerPHP/Logout/logout_Page.php">Logout</a>
                        </div>
                    </li>   
                <?php 
            } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="../Sign-in/Sign-in.php"  id="Signin">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="#">Or</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="../Sign-Up/Sign-Up.php" id="Signout">Sign up</a>
                    </li>
                <?php 
            } ?>
            </ul>
            </div>           
        </div>
    </nav>
    <div class="parallax-window pt-5" data-parallax="scroll" data-image-src="https://images.pexels.com/photos/34676/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
            <h4 class="text-white pt-5" style="text-align:center;font-family: 'Mitr', sans-serif;font-size: 50px;" >เกี่ยวกับ</h4>
            <h4 class="text-white pt-1" style="text-align:center;font-family: 'Mitr', sans-serif;font-size: 30px;" >Vote.com</h4>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-sm">
            <div class="card mt-4 " style="width: 18rem;">
                <img class="card-img-top" src="../../img/annuler-mail-gmail.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Gmail : conannui.cc114@gmail.com</p>
                </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="card mt-4 " style="width: 18rem;">
                <img class="card-img-top" src="../../img/annuler-mail-gmail.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Phone : <br> 09046722XX</p>
                </div>
            </div>
            </div>
            <div class="col-sm">
            <div class="card mt-4 " style="width: 18rem;">
                <img class="card-img-top" src="../../img/annuler-mail-gmail.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Address : <br> Chiang Mai</p>
                </div>
            </div>
            </div>
        </div>
    </div>
    
    <footer class="footer bg-white">
            <div class="container">
                <span class="text-muted">Made by Mr.Kamchai Boonsri</span>
            </div>
    </footer>
</body>
</html>