<?php
// koneksi database
include '../koneksi.php';

$PelangganID = $_POST['PelangganID'];
$PenjualanID = $_POST['PenjualanID'];

mysqli_query($koneksi, "delete from penjualan where PenjualanID='$PenjualanID'");
mysqli_query($koneksi, "delete from detailpenjualan where PenjualanID='$PenjualanID'");

header("location:pembelian.php?pesan=hapus");

?>