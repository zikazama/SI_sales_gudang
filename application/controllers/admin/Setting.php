<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
				redirect(base_url('setting'));
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
        $data = array(
            'konten' => 'admin/pengaturan'
        );
		$this->load->view('_partials/template',$data);
	}

	public function aksi_ubah_password($id_admin){
		$this->load->model('admin_m');
		$data_password = $this->input->post();
		$admin = $this->admin_m->read_where(array('id_admin' => $id_admin))->result_array();
		if($admin[0]['id_admin'] == $data_password['password_lama']){
			$this->admin_m->update(
				array('password' => $data_password['password_baru']),
				array('id_admin' => $id_admin)
			);
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Berhasil Mengubah Password'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Gagal Mengubah Password, Password lama tidak cocok.'
			));
		}
		redirect(base_url('admin/setting'));
	}

	private function upload_foto($nama,$form){
        $config['upload_path']          = './upload/admin/';
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

	public function aksi_ubah_foto($id_user){
		$this->load->model('admin_m');
		$data_admin = $this->input->post();
		$data_admin['foto'] = $this->upload_foto('nama','foto');
		$this->admin_m->update(
			$data_admin,
			array('id_admin' => $id_user)
		);
		$this->session->set_userdata(array(
			'foto' => $data_admin['foto']
		));
		$this->session->set_flashdata(array(
			'status' => 3,
			'message' => 'Berhasil Mengubah Foto'
		));
		redirect(base_url('admin/setting'));
	}
}
