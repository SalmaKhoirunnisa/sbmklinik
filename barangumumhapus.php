
<?php
include 'koneksi.php';
$koneksi->query("DELETE FROM barangumum WHERE idbarangumum='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script> location ='dokterumum.php';</script>"; ?>