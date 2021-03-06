<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
			$x['user'] = $this->usermodel->get_non_active();
			$x['data'] = $this->transaksimodel->tampil_permintaan();
			$this->load->view('DashboardView', $x);
		} else {
			redirect('Custom404');
		}
	}
}
