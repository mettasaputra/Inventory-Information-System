<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        }
        $this->load->model('MasterModel', 'mastermodel');
    }

    function index()
    {
    }

    function input_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $kat = $this->input->post('kategori');
            $satuan = $this->input->post('satuan');
            $this->mastermodel->input_data($kode, $nama, $kat, $satuan);
            redirect('master/barang');
        } else {
            redirect('Custom404');
        }
    }

    function delete_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $this->mastermodel->delete_data($id);
            redirect('master/barang');
        } else {
            redirect('Custom404');
        }
    }

    function history()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $x['brg'] = $this->mastermodel->get_detail_barang($id);
            $x['data'] = $this->mastermodel->kartu_stok($id);
            $this->load->view('KartuStockView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function cetak_kartu()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $x['brg'] = $this->mastermodel->get_detail_barang($id);
            $x['data'] = $this->mastermodel->kartu_stok($id);
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=a.xls");
            $this->load->view('laporan/CetakKartuStock', $x);
        } else {
            redirect('Custom404');
        }
    }

    function cetak_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->post('id');
            $this->session->set_userdata('id', $id);
            if ($id == "all") {
                $x['data'] = $this->mastermodel->get_data_barang();
                // header("Content-type: application/vnd-ms-excel");
                // header("Content-Disposition: attachment; filename=Data_Barang.xls");
                $this->load->view('laporan/CetakDataBarang', $x);
            } else {
                $x['data'] = $this->mastermodel->cetak_data_barang($id);
                // header("Content-type: application/vnd-ms-excel");
                // header("Content-Disposition: attachment; filename=Data_Barang.xls");
                $this->load->view('laporan/CetakDataBarang', $x);
            }
        } else {
            redirect('Custom404');
        }
    }

    function tracking_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $x['brg'] = $this->mastermodel->get_detail_barang($id);
            $x['data'] = $this->mastermodel->tracking_data($id);
            $this->load->view('TrackingDataView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function update_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nabar');
            $kode = $this->input->post('kobar');
            $satuan = $this->input->post('satuan');
            $kat = $this->input->post('kat');
            $this->mastermodel->update_data($id, $nama, $kode, $kat, $satuan);
            redirect('master/barang');
        } else {
            redirect('Custom404');
        }
    }
}
