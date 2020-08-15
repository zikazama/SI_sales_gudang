<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_sales extends CI_Controller {

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
		$this->load->model('sales_m');
		$sales = $this->sales_m->read()->result_array();
		$data = array(
			'konten' => 'admin/kelola_sales',
			'parsing' => array('sales' => $sales)
		);
		$this->load->view('_partials/template',$data);
	}

	public function tambah(){
		$data = array(
			'konten' => 'admin/form_sales'
		);
		$this->load->view('_partials/template',$data);
	}

	private function upload_foto($nama,$form){
        $config['upload_path']          = './upload/sales/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = $nama;
        $config['overwrite']			= true;
        $config['max_size']             = 2048; // 1MB
        $config['encrypt_name'] = TRUE;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($form)) {
            return $this->upload->data("file_name");
        }
        
        return null;
    }

	public function aksi_tambah(){
		$this->load->model('sales_m');
		$data_sales = $this->input->post();
		$data_sales['foto'] = $this->upload_foto('nama','foto');
		if($this->sales_m->create($data_sales)){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Sales Berhasil Ditambahkan'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Sales Gagal Ditambahkan'
			));
		}
		redirect(base_url('admin/kelola_sales'));
	}

	public function ubah($id_sales){
		$this->load->model('sales_m');
		$sales = $this->sales_m->read_where(array('id_sales' => $id_sales))->result_array();
		$data = array(
			'konten' => 'admin/form_sales',
			'parsing' => array('sales' => $sales)
		);
		$this->load->view('_partials/template',$data);
	}

	public function aksi_ubah($id_sales){
		$this->load->model('sales_m');
		$data_sales = $this->input->post();
		$foto = $this->upload_foto('nama','foto');
		if($foto != null){
			$data_sales['foto'] = $foto;
		}
		if($this->sales_m->update($data_sales,array('id_sales' => $id_sales))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Sales Berhasil Diubah'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Sales Gagal Diubah'
			));
		}
		redirect(base_url('admin/kelola_sales'));
	}

	public function hapus($id_sales){
		$this->load->model('sales_m');
		if($this->sales_m->delete(array('id_sales' => $id_sales))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Sales Berhasil Dihapus'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Sales Gagal Dihapus'
			));
		}
		redirect(base_url('admin/kelola_sales'));
	}
}
