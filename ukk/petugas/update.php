<?php 
include '../koneksi.php';

$id_petugas = $_POST['id_petugas'];
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$level = $_POST['level'];

mysqli_query($koneksi,"update petugas set nama_petugas='$nama_petugas', username='$username', level='$level' where id_petugas='$id_petugas'");

header("location:index.php?pesan=update");

?>