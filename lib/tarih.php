<?php
date_default_timezone_set("Europe/Istanbul");

// echo date("d/m/Y");



$eskiTarih ="2023-03-01";

$newDate = date("d/m/Y", strtotime($eskiTarih));

echo "<br>".$eskiTarih."<br>".$newDate."<BR>";

  
  //echo $dosyaYolu;


  echo $_SERVER['SERVER_NAME']; //Outputs www.example.com
echo "<br>";
$str = "0,98";

$str = str_replace(",",".",$str);
echo $str;?>

