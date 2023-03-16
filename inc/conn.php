<?php

if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "192.168.1.50") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DBModaSare";
} else {
    $servername = "5.2.84.235";
    $username = "arizeki_mfs";
    $password = "Afyon1923,";
    $dbname = "arizeki_mfs";

}

date_default_timezone_set("Europe/Istanbul");

try {
    //$db = new PDO("mysql:host=localhost;dbname=DBModaSare;charset=utf8;", 'root', '');

    $db = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname . ";charset=utf8", $username, $password);

    //$db = new PDO("mysql:host=".$servername.";dbname=".$dbname.";charset=utf8;""\,".$username., ".$password);

    //echo "Connecting to Successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
    //echo "Error connecting to DATABASE";
}

function getModelName($id)
{
    // MySQL veritabanına bağlanma
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Sorgu hazırlama ve çalıştırma
    $sql = "SELECT modelAdi FROM model WHERE modelID = " . $id;
    $result = $conn->query($sql);

    // Sorgu sonuçlarını kontrol etme
    if ($result->num_rows > 0) {
        // Bir satır var, ModelAdi sütunundaki değeri döndür
        $row = $result->fetch_assoc();
        return $row["modelAdi"];
    } else {
        // Hiçbir satır yok
        return "Model bulunamadı.";
    }

    // Bağlantıyı kapat
    // $conn->close();
}

function getMaliyetler()
{
    // Veritabanı bilgilerini sabitleyin
    global $servername;
    global $username;
    global $password;
    global $dbname;

    // Veritabanı bağlantısını oluşturun
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // SQL sorgusunu oluşturun
    $sql = "SELECT maliyetAdi, maliyetID FROM maliyetbaslik ORDER BY maliyetAdi ASC ";

    // SQL sorgusunu çalıştırın ve sonuçları alın
    $result = $conn->query($sql);

    // Seçenekler için bir değişken tanımlayın
    $options = "";

    // Sonuçlardaki her satır için döngü oluşturun ve seçenekleri oluşturun
    while ($row = $result->fetch_assoc()) {
        $options .= "<option class=\"form-select form-control\" id=\"maliyetBaslik\" aria-label=\"Maliyet Seçimi\" value='" . $row["maliyetID"] . "'>» " . $row["maliyetAdi"] . "</option>";
    }

    // Veritabanı bağlantısını kapatın
    $conn->close();

    // Seçenekleri döndürün
    return $options;
}

function getModelPic($id)
{
    // MySQL veritabanına bağlanma
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Sorgu hazırlama ve çalıştırma
    $sql = "SELECT modelResmi FROM model WHERE modelID = " . $id;
    $result = $conn->query($sql);

    // Sorgu sonuçlarını kontrol etme
    if ($result->num_rows > 0) {
        // Bir satır var, ModelAdi sütunundaki değeri döndür
        $row = $result->fetch_assoc();
        return $row["modelResmi"];
    } else {
        // Hiçbir satır yok
        return "Model Resmi bulunamadı.";
    }

    // Bağlantıyı kapat
    //$conn->close();
}


// rakam -> Verilen sayıyı
// binler basamaklarına göre nokta (.) ile
// ondalık kısımlarını ise virgül (,) ile görünmesini sağlıyor
function rakam($sayi)
{
    $bicimlendir = number_format($sayi, 2, ",", ".");
    return $bicimlendir;
}

// tarihCevir -> Tarihi ekrana basarken MySQL'den gelen tarihin formatını değiştirmek için kullanılıyor
function tarihCevir($tarih)
{
    $newDate = date("d/m/Y", strtotime($tarih));
    return $newDate;
}

// getToplamMaliyet -> Birim maliyet ile üretime adedini çarpıp toplam maliyeti buluyor
function getToplamMaliyet($birimMaliyet, $uretimAdedi)
{
    $sonuc = $birimMaliyet * $uretimAdedi;
    $sonuc = rakam($sonuc);
    return $sonuc;
}

function getBirimMaliyet($i)
{
    // MySQL veritabanına bağlanma
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantı hatası kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "SELECT 
            SUM(maliyetler.maliyetFiyat) as birimMaliyet 
            FROM model 
            JOIN maliyetler 
            ON model.ModelID = maliyetler.ModelID 
            WHERE model.modelID=" . $i;

    $result = $conn->query($sql);

    // Sorgu sonuçlarını kontrol etme
    if ($result->num_rows > 0) {
        // Bir satır var,
        $row = $result->fetch_assoc();
        return $row["birimMaliyet"];
    } else {
        // Hiçbir satır yok
        return "Model Resmi bulunamadı.";
    }

    // Bağlantıyı kapat
    $conn->close();

}

function getModelMaliyetSelect()
{
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "SELECT model.*, maliyetler.maliyetTarihi 
    FROM model 
    INNER JOIN maliyetler 
    ON model.modelID = maliyetler.modelID 
    WHERE maliyetler.maliyetBaslikID =1
    ORDER BY maliyetler.maliyetTarihi desc";

    $result = $conn->query($sql);

    $options = "";

    while ($row = $result->fetch_assoc()) {
        $options .= " <option value=\"?ModelID=" . $row["modelID"] . "\"";
        if ($_GET['ModelID'] == $row["modelID"]) {
            $options .= " selected";
        }
        $options .= ">" . $row["modelAdi"] . "</option>";
    }
    //$conn->close();
    return $options;
}

function getModelSelect()
{
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "SELECT model.*, maliyetler.maliyetTarihi 
    FROM model 
    INNER JOIN maliyetler 
    ON model.modelID = maliyetler.modelID 
    WHERE maliyetler.maliyetBaslikID =1
    ORDER BY maliyetler.maliyetTarihi desc";

    $result = $conn->query($sql);

    $options = "";

    while ($row = $result->fetch_assoc()) {
        $options .= " <option value=\"" . $row["modelID"] . "\"";
        if (isset($_GET["ModelID"])) {

            if ($_GET['ModelID'] == $row["modelID"]) {
                $options .= " selected";
            }
        } $options .= ">" . $row["modelAdi"] . "</option>\n\t";
    }
    //$conn->close();
    return $options;
}

function setHareket($modelID, $hareketSayi, $hareketTarihi)
{
    global $servername;
    global $username;
    global $password;
    global $dbname;
    $sonuc = "";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "INSERT INTO hareket (`modelID`,`hareketSayi`,`hareketTarihi`) VALUES ('" . $modelID . "','" . $hareketSayi . "','" . $hareketTarihi . "');";

    $result = $conn->query($sql);

}

function getModelHareket($modelID)
{
    global $servername;
    global $username;
    global $password;
    global $dbname;
    $sonuc = "";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM hareket WHERE modelID= " . $modelID . " ORDER BY hareketTarihi  DESC";

    $result = $conn->query($sql);
    $toplam = 0;
    while ($row = $result->fetch_assoc()) {
        $toplam += $row["hareketSayi"];
        echo "<div class=\"row btn-outline-dark\">";
        echo "<div class=\"col-6\">" . tarihCevir($row["hareketTarihi"]) . "</div>";
        echo "<div class=\"col-6\">" . $row["hareketSayi"] . "</div>";
        echo "</div>";
    }


    echo "<div class=\"row border-top btn-success\">";
    echo "<div class=\"col-6 \">Toplam</div><div class=\"col-6\">" . $toplam . "</div>";
}

function getModelHareketleriIndex($modelID)
{
    // Veritabanı bilgilerini sabitleyin
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }


    $sql = "SELECT model.kesimAdedi, SUM(hareket.hareketSayi) as gelen FROM model INNER JOIN	hareket	ON model.modelID = hareket.modelID WHERE model.modelID =" . $modelID;

    $result = $conn->query($sql);

    $options = "";

    while ($row = $result->fetch_assoc()) {
        $kalan = $row["kesimAdedi"] - $row["gelen"];
        if ($kalan == 0) {
            $options .= "<div class=\"col-sm-4 mb-3\">";
            $options .= " <button type=\"button\" class=\"btn-sm btn-success position-relative\"><i class=\"fa-solid fa-circle-check\" STYLE='font-size: 32px;'></i>";
            $options .= " <span class=\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light bg-dark\">" . $row["kesimAdedi"] . "<span class=\"visually-hidden\"></span></span>";
            $options .= " </button></div>";
        } elseif ($kalan < 0) {
            echo "NEGATİF";
        } else {
            $options .= " <div class=\"col-sm-4 mb-3\">";
            $options .= " <button type=\"button\" class=\"btn-sm btn-success position-relative\">Gelen";
            $options .= " <span class=\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light bg-dark\">" . $row["gelen"] . "<span class=\"visually-hidden\"></span></span>";
            $options .= " </button></div><div class=\"col-sm-4\">";
            $options .= " <button type=\"button\" class=\"btn-sm btn-danger position-relative\">Kalan";
            $options .= " <span class=\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark\">" . $kalan . "<span class=\"visually-hidden\"></span></span></button></div>";
        }
        $kalan = 0;
    }

    $conn->close();

    return $options;
}