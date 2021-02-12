<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_transaksi_m extends Base_m {

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
    public $table = 'item_transaksi';

	public function read_full_where($where){
		$this->db->select('*, item_transaksi.created_at as waktu');
		$this->db->from($this->table);
		$this->db->join('barang','barang.id_barang = item_transaksi.id_barang');
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = item_transaksi.id_transaksi_sales');
		$this->db->where($where);
		return $this->db->get();
	}

	public function read_print(){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = item_transaksi.id_transaksi_sales');
		$this->db->join('sales','sales.id_sales = transaksi_sales.id_sales');
		$this->db->join('barang','barang.id_barang = item_transaksi.id_barang');
		return $this->db->get();
	}

	public function grand_total(){
		$this->db->select('sum(subtotal) as subtotal, sum(subdiskon) as subdiskon');
		$this->db->from($this->table);
		return $this->db->get();
	}

	public function read_print_where($where){
		$this->db->select('*, item_transaksi.created_at as tanggal_transaksi');
		$this->db->from($this->table);
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = item_transaksi.id_transaksi_sales');
		$this->db->join('sales','sales.id_sales = transaksi_sales.id_sales');
		$this->db->join('barang','barang.id_barang = item_transaksi.id_barang');
		$this->db->join('toko','toko.id_toko = transaksi_sales.id_toko');
		$this->db->where($where);
		return $this->db->get();
	}

	public function grand_total_where($where){
		$this->db->select('sum(subtotal) as subtotal, sum(subdiskon) as subdiskon');
		$this->db->from($this->table);
		$this->db->where($where);
		return $this->db->get();
	}

	public function read_not_in($in,$where){
		$this->db->select('*, item_transaksi.created_at as waktu');
		$this->db->from($this->table);
		$this->db->join('barang','barang.id_barang = item_transaksi.id_barang');
		$this->db->join('transaksi_sales','transaksi_sales.id_transaksi_sales = item_transaksi.id_transaksi_sales');
		$this->db->where_not_in('id_item_transaksi', $in);
		$this->db->where($where);
		return $this->db->get();
	}

	public function cek_sisa_item($in,$where){
		$this->db->from($this->table);
		$this->db->where_not_in('id_item_transaksi', $in);
		$this->db->where($where);
		return $this->db->get();
	}
}