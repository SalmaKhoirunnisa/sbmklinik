
<?php
include 'koneksi.php';
$koneksi->query("DELETE FROM baranggigi WHERE idbaranggigi='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script> location ='doktergigi.php';</script>"; ?>