<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "kasir";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM petugas WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['level'] = $user['level'];
            $_SESSION['nama_petugas'] = $user['nama_petugas'];
            header("Location: dashboard.php");
        } else {
            header("Location: login.php?login_failed=true");
            exit();
        }
    } else {
        header("Location: login.php?login_failed=true");
        exit();
    }
}


// PROSES LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
}
?>