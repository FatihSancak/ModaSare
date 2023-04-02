<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';


?>
    <style>
        @media only screen and (max-width: 900px) {

            #no-more-tables tbody,
            #no-more-tables tr,
            #no-more-tables td {
                display: block;
            }

            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #no-more-tables td {
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #eee;
            }

            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;
            }

            #no-more-tables tr {
                border-bottom: 1px solid #ccc;
            }
        }
    </style>

    <div class="container col-12">
        <section class="bg-light p-2">
            <h3 class="pb-2">Modeller
            </h3>

            <div class="table-responsive" id="no-more-tables">
                <table class="table bg-white table-hover text-center">
                    <thead class="bg-dark text-light">
                    <tr>
                        <th class="text-center">Model Resmi</th>
                        <th class="text-center">Model Adı</th>
                        <th class="text-center">Kesim Tarihi</th>
                        <th class="text-center">Kesim Adedi</th>
                        <th class="text-center">Maliyet Toplamı</th>
                        <th class="text-center">Satış</th>
                        <th class="text-center">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT model.*, maliyetler.maliyetTarihi 
                            FROM model 
                            INNER JOIN maliyetler 
                            ON model.modelID = maliyetler.modelID 
                            WHERE maliyetler.maliyetBaslikID =1
                            ORDER BY maliyetler.maliyetTarihi desc
                            ";

                    $ModelGetir = $db->prepare($sql);

                    //$ModelGetir = $db->prepare("SELECT * FROM model ORDER BY modelID DESC");

                    $ModelGetir->execute();

                    $ModelSayisi = $ModelGetir->rowCount(); // gelen kayıtları sayısını aldık
                    if ($ModelSayisi > 0) {
                        while ($satir = $ModelGetir->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td data-title="Model Resmi"><img width="100"
                                                                  src="/ModelPic/<?= $satir['modelResmi'] ?>" alt=""
                                                                  class="img-thumbnail img-fluid rounded"></td>
                                <td data-title="Model Adı" class="align-middle"><?= $satir['modelAdi'] ?></td>

                                <td data-title="Kesim Tarihi" class="align-middle">
                                    <button type="button" class="btn btn-dark"><?= $satir['kesimAdedi'] ?></button>
                                    <br>
                                    <span style="font-size:10px"><?= $satir['kesimTuru'] ?> / adet</span><br>
                                    <span style="font-size:10px"><?= tarihCevir($satir['maliyetTarihi']) ?></span>
                                </td>


                                <td data-title="Kesim Adedi" class="align-middle">
                                    <?= getModelHareketleriIndex($satir['modelID']) ?>
                                </td>


                                <td data-title="Maliyet Toplamı" class="align-middle">
                                    <button type="button"
                                            class="btn btn-primary"><?= rakam(getBirimMaliyet($satir['modelID'])) ?> ₺ /
                                        adet
                                    </button>
                                    <br>
                                    <small>
                                        Toplam : <?php
                                        $tm = getBirimMaliyet($satir['modelID']) * $satir['kesimAdedi'];
                                        $tm = number_format((float)$tm, 2, ",", ".");
                                        echo($tm);
                                        ?> ₺ <br>
                                    </small>
                                </td>
                                <td data-title="Satış" class="align-middle">
                                    <div class="text-center">
                                        <a href="" class="btn" style="background-color: #0dcaf0;">
                                            <b> <?= rakam(getBirimMaliyet($satir['modelID']) + (getBirimMaliyet($satir['modelID']) * $satir['karMarji'] / 100)) ?>
                                                ₺</b></a>
                                    </div>
                                </td>

                                <td data-title="İşlemler" class="align-middle">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="MaliyetEkle.php?ModelID=<?= $satir['modelID'] ?>"
                                           class="btn btn-outline-primary m-1" data-bs-target="#exampleModal"
                                           data-bs-whatever="@mdo">
                                            Maliyet Ekle</a>
                                        <a href="ModelSil.php?ModelID=<?= $satir['modelID'] ?>"
                                           class="btn btn-outline-danger m-1">Sil</a>
                                        <a href="ModelDetay.php?ModelID=<?= $satir['modelID'] ?>"
                                           class="btn btn-outline-dark m-1">Detay</a>
                                        <a href="ModelGuncelle.php?ModelID=<?= $satir['modelID'] ?>"
                                           class="btn btn-outline-info m-1">Güncelle</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    </div>
<?php
include_once "inc/bottom.php";
?>