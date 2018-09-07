<?php
session_start();
$topic_ID = $_GET['topic_ID'];
$topic_text = $_GET['topic_text'];
$User_ID = $_GET['User_ID'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../../img/icon-02.png" type="image/png">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote.com - Result    Vote</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <style>
        canvas{
            width:90% !important;
            height:500px !important;
            margin-left: auto;
            margin-right: auto;

        }
    </style>
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

    <canvas id="ChartBnt" width="30%"></canvas>
    <?php 
            $con = mysqli_connect('localhost','root','123456789','web_vote');
            if(!$con){
                exit("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
            }
            mysqli_set_charset($con,"utf8");
            $text = array();
            $scroe = array();
            $color = array();
            $sql  = "SELECT * FROM `vote_choice` WHERE `topic_ID` = $topic_ID";
            $query = mysqli_query($con,$sql);
            while($data = mysqli_fetch_array($query)){
                $text_data = "'".$data[2]."'";
                $scroe_data = $data[3];
                $color_data = "'".$data[4]."'";
                array_push($text,$text_data);
                array_push($scroe ,$scroe_data);
                array_push($color ,$color_data);
            }  
            $value_text = implode(",",$text);
            $value_scroe = implode(",",$scroe);
            $value_color = implode(",",$color);
            // echo $value_color;
    ?>
    <script>
        var ChartT = document.getElementById('ChartBnt').getContext('2d');
        Chart.defaults.global.defaultFontFamily = 'Mitr';
        Chart.defaults.global.defaultFontSize = 18;
        Chart.defaults.global.defaultFontColor = '#777';
            
        var massPopChart = new Chart(ChartT, {
        type:'bar', 
        data:{
            labels:[<?php echo $value_text ?>],
            datasets:[{
            data:[<?php echo $value_scroe ?> ],
            //backgroundColor:'green',
            backgroundColor:[<?php echo $value_color ?>],
            borderWidth:1,
            borderColor:'rgba(191, 191, 191)',
            // hoverBorderWidth:3,
            // hoverBorderColor:'#000'
            }]
        },
            options:{
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                title:{
                display:true,
                text:'<?php echo $topic_text ?>',
                fontSize:25
                },
                legend:{
                    display:false,
        
                },
                layout:{
                padding:{
                    left:50,
                    right:50,
                    bottom:0,
                    top:25
                }
                },
                // tooltips:{
                //   enabled:true
                // }
            }
            });

    </script>
</body>
</html>