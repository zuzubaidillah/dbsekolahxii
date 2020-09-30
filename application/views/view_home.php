<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap.min.css'); ?>">

    <title>DbSekolah</title>
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
        <h1>Guru 5 Terbaru</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Lahir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // membuat fariabel $no untuk membuat nomer otomatis
                $no = 0;

                // membuat logika if pada variabel $dtguru jika datanya 0 maka akan terbilang data kosong
                if ($dtguru != 0) {

                    // membuat nilai $dtguru menjadi array dengan alias $dg
                    foreach ($dtguru as $dg) {
                        // ini akan menambahkan kondisi dari variabel $no
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $dg->nama; ?></td>
                            <td><?= $dg->alamat; ?></td>
                            <td><?= $dg->tgl_lahir; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th colspan="4">Data Kosong</th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h1>Siswa 5 Terbaru</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                if ($dtsiswa != 0) {
                    foreach ($dtsiswa as $ds) {
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $ds->nama; ?></td>
                            <td><?= $ds->alamat; ?></td>
                            <td><?= $ds->tgl_lahir; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th colspan="4">Data Kosong</th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url('asset/jquery-3.2.1.slim.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/js-bootstrap.min.js'); ?>"></script>
</body>

</html>