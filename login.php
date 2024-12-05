<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boxicons -->
    <link
        href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
        rel="stylesheet" />
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />

    <title>Stok Bahan Medis Klinik Pratama</title>
</head>

<body>
    <div class="header">
        <img src="img/logo uin.png" alt="logo" class="logo-img">
        <div class="text">
            <h1>STOK </br>BAHAN MEDIS</h1>
        </div>
    </div>
    <div class="login">
        <img src="img/background.png" alt="Background" class="background-img">
        <div class="login-box">
            <h2>Login</h2>
            <form method="post"> <!-- Tambahkan action dan method -->
                <div class="input-group">
                    <label for="username">Email</label>
                    <input type="email" id="username" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login" value="Masuk" class="login-btn">Login</button>
            </form>
        </div>
        <?php
        include('koneksi.php');
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $ambil = $koneksi->query("SELECT * FROM pengguna
		                WHERE email='$email' AND password='$password' limit 1");
            $akunyangcocok = $ambil->num_rows;
            if ($akunyangcocok == 1) {
                $akun = $ambil->fetch_assoc();
                $_SESSION['admin'] = $akun;
                echo "<script> alert('Login Berhasil');</script>";
                echo "<script> location ='menu.php';</script>";
                print_r($_SESSION['admin']);
            } else {
                echo "<script> alert('Login Gagal, Email atau Password anda salah');</script>";
                echo "<script> location ='home.php';</script>";
            }
        }
        ?>
    </div>
    <img src="img/Clipped.png" alt="logo" class="gambar">
</body>

</html>