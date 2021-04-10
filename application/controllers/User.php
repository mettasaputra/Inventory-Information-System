<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'usermodel');
    }

    public function index()
    {
    }

    public function input_data()
    {
        $nama = $this->input->post('user');
        $personaid = $this->input->post('personal');
        $level = $this->input->post('level');
        $this->usermodel->input_data($nama, $personaid, $level);
        redirect('master/user');
    }

    public function delete_data()
    {
        $id = $this->input->get('id');
        $this->usermodel->delete_data($id);
        redirect('master/user');
    }
}
