<?php

include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

?>
    <div class="container">
        <div class="row justify-content-center align-items-center mt-2" style="height: 79vh">
            <div class="col-md-6">
                <div class="card text-center rounded-bottom-pill" style="background-color: #1f0256;">
                    <div class="card-body">
<!--                        <img src="..." class="card-img-top" alt="...">-->
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"></p>
                            <a href="CariOzet.php" class="btn btn-light btn-lg">Firma işlemleri Giriş</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center rounded-top-pill" style="background-color: #dd4106">
                    <div class="card-body">
<!--                        <img src="..." class="card-img-top" alt="...">-->
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"></p>
                            <a href="ModelOzet.php" class="btn btn-light btn-lg">Model İşlemleri Giriş</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once 'inc/bottom.php'; ?>