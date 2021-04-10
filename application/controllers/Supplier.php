<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
        $nama = $this->input->post('sup');
        $ctc = $this->input->post('ctc');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $this->mastermodel->input_supplier($nama, $ctc, $telp, $alamat);
        redirect('master/supplier');
    }

    function update_data()
    {
        $id = $this->input->post('id');
        $ctc = $this->input->post('ctc');
        $telp = $this->input->post('telp');
        $this->mastermodel->update_supplier($ctc, $telp, $id);
        redirect('master/supplier');
    }

    function delete_data()
    {
        $id = $this->input->get('id');
        $this->mastermodel->delete_supplier($id);
        redirect('master/supplier');
    }
}
