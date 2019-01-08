<?php
    $con = mysqli_connect('XXXXX','XXXXX','XXXXX','web_vote');
    if(!$con){
        exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
    }
    mysqli_set_charset($con,"utf8");
    if($_POST['username'] != null){
         $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $pass_md5_1 = md5($password);
        $pass_md5_2 = md5($pass_md5_1);
        $sql = "INSERT INTO `member`(`Username`, `Email`, `Password`) VALUES ("."'".$username."'".","."'".$email."'".","."'".$pass_md5_2."'".");"; 
        $query = mysqli_query($con,$sql);
        if($query){
            echo "OK";
        }else{
            echo "NOTOK";
        }
    }
    mysqli_close($con);
?>
