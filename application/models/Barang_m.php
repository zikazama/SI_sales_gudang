<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends Base_m {

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
    public $table = 'barang';

	// public function kurangi_stok($stok_berkurang,$where){
	// 	$this->db->where($where);
	// 	$this->db->set('stok', "stok-".$stok_berkurang , TRUE);
	// 	$this->db->update($this->table);
	// }
}