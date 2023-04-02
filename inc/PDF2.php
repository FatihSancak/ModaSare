<?php
require_once('tcpdf/tcpdf.php');

function generatePDF() {
    // Veritabanı bağlantısı kurulur
    $conn = new mysqli("localhost", "my_user", "my_password", "my_database");
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı kurulamadı: " . $conn->connect_error);
    }

    // PDF dosyası oluşturma işlemi başlatılır
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Benim Adım');
    $pdf->SetTitle('Verilerim');
    $pdf->SetSubject('Veriler');
    $pdf->SetKeywords('veriler, pdf, tcpdf');

    // Sayfa eklendi
    $pdf->AddPage('P', 'A5');

    // Başlık
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Veritabanından Gelen Veriler', 0, 1, 'C');

    // Verileri sorgula
    $sql = "SELECT * FROM my_table";
    $result = $conn->query($sql);

    // Tablo başlıkları
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(20, 7, 'ID', 1);
    $pdf->Cell(50, 7, 'Ad', 1);
    $pdf->Cell(50, 7, 'Soyad', 1);
    $pdf->Cell(20, 7, 'Yaş', 1);
    $pdf->Ln();

    // Tablo verileri
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 7, $row['id'], 1);
        $pdf->Cell(50, 7, $row['ad'], 1);
        $pdf->Cell(50, 7, $row['soyad'], 1);
        $pdf->Cell(20, 7, $row['yas'], 1);
        $pdf->Ln();
    }

    // PDF dosyası oluşturulur ve kullanıcıya gösterilir
    $pdf->Output('veriler.pdf', 'I');
}

// Fonksiyon çağırılır
generatePDF();
?>
