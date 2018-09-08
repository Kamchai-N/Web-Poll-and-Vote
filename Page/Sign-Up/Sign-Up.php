<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - Sign up</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <script>
        $(document).ready(function(){        
            $('#submit').click(function(){ 
                var errorSting = " ";
                var username = $("#inputUsername").val();
                var email =  $("#inputEmail").val();
                var password =  $("#inputPassword").val();
                var confirm_password =  $("#inputConfirmPassword").val();

                if(password == confirm_password){
                   var json = {username:username,email:email,password:password}
                //    console.log(json)
                    $.ajax({
                        url:'../../ServerPHP/Sign-Up.php',
                        type:'post',
                        data:json,
                        success:function(result){
                            if (result == "OK"){
                                swal("ประกาศ" ,  "สร้างบัญชีสำเร็จ" ,  "success")
                                .then((value) => {
                                    window.location.href = "../../index.php";
                                });
                            }else{
                                swal ("ประกาศ","สร้างบัญชีไม่สำเร็จ","error");
                            }
                        }
                    });
                }else{
                    swal({
                        title: "Password ไม่ตรงกัน!!",
                    });
                }
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
    <nav class= "navbar navbar-expand-md bg-white navbar-dark shadow-sm navbar-inverse navbar-fixed-top">
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
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#" id="Logout">Logout</a>
                        </div>
                    </li>   
                <?php 
            } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="../Sign-in/Sign-in.php" id="Signin">Sign in</a>
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
    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="text-dark" style="width: 100%; text-align:center;">
                Sign Up
            </h1>
            <div class="row">
                <div class="mx-auto p-3" style="width: 70%; font-size: 20px;">
                    <div class="">Username : </div>
                    <div class="">
                        <label for="inputUsername" class="sr-only">Username</label>
                        <input type="text" id="inputUsername" required="" class="form-control" placeholder="Username" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto p-3" style="width: 70%; font-size: 20px;">
                    <div class="">Email : </div>
                    <div class="">
                        <label for="inputEmail" class="sr-only">Email</label>
                        <input type="email" id="inputEmail" required="" class="form-control" placeholder="Email" required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto p-3" style="width: 70%; font-size: 20px;">
                    <div class="row">
                        <div class="col-sm">
                            <div class="">Password : </div>
                            <div class="">
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" required="" class="form-control" placeholder="Password" required="">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div>Confirm Password : </div>
                            <div>
                                <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
                                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto p-3" style="width: 70%; font-size: 20px;">
                <button class="btn btn-lg btn-success btn-block" type="submit" id="submit">Sign Up</button>
            </div>
        </div>
    </div>

</body>

</html>