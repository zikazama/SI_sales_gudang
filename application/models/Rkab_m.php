<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkab_m extends Base_m {

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
	public $table = 'rkab';
	
	public function read_full()
	{
		$this->db->from($this->table);
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = rkab.id_transaksi_sales');
		$this->db->join('toko','toko.id_toko = transaksi_sales.id_toko');
		$this->db->join('rkab_item','rkab_item.id_rkab = rkab.id_rkab');
		$this->db->join('driver','rkab_item.id_driver = driver.id_driver');
		return $this->db->get();
	}

	public function read_full_status()
	{
		$this->db->from($this->table);
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = rkab.id_transaksi_sales');
		$this->db->join('toko','toko.id_toko = transaksi_sales.id_toko');
		$this->db->join('rkab_item','rkab_item.id_rkab = rkab.id_rkab');
		$this->db->join('driver','rkab_item.id_driver = driver.id_driver');
		$this->db->where_in(array('1','2'));
		$this->db->order_by('rkab.id_rkab','DESC');
		return $this->db->get();
	}

	public function read_full_status_where($where)
	{
		$this->db->from($this->table);
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = rkab.id_transaksi_sales');
		$this->db->join('toko','toko.id_toko = transaksi_sales.id_toko');
		$this->db->join('rkab_item','rkab_item.id_rkab = rkab.id_rkab');
		$this->db->join('driver','rkab_item.id_driver = driver.id_driver');
		$this->db->where_in(array('1','2'));
		$this->db->where($where);
		$this->db->order_by('rkab.id_rkab','DESC');
		return $this->db->get();
	}

	public function read_full_where($where)
	{
		$this->db->from($this->table);
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = rkab.id_transaksi_sales');
		$this->db->join('toko','toko.id_toko = transaksi_sales.id_toko');
		$this->db->join('rkab_item','rkab_item.id_rkab = rkab.id_rkab');
		$this->db->join('driver','rkab_item.id_driver = driver.id_driver');
		$this->db->where($where);
		return $this->db->get();
	}

}