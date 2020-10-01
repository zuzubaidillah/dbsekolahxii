<!-- BAGIAN HEADER -->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap.min.css'); ?>">

    <title>Guru - DbSekolah</title>
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
            <li class="nav-item">
                <a class="nav-link disabled" href="<?php echo base_url('GALERI'); ?>">GALERI</a>
            </li>
        </ul>
    </nav>
    <!-- BAGIAN HEADER -->
    <!-- BAGIAN KONTEN -->
    <div class="container">
        <h1>Data Keseluruhan Guru</h1>
        <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#modal_guru" data-whatever="@mdo">Tambah Guru</button>

        <?php
        // digunakan untuk menampilkan notifikasi setelah dieksekusi
        $data = $this->session->flashdata('notif');
        if (isset($data)) {
            echo $this->session->flashdata('notif');
        } ?>
        <div class="modal fade" id="modal_guru" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- untuk menambahkan foto atau menyimpan foto kita wajib menggunakan enctype="multipart/form-data" -->
                    <form enctype="multipart/form-data" action="<?= base_url('guru/tambah'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtnama" class="col-form-label">Nama:</label>
                                <input type="text" class="form-control" id="txtnama" name="txtnama" required>
                            </div>
                            <div class="form-group">
                                <label for="txtalamat" class="col-form-label">Alamat:</label>
                                <textarea class="form-control" id="txtalamat" name="txtalamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="txttanggallahir" class="col-form-label">TTL:</label>
                                <input type="date" class="form-control" id="txttanggallahir" name="txttanggallahir" required>
                            </div>
                            <div class="form-group">
                                <label for="txtfoto" class="col-form-label">Foto:</label><code class="highlighter-rouge"> *Size kurang dari 2mb</code>
                                <input type="file" class="form-control" id="txtfoto" name="txtfoto" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>
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
                            <td width="30%">
                                <?php
                                if ($dg->foto == "kosong") {
                                    echo 'Tidak Ada Gmbar';
                                } else {
                                    // MENCARI LOKASI DIMANA FOTO GURU DI SIMPAN DAN NAMA FOTO GURU SUDAH TERCANTUM DI DATABASE
                                    echo '<img width="20%" src="upload/guru/' . $dg->foto . '" alt="Avatar">';
                                }
                                ?>

                            </td>
                            <td>
                                <a href="<?php echo base_url('guru/edit/' . $dg->id_guru); ?>" class="btn btn-primary">Edit</a>
                                <a href="#" onclick="btn_hapus('<?php echo $dg->id_guru; ?>','<?php echo $dg->nama; ?>','<?php echo $dg->foto; ?>')" class="btn btn-danger">Hapus</a>
                            </td>
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
    <script>
        function btn_hapus(id_guru, nama, foto) {
            swal({
                    title: "Data " + nama + " akan dihapus?",
                    text: "Jika data di hapus, foto akan terhapus pada directory",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = " echo base_url('guru/hapus/'); ?>" + id_guru + "/" + foto;
                    }
                });
        }
    </script>
    <!-- BAGIAN KONTEN -->
    <!-- BAGIAN FOTER -->
    <script script src="<?php echo base_url('asset/jquery-3.2.1.slim.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('asset/js-bootstrap.min.js'); ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
<!-- BAGIAN FOTER -->