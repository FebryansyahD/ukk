<?php
include('../koneksi.php');

$NamaPelanggan = $_POST['NamaPelanggan'];
$Alamat = $_POST['Alamat'];
$NomorTelepon = $_POST['NomorTelepon'];

mysqli_query($koneksi, "insert into pelanggan values('','$NamaPelanggan','$Alamat','$NomorTelepon')");

header('location:index.php?pesan=simpan');

?>