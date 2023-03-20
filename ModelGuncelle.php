<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';
$modelInfo = getModel($_GET["ModelID"]);

if($_SERVER["REQUEST_METHOD"]=="POST") {

    $model = array(
        'modelAdi'=> $_POST["modelName"],
        'kesimTuru'=> $_POST["kumasBirimi"],
        'kesimAdedi'=> $_POST["kesimAdedi"],
        'kumasCinsi'=> $_POST["kumasCinsi"],
        'kumasMiktari'=> $_POST["kumasMiktari"],
        'kumasFiyat'=> $_POST["kumasFiyati"],
        'modelID'=> $_GET["ModelID"]
    );

    setModelGuncelle($model);

}
?>
    <!-- Container Start -->
    <div class="container col-10 mt-3">
        <div>
            <h2 class="border-bottom border-dark no-fixed ">Model Güncelle</h2>
        </div>
        <!-- Form Elemanları Başlangıcı -->
        <form action="#" method="post">

            <div class="form-group row">
                <label for="productName" class="col-sm-2 col-form-label">Model Adı</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="modelName" name="modelName"
                           value="<?= $modelInfo['modelAdi'] ?>" placeholder="Model Adı">
                </div>
            </div>

            <div class="form-group row">
                <label for="kumasCinsi" class="col-sm-2 col-form-label">Kumaş Cinsi</label>
                <div class="col-sm-10">
                    <input type="test" class="form-control" id="kumas" name="kumasCinsi"
                           value="<?= $modelInfo['kumasCinsi'] ?>" placeholder="Kumaş Cinsi">
                </div>
            </div>


            <div class="form-group row">
                <label for="kumasMiktari" class="col-sm-2 col-form-label">Kumaş Miktarı</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kumasMiktari" name="kumasMiktari"
                           value="<?= $modelInfo['kumasMiktari'] ?>"
                           placeholder="Kumaş Miktarı (Bu alanda ondalık için virgül ( , ) yerine ( . ) NOKTA kullanmalısınız.">
                </div>
            </div>

            <div class="form-group row">
                <label for="kumasFiyati" class="col-sm-2 col-form-label">Kumaş Fiyatı</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kumasFiyati" name="kumasFiyati"
                           value="<?= $modelInfo['kumasFiyati'] ?>"
                           placeholder="Kumaş Fiyatı (Bu alanda ondalık için virgül ( , ) yerine ( . ) NOKTA kullanmalısınız.">
                </div>
            </div>

            <div class="form-group row">
                <label for="rawcount" class="col-sm-2 col-form-label">Kesim Adedi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rawcount" value="<?= $modelInfo['kesimAdedi'] ?>"
                           name="kesimAdedi" placeholder="Kesim Adedi">
                </div>
            </div>

            <div class="form-group row">
                <legend class="col-form-label col-sm-2 pt-0">Kumaş Birimi (kg/mt)</legend>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kumasBirimi" id="inlineRadio1" value="mt"
                            <?php
                            if ($modelInfo['kesimTuru'] == "mt") {
                                echo "checked";
                            }
                            ?>
                        >
                        <label class="form-check-label" for="mt">Metre</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kumasBirimi" id="inlineRadio2" value="kg"
                            <?php
                            if ($modelInfo['kesimTuru'] == "kg") {
                                echo "checked";
                            }
                            ?>>
                        <label class="form-check-label" for="kg">Kilogram</label>
                    </div>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10">
                    <div class="ml-auto">
                        <button type="reset" class="btn-danger btn-lg" onclick="history.back()">Vazgeç</button>
                        <button type="submit" name="save" class="btn-success btn-lg">Güncelle</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Form Elemanları Bitiş -->
    </div>

<?php include_once "inc/bottom.php";
?>