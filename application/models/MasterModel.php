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

    function kartu_stok($id)
    {
        return $this->db->query("SELECT * from (select date(`pengeluaran`.`tanggal`) as tanggal ,concat(`pengeluaran`.`jenis_pengeluaran`,',',detail_pengeluaran.keterangan) as keterangan ,-`detail_pengeluaran`.`jumlah` 
        as qty from pengeluaran join detail_pengeluaran on pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran where detail_pengeluaran.id_barang ='$id' union ALL
        SELECT date(`penerimaan`.`tanggal`) as tanggal , concat(penerimaan.jenis_penerimaan,',',detail_penerimaan.keterangan) as keterangan ,detail_penerimaan.jumlah as qty 
        from penerimaan join detail_penerimaan on penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan where detail_penerimaan.id_barang ='$id')a order by a.tanggal asc , a.qty DESC");
    }

    function input_data($kode, $nama, $kat, $satuan)
    {
        $this->db->query("INSERT INTO barang(kode_barang, nama_barang, id_kategori,satuan,stok) VALUES ('$kode','$nama','$kat','$satuan',0)");
    }

    function delete_data($id)
    {
        $this->db->query("DELETE FROM barang WHERE id_barang='$id'");
    }

    function get_data_supplier()
    {
        return $this->db->query("SELECT * FROM supplier ORDER BY nama_supplier ASC");
    }

    function input_supplier($nama, $ctc, $telp, $alamat)
    {
        $this->db->query("INSERT into supplier(nama_supplier, contact_person, no_telp, alamat) VALUES ('$nama','$ctc','$telp','$alamat')");
    }

    function update_supplier($ctc, $telp, $id)
    {
        $this->db->query("UPDATE supplier SET contact_person='$ctc',no_telp='$telp' WHERE id_supplier='$id'");
    }

    function delete_supplier($id)
    {
        $this->db->query("DELETE FROM supplier WHERE id_supplier='$id'");
    }

    function get_data_karyawan()
    {
        return $this->db->query("SELECT karyawan.*, divisi.* FROM karyawan JOIN divisi ON karyawan.id_divisi = divisi.id_divisi");
    }

    function input_karyawan($divisi, $nama)
    {
        $this->db->query("INSERT INTO karyawan(id_divisi, nama_karyawan) VALUES ('$divisi','$nama')");
    }

    function update_karyawan($id, $divisi, $nama)
    {
        $this->db->query("UPDATE karyawan SET id_divisi='$divisi', nama_karyawan='$nama' WHERE id_karyawan='$id'");
    }

    function delete_karyawan($id)
    {
        $this->db->query("DELETE FROM karyawan WHERE id_karyawan='$id'");
    }

    function get_user()
    {
        $nama = $this->session->userdata('nama');
        return $this->db->query("SELECT * FROM karyawan WHERE nama_karyawan = '$nama'");
    }
}
