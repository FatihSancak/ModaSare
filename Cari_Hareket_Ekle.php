<?php

include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

$bugunun_tarihi = date("Y-m-d");

if (isset($_POST["save"])) {
    setCariHareket($_POST["cari_id"], $_POST["hturu"], $_POST["dturu"], $_POST["hareketTarihi"], $_POST["tutar"], $_POST["aciklama"]);
    go("/Cari_Liste.php");
}
?>
    <div class="container col-10 mt-3">
        <div>
            <h3 class="border-bottom border-dark no-fixed ">Cari Hareket Ekle</h3>
        </div>
        <!-- Form Elemanları Başlangıcı -->
        <form action="#" method="post">

            <div class="form-group row">

                <label for="cari_id" class="col-form-label col-sm-3">Firma Adı</label>
                <div class="col-sm-9">
                    <select name="cari_id" id="cari_id" class="form-control">
                        <?= getCariSelect() ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="hturu" class="col-form-label col-sm-3">Hareket Türü</label>
                <div class="col-sm-9">
                    <select name="hturu" id="hturu" class="form-control">
                        <?= getCariHareketTuruSelect() ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="dturu" class="col-form-label col-sm-3">Para Birimi</label>
                <div class="col-sm-9">
                    <select name="dturu" id="dturu" class="form-control">
                        <?= getDovizSelect() ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="hareketTarihi" class="col-form-label col-sm-3">Tarih</label>
                <div class="col-sm-9">
                    <input type="date" name="hareketTarihi" value="<?php echo $bugunun_tarihi; ?>"
                           class="form-control" id="datepicker"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="adet" class="col-form-label col-sm-3">Adet/Kg</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="adet" name="adet">
                </div>
            </div>

            <div class="form-group row">
                <label for="birim" class="col-form-label col-sm-3">Birim Fiyat</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="birim" name="birim">
                </div>
            </div>

            <div class="form-group row">
                <label for="tutar" class="col-form-label col-sm-3">Tutar</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="tutar" name="tutar">
                </div>
            </div>
            <div class="form-group row">
                <label for="aciklama" class="col-form-label col-sm-3">Açıklama</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="aciklama" name="aciklama"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2 ml-auto">
                    <input type="button" class="btn btn-danger mr-1" onclick="history.back()" value="Vazgeç"></input>
                    <button class="btn btn-success" name="save" type="submit">Kaydet</button>
                </div>
            </div>
        </form>
    </div>

    <script>

        const adetInput = document.getElementById('adet');
        const birimInput = document.getElementById('birim');
        const tutarInput = document.getElementById('tutar');
        const aciklamaInput = document.getElementById('aciklama');

        function hesapla() {
            const adet = parseFloat(adetInput.value);
            const birim = parseFloat(birimInput.value);
            const sonuc = adet * birim;


            tutarInput.value = sonuc;
            aciklamaInput.value  = adet +" x "+ birim;
        }

        adetInput.addEventListener('input', hesapla);
        birimInput.addEventListener('input', hesapla);

    </script>

<?php
include_once 'inc/bottom.php';
?>