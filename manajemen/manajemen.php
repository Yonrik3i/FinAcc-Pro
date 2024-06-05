<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "userdb");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM transactions WHERE id=$id");
    header("Location: manajemen.php");
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM transactions");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manajemen</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li><a href="../admin.php"><i class="bx bxs-dashboard"></i><span>Dashboard</span></a></li>
            <li class="active"><a href="#"><i class="bx bx-money-withdraw"></i><span>Manajemen Transaksi Keuangan</span></a></li>
            <li><a href="input.php"><i class="bx bx-notepad"></i><span>Input Data</span></a></li>
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
            <h3 class="main-title">Manajemen Transaksi Keuangan</h3>
            <div class="button-container">
                <button class="move-button" onclick="window.location.href='input.php'">Input Data</button>
            </div>
            <div class="tabel-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Balance Sheet</th>
                            <th>Laporan Laba Rugi</th>
                            <th>Laporan Arus Kas</th>
                            <th>Gambar</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['balance_sheet']; ?></td>
                                <td><?php echo $row['laba_rugi']; ?></td>
                                <td><?php echo $row['arus_kas']; ?></td>
                                <td><img src="<?php echo $row['image']; ?>" alt="Image" width="100"></td>
                                <td>
                                    <div class="button-container">
                                        <button class="edit-button" onclick="window.location.href='edit.php?id=<?php echo $row['id']; ?>'">Edit</button>
                                        <button class="remove-button" onclick="window.location.href='manajemen.php?delete=<?php echo $row['id']; ?>'">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">Jumlah Data: <?php echo $result->num_rows; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
