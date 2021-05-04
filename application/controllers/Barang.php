<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MasterModel', 'mastermodel');
    }

    public function index()
    {
    }

    public function input_data()
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

    public function delete_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $this->mastermodel->delete_data($id);
            redirect('master/barang');
        } else {
            redirect('Custom404');
        }
    }

    public function history()
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

    public function tracking_data()
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
}
