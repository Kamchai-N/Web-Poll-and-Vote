<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">
    <title>Vote.com - Sign In</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>    
    <script>
        $(document).ready(function(){
            $('#submit').click(function(){
                var email = $('#inputEmail').val();
                var password = $('#inputPassword').val();
                var json = {email:email,password:password}
                $.ajax({
                        url:'../../ServerPHP/Sign-In.php',
                        type:'post',
                        data:json,
                        success:function(result){
                           if(result == "OK"){
                               window.location.href = '../../index.php'; 
                           }else{
                                swal ("ประกาศ","เข้าสู่ระบบไม่สำเร็จ","error");
                           }
                        }
                });
            });
            $('#createPoll').click(function(){
               $.ajax({
                   url: "../../ServerPHP/Check-SingnIn.php",
                   success: function (response) {
                       if(response == "OK"){
                            window.location.href = "../Create-Poll/createPoll.php";
                       }else{
                        swal("ประกาศ","ท่านยังไม่ได้เข้าสู่ระบบ","warning")
                            .then((value) => {
                                window.location.href = "../Sign-in/Sign-in.php";
                            });
                       }
                   }
               });
            }); 
        });
    </script>
</head>
<body>
    <nav class= "navbar navbar-expand-md bg-white navbar-dark shadow-sm fixed-top">
        <div class="container">
         <a class="navbar-brand text-success" href="../../index.php" id="text-lowgo"> <h3>Vote.com</h3> </a>
         <button class="navbar-toggler bg-success" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" id="createPoll">สร้างโพล</a>
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
                            <a class="dropdown-item" href="#" id="Logout">Logout</a>
                        </div>
                    </li>   
                <?php 
            } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="#" id="Signin">Sign in</a>
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
    <div class="container pt-5 mt-5" style="width: 100%">
        <div class="jumbotron">
            <h1 class="text-dark"  style="width: 100%; text-align:center;">Sign In</h1> <br>
            <form class="form-signin">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control " placeholder="Email address">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" >
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <button class="btn btn-lg btn-success btn-block" id="submit">Sign in</button>
                    </div>
                </div>
              </form>
        </div>
    </div>
    
</body>
</html>