<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanModel extends CI_Model
{
    function tampilStok($bln)
    {
        $before = $bln - 1;
        return $this->db->query("SELECT barang.*,(SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= '$before') as qtyterima1,
        (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= '$before') as qtykeluar1,
        (SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= '$bln') as qtyterima,
        (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= '$bln') as qtykeluar
        FROM barang");
    }

    function laporanPemakaian($bln, $iddivisi)
    {
        return $this->db->query("SELECT barang.*, divisi.nama_divisi, DATE_FORMAT(pengeluaran.tanggal,'%M') as bulans,
        (SELECT SUM(detail_pengeluaran.jumlah) FROM detail_pengeluaran WHERE detail_pengeluaran.id_barang = barang.id_barang) as jlh FROM detail_pengeluaran 
        JOIN pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran
        JOIN barang ON detail_pengeluaran.id_barang = barang.id_barang
        JOIN karyawan ON karyawan.id_karyawan = pengeluaran.request_by
        JOIN divisi ON divisi.id_divisi = karyawan.id_divisi
        WHERE DATE_FORMAT(pengeluaran.tanggal,'%m-%Y') = '$bln' AND divisi.id_divisi ='$iddivisi'");
    }
}
