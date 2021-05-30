<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        }
        $this->load->model('UserModel', 'usermodel');
    }

    function index()
    {
    }

    function input_data()
    {
        if ($this->session->userdata('akses') == '1') {
            $nama = $this->input->post('user');
            $personaid = $this->input->post('personal');
            $level = $this->input->post('level');
            $this->usermodel->input_data($nama, $personaid, $level);
            redirect('master/user');
        } else {
            redirect('Custom404');
        }
    }

    function delete_data()
    {
        if ($this->session->userdata('akses') == '1') {
            $id = $this->input->get('id');
            $this->usermodel->delete_data($id);
            redirect('master/user');
        } else {
            redirect('Custom404');
        }
    }


    function set_active()
    {
        $id = $this->input->get('iduser');
        $this->usermodel->set_active($id);
        redirect('dashboard');
    }
}
