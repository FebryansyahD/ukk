<?php
session_start();

if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="content">
            <!-- FORM -->
            <div class="card mt-2">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#tambah-data">
                        Tambah Data
                    </button>
                    <a href="../dashboard.php"><button type="button" class="btn btn-danger btn-sm">
                            Kembali
                        </button></a>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "simpan") { ?>
                            <div class="alert alert-success" role="alert">
                                Data Berhasil Di Simpan
                            </div>
                        <?php } ?>
                        <?php if ($_GET['pesan'] == "update") { ?>
                            <div class="alert alert-success" role="alert">
                                Data Berhasil Di Update
                            </div>
                        <?php } ?>
                        <?php if ($_GET['pesan'] == "hapus") { ?>
                            <div class="alert alert-success" role="alert">
                                Data Berhasil Di Hapus
                            </div>
                        <?php } ?>
                        <?php
                    }
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pelanggan</th>
                                <th>Tanggal Penjualan</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
                            while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['PelangganID']; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['TanggalPenjualan']; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['NamaPelanggan']; ?>
                                    </td>
                                    <td>Rp.
                                        <?php echo $d['TotalHarga']; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm"
                                            href="detail_pembelian.php?PelangganID=<?php echo $d['PelangganID']; ?>">Detail
                                            Transaksi</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- MODAL HAPUS-->
                                <div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="proses_hapus_pembelian.php">
                                                <div class="modal-body">
                                                    <input type="hidden" name="PelangganID"
                                                        value="<?php echo $d['PelangganID']; ?>">
                                                    <input type="hidden" name="PenjualanID"
                                                        value="<?php echo $d['PenjualanID']; ?>">
                                                    Apakah anda yakin akan menghapus data
                                                    <b>
                                                        <?php echo $d['NamaPelanggan']; ?>
                                                    </b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- MODAL TAMBAH PEMBELIAN -->
        <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="proses_tambah_pembelian.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Pilih Pelanggan</label>
                                <select name="PelangganID" class="form-control">
                                    <?php
                                    include '../koneksi.php';
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