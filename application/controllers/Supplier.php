<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
            $nama = $this->input->post('sup');
            $ctc = $this->input->post('ctc');
            $alamat = $this->input->post('alamat');
            $telp = $this->input->post('telp');
            $this->mastermodel->input_supplier($nama, $ctc, $telp, $alamat);
            redirect('master/supplier');
        } else {
            redirect('Custom404');
        }
    }

    function update_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->post('id');
            $ctc = $this->input->post('ctc');
            $telp = $this->input->post('telp');
            $this->mastermodel->update_supplier($ctc, $telp, $id);
            redirect('master/supplier');
        } else {
            redirect('Custom404');
        }
    }

    function delete_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $this->mastermodel->delete_supplier($id);
            redirect('master/supplier');
        } else {
            redirect('Custom404');
        }
    }

    function list_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $x['sup'] = $this->mastermodel->get_data_supplier();
            $x['data'] = $this->mastermodel->list_data($id);
            $this->load->view('ListBarangSupplier', $x);
        } else {
            redirect('Custom404');
        }
    }
}
