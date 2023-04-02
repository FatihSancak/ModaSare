<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';


if (isset($_POST["save"])){
    setCariYeni($_POST["cariAdi"],$_POST["cariTel"],$_POST["cariTC"],$_POST["cariVNo"],$_POST["cariAdres"]);
    go("/Cari_Liste.php");
}

?>


<!-- Container Start -->
<div class="container col-10 mt-3">
    <div>
        <h4 class="border-bottom border-dark no-fixed ">Yeni Müşteri/Tedarikçi</h4>
    </div>
    <!-- Form Elemanları Başlangıcı -->
    <form action="#" method="post" enctype="multipart/form-data">

        <div class="form-group row">
            <label for="cariAdi" class="col-sm-2 col-form-label">Müşteri/Firma Adı</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cariAdi" name="cariAdi">
            </div>
        </div>

        <div class="form-group row">
            <label for="cariTel" class="col-sm-2 col-form-label">Telefon Numarası </label>
            <div class="col-sm-10">
                <input type="test" class="form-control" id="cariTel" name="cariTel">
            </div>
        </div>


        <div class="form-group row">
            <label for="cariTC" class="col-sm-2 col-form-label">Müşteri T.C. No</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="cariTC" name="cariTC">
            </div>
        </div>

        <div class="form-group row">
            <label for="cariVNo" class="col-sm-2 col-form-label">Müşteri / Firma Vergi No</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cariVNo" name="cariVNo">
            </div>
        </div>

        <div class="form-group row">
            <label for="cariAdres" class="col-sm-2 col-form-label">Adres</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="cariAdres" name="cariAdres">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn-danger" onclick="history.back()">Temizle</button>
                    <button type="submit" name="save" class="btn-success">Kaydet</button>
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
