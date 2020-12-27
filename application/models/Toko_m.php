<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko_m extends Base_m {

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
    public $table = 'toko';

	public function read_akses(){
		$this->db->from($this->table);
		$this->db->join('akses_toko','akses_toko.id_toko = toko.id_toko');
		return $this->db->get();
	}

	public function read_akses_where($where){
		$this->db->from($this->table);
		$this->db->join('akses_toko','akses_toko.id_toko = toko.id_toko');
		$this->db->where($where);
		return $this->db->get();
	}

}