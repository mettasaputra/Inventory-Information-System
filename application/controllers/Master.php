<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MasterModel', 'mastermodel');
        $this->load->model('UserModel', 'usermodel');
        $this->load->model('LaporanModel', 'laporanmodel');
    }

    function index()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $x['data'] = $this->mastermodel->get_data_barang();
            $x['sql'] = $this->laporanmodel->getbulan();
            $this->load->view('DataMasterView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function barang()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $x['data'] = $this->mastermodel->get_data_barang();
            $this->load->view('DataBarangView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function supplier()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $x['data'] = $this->mastermodel->get_data_supplier();
            $this->load->view('DataSupplierView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function user()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $x['data'] = $this->usermodel->get_data_user();
            $this->load->view('DataUserView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function karyawan()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $x['dt'] = $this->mastermodel->get_data_karyawan();
            $this->load->view('DataKaryawanView', $x);
        } else {
            redirect('Custom404');
        }
    }
}
