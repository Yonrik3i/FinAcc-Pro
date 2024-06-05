<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengaduan = $_POST['id_pengaduan'];
    $balance_sheet = $_POST['balance_sheet'];
    $laba_rugi = $_POST['laba_rugi'];
    $arus_kas = $_POST['arus_kas'];

    // Proses upload gambar
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "userdb");

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO transactions (id, balance_sheet, laba_rugi, arus_kas, image) VALUES ('$id_pengaduan', '$balance_sheet', '$laba_rugi', '$arus_kas', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        header("Location: manajemen.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Input Data</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li><a href="../admin.php"><i class="bx bxs-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="manajemen.php"><i class="bx bx-money-withdraw"></i><span>Manajemen Transaksi Keuangan</span></a></li>
            <li class="active"><a href="#"><i class="bx bx-notepad"></i><span>Input Data</span></a></li>
            <li><a href="../analisa/analisa.php"><i class="bx bxs-analyse"></i><span>Analisis Keuangan</span></a></li>
            <li><a href="../logout.php"><i class="bx bxs-log-out"></i><span>Logout</span></a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <span>FinAcc Pro</span>
                <span>Dashboard</span>
            </div>
            <div class="user-info">
                <div class="search">
                    <i class="bx bx-search-alt"></i>
                    <input type="text" placeholder="Search" />
                </div>
                <img src="../image/report.png" alt="" />
            </div>
        </div>
        <div class="tabel-wrapper">
            <h3 class="main-title">Input Data</h3>
            <div class="form-wrapper">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_pengaduan">ID</label>
                        <input type="text" id="id_pengaduan" name="id_pengaduan" required />
                    </div>
                    <div class="form-group">
                        <label for="balance_sheet">Balance Sheet</label>
                        <textarea id="balance_sheet" name="balance_sheet" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="laba_rugi">Laporan Laba Rugi</label>
                        <textarea id="laba_rugi" name="laba_rugi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="arus_kas">Laporan Arus Kas</label>
                        <textarea id="arus_kas" name="arus_kas" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Gambar</label>
                        <input type="file" id="image" name="image" required />
                    </div>
                    <div class="button-container">
                        <button type="submit" class="move-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
