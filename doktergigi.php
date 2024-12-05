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
            <a href="#" class="nav-link">Bahan Dokter Gigi</a>
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
            <h2>Data Barang Dokter Gigi Terbaru</h2>
        </div>
        <div class="data-terbaru-container">
            <!-- Header Tombol -->
            <div class="data-terbaru-header">
                <button class="btn-kembali" onclick="window.location.href='menu.php';">Kembali</button>
                <button class="btn-tambah" onclick="window.location.href='barangdoktergigi.php';">Tambah</button>
                <button class="btn-print" onclick="generatePDF()">Print</button>
            </div>
            <div class="table-responsive">
                <table class="data-terbaru-table table table-hover" id="tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal Masuk</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $baranggigi = $koneksi->query("SELECT * FROM baranggigi");
                        $ambilbaranggigi = $baranggigi;
                        while ($data = $ambilbaranggigi->fetch_array()) {
                        ?>
                            <tr>
                            <tr data-id="<?= $data['idbaranggigi'] ?>">
                                <td><?= $no ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['kategori'] ?></td>
                                <td class="jumlah"><?= $data['jumlah'] ?></td>
                                <td><?= formatTanggal($data['tanggalmasuk']) ?></td>
                                <td><?= $data['keterangan'] ?></td>

                                <td>
                                    <a class="btn-edit" href="baranggigiedit.php?id=<?php echo $data['idbaranggigi']; ?>"><i class="bx bxs-pencil"></i></a>
                                    <a class="btn-hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="baranggigihapus.php?id=<?php echo $data['idbaranggigi']; ?>"><i class="bx bxs-trash"></i></a>
                                    <button class="btn-kurangi" onclick="kurangiBarang(<?php echo $data['idbaranggigi']; ?>, '<?php echo $data['nama']; ?>')">Update Stok</button>
                                </td>


                            </tr>
                        <?php $no++;
                        } ?>


                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="script.js"></script>
    <!-- FUNGSI UNTUK MEMBUAT PDF -->
    <script>
        function generatePDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();
            const table = document.getElementById('tabel');
            if (!table) {
                console.error("Tabel tidak ditemukan!");
                return;
            }

            // Menyembunyikan kolom Aksi
            const aksiColumnIndex = 6; // Indeks kolom Aksi (dimulai dari 0)
            const rows = table.querySelectorAll('tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td, th');
                if (cells.length > aksiColumnIndex) {
                    cells[aksiColumnIndex].style.display = 'none'; // Sembunyikan kolom Aksi
                }
            });

            // Membuat PDF
            doc.autoTable({
                html: '#tabel',
                startY: 10,
                styles: {
                    fontSize: 10,
                    cellPadding: 2,
                },
                headStyles: {
                    fillColor: [22, 160, 133],
                    textColor: 255,
                },
            });

            // Menyimpan PDF
            doc.save('Data-Barang-Dokter-Gigi.pdf');

            // Menampilkan kembali kolom Aksi setelah PDF selesai
            rows.forEach(row => {
                const cells = row.querySelectorAll('td, th');
                if (cells.length > aksiColumnIndex) {
                    cells[aksiColumnIndex].style.display = ''; // Tampilkan kolom Aksi kembali
                }
            });
        }

        function kurangiBarang(id, nama) {
            const jumlahKurangi = prompt(`Kurangi stok untuk barang: ${nama}\nMasukkan jumlah:`);

            if (jumlahKurangi && !isNaN(jumlahKurangi)) {
                fetch(`kurangiBarang.php?id=${id}&jumlah=${jumlahKurangi}`)
                    .then(response => response.text())
                    .then(data => {
                        alert(data); // Memberikan konfirmasi kepada pengguna
                        if (data.includes("berhasil")) {
                            // Perbarui elemen jumlah di tabel secara langsung
                            const row = document.querySelector(`tr[data-id='${id}']`);
                            if (row) {
                                const jumlahCell = row.querySelector('.jumlah');
                                jumlahCell.textContent = parseInt(jumlahCell.textContent) - jumlahKurangi;
                            }
                        }
                    })
                    .catch(error => {
                        console.error("Terjadi kesalahan:", error);
                        alert("Terjadi kesalahan saat mengurangi stok.");
                    });
            }
        }
    </script>

</body>

</html>