<?php
session_start();
$topic_ID = $_GET['topic_ID'];
$topic_text = $_GET['topic_text'];
$User_ID = $_GET['User_ID'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - <?php echo $topic_text?></title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <script>
         $(document).ready(function(){
             $('#vote').click(function(){
                 if($('input:checked').length == 0){
                    swal ("ประกาศ","ท่านยังไม่ได้เลือก","info");
                     return false;
                 }
                 var topic_id = $(this).attr('data-id');
                 var choice_id = $( "input:checked" ).val();
                 var json = {'topic_id':topic_id,'choice_id':choice_id}
                 $.ajax({
                     url:'../../ServerPHP/vote.php',
                     type:'post',
                     dataType:'html',
                     data:json,
                    //  beforeSend: function() {
                    //     $.blockUI();
                    //  },
                     success: function(result) {
                         if(result == "OK"){
                                swal("ประกาศ" , "คุณโหวตได้สำเร็จ" ,  "success")
                                .then((value) => {
                                    window.location.href = "../Show-Vote/Show-Vote.php";
                                });
                         }else{
                            swal ("ประกาศ",result,"error");
                         }
                    //    alert(result);
                    },
                    // complete: function() {
                    //     $.unblockUI();
                    // }
                 });
             });
             $('#show-vote').click(function(){
                window.location.href = "../Result-Vote/Result-Vote.php?topic_ID=<?php echo $topic_ID ?>&topic_text=<?php echo urlencode($topic_text) ?>&User_ID=<?php echo $User_ID ?>";
             });
             $('#manage-vote').click(function(){
                window.location.href = "../Manage-Vote/Manage-Vote.php?topic_ID=<?php echo $topic_ID ?>&topic_text=<?php echo urlencode($topic_text) ?>&User_ID=<?php echo $User_ID ?>";
             });
         });
    </script>
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
                    <a class="nav-link text-dark" href="../About/About.php " id="adoutPoll">เกี่ยวกับ Vote.com</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
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
        <img src="../../img/Poll/<?php echo $topic_ID ?>.png"  class="img-fluid float-left mt-5" alt="Responsive image" style="width:600px;height:400px">
        <div class="card float-left  mt-5" style="width:350px;">
            <div class="card-body">
                <h4 class="card-title"><?php echo $topic_text ?></h4>
                <!-- </div> -->
                <?php
                    $con = mysqli_connect('localhost','root','123456789','web_vote');
                    if(!$con){
                        exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
                    }
                    mysqli_set_charset($con,"utf8");
                    $sql = "SELECT * FROM `vote_topic` WHERE `topic_status` = 'active'";
                    $rs =mysqli_query($con,$sql);
                    if(mysqli_num_rows($rs) != 0){
                        $data = mysqli_fetch_array($rs);
                       
                        $sql = "SELECT * FROM `vote_choice` WHERE `topic_ID` = $topic_ID";
                        $query = mysqli_query($con,$sql);
                        while($data = mysqli_fetch_array($query)){
                            $cid = $data[0];
                            $ch = $data[2];
                            // $userId = $data[3];
                             echo "<div class='form-check ml-3'>";
                            echo "<input class='form-check-input' type='radio' name='exampleRadios' id='exampleRadios".$cid."' value='".$cid."'>";  
                            echo "<label class='form-check-label' for='exampleRadios".$cid."'>".$ch."</label>";
                            echo "</div>";  
                        }  
                        if(isset($_SESSION['id'])){
                            if($_SESSION["id"] == $User_ID){
                            echo "<a class='btn btn-primary w-50 mt-3 text-light' data-id=".$topic_ID." id='show-vote'>ดูผล</a>";
                            echo "<a class='btn btn-warning w-50 mt-3' data-id=".$topic_ID." id='manage-vote'>จัดการ</a>";
                            }else{
                                echo "<a class='btn btn-success w-100 mt-3 text-light' data-id=".$topic_ID." id='vote'>โหวต</a>";
                                echo "<a class='btn btn-primary w-100 mt-2 text-light' data-id=".$topic_ID." id='show-vote'>ดูผล</a>";
                            }
                        }else{
                            echo "<div class='mt-3 w-80'>";
                                echo "<h3 class='text-danger' style='text-align:center;'>ท่านยังไม่ได้เข้าสู่ระบบ</h3>";
                            echo "</div>";
                        }
                        
                    }
                    mysqli_close($con);
                ?>
            </div>
        </div>
    </div>
</body>
</html>