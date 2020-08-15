<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_barang extends CI_Controller {

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
		$this->load->model('barang_m');
		$barang = $this->barang_m->read()->result_array();
		$data = array(
			'konten' => 'admin/kelola_barang',
			'parsing' => array('barang' => $barang)
		);
		$this->load->view('_partials/template',$data);
	}

	public function tambah(){
		$data = array(
			'konten' => 'admin/form_barang'
		);
		$this->load->view('_partials/template',$data);
	}

	private function upload_foto($nama,$form){
        $config['upload_path']          = './upload/barang/';
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
		$this->load->model('barang_m');
		$data_barang = $this->input->post();
		$data_barang['harga'] = $this->priceToFloat($data_barang['harga']);
		$data_barang['diskon'] = $this->priceToFloat($data_barang['diskon']);
		$data_barang['foto'] = $this->upload_foto('nama','foto');
		if($this->barang_m->create($data_barang)){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Barang Berhasil Ditambahkan'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Barang Gagal Ditambahkan'
			));
		}
		redirect(base_url('admin/kelola_barang'));
	}

	public function ubah($id_barang){
		$this->load->model('barang_m');
		$barang = $this->barang_m->read_where(array('id_barang' => $id_barang))->result_array();
		$data = array(
			'konten' => 'admin/form_barang',
			'parsing' => array('barang' => $barang)
		);
		$this->load->view('_partials/template',$data);
	}

	public function aksi_ubah($id_barang){
		$this->load->model('barang_m');
		$data_barang = $this->input->post();
		$data_barang['harga'] = $this->priceToFloat($data_barang['harga']);
		$data_barang['diskon'] = $this->priceToFloat($data_barang['diskon']);
		$foto = $this->upload_foto('nama','foto');
		if($foto != null){
			$data_barang['foto'] = $foto;
		}
		if($this->barang_m->update($data_barang,array('id_barang' => $id_barang))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Barang Berhasil Diubah'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Barang Gagal Diubah'
			));
		}
		redirect(base_url('admin/kelola_barang'));
	}

	public function hapus($id_barang){
		$this->load->model('barang_m');
		if($this->barang_m->delete(array('id_barang' => $id_barang))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Barang Berhasil Dihapus'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Barang Gagal Dihapus'
			));
		}
		redirect(base_url('admin/kelola_barang'));
	}

	private function priceToFloat($s)
	{
		// convert "," to "."
		$s = str_replace(',', '.', $s);
	
		// remove everything except numbers and dot "."
		$s = preg_replace("/[^0-9\.]/", "", $s);
	
		// remove all seperators from first part and keep the end
		$s = str_replace('.', '',substr($s, 0, -3)) . substr($s, -3);
	
		// return float
		return (float) $s;
	}

}
