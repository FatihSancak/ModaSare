<?php

include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

?>
    <div class="container">
        <div class="container-fluid py-5">
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

                if($donen_kayit == 0){
                    echo "kayıt yok";
                }else{
                    $i=0;
                    while ($rs = $sorgu->fetch_assoc()) {
                        if($i%3==0){
                            $bg="bg-primary text-white";
                        }elseif($i%2==0){
                            $bg="bg-dark-subtle text-dark";
                        }else{
                            $bg="bg-warning text-dark";
                        }
                        $i++;

                        ?>
                        <!--  Card Start  -->
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card  <?=$bg?>">
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
                                </div>
                            </div>
                        </div>
                        <!--  Card End  -->
                        <?php
                    }
                } ?>

            </div>

        </div>
    </div>
<?php
include_once 'inc/bottom.php'; ?>