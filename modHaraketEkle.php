<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

if($_SERVER["REQUEST_METHOD"]=="POST") {
    //echo $_POST["modelID"]."-". $_POST["gelenUrunAdedi"]."-". $_POST["hareketTarihi"];

    setHareket($_POST["modelID"], $_POST["gelenUrunAdedi"], $_POST["hareketTarihi"]);

    comeBack(5);
}?>

<!-- Modal -->
<div class="modal fade" id="hareketEkle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Form Elemanları Başlangıcı -->
            <form action="HareketEkle.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hareket Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="gelenUrunAdedi" class="col-sm-6 col-form-label">Gelen Ürün Adedi</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="gelenUrunAdedi" name="gelenUrunAdedi"
                                   placeholder="Gelen Ürün Adedi">
                        </div>
                    </div>

                    <!--   Tarih    -->
                    <div class="form-group row">
                        <label for="hareketTarihi" class="col-sm-6 col-form-label">Tarih</label>
                        <div class="col-sm-6">
                            <div class="input-group date" id="datepicker">
                                <input type="date" name="hareketTarihi" class="form-control" id="datepicker"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success" name="save">Hareket Kaydet</button>
                </div>
            </form>
            <!-- Form Elemanları Bitiş -->
        </div>
    </div>
</div>
include_once 'inc/bottom.php';