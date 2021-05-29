<?php
class Administrator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'usermodel');
        $this->load->model('MasterModel', 'mastermodel');
    }

    function index()
    {
        $x['kyw'] = $this->mastermodel->get_data_karyawan();
        $this->load->view('LoginView', $x);
        $this->session->sess_destroy();
    }
    function auth()
    {
        $idpersonal = $this->input->post('idpersonal');
        $p = $idpersonal;
        $cadmin = $this->usermodel->cek_admin($p);
        if ($cadmin->num_rows() > 0) {
            $this->session->set_userdata('masuk', true);
            $xcadmin = $cadmin->row_array();
            if ($xcadmin['level_akses'] == 1)
                $this->session->set_userdata('akses', '1');
            if ($xcadmin['level_akses'] == 2)
                $this->session->set_userdata('akses', '2');
            if ($xcadmin['level_akses'] == 3)
                $this->session->set_userdata('akses', '3');
            $idadmin = $xcadmin['id_user'];
            $user_nama = $xcadmin['nama_user'];
            $divisi = $xcadmin['id_divisi'];
            $this->session->set_userdata('idadmin', $idadmin);
            $this->session->set_userdata('nama', $user_nama);
            $this->session->set_userdata('divisi', $divisi);
        }
        if ($this->session->userdata('masuk') == true) {
            redirect('administrator/berhasillogin');
        } else {
            redirect('administrator/gagallogin');
        }
    }
    function berhasillogin()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            redirect('dashboard');
        } elseif ($this->session->userdata('akses') == '3') {
            redirect('permintaan');
        } else {
            echo "<script>
                alert('Tidak Memiliki Akses');
                window.location.href='/portal';
            </script>";
        }
    }
    function gagallogin()
    {
        echo "<script>
                alert('Personal ID anda salah');
                window.location.href='/portal';
            </script>";
    }
    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('administrator');
        redirect($url);
    }
}
