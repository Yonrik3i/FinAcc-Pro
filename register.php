<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Enkripsi password

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "userdb");

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
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
    <title>register</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style/register.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="wrapper">
    <form action="" method="post">
        <h1>Daftar Akun Baru</h1>
        <div class="input-box">
          <div class="input-field">
          <input type="text" name="username" placeholder="Nama Lengkap" required />
            <i class="bx bx-user-circle"></i>
          </div>
          <div class="input-field">
          <input type="email" name="email" placeholder="Email" required />
            <i class="bx bxl-gmail"></i>
          </div>
        </div>
        <div class="input-box">
          <div class="input-field">
          <input type="password" name="password" placeholder="Password" required />
            <i class="bx bx-lock"></i>
          </div>
          <div class="input-field">
          <input type="password" placeholder="Confirm Password" required />
            <i class="bx bx-lock"></i>
          </div>
        </div>
        <label for=""
          ><input type="checkbox" />Dengan ini saya menyatakan bahwa informasi
          diatas benar dan tepat</label
        >
        <button type="submit" class="btn">Register</button>
      </form>
    </div>
  </body>
</html>
