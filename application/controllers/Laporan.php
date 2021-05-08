<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('LaporanModel', 'laporanmodel');
    }

    function index()
    {
        $bln = $this->input->post('bln');
        if ($bln == true) {
            $before = date("Y-m", strtotime('-1 month', strtotime($bln)));
        }
        $x['data'] = $this->laporanmodel->tampilstok($bln, $before);
        $this->load->view('laporan/laporanlogistik', $x);
    }

    function laporanDivisi()
    {
        $bln = $this->input->post('bln');
        $iddivisi = $this->input->post('iddivisi');
        $x['data'] = $this->laporanmodel->laporanpemakaian($bln, $iddivisi);
        $this->load->view('laporan/laporandivisi', $x);
    }
}
