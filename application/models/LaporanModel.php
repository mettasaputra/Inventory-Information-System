<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanModel extends CI_Model
{
    function tampilStok($bln)
    {
        $before = $bln - 1;
        // return $this->db->query("SELECT barang.*,
        // ((SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= '$before')- (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= '$before')) as stokawal,
        // (SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= '$bln') as qtyterima,
        // (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= '$bln') as qtykeluar,
        // ((SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= '$before')- (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= '$before'))+
        //  (SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= '$bln') -
        // (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= '$bln')as stokakhir
        // FROM barang");

        return $this->db->query("SELECT barang.*,
        ((SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= $before)- (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= $before)) as stokawal,
        (SELECT SUM(jumlah) FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan WHERE detail_penerimaan.id_barang=barang.id_barang AND DATE_FORMAT(penerimaan.tanggal,'%c')= $bln) as qtyterima,
        (SELECT SUM(jumlah) FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran WHERE detail_pengeluaran.id_barang=barang.id_barang AND DATE_FORMAT(pengeluaran.tanggal,'%c')= $bln) as qtykeluar
        FROM barang");
    }
}
