<?php
session_start();

if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit();
}

$level = $_SESSION['level'];
$name = $_SESSION['nama_petugas'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: url('css/bg.jpg') no-repeat center center;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #555;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            color: #ffd700;
        }

        .logout-btn {
            background-color: #f00;
            color: #fff;
            border-radius: 7px;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-btn:hover {
            background-color: #ff6666;
        }

        .card-container {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 60px;
            justify-content: center;
        }

        .card {
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            width: 200px;
        }

        .card h2 {
            color: #333;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .data-number {
            font-size: 20px;
            color: #007bff;
        }

        .card-container-btn-loncat {
            margin-top: 60px;
            display: flex;
            flex-wrap: wrap;
            gap: 60px;
            justify-content: center;
        }

        .btn-loncat {
            text-align: center;
            display: inline-block;
            padding: 20px 110px;
            font-size: 30px;
            background-color: #ed8a39;
            color: #fff;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body>

    <nav>
        <?php
        if ($level == 'petugas') {
            echo '<a href="pelanggan/index.php">Data Pelanggan</a>';
            echo '<a href="pembelian/pembelian.php">Data Pembelian</a>';
        }
        ?>

        <?php
        if ($level == 'administrator') {
            echo '<a href="barang/index.php">Data Barang</a>';
            echo '<a href="petugas/index.php">Data Pengguna</a>';
        }
        ?>
        <a href="process.php?logout=true"><button class="logout-btn">Logout</button></a>
    </nav><br>
    <header>
        <h1>Dashboard KasirKita</h1>
    </header><br>
    <div>
        <marquee behavior="" direction="" scrollamount="17">
            <h2>Selamat datang,
                <?php echo $name; ?>! Kamu adalah,
                <?php echo $level; ?>!
            </h2>
        </marquee>
    </div>
    <div class="card-container">
        <?php if ($level == 'administrator') { ?>
            <div class="card">
                <i class="fas fa-box"></i>
                Data Barang
                <?php
                include 'koneksi.php';
                $data_produk = mysqli_query($koneksi, "SELECT * FROM produk");
                $jumlah_produk = mysqli_num_rows($data_produk);
                ?>
                <h3>
                    <?php echo $jumlah_produk; ?>
                </h3>
                <a href="barang/index.php" class="btn btn-outline-primary btn-sm">Detail <i
                        class="fas fa-chevron-right"></i></a>
            </div>
            <div class="card">
                <i class="fas fa-user"></i>
                Data Pengguna
                <?php
                include 'koneksi.php';
                $data_petugas = mysqli_query($koneksi, "SELECT * FROM petugas");
                $jumlah_petugas = mysqli_num_rows($data_petugas);
                ?>
                <h3>
                    <?php echo $jumlah_petugas; ?>
                </h3>
                <a href="petugas/index.php" class="btn btn-outline-primary btn-sm">Detail <i
                        class="fas fa-chevron-right"></i></a>
            </div>
        <?php } else { ?>

            <div class="card mb-5">
                <i class="fas fa-user"></i>
                Data Pelanggan
                <?php
                include 'koneksi.php';
                $data_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                $jumlah_pelanggan = mysqli_num_rows($data_pelanggan);
                ?>
                <h3>
                    <?php echo $jumlah_pelanggan; ?>
                </h3>
                <a href="pelanggan/index.php" class="btn btn-outline-primary btn-sm">Detail <i
                        class="fas fa-chevron-right"></i></a>
            </div>

            <div class="card mb-5">
                <i class="fas fa-shopping-cart"></i>
                Data Pembelian
                <?php
                include 'koneksi.php';
                $data_penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan");
                $jumlah_penjualan = mysqli_num_rows($data_penjualan);
                ?>
                <h3>
                    <?php echo $jumlah_penjualan; ?>
                </h3>
                <a href="pembelian/pembelian.php" class="btn btn-outline-primary btn-sm">Detail <i
                        class="fas fa-chevron-right"></i></a>
            </div>

        </div>
        <div class="card-container-btn-loncat">
            <!-- <a href="pembelian/pembelian.php"> -->
            <button class="btn-loncat" data-bs-toggle="modal" data-bs-target="#tambah-data">Lakukan Transaksi</button>
            <!-- </a> -->
        </div>
    <?php } ?>

    <!-- MODAL TAMBAH PEMBELIAN -->
    <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="pembelian/proses_tambah_pembelian.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Pelanggan</label>
                            <select name="PelangganID" class="form-control">
                                <?php
                                include 'koneksi.php';
                                $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                                while ($d = mysqli_fetch_array($data)) {
                                    ?>
                                    <option value="<?php echo $d['PelangganID']; ?>">
                                        <?php echo $d['NamaPelanggan']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <input type="date" name="TanggalPenjualan" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>

</html>