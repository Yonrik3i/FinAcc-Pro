<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "userdb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM financial_data";
$result = $conn->query($sql);

// Membuat objek Dompdf
$dompdf = new Dompdf();

// Mengatur HTML yang akan dicetak
$html = "<html><body>";
$html .= "<h1>Daftar Analisis Keuangan</h1>";
$html .= "<table border='1' cellspacing='0' cellpadding='10'>";
$html .= "<thead>";
$html .= "<tr>";
$html .= "<th>ID</th>";
$html .= "<th>Laporan Laba Rugi</th>";
$html .= "<th>Laporan Arus Kas</th>";
$html .= "<th>Rasio Keuangan</th>";
$html .= "<th>Trend</th>";
$html .= "<th>Analisis Kesehatan Keuangan</th>";
$html .= "</tr>";
$html .= "</thead>";
$html .= "<tbody>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $html .= "<tr>";
        $html .= "<td>" . htmlspecialchars($row["id"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["laporan_laba_rugi"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["laporan_arus_kas"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["rasio_keuangan"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["trend"]) . "</td>";
        $html .= "<td>" . htmlspecialchars($row["analisis_kesehatan_keuangan"]) . "</td>";
        $html .= "</tr>";
    }
} else {
    $html .= "<tr><td colspan='6'>Tidak ada data</td></tr>";
}

$html .= "</tbody>";
$html .= "</table>";
$html .= "</body></html>";

// Memasukkan HTML ke Dompdf
$dompdf->loadHtml($html);

// Mengatur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');

// Render PDF
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("daftar_analisis_keuangan.pdf", array("Attachment" => false));

// Tutup koneksi database
$conn->close();
?>
