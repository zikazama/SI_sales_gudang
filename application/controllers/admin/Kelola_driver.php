<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_driver extends CI_Controller {

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
		$this->load->model('driver_m');
		$driver = $this->driver_m->read()->result_array();
		$data = array(
			'konten' => 'admin/kelola_driver',
			'parsing' => array('driver' => $driver)
		);
		$this->load->view('_partials/template',$data);
	}

	public function tambah(){
		$data = array(
			'konten' => 'admin/form_driver'
		);
		$this->load->view('_partials/template',$data);
	}

	private function upload_foto($nama,$form){
        $config['upload_path']          = './upload/driver/';
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
		$this->load->model('driver_m');
		$data_driver = $this->input->post();
		$data_driver['foto'] = $this->upload_foto('nama','foto');
		if($this->driver_m->create($data_driver)){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Driver Berhasil Ditambahkan'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Driver Gagal Ditambahkan'
			));
		}
		redirect(base_url('admin/kelola_driver'));
	}

	public function ubah($id_driver){
		$this->load->model('driver_m');
		$driver = $this->driver_m->read_where(array('id_driver' => $id_driver))->result_array();
		$data = array(
			'konten' => 'admin/form_driver',
			'parsing' => array('driver' => $driver)
		);
		$this->load->view('_partials/template',$data);
	}

	public function aksi_ubah($id_driver){
		$this->load->model('driver_m');
		$data_driver = $this->input->post();
		$foto = $this->upload_foto('nama','foto');
		if($foto != null){
			$data_driver['foto'] = $foto;
		}
		if($this->driver_m->update($data_driver,array('id_driver' => $id_driver))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Driver Berhasil Diubah'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Driver Gagal Diubah'
			));
		}
		redirect(base_url('admin/kelola_driver'));
	}

	public function hapus($id_driver){
		$this->load->model('driver_m');
		if($this->driver_m->delete(array('id_driver' => $id_driver))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Driver Berhasil Dihapus'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Driver Gagal Dihapus'
			));
		}
		redirect(base_url('admin/kelola_driver'));
	}
}
