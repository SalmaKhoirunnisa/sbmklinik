<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');
?>

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
            <li>
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
            <li class="active">
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
                <a href="doktergigi.php" class="nav-link">Bahan Dokter Gigi</a>
            </div>
            <div class="nav-right">
                <a href="#" class="profile">
                    <?php echo isset($_SESSION['admin']['namapengguna']) ? $_SESSION['admin']['namapengguna'] : 'Guest'; ?>
                </a>
            </div>
        </nav>
        <!-- NAVBAR -->

    </section>
    <!-- CONTENT -->

    <section id="data">
        <div class="data-terbaru-header-container">
            <h2>Tambah Bahan Medis</h2>
        </div>
        <div class="data-terbaru-container">
            <div class="data-terbaru-header">
                <button class="btn-kembali" onclick="window.location.href='dokterumum.php';">Kembali</button>
            </div>
            <div class="form-container">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12 col-md-12" style="padding-bottom:10px">
                            <div class="form-row">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12" style="padding-bottom:10px">
                            <div class="form-row">
                                <label>Kategori</label>
                                <input type="text" class="form-control" name="kategori" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12" style="padding-bottom:10px">
                            <div class="form-row">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12" style="padding-bottom:10px">
                            <div class="form-row">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggalmasuk" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-12" style="padding-bottom:10px">
                            <div class="form-row">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="isi" required></textarea>
                                <script>
                                    CKEDITOR.replace('isi');
                                </script>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="btn-simpan" name="simpan">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['simpan'])) {
        $koneksi->query("INSERT INTO baranggigi
		(nama,kategori,jumlah,tanggalmasuk,keterangan)
		VALUES('$_POST[nama]','$_POST[kategori]','$_POST[jumlah]','$_POST[tanggalmasuk]','$_POST[keterangan]')");
        echo "<script>alert('Data Berhasil Di Simpan');</script>";
        echo "<script> location ='doktergigi.php';</script>";
    }
    ?>


    <script src="script.js"></script>
</body>

</html>