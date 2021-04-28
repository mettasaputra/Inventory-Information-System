<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('LaporanModel', 'laporanmodel');
    }

    public function index()
    {
        $bln = $this->input->post('bln');
        $x['data'] = $this->laporanmodel->tampilstok($bln);
        $this->load->view('laporan/laporanlogistik', $x);
    }

    public function laporanDivisi()
    {
        $idbarang = $this->input->post('idbrg');
        $iddivisi = $this->input->post('iddivisi');
        $this->laporanmodel->laporanpemakaian($idbarang, $iddivisi);
    }
}
