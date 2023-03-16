<?php
include '../inc/conn.php';
include '../inc/top.php';

//if(setHareket(426,300,"2023-01-02")==1){
go("/HareketModel.php?modelID=".$_POST("modelID"),1);
?>
<?php include '../inc/bottom.php'; ?>