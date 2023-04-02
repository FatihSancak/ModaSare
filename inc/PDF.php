
<?php

require('fpdf/fpdf.php');

// Veritabanı bağlantısı kurulur
$conn = mysqli_connect("localhost", "my_user", "my_password", "my_database");

// Fonksiyon oluşturulur
function generatePDF() {
    global $conn;

    // Veritabanından verileri sorgula
    $sql = "SELECT * FROM my_table";
    $result = mysqli_query($conn, $sql);

    // PDF oluşturma işlemi başlatılır
    $pdf = new FPDF('P', 'mm', 'A5');
    $pdf->AddPage();

    // Başlık
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Veritabanindan Gelen Veriler', 0, 1);

    // Tablo başlıkları
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 7, 'ID', 1);
    $pdf->Cell(40, 7, 'Ad', 1);
    $pdf->Cell(50, 7, 'Soyad', 1);
    $pdf->Cell(30, 7, 'Yas', 1);
    $pdf->Ln();

    // Tablo verileri
    $pdf->SetFont('Arial', '', 12);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(30, 7, $row['id'], 1);
        $pdf->Cell(40, 7, $row['ad'], 1);
        $pdf->Cell(50, 7, $row['soyad'], 1);
        $pdf->Cell(30, 7, $row['yas'], 1);
        $pdf->Ln();
    }

    // PDF dosyası oluşturulur ve kullanıcıya gösterilir
    $pdf->Output();
}

// Fonksiyon çağırılır
generatePDF();

?>
