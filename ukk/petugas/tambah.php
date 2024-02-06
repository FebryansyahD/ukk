<?php
include('../koneksi.php');

$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($koneksi, "insert into petugas values('','$nama_petugas','$username','$hashed_password','$level')");

header('location:index.php?pesan=simpan')

    ?>