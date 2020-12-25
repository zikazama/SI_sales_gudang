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

	public function __construct(){
		parent::__construct();
		$this->load->model('sales_m');
		$this->load->model('driver_m');
	}

	public function index()
	{
		$this->cekLogin();
		$this->load->view('sales/login');
	}

	public function aksi_login(){
		$data_login = $this->input->post();
		$where = array(
			'email' => $data_login['email'],
			'password' => $data_login['password']
		);
		$sales = $this->sales_m->read_where($where);
		$driver = $this->driver_m->read_where($where);
		if($sales->num_rows() > 0){
			$sales = $sales->result_array();
			$this->session->set_userdata(array(
				'email' => $sales[0]['email'],
				'id' => $sales[0]['id_sales'],
				'nama' => $sales[0]['nama_sales'],
				'foto' => $sales[0]['foto'],
				'role' => 'sales'
			));
			redirect(base_url('home'));
		} else if($driver->num_rows() > 0) {
			$driver = $driver->result_array();
			$this->session->set_userdata(array(
				'email' => $driver[0]['email'],
				'id' => $driver[0]['id_driver'],
				'nama' => $driver[0]['nama_driver'],
				'foto' => $driver[0]['foto'],
				'role' => 'driver'
			));
			redirect(base_url('home'));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Maaf email atau password anda salah. Silahkan coba lagi!'
			));
			redirect(base_url('login'));
		}
	}

	public function aksi_logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata(array(
			'status' => 1,
			'message' => 'Berhasil logout!'
		));
		redirect(base_url('login'));
	}
}
