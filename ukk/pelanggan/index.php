<?php
session_start();

if (!isset($_SESSION['level'])) {
    header("Location: ../login.php");
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
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                            while ($d = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['NamaPelanggan']; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['Alamat']; ?>
                                    </td>
                                    <td>
                                        <?php echo $d['NomorTelepon']; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#edit-data<?php echo $d['PelangganID']; ?>">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT DATA-->
                                <div class="modal fade" id="edit-data<?php echo $d['PelangganID']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="update.php" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama Pelanggan</label>
                                                        <input type="hidden" name="PelangganID"
                                                            value="<?php echo $d['PelangganID']; ?>">
                                                        <input type="text" name="NamaPelanggan" class="form-control"
                                                            value="<?php echo $d['NamaPelanggan']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <input type="text" name="Alamat" class="form-control"
                                                            value="<?php echo $d['Alamat']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No Telepon</label>
                                                        <input type="number" name="NomorTelepon" class="form-control"
                                                            value="<?php echo $d['NomorTelepon']; ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL HAPUS DATA -->
                                <div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="hapus.php">
                                                <div class="modal-body">
                                                    <input type="hidden" name="PelangganID"
                                                        value="<?php echo $d['PelangganID']; ?>">
                                                    Apakah anda yakin akan menghapus
                                                    <b>
                                                        <?php echo $d['NamaPelanggan']; ?>
                                                    </b>?
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

            <!-- MODAL TAMBAH DATA-->
            <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="tambah.php" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="NamaPelanggan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="Alamat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="number" name="NomorTelepon" class="form-control">
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