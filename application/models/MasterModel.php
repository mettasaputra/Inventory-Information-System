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
        return $this->db->query("SELECT barang.* FROM barang WHERE barang.id_barang = '$kode' ORDER BY barang.kode_barang ASC");
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
}
