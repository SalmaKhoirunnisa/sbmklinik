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
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="menu.php" class="brand">
            <img src="img/logo uin.png" alt="Bahan Dokter Umum" class="icon-img">
            <span class="text">STOK </br>BAHAN MEDIS</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="menu.php">
                    <i class="bx bxs-dashboard"></i>
                    <span class="text">Beranda</span>
                </a>
            </li>
            <li>
                <a href="dokterumum.php">
                    <img src="img/medical-report.png" alt="Bahan Dokter Umum" class="icon-img">
                    <span class="text">Bahan Dokter Umum</span>
                </a>
            </li>
            <li>
                <a href="doktergigi.php">
                    <img src="img/dental.png" alt="Bahan Dokter Umum" class="icon-img">
                    <span class="text">Bahan Dokter Gigi</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <li>
                <a href="login.php" class="logout">
                    <i class="bx bx-arrow-from-left"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <!-- <nav>
            <i class="bx bx-menu"></i>
            <a href="#" class="nav-link">Bahan Dokter Umum</a>
             <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search..." />
                    <button type="submit" class="search-btn">
                        <i class="bx bx-search"></i>
                    </button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden /> 
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class="bx bxs-bell"></i>
                <span class="num">8</span>
            </a> 
            <a href="#" class="profile">
                <img src="img/user-solid.svg" />
            </a>
        </nav> -->
        <nav>
            <div class="nav-left">
                <i class="bx bx-menu"></i>
                <a href="menu.php" class="nav-link">Beranda</a>
            </div>
            <div class="nav-right">
                <a href="#" class="profile">
                    <?php echo isset($_SESSION['admin']['namapengguna']) ? $_SESSION['admin']['namapengguna'] : 'Guest'; ?>>
                </a>
            </div>
        </nav>
        <!-- NAVBAR -->

    </section>
    <!-- CONTENT -->

    <section id="data">
        <div class="data-terbaru-header-container">
            <h2>Edit Bahan Medis</h2>
        </div>
        <div class="data-terbaru-container">
            <div class="data-terbaru-header">
                <button class="btn-kembali" onclick="window.location.href='barangdokterumum.php';">Kembali</button>
                <button class=" btn-tambah" onclick="window.location.href='barangdokterumum.php';">Simpan</button>
            </div>
            <div class="form-container">
                <div class="form-row">
                    <label>Bahan Medis :</label>
                    <input type="text" placeholder="Masukan Bahan Medis">
                </div>
                <div class="form-row">
                    <label>Stok :</label>
                    <input type="number" placeholder="Masukan Stok Bahan Medis">
                </div>
                <div class="form-row">
                    <label>Harga Beli (Per Satuan) :</label>
                    <input type="number" placeholder="Masukan Harga Beli Bahan Medis">
                </div>
                <div class="form-row">
                    <label>Tanggal :</label>
                    <input type="date">
                </div>
                <div class="form-row">
                    <label>Keterangan :</label>
                    <textarea placeholder="Masukan Keterangan"></textarea>
                </div>
            </div>
            <div class="button-form">
                <button class="btn-hapus" onclick="window.location.href='dokterumum.php';">Hapus</button>
            </div>
        </div>
    </section>



    <script src="script.js"></script>
</body>

</html>