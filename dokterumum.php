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
            <li class="active">
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
        <nav>
            <div class="nav-left">
                <i class="bx bx-menu"></i>
                <a href="dokterumum.php" class="nav-link">Bahan Dokter Umum</a>
            </div>
            <div class="nav-right">
                <a href="#" class="profile">
                    <?php echo isset($_SESSION['admin']['namapengguna']) ? $_SESSION['admin']['namapengguna'] : 'Guest'; ?>
                </a>
            </div>
        </nav>
    </section>
    <!-- CONTENT -->

    <section id="data">
        <div class="data-terbaru-header-container">
            <h2>Data Barang Dokter Umum Terbaru</h2>
        </div>
        <div class="data-terbaru-container">
            <div class="data-terbaru-header">
                <button class="btn-kembali" onclick="window.location.href='menu.php';">Kembali</button>
                <button class="btn-tambah" onclick="window.location.href='barangdokterumum.php';">Tambah</button>
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
                        $barangumum = $koneksi->query("SELECT * FROM barangumum");
                        while ($data = $barangumum->fetch_array()) {
                        ?>
                            <tr data-id="<?= $data['idbarangumum'] ?>">
                                <td><?= $no ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['kategori'] ?></td>
                                <td class="jumlah"><?= $data['jumlah'] ?></td>
                                <td><?= formatTanggal($data['tanggalmasuk']) ?></td>
                                <td><?= $data['keterangan'] ?></td>
                                <td>
                                    <a class="btn-edit" href="barangumumedit.php?id=<?php echo $data['idbarangumum']; ?>"><i class="bx bxs-pencil"></i></a>
                                    <a class="btn-hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="barangumumhapus.php?id=<?php echo $data['idbarangumum']; ?>"><i class="bx bxs-trash"></i></a>
                                    <button class="btn-kurangi" onclick="kurangiBarang(<?php echo $data['idbarangumum']; ?>, '<?php echo $data['nama']; ?>', <?php echo $data['jumlah']; ?>)">Update Stok</button>
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

        function kurangiBarang(id, nama, jumlahStok) {
            const jumlahKurangi = prompt(`Kurangi stok untuk barang: ${nama}\nMasukkan jumlah:`);

            if (jumlahKurangi && !isNaN(jumlahKurangi) && jumlahKurangi <= jumlahStok) {
                fetch(`kurangiBarang.php?id=${id}&jumlah=${jumlahKurangi}`)
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        if (data.includes("berhasil")) {
                            // Update jumlah stok di halaman
                            const row = document.querySelector(`tr[data-id="${id}"]`);
                            const jumlahCell = row.querySelector('.jumlah');
                            let currentJumlah = parseInt(jumlahCell.textContent);
                            currentJumlah -= parseInt(jumlahKurangi);
                            jumlahCell.textContent = currentJumlah;

                            // Menambahkan baris baru untuk pengurangan
                            const table = document.querySelector('#tabel tbody');
                            const newRow = document.createElement('tr');
                            newRow.innerHTML = `
                                <td>${table.rows.length + 1}</td>
                                <td>${nama}</td>
                                <td>Kategori Baru</td>
                                <td>${jumlahKurangi}</td>
                                <td>${new Date().toLocaleDateString()}</td>
                                <td>Stok baru ditambahkan</td>
                            `;
                            table.appendChild(newRow);
                        }
                    })
                    .catch(error => {
                        console.error("Terjadi kesalahan:", error);
                        alert("Terjadi kesalahan saat mengurangi stok.");
                    });
            } else {
                alert("Jumlah yang dimasukkan tidak valid.");
            }
        }
    </script>
</body>

</html>