<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

if($_SERVER["REQUEST_METHOD"]=="POST") {
    //echo $_POST["modelID"]."-". $_POST["gelenUrunAdedi"]."-". $_POST["hareketTarihi"];
    setHareket($_POST["modelID"], $_POST["gelenUrunAdedi"], $_POST["hareketTarihi"]);
    go("/ModelDetay.php?ModelID=".$_POST["modelID"],0);
}
?>

    <!-- Container Start -->
    <div class="container col-10 mt-3">
        <div class="row">
            <h2 class="border-bottom border-dark no-fixed ">Model Yeni Hareket Ekleme</h2>
        </div>
        <!-- Form Elemanları Başlangıcı -->
        <form action="HareketEkle.php" method="post">

            <div class="form-group row">
                <label for="productName" class="col-sm-2 col-form-label">Model Adı</label>
                <div class="col-sm-10">
                    <select class="form-select mb-3 form-select-sm" name="modelID" id="modeller">
                        <option selected>Diğer Modeller</option>
                        <?= getModelSelect() ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="kumasCinsi" class="col-sm-2 col-form-label">Gelen Ürün Adedi</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="kumas" name="gelenUrunAdedi"
                           placeholder="Gelen Ürün Adedi">
                </div>
            </div>

            <!--   Tarih    -->
            <div class="form-group row">
                <label for="startDate" class="col-form-label col-sm-2">Tarih</label>
                <div class="col-sm-10">
                    <div class="input-group date" id="datepicker">

                        <input type="date" name="hareketTarihi" class="form-control" id="datepicker"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-10"></div>
                <div class="col-2">
                    <button type="reset" class="btn-danger rounded-1">Temizle</button>
                    <button type="submit" name="save" class="btn-success rounded-1">Kaydet</button>
                </div>
            </div>

        </form>
        <!-- Form Elemanları Bitiş -->

        <!-- Container End -->
    </div>

    </div>

    <?php
    include_once "inc/bottom.php";
    ?>