<?php

include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';


if ($_GET["MaliyetID"]!="") {
    delMaliyet($_GET["MaliyetID"]);
   }
else{
    go("ModelListe.php",0);
}
