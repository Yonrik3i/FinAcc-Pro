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

// Ambil ID analisis dari URL dan validasi
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id) || !ctype_digit($id)) {
    // Jika ID tidak valid, redirect ke halaman analisa.php
    header("Location: analisa.php");
    exit;
}

// Ambil data analisis dari database berdasarkan ID
$sql = "SELECT * FROM financial_data WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Data ditemukan, ambil baris data
    $row = $result->fetch_assoc();
} else {
    // Data tidak ditemukan, redirect ke halaman analisa.php
    header("Location: analisa.php");
    exit;
}

// Proses form jika POST request diterima
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $laporan_laba_rugi = $_POST['laporan_laba_rugi'];
    $laporan_arus_kas = $_POST['laporan_arus_kas'];
    $rasio_keuangan = $_POST['rasio_keuangan'];
    $trend = $_POST['trend'];
    $analisis_kesehatan_keuangan = $_POST['analisis_kesehatan_keuangan'];

    // Update data di database
    $sql_update = "UPDATE financial_data SET laporan_laba_rugi=?, laporan_arus_kas=?, rasio_keuangan=?, trend=?, analisis_kesehatan_keuangan=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssssi", $laporan_laba_rugi, $laporan_arus_kas, $rasio_keuangan, $trend, $analisis_kesehatan_keuangan, $id);

    // Eksekusi statement
    if ($stmt->execute()) {
        // Jika update berhasil, redirect kembali ke halaman analisa.php
        header("Location: analisa.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
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
    <!-- Head content -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Analisis Keuangan</title>
    <link rel="stylesheet" href="../style/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
<div class="sidebar">
    <div class="logo"></div>
    <ul class="menu">
        <li>
            <a href="admin.php">
                <i class="bx bxs-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="../tiket/tiket.php">
                <i class="bx bxs-calendar-plus"></i>
                <span>Manajemen Tiket</span>
            </a>
        </li>
        <li class="active">
            <a href="analisa/input.php">
                <i class="bx bx-archive-in"></i>
                <span>Input Data</span>
            </a>
        </li>
        <li>
            <a href="analisa.php">
                <i class="bx bx-bar-chart-square"></i>
                <span>Analisis</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bx bxs-log-out"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>
<div class="main-content">
    <div class="header-wrapper">
        <div class="header-title">
            <span>Edit Analisis Keuangan</span>
            <span>Admin Dashboard</span>
        </div>
        <div class="user-info">
            <div class="search">
                <i class="bx bx-search-alt"></i>
                <input type="text" placeholder="Search">
            </div>
            <img src="../image/admin.png" alt="Admin Image">
        </div>
    </div>
    <div class="form-wrapper">
        <form action="" method="post">
            <div class="form-group">
                <label for="laporan_laba_rugi">Laporan Laba Rugi</label>
                <input type="text" id="laporan_laba_rugi" name="laporan_laba_rugi" value="<?php echo htmlspecialchars($row['laporan_laba_rugi']); ?>">
            </div>
            <div class="form-group">
                <label for="laporan_arus_kas">Laporan Arus Kas</label>
                <input type="text" id="laporan_arus_kas" name="laporan_arus_kas" value="<?php echo htmlspecialchars($row['laporan_arus_kas']); ?>">
            </div>
            <div class="form-group">
                <label for="rasio_keuangan">Rasio Keuangan</label>
                <input type="text" id="rasio_keuangan" name="rasio_keuangan" value="<?php echo htmlspecialchars($row['rasio_keuangan']); ?>">
            </div>
            <div class="form-group">
                <label for="trend">Trend</label>
                <input type="text" id="trend" name="trend" value="<?php echo htmlspecialchars($row['trend']); ?>">
            </div>
            <div class="form-group">
                <label for="analisis_kesehatan_keuangan">Analisis Kesehatan Keuangan</label>
                <input type="text" id="analisis_kesehatan_keuangan" name="analisis_kesehatan_keuangan" value="<?php echo htmlspecialchars($row['analisis_kesehatan_keuangan']); ?>">
            </div>
            <button type="submit" class="move-button">Simpan Perubahan</button>
        </form>
    </div>
</div>
</body>
</html>
