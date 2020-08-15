<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct(){
		parent::__construct();
		if($this->session->userdata('role') != null){
			if($this->session->userdata('role') == 'sales'){
				redirect(base_url('home'));
			}
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Maaf anda harus login terlebih dahulu!'
			));
			redirect(base_url('admin/login'));
		}
	}

	public function index()
	{
		$this->load->model('transaksi_sales_m');
		$tanggal_ini = date('Y-m-d');
		$penjualan_hari = $this->transaksi_sales_m->penjualan_hari_where(array('date(transaksi_sales.created_at)' => $tanggal_ini))->result_array();
		$transaksi_hari = $this->transaksi_sales_m->transaksi_hari_where(array('date(transaksi_sales.created_at)' => $tanggal_ini))->result_array();
		$barang_hari = $this->transaksi_sales_m->barang_hari_where(array('date(transaksi_sales.created_at)' => $tanggal_ini))->result_array();
		$penjualan = $this->transaksi_sales_m->penjualan_hari()->result_array();
		$transaksi = $this->transaksi_sales_m->transaksi_hari()->result_array();
		$barang = $this->transaksi_sales_m->barang_hari()->result_array();
		$data = array(
			'konten' => 'admin/home',
			'parsing' => array(
				'penjualan_hari' => $penjualan_hari,
				'transaksi_hari' => $transaksi_hari,
				'barang_hari' => $barang_hari,
				'penjualan' => $penjualan,
				'transaksi' => $transaksi,
				'barang' => $barang
			)
		);
		$this->load->view('_partials/template',$data);
	}
}
