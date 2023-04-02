<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';
?>



    <div class="container mt-2">
        <!-- MODEL ****************************************************** -->
        <h3 class="" style="border-bottom: 1px solid red">Model Teslimat Özetleri</h3>
        <div class="container-fluid mb-3">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $conn = connect_db();
                if ($conn->connect_error) {
                    die("Bağlantı Hatası : " . $conn->connect_error);
                }

                $sorgu = $conn->query("SELECT * FROM model");

                if ($conn->errno > 0) {
                    die("<b>Sorgu Hatası : </b>" . $conn->error);
                }

                // veritabanından toplam dönen kayıt sayısını aldı.
                $donen_kayit = $sorgu->num_rows;

                if ($donen_kayit == 0) {
                    echo "kayıt yok";
                } else {
                    $i = 0;
                    while ($rs = $sorgu->fetch_assoc()) {
                        if ($i % 3 == 0) {
                            $bg = "bg-danger-subtle text-dark";
                        } elseif ($i % 2 == 0) {
                            $bg = "bg-dark-subtle text-dark";
                        } else {
                            $bg = "bg-warning text-dark";
                        }
                        $i++;

                        ?>
                        <!--  Card Start  -->
                        <div class="col-xl-3 col-sm-6 mb-xl-0 ">
                            <div class="card  <?= $bg ?>" ><a href="ModelDetay.php?ModelID=<?=$rs["modelID"]?>">
                                    <div class="text-center mt-3">
                                        <div style="display: flex; justify-content: center; " class="">
                                        <img src="ModelPic/<?=$rs["modelResmi"]?>" style="border: 3px solid deeppink; max-width: 50%;  max-height: 50%;; " alt="<?= $rs["modelAdi"] ?>">
                                    </div>
                                        <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center justify-content-center">
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"><?= $rs["modelAdi"] ?></p>
                                                    </div>
                                                    <div class="col-5">
                                                        <?= getModelHareketleriIndex($rs['modelID']) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div></a>
                            </div>
                        </div>
                        <!--  Card End  -->
                        <?php
                    }
                } ?>
            </div>
        </div>
        <!-- CARI ******************************************************* -->
        <h3 style="border-bottom: 1px solid red">Cari Hesap Özetleri</h3>
        <div class="container-fluid py-5 mt-2">
            <div class="col-xl-12 mb-xl-0">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    $conn = connect_db();
                    if ($conn->connect_error) {
                        die("Bağlantı Hatası : " . $conn->connect_error);
                    }

                    $sorgu = $conn->query("SELECT * FROM cari");

                    if ($conn->errno > 0) {
                        die("<b>Sorgu Hatası : </b>" . $conn->error);
                    }

                    // veritabanından toplam dönen kayıt sayısını aldı.
                    $donen_kayit = $sorgu->num_rows;

                    if ($donen_kayit == 0) {
                        echo "kayıt yok";
                    } else {
                        $i = 0;
                        while ($rs = $sorgu->fetch_assoc()) {
                            $borc = rakam(getCariToplam($rs["CARI_ID"], 1));
                            $alacak = rakam(getCariToplam($rs["CARI_ID"], 2));
                            $bakiye = rakam((getCariToplam($rs["CARI_ID"], 1)) - (getCariToplam($rs["CARI_ID"], 2)));

                            if ($i % 3 == 0) {
                                $bg = "bg-success-subtle text-white";
                            } elseif ($i % 2 == 0) {
                                $bg = "bg-danger text-dark";
                            } elseif ($i % 5 == 0) {
                                $bg = "bg-warning text-dark";
                            } else {
                                $bg = "bg-primary-subtle text-dark";
                            }
                            $i++;
                            ?>
                            <!--  Card Start  -->

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card <?= $bg ?>">

                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"><?= $rs["CARI_ADI"] ?></p>
                                                        <h5><?= $bakiye ?> ₺</h5>
                                                    </div>
                                                    <div class="col-3 text-center">
                                                        <a href="Cari_Liste_Detay.php?CARI_ID=<?= $rs["CARI_ID"] ?>"
                                                           style="font-size:40px; color:black">
                                                            <i class="bi bi-arrow-up-right-circle-fill"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  Card End  -->
                            <?php
                        }
                    }
                    $conn->close();
                    ?></div>
            </div>

        </div>
    </div>
<?php
include_once 'inc/bottom.php';


