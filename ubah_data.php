<?php
    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require("function.php");

    $id_buku = $_GET['id'];

    $query = query("SELECT * FROM buku WHERE id_buku = $id_buku")[0];
    $buku = $query;

    // ketika tombol submit nya di klik
    if(isset($_POST['tombol_submit'])){
       
        if(ubah_data($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-light white bg-info">
        <div class="container">
            <a class="navbar-brand text-white" href="#">SIMBS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">List Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Link</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->
   
    <div class="p-4 container">
        <div class="row">
            <h1 class="mb-2">Ubah Data Buku</h1>
            <a href="index.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <form action="" method="POST" enctype="multipart/form-data">

                    <!-- input text bayangan -->
                    <input type="hidden" class="form-control" name="id_buku" id="id_buku" value="<?= $buku['id_buku'] ?>" autocomplete="off">
                    <input type="hidden" name="gambar_lama" value="<?= $buku['gambar'] ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="nim" value="<?= $buku['isbn'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Buku</label>
                        <input type="text" class="form-control" name="nama_buku" id="nama_buku" value="<?= $buku['nama_buku'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select" id="kategori" autocomplete="off">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Fiksi" <?= ($buku['kategori'] == 'Fiksi') ? 'selected' : '' ?>>Fiksi</option>
                            <option value="Non Fiksi" <?= ($buku['kategori'] == 'NonFiksi') ? 'selected' : '' ?>>Non Fiksi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Penulis</label>
                        <input type="text" class="form-control" name="nama_penulis" id="nama_penulis" value="<?= $buku['nama_penulis'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar" value="<?= $buku['gambar'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Input</label>
                        <input type="text" class="form-control" value="<?= isset($buku['tanggal_input']) ? $buku['tanggal_input'] : '-' ?>" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="tombol_submit" class="btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>