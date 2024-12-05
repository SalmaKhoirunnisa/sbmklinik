<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$koneksi = new mysqli("localhost", "root", "", "barangmedis");


function formatTanggal($tanggal)
{
    // Pastikan ekstensi Intl diaktifkan pada server
    $formatter = new IntlDateFormatter(
        'id_ID', // Lokal bahasa Indonesia
        IntlDateFormatter::LONG, // Format panjang (contoh: 27 November 2024)
        IntlDateFormatter::NONE, // Tidak butuh waktu
        'Asia/Jakarta', // Zona waktu
        IntlDateFormatter::GREGORIAN // Kalender Gregorian
    );

    $timestamp = strtotime($tanggal);
    return $formatter->format($timestamp); // Format tanggal sesuai lokal  
}
function updateStok($id_barang, $perubahan, $keterangan, $koneksi)
{
    // Update stok di tabel barang
    $query = "UPDATE barangumum SET jumlah = jumlah + ? WHERE idbarangumum = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('ii', $perubahan, $id_barang);
    $stmt->execute();

    // Catat log perubahan
    $queryLog = "INSERT INTO log_barang (id_barang, perubahan, keterangan) VALUES (?, ?, ?)";
    $stmtLog = $koneksi->prepare($queryLog);
    $stmtLog->bind_param('iis', $id_barang, $perubahan, $keterangan);
    $stmtLog->execute();
}
