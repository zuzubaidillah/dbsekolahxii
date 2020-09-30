<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mguru');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtguru'] = $this->Mguru->guru();
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtguru] $data['dtsiswa]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('view_guru_tampil', $data);
    }

    public function tambah()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mguru');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('guru/tambah');
        $nama = $this->input->post('txtnama');
        $alamat = $this->input->post('txtalamat');
        $tanggallahir = $this->input->post('txttanggallahir');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
        $x = explode(".", $e);
        // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
        $ekstensi = strtolower(end($x));
        // MEMBUAT FILE FOTO GURU YANG NNTINYA DIMASUKKAN KE DAABASE
        $foto = date('YmdHis') . "." . $ekstensi;

        /* Location FOTO YANG AKAN DISIMPAN */
        $location = "upload/guru/" . $foto;

        /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
        $valid_extensions = array("jpg", "jpeg", "png");


        // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
        if (!in_array($ekstensi, $valid_extensions)) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('guru');
        } else {
            // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
            if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Mguru->guru_tambah($nama, $alamat, $tanggallahir, $foto)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Disimpan!</strong> Data '.$nama.' Sudah Tersimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('guru');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('guru');
            }
        }
    }

    // pada function kali ini berbeda dari yang diatas, dikarenakan ada parameter didalamnya function yaitu $id_guru
    // APA ITU PARAMETER ADALAH SEBUAH PERINTAH UNTUK MENYIMPAN NILAI YANG DISIMPAN DI VARIABEL seperti contoh dibawah ini kita menggunakan variabel $id_guru
    // $id_guru=0  YANG DIMAKSUD PADA VARIABEL INI ADALAH UNTUK MELIHAT JIKA PADA PERINTAH TIDAK ADA NILAINYA MAKA NILAI 0 INILAH YANG AKANN  DIGUNAKAN
    public function edit($id_guru=0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_guru sudah ada nilainya atau tidak
        if ($id_guru==0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('guru');        
        }

        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mguru');

        //memanggil database melalui model dengan  membawa nilai $id_guru  ke modelnya
        $data['dtguruid'] = $this->Mguru->guru_edit($id_guru);

        // melakukan logika terlebih dahulu untuk mengetahui hasil dari model guru_edit sudah ada nilainya atau tidak
        if ($data['dtguruid']==0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ID Tidak Terdapat diDatabase!</strong> Silahkan Ulangi lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('guru');
        }

        //untuk penamaan view_guru bebas asalkan sama pada file yang ada di folder views
        $this->load->view('view_guru_edit', $data);
        // $data ini digunakan untuk mengirim nilai hasil dari pencarian melalui model $data['dtguru']
    }


    public function edit_proses()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mguru');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('guru/tambah');
        $id_guru = $this->input->post('txtid_guru');
        $namafoto = $this->input->post('txtnamafoto');
        $nama = $this->input->post('txtnama');
        $alamat = $this->input->post('txtalamat');
        $tanggallahir = $this->input->post('txttanggallahir');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // membuat logika jika foto tidak diedit / dirubah / diganti
        if ($e=="") {
            // jika tidak diedit maka yang dieksekusi hanya dibawah inni

            // update data melalui model
            if ($this->Mguru->guru_edit_proses($id_guru, $nama, $alamat, $tanggallahir)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('guru');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('guru');
            }
        }else{
            // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
            $x = explode(".", $e);
            // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
            $ekstensi = strtolower(end($x));
            // MEMBUAT FILE FOTO GURU YANG NNTINYA DIMASUKKAN KE DAABASE
            $foto = date('YmdHis') . "." . $ekstensi;

            /* Location FOTO YANG AKAN DISIMPAN */
            $location = "upload/guru/" . $foto;

            /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
            $valid_extensions = array("jpg", "jpeg", "png");


            // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
            if (!in_array($ekstensi, $valid_extensions)) {
                // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                // REDIRECT BERPINDAH HALAMAN KE GURU
                redirect('guru');
            } else {
                // sekarang proses untuk menghapus gambar yang ada di dalam directory
                unlink(realpath('upload/guru/' . $namafoto));                

                // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
                if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Mguru->guru_edit_prosesfoto($id_guru, $nama, $alamat, $tanggallahir, $foto)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('guru');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('guru');
                }
            }
        }
    }

    function hapus($id_guru = 0, $foto = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_guru sudah ada nilainya atau tidak
        if ($id_guru == 0 or $foto == '0') {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN GURU
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> gagal hapus data, URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE GURU
            redirect('guru');
        }
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mguru');

        if ($foto != 'foto') {
            // menghilangkan foto pada directory
            unlink(realpath('upload/guru/' . $foto));
        }
        // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $alamat, $tanggallahir, $foto)]
        if ($this->Mguru->guru_hapus($id_guru)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('guru');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Hapus Data!</strong> Data Belum Dihapus ID tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('guru');
        }
    }

}
