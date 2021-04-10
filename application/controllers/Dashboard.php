<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
		$x['data'] = $this->transaksimodel->tampil_permintaan();
		$this->load->view('DashboardView', $x);
	}
}
