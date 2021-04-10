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
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $kat = $this->input->post('kategori');
        $satuan = $this->input->post('satuan');
        $this->mastermodel->input_data($kode, $nama, $kat, $satuan);
        redirect('master/barang');
    }

    public function delete_data()
    {
        $id = $this->input->get('id');
        $this->mastermodel->delete_data($id);
        redirect('master/barang');
    }
}
