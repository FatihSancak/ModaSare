<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';

$borc = rakam(getCariToplam($_GET["CARI_ID"], 1));
$alacak = rakam(getCariToplam($_GET["CARI_ID"], 2));
$bakiye = rakam((getCariToplam($_GET["CARI_ID"], 1)) - (getCariToplam($_GET["CARI_ID"], 2)));
$cari_adi = getCariAdi($_GET["CARI_ID"]);
if ($borc > $alacak) {
    $bakiye_turu = "Borç Bakiyesi : ";
} else {
    $bakiye_turu = "Alacak Bakiyesi : ";
}
?>
<div class="container col-sm-12">
    <section class="bg-light p-2">
        <div class="row">
            <h4 class="pb-2"><a href="Cari_Liste.php" class="text-left">Müşteri/Tedarikçi Listesi</a></h4>
        </div>
        <div class="row">
            <div class="col-sm-6 float-left"><h5 class="border-bottom"><?= $cari_adi ?></h5></div>
            <div class="col-sm-1 text-right">Müşteri Seç :</div>
            <div class="col-sm-5 text-right">
                    <select class="form-select mb-3 form-select-sm" name="cariler" id="cariler"
                            onchange="this.options[this.selectedIndex].value != '' ? location = this.options[this.selectedIndex].value : false">
                    <?= getCariSelect2() ?></select></div>
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-hover">


                <thead>
                <tr class="text-right bg-info-subtle te">
                    <td><a href="Cari_Guncelle.php?CARI_ID=<?=$_GET["CARI_ID"]?>"><i class="fa-solid fa-pen-to-square fa-xl mr-2"></i></a>
                        <a href="Cari_Hareket_Ekle.php?CARI_ID=<?= $_GET['CARI_ID'] ?>"><i class="fa-solid fa-hand-holding-dollar fa-xl"></i></a></td>
                    <td colspan="2"></td>
                    <td>Borç Toplamı : <?= $borc ?> ₺</td>
                    <td>Alacak Toplamı : <?= $alacak ?> ₺</td>
                    <td><?= $bakiye_turu, $bakiye ?> ₺</td>
                </tr>
                <tr class="bg-dark text-light text-center">
                    <th>Tarih</th>
                    <th>Tür</th>
                    <th>Açıklama</th>
                    <th>Borç</th>
                    <th>Alacak</th>
                    <th>...</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $cariler = getCariHareketleri($_GET["CARI_ID"]);

                foreach ($cariler as $cari) {
                    ?>
                    <tr>
                        <td class="text-center"><?= tarihCevir($cari['HAREKET_TARIHI']) ?></td>
                        <td class="text-left"><?= $cari['HAREKET_TURU'] ?></td>
                        <td class="text-left"><?= $cari['HAREKET_ACIKLAMA'] ?></td>
                        <td class="text-right"
                            style="background-color: #eeeeee"><?php if ($cari['HAREKET_TURU_ID'] == 1) echo rakam($cari['HAREKET_TUTARI']) . ' ₺' ?> </td>
                        <td class="text-right"><?php if ($cari['HAREKET_TURU_ID'] == 2) echo rakam($cari['HAREKET_TUTARI']) . ' ₺' ?> </td>
                        <td class="text-right">
                            <a href="Cari_Hareket_Guncelle.php?HAREKET_ID=<?= $cari['HAREKET_ID'] ?>"><i
                                        class="fa-sharp fa-regular fa-pen-to-square fa-xl"></i></a>
                            <a href="Cari_Hareket_Sil.php?HAREKET_ID=<?= $cari['HAREKET_ID'] ?>"><i class="fa-solid fa-trash-can fa-xl"></i></a>
                        </td>
                    </tr>
                    <?php
                } ?>
                <tr class="text-right bg-info-subtle">
                    <td colspan="3"></td>
                    <td>Borç Toplamı : <?= $borc ?> ₺</td>
                    <td>Alacak Toplamı : <?= $alacak ?> ₺</td>
                    <td><?= $bakiye_turu, $bakiye ?> ₺</td>

                </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php
include_once 'inc/bottom.php';
?>
