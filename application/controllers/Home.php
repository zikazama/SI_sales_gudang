<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_sales_m');
		$this->load->model('rkab_m');
		$this->load->model('rkab_item_m');
		if ($this->session->userdata('role') != null) {
			if ($this->session->userdata('role') == 'admin') {
				redirect(base_url('admin/home'));
			}
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Maaf anda harus login terlebih dahulu!'
			));
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'sales') {
			$id_user = $this->session->userdata('id');
			$tanggal_ini = date('Y-m-d');
			$penjualan_hari = $this->transaksi_sales_m->penjualan_hari_where(array('id_sales' => $id_user, 'date(transaksi_sales.created_at)' => $tanggal_ini, 'status' => 'diterima'))->result_array();
			$transaksi_hari = $this->transaksi_sales_m->transaksi_hari_where(array('id_sales' => $id_user, 'date(transaksi_sales.created_at)' => $tanggal_ini, 'status' => 'diterima'))->result_array();
			$barang_hari = $this->transaksi_sales_m->barang_hari_where(array('id_sales' => $id_user, 'date(transaksi_sales.created_at)' => $tanggal_ini, 'status' => 'diterima'))->result_array();
			$data = array(
				'konten' => 'sales/home',
				'parsing' => array(
					'penjualan_hari' => $penjualan_hari,
					'transaksi_hari' => $transaksi_hari,
					'barang_hari' => $barang_hari
				)
			);
		} else if ($this->session->userdata('role') == 'driver') {
			$id_user = $this->session->userdata('id');
			$pengiriman_diproses = $this->rkab_item_m->read_only_where(array(
				'rkab_item.id_driver' => $id_user,
				'rkab.status_proses' => 1	
			))->num_rows();
			$pengiriman_diantar = $this->rkab_item_m->read_only_where(array(
				'rkab_item.id_driver' => $id_user,
				'rkab.status_proses' => 2
				))->num_rows();
			$data = array(
				'konten' => 'driver/home',
				'parsing' => array(
					'pengiriman_diproses' => $pengiriman_diproses,
					'pengiriman_diantar' => $pengiriman_diantar
				)
			);
		}
		$this->load->view('_partials/template', $data);
	}
}
