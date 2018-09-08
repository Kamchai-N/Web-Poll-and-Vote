<?php
    session_start();
    session_destroy();
    header('location:../../Page/Sign-in/Sign-in.php');
?>