<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/icon-02.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - เว็บไซต์เพื่อสร้างโพลที่แตกต่าง</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">  
    <script>
         $(document).ready(function(){
            $('#btnCreate,#createPoll').click(function(){
               $.ajax({
                   url: "ServerPHP/Check-SingnIn.php",
                   success: function (response) {
                       if(response == "OK"){
                            window.location.href = "Page/Create-Poll/createPoll.php";
                       }else{
                        swal("ประกาศ","ท่านยังไม่ได้เข้าสู่ระบบ","warning")
                            .then((value) => {
                                window.location.href = "Page/Sign-in/Sign-in.php";
                            });
                       }
                   }
               });
            });    
        });
    </script>
</head>
<body >
    <nav class= "navbar navbar-expand-md bg-white navbar-dark shadow-sm">
        <div class="container">
         <a class="navbar-brand text-success" href="#" id="text-lowgo"> <h3>Vote.com</h3> </a>
         <button class="navbar-toggler bg-success" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" id="createPoll">สร้างโพล</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link text-dark" href="Page/Show-Vote/Show-Vote.php" id= "votePoll">โหวตโพล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="Page/About/About.php" id="adoutPoll">เกี่ยวกับ Vote.com</a>
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
                            <a class="dropdown-item" href="Page/My-Poll/My-Poll.php">โพลของฉัน</a>
                            <!-- <a class="dropdown-item" href="#">Another action</a> -->
                            <a class="dropdown-item" href="ServerPHP/Logout/logout_index.php">Logout</a>
                        </div>
                    </li>   
                <?php 
            } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="Page/Sign-in/Sign-in.php"  id="Signin">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="#">Or</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="Page/Sign-Up/Sign-Up.php" id="Signout">Sign up</a>
                    </li>
                <?php 
            } ?>
            </ul>
            </div>           
        </div>
        </nav>
        <div class="container pb-5 world-map" style="height:78vh;">
            <div class="mt-5" style="width: 100%;font-family: 'Mitr', sans-serif;text-align:center;padding-top: 10%;">
                <h1>เว็บไซต์เพื่อสร้างโพลที่แตกต่าง</h1>
            </div>
            <div class="mx-auto" style="width: 80%;font-family: 'Mitr', sans-serif;text-align:center;">
                <h5>
                <?php
                    $con = mysqli_connect('localhost','root','123456789','web_vote');
                    if(!$con){
                        exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
                    }
                    mysqli_set_charset($con,"utf8");
                    $sql = "SELECT * FROM `vote_topic`";
                    $rs =mysqli_query($con,$sql);
                    $count = mysqli_num_rows($rs);
                    echo $count;
                    mysqli_close($con);
                ?>
                โพลที่อยู่ในเว็บไซต์นี้ <a href="Page/Show-Vote/Show-Vote.php"> คลิกดูโพลทั้งหมด</a></h5> <br>
            </div>
            <div class="mx-auto" style="width: 80%;font-family: 'Mitr', sans-serif;text-align:center;">
                <button type="button" class="btn btn-success" style="width:30%;" id="btnCreate">สร้างโพล</button>
            </div>
        </div>
        <footer class="footer bg-white">
            <div class="container">
                <span class="text-muted">Made by Mr.Kamchai Boonsri</span>
            </div>
        </footer>
</body>
</html>