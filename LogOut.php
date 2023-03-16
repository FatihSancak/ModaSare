<?php 
session_start();
$_SESSION['isLogin']="";
echo $_SESSION['isLogin'];
session_destroy();
header("refresh:0,url='index.php'");
?>
