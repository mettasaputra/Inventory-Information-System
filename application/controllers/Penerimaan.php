<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransaksiModel', 'transaksimodel');
        $this->load->model('MasterModel', 'mastermodel');
        $this->load->library('session');
        $this->load->library('cart');
        $this->cart->product_name_rules = '\d\D';
        $this->cart->product_id_rules = '\d\D';
    }

    function index()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $this->load->view('PenerimaanView');
        } else {
            redirect('Custom404');
        }
    }

    function get_detail_barang()
    {
        $kode = $this->input->post('brg');
        $x['brg'] = $this->mastermodel->get_detail_barang($kode);
        $this->load->view('DetailViewPenerimaan', $x);
    }

    function supplier()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $data['brg'] = $this->mastermodel->get_data_barang();
            $data['supplier'] = $this->mastermodel->get_data_supplier();
            $this->load->view('PSupplierView', $data);
        } else {
            redirect('Custom404');
        }
    }

    function add_to_cart()
    {
        $tgl = $this->input->post('tgl');
        $sup = $this->input->post('sup');
        $keterangan = $this->input->post('keterangan');
        $brg = $this->input->post('brg');
        $qty = $this->input->post('qty');
        $ket = $this->input->post('ket');
        $this->session->set_userdata('tgl', $tgl);
        $this->session->set_userdata('sup', $sup);
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
        redirect('penerimaan/supplier');
    }

    function remove($data)
    {
        // $row_id = $this->uri->segment(4);
        $this->cart->update(array(
            'rowid'   => $data,
            'qty'     => 0
        ));
        redirect('penerimaan/supplier');
    }

    function penerimaan_supplier()
    {
        $cek = count($this->cart->contents());
        if ($cek > 0) {
            $tgl = $this->session->userdata('tgl');
            $sup = $this->session->userdata('sup');
            $keterangan = $this->session->userdata('keterangan');
            $this->transaksimodel->input_penerimaan($tgl, $sup, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('sup');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            redirect('penerimaan/supplier');
        } else {
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/penerimaan/supplier';
            </script>";
        }
    }

    function opsional()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $data['brg'] = $this->mastermodel->get_data_barang();
            $data['kyw'] = $this->mastermodel->get_data_karyawan();
            $this->load->view('POpsionalView', $data);
        } else {
            redirect('Custom404');
        }
    }

    function add_to_cart_opsional()
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
        redirect('penerimaan/opsional');
    }

    function remove_data($dataopsional)
    {
        $this->cart->update(array(
            'rowid'   => $dataopsional,
            'qty'     => 0
        ));
        redirect('penerimaan/opsional');
    }

    function penerimaan_opsional()
    {
        $cek = count($this->cart->contents());
        if ($cek > 0) {
            $tgl = $this->session->userdata('tgl');
            $karyawan = $this->session->userdata('karyawan');
            $keterangan = $this->session->userdata('keterangan');
            $this->transaksimodel->input_opsional($tgl, $karyawan, $keterangan);
            $this->session->unset_userdata('tgl');
            $this->session->unset_userdata('karyawan');
            $this->session->unset_userdata('keterangan');
            $this->cart->destroy();

            redirect('penerimaan/opsional');
        } else {
            echo "<script>
                alert('Tidak ada data yang diinput!');
                window.location.href='/portal/penerimaan/opsional';
            </script>";
        }
    }

    function dataHistory()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $this->session->set_userdata('from', $from);
            $this->session->set_userdata('to', $to);
            $x['data'] = $this->transaksimodel->history_penerimaan($from, $to);
            $this->load->view('PHistoryView', $x);
        } else {
            redirect('Custom404');
        }
    }

    function dataHistoryOpsional()
    {
        if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $this->session->set_userdata('from', $from);
            $this->session->set_userdata('to', $to);
            $x['data'] = $this->transaksimodel->history_penerimaan_lain($from, $to);
            $this->load->view('PHistoryLainView', $x);
        } else {
            redirect('Custom404');
        }
    }
}
