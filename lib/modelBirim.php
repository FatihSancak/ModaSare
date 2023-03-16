<?php
// Veritabanı bağlantısı yapılır
$conn = new mysqli("localhost", "root", "", "dbmodasare");

// Hata kontrolü yapılır
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// ModelID'ye göre maliyetFiyat değerlerini toplamak için SQL sorgusu oluşturulur
$sql = "SELECT SUM(maliyetFiyat) AS toplamMaliyet FROM maliyetler WHERE modelID = ?";

// SQL sorgusu prepare edilir
$stmt = $conn->prepare($sql);

// ModelID değeri
$modelID = 421;

// SQL sorgusundaki "?" parametresine ModelID değeri bind edilir
$stmt->bind_param("i", $modelID);

// SQL sorgusu çalıştırılır
$stmt->execute();

// Sonuçlar alınır
$result = $stmt->get_result();

// Toplam maliyet değeri alınır
$row = $result->fetch_assoc();
$toplamMaliyet = $row["toplamMaliyet"];

// Kesim adedi alınır
$kesimAdedi = 1500;

// Birim maliyet hesaplanır
$birimMaliyet = $toplamMaliyet / $kesimAdedi;

// Sonuç ekrana yazdırılır
echo "Birim Maliyet: " . $birimMaliyet;

// Veritabanı bağlantısı kapatılır
$conn->close();
?>
