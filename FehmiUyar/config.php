<?php
$server = "localhost" ;
$user="root";
$pass="";
$db="dbmodasare";

try {
    $db = new PDO("mysql:host=".$server.";dbname=".$db.";charset=utf8;",$user,"");
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>