<?php 
include '../koneksi.php';

$ProdukID = $_POST['ProdukID'];
$NamaProduk = $_POST['NamaProduk'];
$Harga = $_POST['Harga'];
$Stok = $_POST['Stok'];

mysqli_query($koneksi,"update produk set NamaProduk='$NamaProduk', Harga='$Harga', Stok='$Stok' where ProdukID='$ProdukID'");

header("location:index.php?pesan=update");

?>