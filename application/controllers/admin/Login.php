<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	private function cekLogin(){
		if($this->session->userdata('role') != null){
			if($this->session->userdata('role') == 'sales'){
				redirect(base_url('home'));
			} else if($this->session->userdata('role') == 'admin'){
				redirect(base_url('admin/home'));
			}
		}
	}

	public function index()
	{
		$this->cekLogin();
		$this->load->view('admin/login');
	}

	public function aksi_login(){
		$this->load->model('admin_m');
		$data_login = $this->input->post();
		$where = array(
			'email' => $data_login['email'],
			'password' => $data_login['password']
		);
		$admin = $this->admin_m->read_where($where);
		if($admin->num_rows() > 0){
			$admin = $admin->result_array();
			$this->session->set_userdata(array(
				'email' => $admin[0]['email'],
				'id' => $admin[0]['id_admin'],
				'nama' => $admin[0]['nama_admin'],
				'foto' => $admin[0]['foto'],
				'role' => 'admin'
			));
			redirect(base_url('admin/home'));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Maaf email atau password anda salah. Silahkan coba lagi!'
			));
			redirect(base_url('admin/login'));
		}
	}

	public function aksi_logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata(array(
			'status' => 1,
			'message' => 'Berhasil logout!'
		));
		redirect(base_url('admin/login'));
	}
}
