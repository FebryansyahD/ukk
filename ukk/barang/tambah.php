<?php
include('../koneksi.php');

$NamaProduk = $_POST['NamaProduk'];
$Harga = $_POST['Harga'];
$Stok = $_POST['Stok'];

mysqli_query($koneksi, "insert into produk values('','$NamaProduk','$Harga','$Stok')");

header("location:index.php?pesan=simpan");
?>