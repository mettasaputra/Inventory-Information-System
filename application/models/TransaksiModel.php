<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransaksiModel extends CI_Model
{
    function input_penerimaan($tgl, $sup, $ket)
    {
        $this->db->query("INSERT INTO penerimaan (tanggal, id_supplier, keterangan, jenis_penerimaan) VALUES ('$tgl','$sup','$ket','Penerimaan Barang dari Supplier')");
        foreach ($this->cart->contents() as $item) {
            $id = $this->get_id();
            $idbrg = $item['id'];
            $qty = $item['qty'];
            $comment = $item['comment'];
            $this->db->query("INSERT INTO detail_penerimaan (id_penerimaan, id_barang, jumlah, keterangan) VALUES ('$id','$idbrg','$qty','$comment')");
            $this->db->query("UPDATE barang SET stok=stok+$qty WHERE id_barang='$idbrg'");
        }
    }

    function input_opsional($tgl, $karyawan, $ket)
    {
        $this->db->query("INSERT INTO penerimaan (tanggal, id_karyawan, keterangan, jenis_penerimaan) VALUES ('$tgl','$karyawan','$ket','Penerimaan Opsional')");
        foreach ($this->cart->contents() as $item) {
            $id = $this->get_id();
            $idbrg = $item['id'];
            $qty = $item['qty'];
            $comment = $item['comment'];
            $this->db->query("INSERT INTO detail_penerimaan (id_penerimaan, id_barang, jumlah, keterangan) VALUES ('$id','$idbrg','$qty','$comment')");
            $this->db->query("UPDATE barang SET stok=stok+$qty WHERE id_barang='$idbrg'");
        }
    }

    function get_id()
    {
        $query = $this->db->query("SELECT * from penerimaan order by id_penerimaan desc limit 1")->result_array();
        $result = (int) $query[0]['id_penerimaan'];
        return $result;
    }

    function history_penerimaan($from, $to)
    {
        return $this->db->query("SELECT penerimaan.*, detail_penerimaan.keterangan as ket,
        detail_penerimaan.jumlah, barang.nama_barang, barang.satuan, supplier.nama_supplier
        FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan 
        JOIN barang ON barang.id_barang = detail_penerimaan.id_barang
        JOIN supplier ON penerimaan.id_supplier = supplier.id_supplier
        WHERE penerimaan.id_supplier IS NOT NULL AND penerimaan.tanggal BETWEEN '$from' AND '$to'
        ORDER BY penerimaan.tanggal ASC");
    }

    function history_penerimaan_lain($from, $to)
    {
        return $this->db->query("SELECT penerimaan.*, detail_penerimaan.keterangan as ket,
        detail_penerimaan.jumlah, barang.nama_barang, barang.satuan, karyawan.nama_karyawan
        FROM penerimaan JOIN detail_penerimaan ON penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan 
        JOIN barang ON barang.id_barang = detail_penerimaan.id_barang
        JOIN karyawan ON penerimaan.id_karyawan = karyawan.id_karyawan
        WHERE penerimaan.id_karyawan IS NOT NULL AND penerimaan.tanggal BETWEEN '$from' AND '$to'
        ORDER BY penerimaan.tanggal ASC");
    }

    function input_permintaan($tgl, $karyawan, $ket)
    {
        $this->db->query("INSERT INTO permintaan_karyawan (tanggal_kebutuhan, request_by, keterangan) VALUES ('$tgl','$karyawan','$ket')");
        foreach ($this->cart->contents() as $item) {
            $id = $this->get_id_permintaan();
            $idbrg = $item['id'];
            $qty = $item['qty'];
            $comment = $item['comment'];
            $this->db->query("INSERT INTO detail_permintaan (id_permintaan, id_barang, jumlah, keterangan) VALUES ('$id','$idbrg','$qty','$comment')");
        }
    }

    function get_id_permintaan()
    {
        $query = $this->db->query("SELECT * from permintaan_karyawan order by id_permintaan desc limit 1")->result_array();
        $result = (int) $query[0]['id_permintaan'];
        return $result;
    }

    function tampil_permintaan()
    {
        return $this->db->query("SELECT permintaan_karyawan.id_permintaan,permintaan_karyawan.tanggal_kebutuhan, permintaan_karyawan.keterangan as ket, permintaan_karyawan.created_at, user.nama_user 
        FROM permintaan_karyawan JOIN user ON permintaan_karyawan.request_by = user.id_user");
    }

    function permintaan($id)
    {
        return $this->db->query("SELECT permintaan_karyawan.id_permintaan,permintaan_karyawan.request_by,permintaan_karyawan.tanggal_kebutuhan, permintaan_karyawan.keterangan as ket, permintaan_karyawan.created_at, user.nama_user 
        FROM permintaan_karyawan JOIN user ON permintaan_karyawan.request_by = user.id_user WHERE permintaan_karyawan.id_permintaan='$id'");
    }

    function delete($idbrg, $id)
    {
        $this->db->query("DELETE FROM detail_permintaan WHERE id_barang='$idbrg' AND id_permintaan='$id'");
    }

    function detail_permintaan($id)
    {
        return $this->db->query("SELECT permintaan_karyawan.*, permintaan_karyawan.keterangan as ket, permintaan_karyawan.keterangan as ket, DATE_FORMAT(permintaan_karyawan.tanggal_kebutuhan,'%m/%d/%Y') as tgl, 
        barang.*,
        detail_permintaan.jumlah, detail_permintaan.keterangan, user.nama_user FROM permintaan_karyawan JOIN detail_permintaan
        ON permintaan_karyawan.id_permintaan = detail_permintaan.id_permintaan 
        JOIN user ON permintaan_karyawan.request_by = user.id_user
        JOIN barang ON detail_permintaan.id_barang = barang.id_barang
        WHERE permintaan_karyawan.id_permintaan = '$id'");
    }

    function deletepermintaan($id)
    {
        $this->db->query("DELETE FROM permintaan_karyawan WHERE id_permintaan = '$id'");
        $this->db->query("DELETE FROM detail_permintaan WHERE id_permintaan = '$id'");
    }

    function input_pengeluaran($tgl, $karyawan, $ket)
    {
        $this->db->query("INSERT INTO pengeluaran (tanggal, request_by, keterangan, jenis_pengeluaran) VALUES ('$tgl','$karyawan','$ket','Permintaan Karyawan')");
        foreach ($this->cart->contents() as $item) {
            $id = $this->get_id_pengeluaran();
            $idbrg = $item['id'];
            $qty = $item['qty'];
            $comment = $item['comment'];
            $this->db->query("INSERT INTO detail_pengeluaran (id_pengeluaran, id_barang, jumlah, keterangan) VALUES ('$id','$idbrg','$qty','$comment')");
            $this->db->query("UPDATE barang SET stok=stok-$qty WHERE id_barang='$idbrg'");
        }
    }

    function get_id_pengeluaran()
    {
        $query = $this->db->query("SELECT * from pengeluaran order by id_pengeluaran desc limit 1")->result_array();
        $result = (int) $query[0]['id_pengeluaran'];
        return $result;
    }

    function input_pengeluaran_opsional($tgl, $ket)
    {
        $this->db->query("INSERT INTO pengeluaran (tanggal, keterangan, jenis_pengeluaran, status) VALUES ('$tgl','$ket','Pengeluaran Opsional',1)");
        foreach ($this->cart->contents() as $item) {
            $id = $this->get_id_pengeluaran();
            $idbrg = $item['id'];
            $qty = $item['qty'];
            $comment = $item['comment'];
            $this->db->query("INSERT INTO detail_pengeluaran (id_pengeluaran, id_barang, jumlah, keterangan) VALUES ('$id','$idbrg','$qty','$comment')");
            $this->db->query("UPDATE barang SET stok=stok-$qty WHERE id_barang='$idbrg'");
        }
    }

    function history_pengeluaran($from, $to)
    {
        return $this->db->query("SELECT pengeluaran.*, detail_pengeluaran.keterangan as ket,
        detail_pengeluaran.jumlah, barang.nama_barang, barang.satuan, karyawan.nama_karyawan
        FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran 
        JOIN barang ON barang.id_barang = detail_pengeluaran.id_barang
        JOIN karyawan ON pengeluaran.request_by = karyawan.id_karyawan
        WHERE pengeluaran.request_by IS NOT NULL AND pengeluaran.tanggal BETWEEN '$from' AND '$to'
        ORDER BY pengeluaran.tanggal ASC");
    }

    function history_pengeluaran_lain($from, $to)
    {
        return $this->db->query("SELECT pengeluaran.tanggal, detail_pengeluaran.keterangan as ket,
        detail_pengeluaran.jumlah, barang.nama_barang, barang.satuan
        FROM pengeluaran JOIN detail_pengeluaran ON pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran 
        JOIN barang ON barang.id_barang = detail_pengeluaran.id_barang
        WHERE pengeluaran.request_by IS NULL AND pengeluaran.tanggal BETWEEN '$from' AND '$to'
        ORDER BY pengeluaran.tanggal ASC");
    }
}
