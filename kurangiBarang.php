<?php
include('koneksi.php');

if (isset($_GET['id']) && isset($_GET['jumlah'])) {
    $id_barang = $_GET['id'];
    $jumlah = (int) $_GET['jumlah'];

    // Query untuk mengurangi stok
    $query = "UPDATE barangumum SET jumlah = jumlah - ? WHERE idbarangumum = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('ii', $jumlah, $id_barang);

    if ($stmt->execute()) {
        echo "Stok berhasil dikurangi.";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Menambahkan data stok baru ke tabel
    $query_insert = "INSERT INTO barangumum (nama, kategori, jumlah, tanggalmasuk) 
                     SELECT nama, kategori, ?, NOW() FROM barangumum WHERE idbarangumum = ?";
    $stmt_insert = $koneksi->prepare($query_insert);
    $stmt_insert->bind_param('ii', $jumlah, $id_barang);
    $stmt_insert->execute();

    $stmt->close();
    $stmt_insert->close();
    $koneksi->close();
}
