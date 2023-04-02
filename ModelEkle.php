<?php
include_once 'inc/logCheck.php';
include_once 'inc/conn.php';
include_once 'inc/top.php';
$bugunun_tarihi = date("Y-m-d");


// MALİYET BAŞLIĞI EKLEME 

if (isset($_POST['save']) && isset($_FILES["modelFile"])) {

    $modelAdi = $_POST['modelName']; // MODEL ADI
    $kesimTuru = $_POST['kumasBirimi']; // KG / MT
    $kesimAdedi = $_POST['kesimAdedi']; // KESİM ADEDİ
    $kumasCins = $_POST['kumasCinsi']; // KUMAS CINSI
    $kumasMiktari = $_POST['kumasMiktari']; // KULLANILAN KUMAS MIKTARI (KG/MT)
    $karMarji= $_POST['karMarji']; // KAR MARJI

    $maliyetBaslikID = 1; // MALİYET BAŞLIKLARINDAN KUMASA KARSILIK GELEN ID 1 OLDUĞUNDAN TEMEL MALİYET EKLENİYOR
    $maliyetTarihi = $_POST['kesimTarihi']; // KESİMİN YAPILDIĞI TARİH 
    $kumasFiyati = $_POST['kumasFiyati']; // KUMAS FIYATI
    $kumasFiyati = (float) str_replace(",",".",$kumasFiyati);
    $kumasBirimMaliyeti = ((float)$kumasMiktari / (float)$kesimAdedi) * ($kumasFiyati);

    // MODEL EKLENDİ
    $ekle = $db->prepare("INSERT INTO model (modelAdi,kesimTuru,kesimAdedi, kumasCinsi, kumasMiktari, kumasFiyat, karMarji) VALUES 
            ('" . $modelAdi . "','" . $kesimTuru . "','" . $kesimAdedi . "','" . $kumasCins . "','" . $kumasMiktari . "', '" . $kumasFiyati . "', '".$karMarji."')");
    $ekle->execute();

    $model_ID = $db->lastInsertId();

    // MODEL İLK MALİYETİ EKLENDİ
    $Mekle = $db->prepare("INSERT INTO maliyetler (modelID, maliyetBaslikID, maliyetFiyat, maliyetTarihi) VALUES 
            ('" . $model_ID . "','" . $maliyetBaslikID . "','" . $kumasBirimMaliyeti . "','" . $maliyetTarihi . "')");
    $Mekle->execute();


    // RESİM VARSA UPLOAD ETME VE YOLUNU VERİTABANINA GİR
    if (isset($_FILES["modelFile"])) {
        $modelResmi = $_FILES["modelFile"];
        $modelResmiAdi = $modelResmi["name"];
        $fileTempName = $modelResmi["tmp_name"];
        $dosyaYolu = "ModelPic/" . $modelResmiAdi;
        if (move_uploaded_file($fileTempName, $dosyaYolu)) {
            echo "ModelPic yüklendi";
            $resimEkle = $db->prepare("UPDATE `model` SET `modelResmi` = '" . $modelResmiAdi . "' WHERE `model`.`modelID` =" . $model_ID);
            $resimEkle->execute();
        } else {
            echo "ModelPic YÜKLENEMEDİ";
        }
    }

    // HAREKET BİLGİSİ GİR
    setHareket($model_ID,0,$maliyetTarihi);

go("ModelListe.php",0);

}
?>


    <!-- Container Start -->
    <div class="container col-10 mt-3">
        <div>
            <h4 class="border-bottom border-dark no-fixed ">Yeni Model</h4>
        </div>
        <!-- Form Elemanları Başlangıcı -->
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="productName" class="col-sm-2 col-form-label">Model Adı</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="modelName" name="modelName" placeholder="Model Adı">
                </div>
            </div>

            <div class="form-group row">
                <label for="kumasCinsi" class="col-sm-2 col-form-label">Kumaş Cinsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kumas" name="kumasCinsi" placeholder="Kumaş Cinsi">
                </div>
            </div>


            <div class="form-group row">
                <label for="kumasMiktari" class="col-sm-2 col-form-label">Kumaş Miktarı</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kumasMiktari" name="kumasMiktari"
                           placeholder="Kumaş Miktarı (Bu alanda ondalık için virgül ( , ) yerine ( . ) NOKTA kullanmalısınız.">
                </div>
            </div>

            <div class="form-group row">
                <label for="kumasFiyati" class="col-sm-2 col-form-label">Kumaş Fiyatı</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kumasFiyati" name="kumasFiyati"
                           placeholder="Kumaş Fiyatı (Bu alanda ondalık için virgül ( , ) yerine ( . ) NOKTA kullanmalısınız.">
                </div>
            </div>

            <div class="form-group row">
                <label for="rawcount" class="col-sm-2 col-form-label">Kesim Adedi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rawcount" name="kesimAdedi" placeholder="Kesim Adedi">
                </div>
            </div>

            <div class="form-group row">
                <legend class="col-form-label col-sm-2 pt-0">Kumaş Birimi (kg/mt)</legend>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kumasBirimi" id="inlineRadio1" value="mt">
                        <label class="form-check-label" for="mt">Metre</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kumasBirimi" id="inlineRadio2" value="kg"
                               checked>
                        <label class="form-check-label" for="kg">Kilogram</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="karMarji" class="col-form-label col-sm-2">Kar Marjı</label>
                <div class="col-sm-10">
                    <div class="input">
                        <input type="text" name="karMarji" class="form-control" id="karMarji">
                    </div>
                </div>
            </div>


            <!--   Tarih    -->
            <div class="form-group row">
                <label for="datepicker" class="col-form-label col-sm-2">Kesim Tarihi</label>
                <div class="col-sm-10">
                    <div class="input-group date">
                        <input type="date" name="kesimTarihi" class="form-control" value="<?php echo $bugunun_tarihi; ?>"  id="datepicker"/>
                    </div>
                </div>
            </div>

            <!-- Dosya İşlemleri -->
            <div class="form-group row">

                <label for="formFile" class="col-form-label col-sm-2">Model Resmi</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="customFile" name="modelFile">
                </div>
            </div>
            <!-- Dosya işlemleri sonu -->
            <div class="form-group row">
                <div class="col-sm-10">
                    <div class="ml-auto">
                        <button type="reset" class="btn-danger btn-lg">Temizle</button>
                        <button type="submit" name="save" class="btn-success btn-lg">Kaydet</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Form Elemanları Bitiş -->

        <!-- Container End -->
    </div>
</div>

<?php include_once "inc/bottom.php";
?>