<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_toko extends CI_Controller {

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
    public function __construct(){
		parent::__construct();
		if($this->session->userdata('role') != null){
			if($this->session->userdata('role') == 'sales'){
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
		$this->load->model('toko_m');
		$toko = $this->toko_m->read()->result_array();
		$data = array(
			'konten' => 'admin/kelola_toko',
			'parsing' => array('toko' => $toko)
		);
		$this->load->view('_partials/template',$data);
    }
    
    public function tambah(){
		$data = array(
			'konten' => 'admin/form_toko'
		);
		$this->load->view('_partials/template',$data);
    }
    
    public function aksi_tambah(){
		$this->load->model('toko_m');
        $data_toko = $this->input->post();
        $data_toko['kode_toko'] = mt_rand(100000, 999999);
		if($this->toko_m->create($data_toko)){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Toko Berhasil Ditambahkan'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Toko Gagal Ditambahkan'
			));
		}
		redirect(base_url('admin/kelola_toko'));
    }
    
    public function ubah($id_toko){
		$this->load->model('toko_m');
		$toko = $this->toko_m->read_where(array('id_toko' => $id_toko))->result_array();
		$data = array(
			'konten' => 'admin/form_toko',
			'parsing' => array('toko' => $toko)
		);
		$this->load->view('_partials/template',$data);
	}

	public function aksi_ubah($id_toko){
		$this->load->model('toko_m');
		$data_toko = $this->input->post();
		if($this->toko_m->update($data_toko,array('id_toko' => $id_toko))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Toko Berhasil Diubah'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Toko Gagal Diubah'
			));
		}
		redirect(base_url('admin/kelola_toko'));
	}

	public function hapus($id_toko){
		$this->load->model('toko_m');
		if($this->toko_m->delete(array('id_toko' => $id_toko))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Toko Berhasil Dihapus'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Toko Gagal Dihapus'
			));
		}
		redirect(base_url('admin/kelola_toko'));
	}
}
