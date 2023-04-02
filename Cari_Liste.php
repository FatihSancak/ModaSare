<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';
?>
<div class="container col-sm-12">
    <section class="bg-light p-2">
        <div class="row">
            <h4 class="pb-2">Müşteri/Tedarikçi Listesi</h4>
            <div class="col-sm-2">
                <a href="Cari_Ekle.php">Yeni Ekle</a>
            </div>
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-hover">
                <thead class="bg-dark text-light">
                <tr>
                    <th scope="col" class="text-center">Müşteri/Firma Adı</th>
                    <th scope="col" class="text-center">Telefon</th>
                    <th scope="col" class="text-center">TC No</th>
                    <th scope="col" class="text-center">Vergi No</th>
                    <th scope="col" class="text-center">Adres</th>
                    <th scope="col" class="text-center"></th>

                </tr>
                </thead>
                <tbody>
                <?php
                $cariler = getCariler();

                foreach ($cariler as $cari) {
                    ?>
                    <tr>
                        <td class="text-left">
                            <a href="Cari_Liste_Detay.php?CARI_ID=<?= $cari['CARI_ID'] ?>">
                                <span style="font-size:large "><i class="bi bi-arrow-right-circle"></i></span>

                                <?= $cari['CARI_ADI'] ?></a>
                        </td>
                        <td><?= $cari['CARI_TELEFON'] ?></td>
                        <td><?= $cari['CARI_TC'] ?></td>
                        <td><?= $cari['CARI_VNO'] ?></td>
                        <td class="text-left"><?= $cari['CARI_ADRES'] ?></td>
                        <td class="text-center">
                            <a href="Cari_Guncelle.php?CARI_ID=<?=$cari["CARI_ID"]?>"><i class="fa-solid fa-pen-to-square fa-xl mr-2"></i></a>
                            <a href="Cari_Hareket_Ekle.php?CARI_ID=<?= $cari['CARI_ID'] ?>"><i class="fa-solid fa-hand-holding-dollar fa-xl"></i></a>

                            <!--<i class="fa-solid fa-trash-can fa-xl mr-2"></i>
                            <i class="fa-solid fa-circle-info fa-xl mr-1"></i>-->
                        </td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php
include_once 'inc/bottom.php';
?>
