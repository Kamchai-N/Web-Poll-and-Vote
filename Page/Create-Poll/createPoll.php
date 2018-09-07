<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - Create Poll</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <link rel="stylesheet" href="createPoll_style.css">

    <script>
        $(document).ready(function(){
            var input = '<div class="choiceform">';
            input += '<input type="text" class="form-control w-75" name="choice[]" id="text-choiceform" placeholder="ตัวเลือก" required> ';
            input += '<input type="color" name="color[]" id="color" required>';
            input += '</div>';

            $('#add').click(function(){
                if($('div.choiceform').length == 10){
                    return false;
                }
                $('.chice-container').append(input);
                
            });
            $('#remove').click(function(){
                if($('div.choiceform').length == 2){
                    return false;
                }
                $('input[name^=choice]:last').parent().remove();
                // alert("Ok");
            });
            $('#add').click();
            $('#add').click();

           
        });
    </script>
    <?php
        if($_POST){
            // session_start();
            $con = mysqli_connect('localhost','root','123456789','web_vote');
            if(!$con){
                exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
            }

            mysqli_set_charset($con,"utf8");
            $topic = $_POST['topic'];
            $sql = "INSERT INTO `vote_topic` VALUES('','".$topic."','active','".$_SESSION['id']."')";
            $query = mysqli_query($con,$sql);
            $topic_id = mysqli_insert_id($con);
            $topic_id = mysqli_insert_id($con);
            if($_FILES){
            //    echo $_FILES['ControlFile']['tmp_name'];
                move_uploaded_file($_FILES['ControlFile']['tmp_name'],'../../img/Poll/'.$topic_id.'.png');
            }
            $choice = array();
            for($i=0;$i<count($_POST['choice']);$i++){
                $ch_text = $_POST['choice'] [$i];
                $color = $_POST['color'] [$i];
                $str = "(' ','$topic_id','$ch_text','0','$color')";
                array_push($choice,$str);
            }
            $value = implode(",",$choice);
            $sql = "INSERT INTO `vote_choice` VALUES $value";
            mysqli_query($con,$sql);
            // echo "OK";
            header("location:../Show-Vote/Show-Vote.php");
            mysqli_close($con);
        }
    ?>
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
                    <a class="nav-link text-dark" href="#" id="createPoll">สร้างโพล</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link text-dark" href="../Show-Vote/Show-Vote.php" id= "votePoll">โหวตโพล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" id="adoutPoll">เกี่ยวกับ Vote.com</a>
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
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark login" href="#" id="Signin">Sign in</a>
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
        <form method="post" class="mx-auto w-75" enctype="multipart/form-data">
            <br>
            <div class="top">เพิ่มหัวข้อมูลโพล</div>
            <div class="form-group">
                <input type="text" name="topic" class="form-control" id="InputText"  placeholder="หัวข้อโพล" required>
            </div>
            <div class="form-group">
                <label for="ControlFile">ไฟล์รูปภาพสำหรับพื้นหลัง (ขนาดที่แนะนำคือ 700 x 400)</label>
                <input type="file" class="form-control-file" name="ControlFile" required>
            </div>
            <br>
            ตัวเลือก
            <button type="button" class="btn btn-success" id="add">+</button>
            <button type="button" class="btn btn-danger" id="remove">-</button>
            <br> <br>

            <div class="chice-container"> </div>
                    
            <div class="footer-form">
                    <button type="submit" class="btn btn-success" id="btnCre">สร้างโพล</button>
            </div>
        </form>
    </div>
    
</body>
</html>