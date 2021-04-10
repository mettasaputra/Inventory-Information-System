<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MasterModel', 'mastermodel');
        $this->load->model('UserModel', 'usermodel');
    }

    public function index()
    {
        $this->load->view('DataMasterView');
    }

    public function barang()
    {
        $x['data'] = $this->mastermodel->get_data_barang();
        $this->load->view('DataBarangView', $x);
    }

    public function supplier()
    {
        $x['data'] = $this->mastermodel->get_data_supplier();
        $this->load->view('DataSupplierView', $x);
    }

    public function user()
    {
        $x['data'] = $this->usermodel->get_data_user();
        $this->load->view('DataUserView', $x);
    }
}
