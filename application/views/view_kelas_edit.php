<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap.min.css'); ?>">


    <title>Edit Kelas - DbSekolah</title>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <!-- Navbar content -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url('home'); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('guru'); ?>">Guru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('siswa'); ?>">Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="<?php echo base_url('kelas'); ?>">Kelas</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h1>Edit Data kelas</h1>

        <?php
        // memanggil nilai yang telah dikirim di file ini
        foreach ($dtkelasid as $dg);
        ?>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        <form enctype="multipart/form-data" action="<?= base_url('kelas/edit_proses'); ?>" method="POST">
            <div class="form-group">
                <label for="txtnama">Nama</label>
                <!-- penting di masukkan script dibawah ini digunakan untuk penanda bahwa yang akan dirubah ini adalah id_kelas sesuai yang dirubah -->
                <!-- type="hidden" difungsikan agar input text tersebut tidak kelihatan -->
                <input value="<?php echo $dg->id_kelas; ?>" type="hidden" class="form-control" id="txtid_kelas" name="txtid_kelas" required>
                <input value="<?php echo $dg->kelas; ?>" type="text" class="form-control" id="txtnama" name="txtnama" placeholder="Nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url('asset/jquery-3.2.1.slim.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/js-bootstrap.min.js'); ?>"></script>
</body>

</html>