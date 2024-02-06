<?php 
// koneksi database
include '../koneksi.php';

$PelangganID = $_POST['PelangganID'];
$TanggalPenjualan = $_POST['TanggalPenjualan'];

mysqli_query($koneksi,"insert into penjualan values('','$TanggalPenjualan','','$PelangganID')");

header("location:pembelian.php?pesan=simpan");

?>