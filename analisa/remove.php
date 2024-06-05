<?php
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

// Proses penghapusan data jika tombol "Remove" diklik
if (isset($_POST['id_remove'])) {
    $id_remove = $_POST['id_remove'];

    // Buat kueri SQL untuk menghapus data
    $sql_delete = "DELETE FROM financial_data WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $id_remove);

    // Eksekusi kueri
    if ($stmt->execute()) {
        // Data berhasil dihapus, redirect kembali ke halaman analisa.php
        header("Location: analisa.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Tabel untuk menampilkan data analisis -->
    <div class="tabel-wrapper">
        <div class="tabel-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Laporan Laba Rugi</th>
                        <th>Laporan Arus Kas</th>
                        <th>Rasio Keuangan</th>
                        <th>Trend</th>
                        <th>Analisis Kesehatan Keuangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Lakukan iterasi untuk setiap baris data yang diterima dari hasil query
                    $sql = "SELECT * FROM financial_data";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["laporan_laba_rugi"] . "</td>";
                            echo "<td>" . $row["laporan_arus_kas"] . "</td>";
                            echo "<td>" . $row["rasio_keuangan"] . "</td>";
                            echo "<td>" . $row["trend"] . "</td>";
                            echo "<td>" . $row["analisis_kesehatan_keuangan"] . "</td>";
                            // Tombol Remove akan mengarahkan pengguna ke remove.php dengan ID analisis sebagai parameter
                            echo "<td><a href=\"remove.php?id_remove=" . $row["id"] . "\" onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Remove</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        // Jika tidak ada data analisis, tampilkan pesan
                        echo "<tr><td colspan='7'>Tidak ada data analisis keuangan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
