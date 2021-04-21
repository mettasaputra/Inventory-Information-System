<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel', 'transaksimodel');
        $this->load->model('MasterModel', 'mastermodel');
        $this->load->model('UserModel', 'usermodel');
        $this->load->library('cart');
        $this->cart->product_name_rules = '\d\D';
        $this->cart->product_id_rules = '\d\D';
    }

    public function index()
    {
        $x['brg'] = $this->mastermodel->get_data_barang();
        $this->load->view('PermintaanView', $x);
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
        $data = array(
            'id'      => $a['id_barang'],
            'kode'    => $a['kode_barang'],
            'qty'     => $this->input->post('qty'),
            'price'   => 0,
            'name'    => $a['nama_barang'],
            'units'   => $a['satuan'],
            'comment' => $this->input->post('ket'),
        );
        $this->cart->insert($data);
        redirect('permintaan');
    }

    function remove()
    {
        $id = $this->input->post('idpermintaan');
        $ids = $this->session->userdata('idpermintaan');
        $idbrg = $this->input->post('id');
        $this->transaksimodel->delete($idbrg, $id);
        redirect('permintaan/detail?id=' . $ids);
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
        $this->load->view('AccKaryawanView', $x);
    }

    function into_pengeluaran()
    {
        $cek = count($this->cart->contents());
        if ($cek > 0) {
            $tgl = $this->session->userdata('tgl');
            $karyawan = $this->session->userdata('kyw');
            $keterangan = $this->session->userdata('ket');
            $this->transaksimodel->input_pengeluaran($tgl, $karyawan, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('karyawan');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            redirect('permintaan/detail');
        } else {
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/permintaan/detail';
            </script>";
        }
    }
}
