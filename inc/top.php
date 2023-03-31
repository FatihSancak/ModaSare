<?php
include 'inc/rout.php';
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/bootstrap-min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Moda Sare </title>
</head>

<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <?php
        if ($_SESSION['isLogin']) {
        ?>
        <a class="navbar-brand" href="/ModelListe.php">Moda Sare</a>
        <?php
        }else{
        ?>
        <a class="navbar-brand" href="/index.php">Moda Sare</a>
        <?php
        }
        ?>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <?php
            if ($_SESSION['isLogin']) {

                ?>
                <div class="navbar-nav  ml-auto">
                    <a class="nav-link" aria-current="page" href="ModelListe.php">Ana Sayfa</a>
                    <a class="nav-link" href="ModelEkle.php">Model Ekle</a>
                    <a class="nav-link" href="MaliyetBaslikEkle.php">Maliyet Türü Ekle</a>
                    <a class="nav-link" href="HareketEkle.php">Hareket Ekle</a>
                    <a class="nav-link" href="LogOut.php">Çıkış</a>

                </div>
                <?php
            } else {
                ?>
                <div class="navbar-nav ml-auto">
                    <a class="nav-link" href="index.php">Giriş</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</nav>
<!-- Navigasyon End -->