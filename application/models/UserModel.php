<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    function cek_admin($idpersonal)
    {
        return $this->db->query("SELECT * FROM user WHERE personal_id='$idpersonal' AND status='Aktif'");
    }

    function get_data_user()
    {
        return $this->db->query("SELECT user.*, divisi.nama_divisi FROM user JOIN karyawan ON user.nama_user = karyawan.nama_karyawan JOIN divisi ON karyawan.id_divisi = divisi.id_divisi ORDER BY nama_user ASC");
    }

    function input_data($nama, $personaid, $level)
    {
        $this->db->query("INSERT INTO user(nama_user,personal_id,level_akses) VALUES('$nama','$personaid','$level')");
    }

    function delete_data($id)
    {
        $this->db->query("DELETE FROM user WHERE id_user='$id'");
    }
}
