<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MasterModel', 'mastermodel');
    }

    public function index()
    {
    }

    function input_data()
    {
        $nama = $this->input->post('nama');
        $divisi = $this->input->post('divisi');
        $this->mastermodel->input_karyawan($nama, $divisi);
        redirect('master/karyawan');
    }

    function update_data()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $divisi = $this->input->post('divisi');
        $this->mastermodel->update_karyawan($id, $divisi, $nama);
        redirect('master/karyawan');
    }

    function delete_data()
    {
        $id = $this->input->get('id');
        $this->mastermodel->delete_karyawan($id);
        redirect('master/karyawab');
    }
}
