<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

$modelID = $_GET['ModelID'];

$ModelSQL = "SELECT
            model.*, 
            maliyetler.maliyetTarihi
            FROM
            model
            INNER JOIN
            maliyetler
            ON 
                model.modelID = maliyetler.modelID
            WHERE
            maliyetler.maliyetBaslikID = 1 AND model.modelID=" . $modelID;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
$result = $conn->query($ModelSQL);
$row = $result->fetch_assoc();
$uretimAdedi = $row["kesimAdedi"]
?>
    <div class="container">
        <!-- MODEL SEÇİMİ VE MALİYET EKLEME -->
        <div class="row">
            <div class="col-sm-7 mt-3">
                <select class="form-select mb-3 form-select-sm" name="modeller" id="modeller"
                        onchange="this.options[this.selectedIndex].value != '' ? location = this.options[this.selectedIndex].value : false">
                    <option value="/ModelListe.php" selected>Diğer Modeller</option>
                    <?= getModelMaliyetSelect() ?>
                </select>
            </div>
            <div class="col-sm-5 mt-2 btn-groupl">
                <a href="MaliyetEkle.php?ModelID=<?= $modelID ?>" class="btn btn-primary">Maliyet Ekle</a>
                <a href="HareketEkle.php?ModelID=<?= $modelID ?>" class="btn btn-success">Hareket Ekle</a>
                <a href="ModelSil.php?ModelID=<?= $modelID ?>" class="btn btn-danger">Sil</a>
                <a href="ModelGuncelle.php?ModelID=<?= $modelID ?>" class="btn btn-info m-1">Güncelle</a>
            </div>

        </div>
        <!-- MODEL SEÇİMİ VE MALİYET EKLEME BİTTİ -->


        <div class="row">
            <div class="mb-3 mt-1">
                <!--  MODEL ADI VE KUMAŞ BİLGİSİ ALANI  -->
                <div class="col-mt-2 border-bottom">
                    <h5 class="card-title"><?= $row["modelAdi"] ?>-><small><?= $row["kumasCinsi"] ?></small></h5>
                </div>
                <div class="row g-0">
                    <div class="col-md-3 mt-2">
                        <img src="ModelPic/<?= $row["modelResmi"] ?>" class="mx-auto d-block rounded img-fluid"
                             alt="<?= $row["modelAdi"] ?>">
                    </div>


                    <div class="col-md-9">
                        <!-- Resim Yanı Bilgileri-->
                        <div class="container">
                            <div class="row mt-3">
                                <div class="col-md-3 col-sm-12 text-center">Kumaş Fiyatı</div>
                                <div class="col-md-9 col-sm-12 text-center"><a href="#"
                                                                               class="btn btn-success"><?= rakam($row["kumasFiyat"]) ?>
                                        ₺ </a></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 col-sm-12 text-center">Kesilen Kumaş</div>
                                <div class="col-md-9 col-sm-12 text-center"><a href="#"
                                                                               class="btn btn-success"><?= $row["kumasMiktari"] ?>  <?= $row["kesimTuru"] ?></a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 col-sm-12 text-center">Kesim Adedi</div>
                                <div class="col-md-9 col-sm-12 text-center"><a href="#"
                                                                               class="btn btn-success"><?= $row["kesimAdedi"] ?></a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 col-sm-12 text-center">Kesim Tarihi</div>
                                <div class="col-md-9 col-sm-12 text-center"><a href="#"
                                                                               class="btn btn-success"><?= tarihCevir($row["maliyetTarihi"]) ?></a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 col-sm-12 text-center">Birim Maliyet</div>
                                <div class="col-md-9 col-sm-12 text-center"><a href="#"
                                                                               class="btn btn-danger mb-2"><?= rakam(getBirimMaliyet($modelID)) ?>
                                        ₺</a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 col-sm-12 text-center">Satış Fiyatı <span class="badge text-bg-success">% <?=$row["karMarji"]?></span></div>
                                <div class="col-md-9 col-sm-12 text-center"><a href=""
                                                                               class="btn mb-3" style="background-color: #0dcaf0;" ><h5><b><?= rakam(getBirimMaliyet($modelID)+(getBirimMaliyet($modelID)*$row["karMarji"]/100)) ?></b>
                                        ₺</h5></a>
                                </div>
                            </div>
                        </div>
                        <!-- Resim Yanı Bilgileri Bitti -->

                        <div class="accordion accordion-flush col-11" id="accordionFlush">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed bg-danger-subtle" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                        Maliyetler
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                     aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
                                    <div class="accordion-body">
                                        <?php

                                        $sql = "SELECT
           maliyetbaslik.maliyetAdi, 
           maliyetler.maliyetFiyat, 
           maliyetler.maliyetTarihi,
           maliyetler.maliyetID,
           maliyetler.maliyetBaslikID,
           model.modelAdi, 
        model.modelID
        FROM
           maliyetler
           INNER JOIN
           model
           ON 
               maliyetler.modelID = model.modelID
           INNER JOIN
           maliyetbaslik
           ON 
               maliyetler.maliyetBaslikID = maliyetbaslik.maliyetID
        WHERE model.modelID = " . $modelID . " ORDER BY maliyetTarihi asc";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            ?>

                                            <div class="row mb-1 mt-1 border-bottom">
                                                <?php
                                                if ($row["maliyetBaslikID"]!=1){
                                                ?>
                                                <div class="col-md-2">
                                                    <a href="MaliyetSil.php?MaliyetID=<?= $row["maliyetID"] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></a>
                                                </div>
                                                <?php
                                                }else{
                                                ?>
                                                <div class="col-md-2 mb-1 mt-1 ">
                                                    <button class="btn btn-outline-success">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                    </button>
                                                </div>

                                                    <?php
                                                }
                                                    ?>
                                                <div class="col-md-2">
                                                    <small><?= tarihCevir($row["maliyetTarihi"]) ?></small></div>
                                                <div class="col-md-4"><?= $row["maliyetAdi"] ?></div>
                                                <div class="col-md-4 text-end"><?= rakam($row["maliyetFiyat"]) ?>₺
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        $conn->close();
                                        ?>
                                        <div class="row mb-2 border-bottom border-top-0 ">
                                            <div class="col-md-4">BİRİM MALİYET</div>
                                            <div class="col-md-8 text-end">
                                                <a href="#"
                                                   class="btn btn-danger mb-2"><?= rakam(getBirimMaliyet($modelID)) ?>
                                                    ₺</a>

                                            </div>
                                        </div>

                                        <div class="row mb-2 btn-outline-danger border-bottom">
                                            <div class="col-md-4">Toplam Model Maliyeti</div>
                                            <div class="col-md-8 text-end"><?php
                                                $tm = getBirimMaliyet($modelID);
                                                $tm = getToplamMaliyet($tm, $uretimAdedi);
                                                $tm= number_format(((float)$tm),2,",",".");
                                                echo($tm);
                                                ?> ₺
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed bg-warning-subtle" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                            aria-controls="flush-collapseTwo">
                                        Ürün Hareketleri
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                     aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlush">
                                    <div class="accordion-body">
                                        <div class="container col-12">
                                            <div class="row sm-2 mt-3 text-center">
                                                <div class="col d-grid btn-outline-primary"><b>Model Hareketleri</b>
                                                </div>
                                            </div>
                                            <div class="row btn-outline-dark">
                                                <div class="col-2">&nbsp;</div>
                                                <div class="col-5">Tarih</div>
                                                <div class="col-5">Adet</div>
                                            </div>
                                            <?php getModelHareket($modelID); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php
include_once "inc/bottom.php";
?>