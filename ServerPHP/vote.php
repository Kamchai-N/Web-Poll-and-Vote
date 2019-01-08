<?php   
    session_start();
    $con = mysqli_connect('XXXXX','XXXXX','XXXXX','web_vote');
    if(!$con){
        exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
    }
    mysqli_set_charset($con,"utf8");
    include "user-info.php";
    $userID = $_SESSION["id"];
    $browser = user_browser();
    $ip = user_ip();
    $os = user_os();
    $date = date('Y/m/d');

    $topic_id = $_POST['topic_id'];
    $choice_id = $_POST['choice_id'];
    $sql = "SELECT * FROM `vote_loguser` WHERE `IP` = '$ip' AND `topic_id` = $topic_id";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query) != 0){
        echo "คุณโหวตในหัวข้อนี้แล้วคุณไม่สามารถโหวตซ้ำได้";
        mysqli_close($con);
        exit();
    }
    $sql = "UPDATE `vote_choice` SET `choice_score` = `choice_score` +  1 WHERE `choice_ID` = ".$choice_id."";
    $query = mysqli_query($con,$sql);
   
    $sql = "INSERT INTO `vote_loguser` VALUES('',$userID,$topic_id,'$browser','$ip','$os','$date')";
    mysqli_query($con,$sql);
    echo "OK";
    mysqli_close($con);
?>
