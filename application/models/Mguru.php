<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mguru extends CI_Model
{
    public function guru()
    {
        // pada variabel sql kita menampilkan data guru semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama guru seperti ini "SELECT nama FROM guru ORDER BY id_guru DESC"
        $sql = "SELECT * FROM guru ORDER BY id_guru DESC";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // logika jika num_rows = menghitung pencarian didatabase sesuai variabel $query terdapat berapa baris?
        // jika hasilnya barisnya terdeteksi 0
        if ($query->num_rows() == 0) {
            // ini yang akan dijalankan hasilnya 0
            return 0;
        } else {
            // ini jika hasil barisnya lebih dari 0
            // result() perintah result() digunakan untuk memberikan hasil data dari variabel $query
            return $query->result();
        }
    }

    // ($nama, $alamat, $tgl_lahir, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function guru_tambah($nama, $alamat, $tgl_lahir, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "INSERT INTO guru(`nama`, `alamat`, `tgl_lahir`, `foto`) VALUES ('$nama', '$alamat', '$tgl_lahir', '$foto')";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }


    public function guru_edit($id_guru)
    {
        // pada variabel sql kita menampilkan data guru semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama guru seperti ini "SELECT nama FROM guru ORDER BY id_guru DESC"
        // WHERE id_guru='$id_guru' == fungsi tersebut digunakan untuk mencari data yang sesuai id_guru
        $sql = "SELECT * FROM guru WHERE id_guru='$id_guru'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // logika jika num_rows = menghitung pencarian didatabase sesuai variabel $query terdapat berapa baris?
        // jika hasilnya barisnya terdeteksi 0
        if ($query->num_rows() == 0) {
            // ini yang akan dijalankan hasilnya 0
            return 0;
        } else {
            // ini jika hasil barisnya lebih dari 0
            // result() perintah result() digunakan untuk memberikan hasil data dari variabel $query
            return $query->result();
        }
    }

    // ($nama, $alamat, $tgl_lahir, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function guru_edit_proses($id_guru, $nama, $alamat, $tgl_lahir)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE guru SET `nama`='$nama', `alamat`='$alamat', `tgl_lahir`='$tgl_lahir' WHERE id_guru='$id_guru'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }

    // ($nama, $alamat, $tgl_lahir, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function guru_edit_prosesfoto($id_guru, $nama, $alamat, $tgl_lahir, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE guru SET `nama`='$nama', `alamat`='$alamat', `tgl_lahir`='$tgl_lahir', `foto`='$foto' WHERE id_guru='$id_guru'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }
}
