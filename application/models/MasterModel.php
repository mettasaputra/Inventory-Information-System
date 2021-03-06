<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterModel extends CI_Model
{
    function get_data_barang()
    {
        return $this->db->query("SELECT barang.*, kategori.nama_kategori as kat FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori ORDER BY barang.kode_barang ASC");
    }

    function get_detail_barang($kode)
    {
        return $this->db->query("SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori WHERE barang.id_barang = '$kode' ORDER BY barang.kode_barang ASC");
    }

    function cetak_data_barang($id)
    {
        return $this->db->query("SELECT barang.*, kategori.nama_kategori as kat FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori WHERE barang.id_kategori = '$id' ORDER BY barang.kode_barang ASC");
    }

    function update_data($id, $nama, $kode, $kat, $satuan)
    {
        $this->db->query("UPDATE barang SET nama_barang='$nama',kode_barang='$kode',satuan='$satuan',id_kategori='$kat' WHERE id_barang='$id'");
    }
    function kartu_stok($id)
    {
        return $this->db->query("SELECT * FROM (select date(`pengeluaran`.`tanggal`) as tanggal ,concat(`pengeluaran`.`jenis_pengeluaran`,',',detail_pengeluaran.keterangan) as keterangan ,-`detail_pengeluaran`.`jumlah` 
        as qty from pengeluaran join detail_pengeluaran on pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran where detail_pengeluaran.id_barang ='$id' union ALL
        SELECT date(`penerimaan`.`tanggal`) as tanggal , concat(penerimaan.jenis_penerimaan,',',detail_penerimaan.keterangan) as keterangan ,detail_penerimaan.jumlah as qty 
        from penerimaan join detail_penerimaan on penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan where detail_penerimaan.id_barang ='$id')a order by a.tanggal asc , a.qty DESC");
    }

    function list_data($id)
    {
        return $this->db->query("SELECT barang.* FROM penerimaan JOIN supplier ON penerimaan.id_supplier = supplier.id_supplier
        JOIN detail_penerimaan ON detail_penerimaan.id_penerimaan = penerimaan.id_penerimaan
        JOIN barang ON detail_penerimaan.id_barang = barang.id_barang
        WHERE penerimaan.id_supplier='$id' GROUP BY barang.id_barang
        ORDER BY barang.nama_barang ASC");
    }

    function tracking_data($id)
    {
        return $this->db->query("SELECT supplier.* FROM penerimaan JOIN supplier ON penerimaan.id_supplier = supplier.id_supplier
        JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang='$id'
        GROUP BY penerimaan.id_supplier ORDER BY supplier.nama_supplier ASC");
    }

    function input_data($kode, $nama, $kat, $satuan)
    {
        $this->db->query("INSERT INTO barang(kode_barang, nama_barang, id_kategori,satuan,stok) VALUES ('$kode','$nama','$kat','$satuan',0)");
    }

    function get_id_barang($id)
    {
        return $this->db->query("SELECT id_barang FROM detail_penerimaan WHERE id_barang='$id' UNION ALL SELECT id_barang FROM
        detail_pengeluaran WHERE id_barang='$id'");
    }

    function get_id_karyawan($id)
    {
        return $this->db->query("SELECT id_karyawan FROM penerimaan WHERE id_karyawan='$id' UNION ALL SELECT request_by FROM
        pengeluaran WHERE request_by='$id'");
    }

    function get_id_supplier($id)
    {
        return $this->db->query("SELECT id_supplier FROM penerimaan WHERE id_supplier='$id'");
    }

    function delete_data($id, $nama)
    {
        $akses = $this->session->userdata('idadmin');
        $this->db->query("DELETE FROM barang WHERE id_barang='$id'");
        $this->db->query("INSERT INTO history(nama_data, pengguna) VALUES ('$nama','$akses')");
    }

    function tracking_history()
    {
        return $this->db->query("SELECT history.*, user.nama_user FROM history JOIN user ON history.pengguna = user.id_user");
    }

    function get_data_supplier()
    {
        return $this->db->query("SELECT * FROM supplier ORDER BY nama_supplier ASC");
    }

    function input_supplier($nama, $ctc, $telp, $alamat)
    {
        $this->db->query("INSERT into supplier(nama_supplier, contact_person, no_telp, alamat) VALUES ('$nama','$ctc','$telp','$alamat')");
    }

    function update_supplier($ctc, $telp, $id, $alamat)
    {
        $this->db->query("UPDATE supplier SET contact_person='$ctc',no_telp='$telp', alamat='$alamat' WHERE id_supplier='$id'");
    }


    function delete_supplier($id, $nama)
    {
        $akses = $this->session->userdata('idadmin');
        $this->db->query("DELETE FROM supplier WHERE id_supplier='$id'");
        $this->db->query("INSERT INTO history(nama_data, pengguna) VALUES ('$nama','$akses')");
    }

    function get_data_karyawan()
    {
        return $this->db->query("SELECT karyawan.*, divisi.* FROM karyawan JOIN divisi ON karyawan.id_divisi = divisi.id_divisi");
    }

    function input_karyawan($divisi, $nama, $nik)
    {
        $this->db->query("INSERT INTO karyawan(id_divisi, nama_karyawan, nik) VALUES ('$divisi','$nama', '$nik')");
    }

    function update_karyawan($id, $divisi, $nama)
    {
        $this->db->query("UPDATE karyawan SET id_divisi='$divisi', nama_karyawan='$nama' WHERE id_karyawan='$id'");
    }

    function delete_karyawan($id, $nama)
    {
        $akses = $this->session->userdata('idadmin');
        $this->db->query("DELETE FROM karyawan WHERE id_karyawan='$id'");
        $this->db->query("INSERT INTO history(nama_data, pengguna) VALUES ('$nama','$akses')");
    }

    function get_user()
    {
        $nama = $this->session->userdata('nama');
        return $this->db->query("SELECT * FROM karyawan WHERE nama_karyawan = '$nama'");
    }
}
