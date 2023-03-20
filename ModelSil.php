<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

$modelID = $_GET["ModelID"];

if(isset($_POST["Delete"])){
    print("silme onayı verildi.". $modelID);

    delModel($modelID);
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-10 mt-3">
            <h4><?=getModelName($modelID)?></h4><p>isimli Modeli silmek istiyor musunuz?</p>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-10 ">
                <form method="post" action="">
                <div class="btn-group d-flex justify-content-end">
                    <input type="hidden" value="<?=$_GET["ModelID"]?> name="modelId">
                    <button class="btn-group d-flex btn-danger mr-3" type="button" onclick="history.back();">Hayır</button>
                    <button class="btn-group d-flex btn-success" name="Delete" value="Delete" type="submit">Evet</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>


<?php
include_once 'inc/bottom.php';
?>
