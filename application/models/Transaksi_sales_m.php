<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_sales_m extends Base_m
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
	public $table = 'transaksi_sales';

	public function penjualan_hari()
	{
		$this->db->select('sum(total) as nilai');
		$this->db->from($this->table);
		return $this->db->get();
	}

	public function penjualan_hari_where($where)
	{
		$this->db->select('sum(total) as nilai');
		$this->db->from($this->table);
		$this->db->where($where);
		return $this->db->get();
	}

	public function transaksi_hari()
	{
		$this->db->select('count(total) as nilai');
		$this->db->from($this->table);
		return $this->db->get();
	}

	public function transaksi_hari_where($where)
	{
		$this->db->select('count(total) as nilai');
		$this->db->from($this->table);
		$this->db->where($where);
		return $this->db->get();
	}

	public function barang_hari()
	{
		$this->db->select('sum(item_transaksi.kuantitas) as nilai');
		$this->db->from('item_transaksi');
		$this->db->join($this->table, 'item_transaksi.id_item_transaksi = transaksi_sales.id_transaksi_sales');
		//$this->db->group_by('transaksi_sales.id_transaksi_sales');
		return $this->db->get();
	}

	public function barang_hari_where($where)
	{
		$this->db->select('sum(item_transaksi.kuantitas) as nilai');
		$this->db->from('item_transaksi');
		$this->db->join($this->table, 'item_transaksi.id_item_transaksi = transaksi_sales.id_transaksi_sales');
		//$this->db->group_by('transaksi_sales.id_transaksi_sales');
		$this->db->where($where);
		return $this->db->get();
	}

	public function read_full()
	{
		$this->db->select('*, transaksi_sales.created_at as waktu');
		$this->db->from($this->table);
		$this->db->join('sales', 'sales.id_sales = transaksi_sales.id_sales');
		$this->db->join('toko', 'toko.id_toko = transaksi_sales.id_toko');
		return $this->db->get();
	}

	public function read_full_where($where)
	{
		$this->db->select('*, transaksi_sales.created_at as waktu');
		$this->db->from($this->table);
		$this->db->join('sales', 'sales.id_sales = transaksi_sales.id_sales');
		$this->db->join('toko', 'toko.id_toko = transaksi_sales.id_toko','RIGHT');
		$this->db->where($where);
		return $this->db->get();
	}

	public function read_bulan_ini()
	{
		return $this->db->query("SELECT *, transaksi_sales.created_at as waktu 
		from transaksi_sales join sales on sales.id_sales = transaksi_sales.id_sales 
		WHERE MONTH(transaksi_sales.created_at) = MONTH(CURDATE())");
	}

	public function read_minggu_ini()
	{
		return $this->db->query("SELECT *, transaksi_sales.created_at as waktu 
			from transaksi_sales join sales on sales.id_sales = transaksi_sales.id_sales 
			WHERE DATE(transaksi_sales.created_at) < DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
	}
}
