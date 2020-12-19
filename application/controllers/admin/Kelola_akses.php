<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_akses extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('akses_toko_m');
        $this->load->model('toko_m');
        $this->load->model('sales_m');
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
		$akses = $this->akses_toko_m->read_full()->result_array();
		$data = array(
			'konten' => 'admin/kelola_akses',
			'parsing' => array('akses' => $akses)
		);
		$this->load->view('_partials/template',$data);
    }
    
    public function tambah(){
		$toko = $this->toko_m->read()->result_array();
		$sales = $this->sales_m->read()->result_array();
		$parsing = array(
			'toko' => $toko,
			'sales' => $sales
		);
		$data = array(
			'konten' => 'admin/form_akses',
			'parsing' => $parsing
		
		);
		$this->load->view('_partials/template',$data);
    }

    public function aksi_tambah(){
		$data_akses = $this->input->post();
		if($this->akses_toko_m->create($data_akses)){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Akses Berhasil Ditambahkan'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Akses Gagal Ditambahkan'
			));
		}
		redirect(base_url('admin/kelola_akses'));
    }
    
    public function ubah($id_akses_toko){
		$akses = $this->akses_toko_m->read_where(array('id_akses_toko' => $id_akses_toko))->row_array();
		$toko = $this->toko_m->read()->result_array();
		$sales = $this->sales_m->read()->result_array();
		$data = array(
			'konten' => 'admin/form_akses',
			'parsing' => array('akses' => $akses, 'id_akses_toko' => $id_akses_toko,
			'toko' => $toko, 'sales' => $sales)
		);
		$this->load->view('_partials/template',$data);
	}

	public function aksi_ubah($id_akses_toko){
		$data_akses = $this->input->post();
		if($this->akses_toko_m->update($data_akses,array('id_akses_toko' => $id_akses_toko))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Akses Berhasil Diubah'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Akses Gagal Diubah'
			));
		}
		redirect(base_url('admin/kelola_akses'));
	}
    
    public function hapus($id_akses_toko){
		if($this->akses_toko_m->delete(array('id_akses_toko' => $id_akses_toko))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Akses Berhasil Dihapus'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Akses Gagal Dihapus'
			));
		}
		redirect(base_url('admin/kelola_akses'));
	}

}
