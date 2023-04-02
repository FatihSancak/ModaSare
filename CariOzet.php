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

                $sorgu = $conn->query("SELECT * FROM cari");

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


                        $borc = rakam(getCariToplam($rs["CARI_ID"], 1));
                        $alacak = rakam(getCariToplam($rs["CARI_ID"], 2));
                        $bakiye = rakam((getCariToplam($rs["CARI_ID"], 1)) - (getCariToplam($rs["CARI_ID"], 2)));

                        if($i%3==0){
                            $bg="bg-success text-white";
                        }elseif($i%2==0){
                            $bg="bg-danger text-white";
                        }else{
                            $bg="bg-warning text-dark";
                        }
                        $i++;
                        ?>
                        <!--  Card Start  -->
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card <?=$bg?>">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold"><?= $rs["CARI_ADI"] ?></p>
                                                    <h5><?=$bakiye?> ₺</h5>
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
                } ?>

                <!--
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-info-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                                    <h5 class="font-weight-bolder">
                                                        2,300
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-warning-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                                    <h5 class="font-weight-bolder">
                                                        +3,462
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-info-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                                    <h5 class="font-weight-bolder">
                                                        2,300
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-warning-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                                    <h5 class="font-weight-bolder">
                                                        +3,462
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-info-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                                    <h5 class="font-weight-bolder">
                                                        2,300
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-warning-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                                    <h5 class="font-weight-bolder">
                                                        +3,462
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-info-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                                                    <h5 class="font-weight-bolder">
                                                        2,300
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-warning-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                                    <h5 class="font-weight-bolder">
                                                        +3,462
                                                    </h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card bg-dark-subtle">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                                    <h5 class="font-weight-bolder">
                                                        $103,430
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                -->
            </div>

        </div>
    </div>


<?php
include_once 'inc/bottom.php'; ?>