<?php

include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';


if ($_GET["hareketID"]!="") {
    delHareket($_GET["hareketID"]);
}
else{
    go("ModelListe.php",0);
}
