<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'usermodel');
    }

    function index()
    {
    }

    function input_data()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
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
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $id = $this->input->get('id');
            $this->usermodel->delete_data($id);
            redirect('master/user');
        } else {
            redirect('Custom404');
        }
    }
}
