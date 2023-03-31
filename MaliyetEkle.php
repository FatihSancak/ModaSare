<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

// Maliyetler listesini getir
$options = getMaliyetler();


if ($_POST) {
    

    $modelID = $_POST['modelID'];
    $maliyetBaslikID = $_POST['maliyetBaslik'];
    $maliyet = str_replace(",",".",$_POST['maliyet']);
    $maliyetTarihi = $_POST['maliyetTarihi'];

    $ekle = $db->prepare("INSERT INTO maliyetler (modelID,maliyetBaslikId,maliyetFiyat, maliyettarihi) VALUES 
                ('" . $modelID . "','" . $maliyetBaslikID . "','" . $maliyet . "','" . $maliyetTarihi . "')");
    $ekle->execute();

    go("ModelDetay.php?ModelID=".$modelID, 0);


}

?>

<div class="container">
    <div class="row mt-3">
        <div class="col-sm-11">
            Maliyet Eklenecek Ürün;
            <div class="row p-3 mt-2">
                <h3 class="bg-dark text-light rounded-4"><?= getModelName($_GET['ModelID']);?></h3>
            </div>
            <form action="" method="post">

                <div class="mb-3 row">
                    <!-- maliyet basliklari -->
                    <label class="form-label col-sm-3" for="maliyetBaslik">Maliyet Seçiniz</label>
                    <div class="col-sm-9 ">
                        <input type="hidden" value="<?= $_GET['ModelID'] ?>" name="modelID">
                        <select class="form-select" name="maliyetBaslik" id=maliyetBaslik aria-label="Maliyet Türü Seçimi">
                            <option value="" selected>Maliyet Seçiniz</option>
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <!-- maliyet fiyatı -->
                <div class="mb-3 row">
                    <label class="form-label col-sm-3" for="maliyetBaslik">Maliyet</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="maliyet" placeholder="Maliyet Miktarı">
                    </div>
                </div>
                <!-- date  -->
                <div class="mb-3 row">
                    <label class="col-form-label col-sm-3" for="datepicker">Maliyet Tarihi</label>
                    <div class="form-label col-sm-9">
                        <input type="date" name="maliyetTarihi" class="form-control" id="date" />
                    </div>
                </div>
                <!-- submit -->
                <div class="mb-3 row">
                    <label class="form-label col-sm-3" for="maliyetBaslik"></label>
                    <div class="col-sm-9 ">
                        <button type="button" class="btn btn-danger btn-xs" onclick="history.back()">Vazgeç</button>
                        <button type="submit" class="btn btn-success btn-xs">Maliyeti Ekle
                    </div>
                </div>
                <!-- submit button -->
                <div class="m-auto row">
                    <img class="img-responsive rounded mx-auto" width="10px"
                         src="ModelPic/<?= getModelPic($_GET['ModelID']) ?>">
                </div>
        </div>
        </form>
    </div>
</div>
</div>
    <script>
        $(function(){
            $("#datepicker").datepicker("setDate", new Date());
        });
    </script>

<?php
include_once "inc/bottom.php";
?>