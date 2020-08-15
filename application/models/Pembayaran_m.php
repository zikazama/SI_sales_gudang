<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_m extends Base_m {

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
    public $table = 'pembayaran';

	public function pembayaran_masuk($where){
		$this->db->select('SUM(jumlah_pembayaran) as pembayaran_masuk');
		$this->db->from($this->table);
		$this->db->where($where);
		return $this->db->get();
	}
}