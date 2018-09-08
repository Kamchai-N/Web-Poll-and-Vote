<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - My Poll</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
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
                            <a class="dropdown-item" href="../../ServerPHP/Logout/logout_index.php" id="Logout">Logout</a>
                        </div>
                    </li>   
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="../Sign-in/Sign-in.php" id="Signin">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="#">Or</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="../Sign-Up/Sign-Up.php" id="Signout">Sign up</a>
                    </li>
                <?php } ?>
            </ul>
            </div>           
        </div>
    </nav>
    <div class="container">
        <h1 class="mt-5" style="font-family: 'Mitr', sans-serif;text-align:center;">โพลของฉัน</h1>
        <hr>
        <div class='row'>
    <?php
         $con = mysqli_connect('localhost','root','123456789','web_vote');
         if(!$con){
             exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
         }
         mysqli_set_charset($con,"utf8");
         $user_id = $_SESSION["id"];
         $sql = "SELECT * FROM `vote_topic` WHERE `topic_status` = 'active' AND `User_ID` = $user_id ORDER BY `topic_ID` DESC";
         $query = mysqli_query($con,$sql);
        //  echo "<div class='row mt-5'>";
         while($data = mysqli_fetch_array($query)){
      ?>      
        
            <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item mt-5">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="../../img/Poll/<?php echo $data[0] ?>.png"></a>
                <div class="card-body">
                <h4 class="card-title">
                    <a href="../Show-Vote-Description/Show-Vote-Description.php?topic_ID=<?php echo $data[0] ?>&topic_text=<?php echo urlencode($data[1]) ?>&User_ID=<?php echo $data[3] ?>"><h4><?php echo $data[1] ?></h4></a>
                </h4>
                </div>
            </div>
            </div>
       <?php }  mysqli_close($con); ?>
        </div>
    </div>

</body>
</html>