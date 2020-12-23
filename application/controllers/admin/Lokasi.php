<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('toko_m');
		if($this->session->userdata('role') != null){
			if($this->session->userdata('role') != 'admin'){
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
		$toko = $this->toko_m->read()->result_array();
		$data = array(
            'js' => 'admin/js_lokasi_toko',
			'konten' => 'admin/lokasi_toko',
			'parsing' => array('toko' => $toko)
		);
		$this->load->view('_partials/template',$data);
	}
}
