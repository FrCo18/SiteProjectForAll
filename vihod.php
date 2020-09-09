<?php
if(isset($_POST["vihod"])){
    session_start();
        if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');
    session_destroy();
    header("Refresh: 0");
    }
    //$g=$_SESSION["type"][0];
//echo "<script>alert(\"$g\");</script>";l
    ?>