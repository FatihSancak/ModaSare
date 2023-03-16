<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';
$isRecord="";
if ($_POST) {

    if($_POST["maliyetBaslik"]!=""){

        $ekle = $db->prepare("INSERT INTO maliyetBaslik (maliyetAdi) VALUES ('". $_POST["maliyetBaslik"] ."')");
        $ekle->execute();
            $isRecord = "<div class=\"alert alert-success\" role=\"alert\">
            <strong>". $_POST["maliyetBaslik"] ."</strong>
                    Başarıyla eklendi.
                    </div>";
        }
}

?>
<div class="container mt-3">

<form method="post" action="">
    <div class="col">
        <div class="row">
          
            <label for="maliyetBaslik" class="col-sm-2 col-form-label">Maliyet Türü  
           </label>
                        <div class="col-sm-10 mb-2">
                <input type="text" class="form-control" id="maliyetBaslik" name="maliyetBaslik" placeholder="Eklenecek Yeni Maliyet Türü">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 ml-auto">
                <button class="btn btn-danger mr-1" onclick="history.back()">Vazgeç</button>
                <button class="btn btn-success" type="submit">Kaydet</button>
            </div>
        </div>
        
        <?php 
                if($isRecord != ""){
                    echo $isRecord; 
                } ?>
    </div>
</form>

</div>

<?php
include_once "inc/bottom.php";
?>