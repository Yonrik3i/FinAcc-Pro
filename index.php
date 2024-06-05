<?php
// database connection
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $laporan_laba_rugi = $_POST['laporan_laba_rugi'];
    $laporan_arus_kas = $_POST['laporan_arus_kas'];
    $rasio_keuangan = $_POST['rasio_keuangan'];
    $trend = $_POST['trend'];
    $analisis_kesehatan_keuangan = $_POST['analisis_kesehatan_keuangan'];

    $sql = "INSERT INTO financial_data (laporan_laba_rugi, laporan_arus_kas, rasio_keuangan, trend, analisis_kesehatan_keuangan)
            VALUES ('$laporan_laba_rugi', '$laporan_arus_kas', '$rasio_keuangan', '$trend', '$analisis_kesehatan_keuangan')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <title>FinAcc Pro</title>
    <link rel="stylesheet" href="style/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
</head>
<body>
    <section class="header">
        <nav>
            <a href="index.html"><img src="image/report.png" alt="" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bx bx-x" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#about-us">Why?</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </div>
            <i class="bx bx-menu" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>FinAcc Pro</h1>
            <p>
                Mengelola Keuangan Anda dengan Profesionalisme <br />
                Tim akuntan profesional kami siap membantu Anda mengelola keuangan
                dengan baik.
            </p>
            <a href="" class="hero-btn">Hubungi Kami</a>
        </div>
    </section>

    <!-- Layanan Kami -->
    <div class="hero">
        <h1>Layanan Kami</h1>
        <div class="container">
            <div class="testimonial">
                <div class="slide-row" id="slide">
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Laporan Keuangan Bulanan</h3>
                        </div>
                    </div>
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Pengauditan Internal</h3>
                        </div>
                    </div>
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Konsultasi Pajak</h3>
                        </div>
                    </div>
                    <div class="slide-col">
                        <div class="user-text">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga,
                                dignissimos!
                            </p>
                            <h3>Lorem, ipsum dolor.</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="indicator">
                <span class="btn active"></span>
                <span class="btn"></span>
                <span class="btn"></span>
                <span class="btn"></span>
            </div>
        </div>
    </div>
    <!-- END -->
    <section class="services" id="services">
        <h1>Mengapa Memilih FinAcc Pro?</h1>
        <div class="row">
            <div class="course-col">
                <h3>Layanan akuntansi profesional dan handal</h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam,
                    dolorem.
                </p>
            </div>
            <div class="course-col">
                <h3>Tim ahli dengan pengalaman luas</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore,
                    iste.
                </p>
            </div>
            <div class="course-col">
                <h3>Penanganan cepat dan responsif</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus,
                    cumque.
                </p>
            </div>
        </div>
    </section>

    <!-- About Us + Contact -->
    <section class="about-us" id="about-us">
        <h1>About Us</h1>
        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi eligendi
            tempora deserunt. Vel tempora expedita maiores laudantium accusamus
            iusto, eum minus sunt! Aut magnam nemo accusamus earum impedit delectus
            quisquam?
        </p>
    </section>

    <!-- Modal Section -->
    <section class="new-section">
        <button class="show-modal">Data</button>
        <span class="overlay"></span>

        <div class="modal-box">
            <div class="modal-header">
                <i class="fa-regular fa-circle-xmark close-btn"></i>
                <h2>Input Data</h2>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post">
                      <div class="form-group">
                        <label for="laporan_laba_rugi">Laporan Laba Rugi:</label>
                        <input type="text" id="laporan_laba_rugi" class="judul" name="laporan_laba_rugi" placeholder="Enter Laporan Laba Rugi">

                        <label for="laporan_arus_kas">Laporan Arus Kas:</label>
                        <input type="text" id="laporan_arus_kas" class="judul" name="laporan_arus_kas" placeholder="Enter Laporan Arus Kas">

                        <label for="rasio_keuangan">Rasio Keuangan:</label>
                        <input type="text" id="rasio_keuangan" class="judul" name="rasio_keuangan" placeholder="Enter Rasio Keuangan">

                        <label for="trend">Trend:</label>
                        <input type="text" id="trend" class="judul" name="trend" placeholder="Enter Trend">

                        <label for="analisis_kesehatan_keuangan">Analisis Kesehatan Keuangan:</label>
                        <input type="text" id="analisis_kesehatan_keuangan" class="judul" name="analisis_kesehatan_keuangan" placeholder="Enter Analisis Kesehatan Keuangan">
                      </div>
                    <div class="modal-footer">
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Modal Section -->

    <!-- Footer -->
    <section class="footer">
        <h4>© 2024 FinAcc Pro. Hak Cipta Dilindungi.</h4>
        <div class="icons">
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-instagram"></i>
            <i class="bx bxl-linkedin"></i>
        </div>
    </section>

    <!-- Javascript -->
    <script src="javascript/script.js"></script>
</body>
</html>
