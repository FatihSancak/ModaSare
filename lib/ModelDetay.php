<?php
include 'inc/conn.php';
include 'inc/top.php';

$modelID = $_GET['ModelID'];

$ModelSQL = "SELECT model.*,maliyetler.maliyetTarihi FROM model INNER JOIN maliyetler ON model.modelID = maliyetler.modelID WHERE maliyetler.maliyetBaslikID = 1 AND model.modelID=" . $modelID;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
$result = $conn->query($ModelSQL);
$row = $result->fetch_assoc();
$uretimAdedi = $row["kesimAdedi"]?>



<?php
$conn->close();
?>
<?php include '/inc/bottom.php'; ?>