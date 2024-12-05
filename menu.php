<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Stok Bahan Medis Klinik Pratama</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="menu.php" class="brand">
            <img src="img/logo uin.png" alt="Bahan Dokter Umum" class="icon-img">
            <span class="text">STOK <br>BAHAN MEDIS</span>
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
                    <img src="img/dental.png" alt="Bahan Dokter Gigi" class="icon-img">
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
        <nav>
            <div class="nav-left">
                <i class="bx bx-menu"></i>
                <a href="menu.php" class="nav-link">Beranda</a>
            </div>
            <div class="nav-right">
                <a href="#" class="profile">
                    <p>
                        <?php echo isset($_SESSION['admin']['namapengguna']) ? $_SESSION['admin']['namapengguna'] : 'Guest'; ?>
                    </p>
                </a>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <?php
            $baranggigi = $koneksi->query("SELECT * FROM baranggigi");
            $jumlahbaranggigi = $baranggigi->num_rows;
            $barangumum = $koneksi->query("SELECT * FROM barangumum");
            $jumlahbarangumum = $barangumum->num_rows;
            ?>
            <ul class="box-info">
                <li onclick="window.location.href='doktergigi.php';">
                    <span class="text">
                        <h3>Data Bahan Medis Dokter Gigi</h3>
                        <p><?php echo $jumlahbaranggigi; ?> Bahan</p>
                    </span>
                    <img src="img/drg.png" alt="Bahan Dokter Gigi" class="img-box">
                </li>
                <li onclick="window.location.href='dokterumum.php';">
                    <span class="text">
                        <h3>Data Bahan Medis Dokter Umum</h3>
                        <p><?php echo $jumlahbarangumum; ?> Bahan</p>
                    </span>
                    <img src="img/dr.png" alt="Bahan Dokter Umum" class="img-box">
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Data Terbaru</h3>
                    </div>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>

    <script>
        const labels = ['Dokter Gigi', 'Dokter Umum'];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Stok Barang',
                data: [<?php echo $jumlahbaranggigi; ?>, <?php echo $jumlahbarangumum; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>

</html>