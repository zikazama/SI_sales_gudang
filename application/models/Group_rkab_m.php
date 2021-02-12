<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_rkab_m extends Base_m {

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
	public $table = 'group_rkab';

	public function read_full()
	{
		$this->db->from($this->table);
		$this->db->join('driver','driver.id_driver = group_rkab.id_driver');
		return $this->db->get();
	}

	public function read_full_where($where)
	{
		$this->db->from($this->table);
		$this->db->join('driver','driver.id_driver = group_rkab.id_driver');
		$this->db->where($where);
		return $this->db->get();
	}
	
	public function read_print_where($where){
		$this->db->select('*, sum(kuantitas) as kuantitas_group, sum(kuantitas_perbox) as kuantitas_perbox_group');
		$this->db->from($this->table);
		$this->db->join('rkab_item','rkab_item.id_group_rkab = group_rkab.id_group_rkab');
		$this->db->join('item_transaksi','item_transaksi.id_transaksi_sales = rkab_item.id_transaksi_sales');
		$this->db->join('barang','barang.id_barang = item_transaksi.id_barang');
		$this->db->join('driver','driver.id_driver = group_rkab.id_driver');
		$this->db->where($where);
		$this->db->group_by('item_transaksi.id_barang');
		return $this->db->get();
	}

	public function read_list_no_faktur($where){
		$this->db->distinct();
		$this->db->select('transaksi_sales.id_transaksi_sales');
		$this->db->from($this->table);
		$this->db->join('rkab_item','rkab_item.id_group_rkab = group_rkab.id_group_rkab');
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = rkab_item.id_transaksi_sales');
		$this->db->where($where);
		return $this->db->get();
	}

}