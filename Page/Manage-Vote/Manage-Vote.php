<?php
    session_start();
    $topic_ID = $_GET['topic_ID'];
    $topic_text = $_GET['topic_text'];
    $User_ID = $_GET['User_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - <?php echo $topic_text?></title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <?php
        $con = mysqli_connect('localhost','root','123456789','web_vote');
        if(!$con){
            exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
        }
        mysqli_set_charset($con,"utf8");
        $sql = "SELECT * FROM `vote_choice` WHERE `topic_ID` = $topic_ID";
        $query = mysqli_query($con,$sql);
        // $data = mysqli_fetch_array($query);
        $num_row = mysqli_num_rows($query);
    ?>
    <script>
    function myFunction(aoo,obj) {
         var json = {data:aoo}
         $.ajax({
            url:'../../ServerPHP/Dal-Vote.php',
            type:'post',
            data:json,
            success:function(result){
               if(result == "OK"){
                    window.location.href = "../Manage-Vote/Manage-Vote.php?topic_ID=<?php echo $topic_ID ?>&topic_text=<?php echo urlencode($topic_text) ?>&User_ID=<?php echo $User_ID ?>";
               }
            }
        });
    }
    $(document).ready(function(){
            var input = '<button type="button" class="btn btn-danger mr-2" id="remove">-</button><div class="choiceform">';
            input += '<input type="text" class="form-control w-75" name="choice[]" id="text-choiceform" placeholder="ตัวเลือก" required> ';
            input += '<input type="color" name="color[]" id="color" required>';
            input += '</div>';

            $('#add').click(function(){
                if($('div.choiceform').length == 10){
                    return false;
                }
                $('.chice-container').append(input);
                
            });   
            $('#del').click(function(){
                var data = <?php echo $topic_ID ?>;
                var json = {data:data}
                $.ajax({
                    url:'../../ServerPHP/Dal-All-Vote.php',
                    type:'post',
                    data:json,
                    success:function(result){
                    if(result == "OK"){
                        window.location.href = "../Show-Vote/Show-Vote.php";
                    }
                 }
                });
            });
            <?php
                while($data = mysqli_fetch_array($query)){
                    
            ?>                    
                // <button type="button" class="btn btn-danger mr-2" id="remove" value="<?php echo $data[0]?>">-</button>
                    
                   var input1 = '<button type="button" class="btn btn-danger mr-2" name="remove<?php echo $data[0]?>"  id="remove" onclick="myFunction(<?php echo $data[0] ?>,this)">-</button><div class="choiceform">';
                   input1 += '<input type="text" class="form-control w-75" name="choice[]" id="text-choiceform" placeholder="ตัวเลือก" value="<?php echo $data[2]?>" required> ';
                   input1 += '<input type="color" name="color[]" id="color" value="<?php echo $data[4]?>" required>';
                   input1 += '</div>';
                   $('.chice-container').append(input1);
            <?php   
                }
            ?>    
            
        });
        
    </script>
    <style>
    #remove{
        float: left;  
    }
    #text-choiceform{
        float: left;  
    }
    #color{
        margin-left: 10px;
        width: 10%;
        height: 40px;
    }
    .choiceform{
        margin: 10px;
        /* float: left; */
    }
    .footer-form{
        width: 50px;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
</head>
<body>
    <?php 
        if($_POST){
            $con = mysqli_connect('localhost','root','123456789','web_vote');
            if(!$con){
                exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
            }
            mysqli_set_charset($con,"utf8");
            $text = $_POST['topic'];
            $sql = "UPDATE `vote_topic` SET `topic_text` = '$text' WHERE `topic_ID` = $topic_ID";
            mysqli_query($con,$sql);
            $sql = "SELECT * FROM `vote_choice` WHERE `topic_ID` = $topic_ID";
            $query = mysqli_query($con,$sql);
            for($i=0;$i<count($_POST['choice']);$i++){
                $data = mysqli_fetch_array($query);
                $num_row1 = mysqli_num_rows($query); 
                if(count($_POST['choice']) > $num_row1){
                    echo count($_POST['choice']);
                //    return false;
                }
                $ch_text = $_POST['choice'] [$i];
                $color = $_POST['color'] [$i];
                $sql1 ="UPDATE `vote_choice` SET `choice_text`= '$ch_text',`graph_color`= '$color' WHERE `choice_ID` = $data[0]";
                mysqli_query($con,$sql1);
            }
        }
    ?>
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
        <h1 class=" mt-3">Management System</h1>
        <form method="post" class="mx-auto w-75" enctype="multipart/form-data">
            <br>
            <div class="form-group">
                <input type="text" name="topic" class="form-control" id="InputText"  placeholder="หัวข้อโพล" value="<?php echo $topic_text ?>" required>
            </div>
            <!-- <div class="form-group">
                <label for="ControlFile">ไฟล์รูปภาพสำหรับพื้นหลัง (ขนาดที่แนะนำคือ 700 x 400)</label>
                <input type="file" class="form-control-file" name="ControlFile">
            </div> -->
            <br>  
            ตัวเลือก
                <!-- <button type="button" class="btn btn-success" id="add">+</button> -->
                    <!-- <button type="button" class="btn btn-danger" id="remove">-</button> -->
            <br> <br>
            <div class="chice-container "> </div> <br>
            <a href="../Report-PDF-Vote/Report-PDF-Vote.php?topic_ID=<?php echo $topic_ID ?>&topic_text=<?php echo urlencode($topic_text) ?>&User_ID=<?php echo $User_ID ?>" class>รายงานทางสถิติ</a><br>                    
            <a href="#" class="text-danger mt-4 w-25" id="del">ลบโพล</a> 
            <div class="footer-form">            
                    <button type="submit" class="btn btn-success " id="btnCre">แก้ไขโพล</button>
            </div>
        </form>
    </div>

</body>
</html>