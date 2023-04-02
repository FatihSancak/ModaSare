<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';




if (isset($_POST["save"])){
    updateCari($_POST["cariAdi"],$_POST["cariTel"],$_POST["cariTC"],$_POST["cariVNo"],$_POST["cariAdres"],$_POST["CARI_ID"]);
    go("/Cari_Liste.php");
}

$cari = getCari($_GET["CARI_ID"]);
?>


<!-- Container Start -->
<div class="container col-10 mt-3">
    <div class="row border-bottom border-dark no-fixed mb-4 ">
        <div class="col-sm-5 float-left"><h4>Bilgi Güncelleme</h4></div>
        <div class="col-sm-2 text-right">Müşteri Seç :</div>
        <div class="col-sm-5 text-right">
            <select class="form-select mb-3 form-select-sm" name="cariler" id="cariler"
                    onchange="this.options[this.selectedIndex].value != '' ? location = this.options[this.selectedIndex].value : false">
                <?= getCariSelect2() ?></select></div>
    </div>
    <!-- Form Elemanları Başlangıcı -->
    <form action="#" method="post" enctype="multipart/form-data">

        <div class="form-group row">
            <input type="hidden" name="CARI_ID" value="<?=$_GET["CARI_ID"]?>">
            <label for="cariAdi" class="col-sm-2 col-form-label">Müşteri/Firma Adı</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cariAdi" name="cariAdi" value="<?=$cari["CARI_ADI"]?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="cariTel" class="col-sm-2 col-form-label">Telefon Numarası </label>
            <div class="col-sm-10">
                <input type="test" class="form-control" id="cariTel" name="cariTel" value="<?=$cari["CARI_TELEFON"]?>">
            </div>
        </div>


        <div class="form-group row">
            <label for="cariTC" class="col-sm-2 col-form-label">Müşteri T.C. No</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="cariTC" name="cariTC" value="<?=$cari["CARI_TC"]?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="cariVNo" class="col-sm-2 col-form-label">Müşteri / Firma Vergi No</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cariVNo" name="cariVNo" value="<?=$cari["CARI_VNO"]?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="cariAdres" class="col-sm-2 col-form-label">Adres</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cariAdres" name="cariAdres" value="<?=$cari["CARI_ADRES"]?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn-danger" onclick="history.back()">Temizle</button>
                    <button type="submit" name="save" class="btn-success">Güncelle</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Form Elemanları Bitiş -->
    <!-- Container End -->
</div>
<?php
include_once 'inc/bottom.php';
?>
