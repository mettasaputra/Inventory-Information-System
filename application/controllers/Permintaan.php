<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        }
        $this->load->model('TransaksiModel', 'transaksimodel');
        $this->load->model('MasterModel', 'mastermodel');
        $this->load->model('UserModel', 'usermodel');
        $this->load->library('cart');
        $this->cart->product_name_rules = '\d\D';
        $this->cart->product_id_rules = '\d\D';
    }

    function index()
    {
        $x['user'] = $this->mastermodel->get_user();
        $x['brg'] = $this->mastermodel->get_data_barang();
        $this->load->view('PermintaanView', $x);
    }

    function karyawan()
    {
        $this->cart->destroy();
        $x['user'] = $this->mastermodel->get_user();
        $x['brg'] = $this->mastermodel->get_data_barang();
        $this->load->view('PermintaanView', $x);
    }

    function detail_permintaan()
    {
        $this->cart->destroy();
        $x['data'] = $this->transaksimodel->get_detail_permintaan();
        $this->load->view('PermintaanKaryawanView', $x);
    }

    function get_detail_barang()
    {
        $kode = $this->input->post('brg');
        $x['brg'] = $this->mastermodel->get_detail_barang($kode);
        $this->load->view('DetailViewPengeluaran', $x);
    }

    function add_to_cart()
    {
        $tgl = $this->input->post('tgl');
        $karyawan = $this->input->post('karyawan');
        $keterangan = $this->input->post('keterangan');
        $brg = $this->input->post('brg');
        $qty = $this->input->post('qty');
        $ket = $this->input->post('ket');
        $this->session->set_userdata('tgl', $tgl);
        $this->session->set_userdata('karyawan', $karyawan);
        $this->session->set_userdata('keterangan', $keterangan);
        $this->session->set_userdata('brg', $brg);
        $this->session->set_userdata('qty', $qty);
        $this->session->set_userdata('ket', $ket);
        $barang = $this->mastermodel->get_detail_barang($brg);
        $a = $barang->row_array();
        $datapermintaan = array(
            'id'      => $a['id_barang'],
            'kode'    => $a['kode_barang'],
            'qty'     => $this->input->post('qty'),
            'price'   => 0,
            'name'    => $a['nama_barang'],
            'units'   => $a['satuan'],
            'comment' => $this->input->post('ket'),
        );
        $this->cart->insert($datapermintaan);
        redirect('permintaan');
    }

    function remove_row($datapermintaan)
    {
        $this->cart->update(array(
            'rowid'   => $datapermintaan,
            'qty'     => 0
        ));
        redirect('permintaan');
    }

    function remove()
    {
        $id = $this->input->get('id');
        $idbrg = $this->input->get('idbrg');
        $this->transaksimodel->delete($idbrg, $id);
        redirect('permintaan/detail?id=' . $id);
    }

    function permintaan_karyawan()
    {
        $cek = count($this->cart->contents());
        if ($cek > 0) {
            $tgl = $this->session->userdata('tgl');
            $karyawan = $this->session->userdata('karyawan');
            $keterangan = $this->session->userdata('keterangan');
            $this->transaksimodel->input_permintaan($tgl, $karyawan, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('karyawan');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            redirect('permintaan');
        } else {
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/permintaan';
            </script>";
        }
    }

    function detail()
    {
        $id = $this->input->get('id');
        $x['req'] = $this->transaksimodel->permintaan($id);
        $row = $this->transaksimodel->permintaan($id);
        $result = $row->row_array();
        $this->session->set_userdata('tgl', $result['tanggal_kebutuhan']);
        $this->session->set_userdata('kyw', $result['request_by']);
        $this->session->set_userdata('ket', $result['ket']);
        $dt = $this->transaksimodel->detail_permintaan($id);
        $this->cart->destroy();
        foreach ($dt->result_array() as $a) {
            $data = array(
                'id'      => $a['id_barang'],
                'kode'    => $a['kode_barang'],
                'qty'     => $a['jumlah'],
                'price'   => 0,
                'name'    => $a['nama_barang'],
                'units'   => $a['satuan'],
                'comment' => $a['keterangan'],
            );
            $this->cart->insert($data);
        }
        $x['user'] = $this->mastermodel->get_user();
        $this->load->view('AccKaryawanView', $x);
    }

    function into_pengeluaran()
    {
        $cek = count($this->cart->contents());
        $id = $this->input->get('id');
        if ($cek > 0) {
            $tgl = Date('Y-m-d');
            $karyawan = $this->session->userdata('kyw');
            $keterangan = $this->session->userdata('ket');
            $this->transaksimodel->input_pengeluaran($tgl, $karyawan, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('karyawan');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            $this->transaksimodel->deletepermintaan($id);
            redirect('dashboard');
        } else {
            $this->transaksimodel->deletepermintaan($id);
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/dashboard';
            </script>";
        }
    }

    function delete_permintaan()
    {
        $id = $this->input->get('id');
        $this->transaksimodel->deletepermintaan($id);
        redirect('dashboard');
    }
}
