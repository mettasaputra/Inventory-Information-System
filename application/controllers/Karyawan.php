<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
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
            $nama = $this->input->post('nama');
            $nik = $this->input->post('nik');
            $divisi = $this->input->post('divisi');
            $this->mastermodel->input_karyawan($divisi, $nama, $nik);
            redirect('master/karyawan');
        } else {
            redirect('Custom404');
        }
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
        $nama = $this->input->get('nama');
        $data = $this->mastermodel->get_id_karyawan($id);
        $cek = $data->num_rows();
        if ($cek > 0) {
            echo "<script>
                alert('Data tidak bisa dihapus karena ada transaksi!');
                window.location.href='/portal/master/karyawan';
            </script>";
        } else {
            $this->mastermodel->delete_karyawan($id, $nama);
            redirect('master/karyawan');
        }
    }
}
