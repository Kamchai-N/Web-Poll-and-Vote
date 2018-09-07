<?php
    session_start();
    $con = mysqli_connect('localhost','root','123456789','web_vote');
    if(!$con){
        exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
    }
    mysqli_set_charset($con,"utf8");
    if($_POST['email'] != null){
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $pass_md5_1 = md5($password);
        $pass_md5_2 = md5($pass_md5_1);
        $sql = "SELECT * FROM `member` WHERE `Email` = "."'".$email."'"." AND "."`Password` = "."'".$pass_md5_2."'".";";
        // echo $sql;
        $query = mysqli_query($con,$sql);
        while($data = mysqli_fetch_array($query)){
                $_SESSION["id"] = $data[0];
                $_SESSION["Username"] = $data[1];
                $_SESSION["Email"] = $data[2];
                $_SESSION["Password"] = $data[3];
                echo "OK";
        }
    }
    mysqli_close($con);
?>