<?php
include '../koneksi.php';

$PelangganID = $_POST['PelangganID'];
$NamaPelanggan = $_POST['NamaPelanggan'];
$Alamat = $_POST['Alamat'];
$NomorTelepon = $_POST['NomorTelepon'];

mysqli_query($koneksi, "update pelanggan set NamaPelanggan='$NamaPelanggan', Alamat='$Alamat', NomorTelepon='$NomorTelepon' where PelangganID='$PelangganID'");

header("location:index.php?pesan=update");

?>