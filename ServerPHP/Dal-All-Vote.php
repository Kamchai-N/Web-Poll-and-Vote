<?php 
       $con = mysqli_connect('XXXXX','XXXXX','XXXXX','web_vote');
       if(!$con){
           exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
       }
       mysqli_set_charset($con,"utf8");
       $choice_ID = $_POST['data'];
       $sql = "DELETE FROM `vote_choice` WHERE `topic_ID` = $choice_ID";
       mysqli_query($con,$sql);
       $sql = "DELETE FROM `vote_topic` WHERE `topic_ID` = $choice_ID";
       mysqli_query($con,$sql);
       echo "OK";
?>
