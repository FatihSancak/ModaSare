<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';
$isRecord = "";
if ($_POST) {
    //echo "1. post<br>";
    if ($_POST["maliyetBaslik"] != "") {
        //echo "2. post<br>";

        $maliyetBasligi = "INSERT INTO maliyetbaslik (maliyetAdi) VALUES ('" . $_POST["maliyetBaslik"] . "')";

        //echo $maliyetBasligi;

        $ekle = $db->prepare($maliyetBasligi);
        $ekle->execute();
            $isRecord = "<div class=\"alert alert-success\" role=\"alert\"><strong>" . $_POST["maliyetBaslik"] . "</strong> Başarıyla eklendi.</div>";
        }
}

?>
    <div class="container mt-3">

        <form method="post" action="/MaliyetBaslikEkle.php">
            <div class="col">
                <div class="row">
                    <h3 class="border-bottom border-dark no-fixed ">Yeni Maliyet Türü Ekleme</h3>
                </div>
                <div class="row">

                    <?php
                    if ($isRecord != "") {
                        echo $isRecord;
                    } ?>

                    <label for="maliyetBaslik" class="col-sm-2 col-form-label">Maliyet Türü
                    </label>
                    <div class="col-sm-10 mb-2">
                        <input type="text" class="form-control" id="maliyetBaslik" name="maliyetBaslik"
                               placeholder="Eklenecek Yeni Maliyet Türü">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-2 ml-auto">
                        <button class="btn btn-danger mr-1" onclick="history.back()">Vazgeç</button>
                        <button class="btn btn-success" type="submit">Kaydet</button>
                    </div>
                </div>

            </div>
        </form>

    </div>

<?php
include_once "inc/bottom.php";
?>