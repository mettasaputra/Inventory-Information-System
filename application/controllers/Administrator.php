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
        $x['user'] = $this->usermodel->get_data_user();
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
                alert('Personal ID anda salah atau belum terdaftar');
                window.location.href='/portal';
            </script>";
    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('administrator');
        redirect($url);
    }

    function lupa()
    {
        $nama = $this->input->post('nama');
        $status = $this->input->post('status');
        $this->usermodel->lupa_password($nama, $status);
        echo "<script>
                alert('Terima kasih! Harap menunggu informasi dari bagian yang berwenang!');
                window.location.href='/portal';
        </script>";
    }

    function registrasi()
    {
        $nama = $this->input->post('nama');
        $personal = $this->input->post('personal');
        $level = $this->input->post('level');
        $this->usermodel->registrasi($nama, $personal, $level);
        echo "<script>
                alert('Terima kasih! Harap menunggu informasi dari bagian yang berwenang!');
                window.location.href='/portal';
        </script>";
    }
}
