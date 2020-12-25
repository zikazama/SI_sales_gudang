{<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkab_item_m extends Base_m {

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
	public $table = 'rkab_item';
	
	public function read_driver(){
		$this->db->from($this->table);
		$this->db->join('driver','driver.id_driver = rkab_item.id_driver');
		$this->db->group_by('id_driver');
		return $this->db->get();
	}

	public function read_driver_where($where){
		$this->db->from($this->table);
		$this->db->join('driver','driver.id_driver = rkab_item.id_driver');
		$this->db->where($where);
		$this->db->group_by('id_driver');
		return $this->db->get();
	}

	public function read_full_where($where){
		$this->db->from($this->table);
		$this->db->join('driver','driver.id_driver = rkab_item.id_driver');
		$this->db->join('item_transaksi','item_transaksi.id_item_transaksi = rkab_item.id_item_transaksi');
		$this->db->join('barang','item_transaksi.id_barang = barang.id_barang');
		$this->db->where($where);
		return $this->db->get();
	}

	public function read_only_where($where){
		$this->db->from($this->table);
		$this->db->join('rkab','rkab.id_rkab = rkab_item.id_rkab');
		$this->db->where($where);
		return $this->db->get();
	}

}