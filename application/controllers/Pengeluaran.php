<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
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
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $this->load->view('PengeluaranView');
        } else {
            redirect('Custom404');
        }
    }

    function get_detail_barang()
    {
        $kode = $this->input->post('brg');
        $x['brg'] = $this->mastermodel->get_detail_barang($kode);
        $this->load->view('DetailViewPengeluaran', $x);
    }

    public function requestby()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $data['brg'] = $this->mastermodel->get_data_barang();
            $data['kyw'] = $this->mastermodel->get_data_karyawan();
            $this->load->view('OKaryawanView', $data);
        } else {
            redirect('Custom404');
        }
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
        redirect('pengeluaran/requestby');
    }

    function remove($data)
    {
        $this->cart->update(array(
            'rowid'   => $data,
            'qty'     => 0
        ));
        redirect('pengeluaran/requestby');
    }

    function pengeluaran_kyw()
    {
        $cek = count($this->cart->contents());
        if ($cek > 0) {
            $tgl = $this->session->userdata('tgl');
            $karyawan = $this->session->userdata('karyawan');
            $keterangan = $this->session->userdata('keterangan');
            $this->transaksimodel->input_pengeluaran($tgl, $karyawan, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('sup');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            redirect('pengeluaran/requestby');
        } else {
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/pengeluaran/requestby';
            </script>";
        }
    }

    function opsional()
    {
        $data['brg'] = $this->mastermodel->get_data_barang();
        $this->load->view('OOpsionalView', $data);
    }

    function add_to_cart_opsional()
    {
        $tgl = $this->input->post('tgl');
        $keterangan = $this->input->post('keterangan');
        $brg = $this->input->post('brg');
        $qty = $this->input->post('qty');
        $ket = $this->input->post('ket');
        $this->session->set_userdata('tgl', $tgl);
        $this->session->set_userdata('keterangan', $keterangan);
        $this->session->set_userdata('brg', $brg);
        $this->session->set_userdata('qty', $qty);
        $this->session->set_userdata('ket', $ket);
        $barang = $this->mastermodel->get_detail_barang($brg);
        $a = $barang->row_array();
        $dataopsional = array(
            'id'      => $a['id_barang'],
            'kode'    => $a['kode_barang'],
            'qty'     => $this->input->post('qty'),
            'price'   => 0,
            'name'    => $a['nama_barang'],
            'units'   => $a['satuan'],
            'comment' => $this->input->post('ket'),
        );
        $this->cart->insert($dataopsional);
        redirect('pengeluaran/opsional');
    }

    function remove_data($dataopsional)
    {
        $this->cart->update(array(
            'rowid'   => $dataopsional,
            'qty'     => 0
        ));
        redirect('pengeluaran/opsional');
    }

    function pengeluaran_opsional()
    {
        $cek = count($this->cart->contents());
        if ($cek > 0) {
            $tgl = $this->session->userdata('tgl');
            $keterangan = $this->session->userdata('keterangan');
            $this->transaksimodel->input_pengeluaran_opsional($tgl, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            redirect('pengeluaran/opsional');
        } else {
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/pengeluaran/opsional';
            </script>";
        }
    }

    function dataHistory()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $this->session->set_userdata('from', $from);
        $this->session->set_userdata('to', $to);
        $x['data'] = $this->transaksimodel->history_pengeluaran($from, $to);
        $this->load->view('OHistoryView', $x);
    }

    function dataHistoryLain()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $this->session->set_userdata('from', $from);
        $this->session->set_userdata('to', $to);
        $x['data'] = $this->transaksimodel->history_pengeluaran_lain($from, $to);
        $this->load->view('OHistoryLainView', $x);
    }
}
