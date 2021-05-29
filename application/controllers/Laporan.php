<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('administrator');
            redirect($url);
        }
        $this->load->model('LaporanModel', 'laporanmodel');
    }

    function index()
    {
        error_reporting(0);
        $bln = $this->input->post('bln');
        $this->session->set_userdata('bln', $bln);
        if ($bln == true) {
            $before = date("Y-m", strtotime('-1 month', strtotime($bln)));
        }
        $x['data'] = $this->laporanmodel->tampilstok($bln, $before);
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Stok_Bulanan.xls");
        $this->load->view('laporan/laporanlogistik', $x);
    }

    function laporanDivisi()
    {
        $bln = $this->input->post('bln');
        $iddivisi = $this->input->post('iddivisi');
        $x['data'] = $this->laporanmodel->laporanpemakaian($bln, $iddivisi);
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Habis_Pakai.xls");
        $this->load->view('laporan/laporandivisi', $x);
    }
}
