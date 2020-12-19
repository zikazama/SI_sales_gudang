<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('akses_toko_m');
        $this->load->model('toko_m');
        if ($this->session->userdata('role') != null) {
            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url('admin/home'));
            }
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Maaf anda harus login terlebih dahulu!',
            ));
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $id_sales = $this->session->userdata('id');
        $akses = $this->akses_toko_m->read_full_where(array(
            'akses_toko.id_sales' => $id_sales
        ))->result_array();
        $data = array(
            'konten' => 'sales/lokasi',
            'parsing' => array('akses' => $akses),
        );
        $this->load->view('_partials/template', $data);
    }

    public function atur($id_toko)
    {
        $id_sales = $this->session->userdata('id');
        $cek = $this->akses_toko_m->read_where(array(
            'id_toko' => $id_toko,
            'id_sales' => $id_sales
        ))->num_rows();
        if($cek == 0){
            redirect(base_url('lokasi'));
        }
        $akses = $this->akses_toko_m->read_full_where(array(
            'akses_toko.id_sales' => $id_sales,
            'akses_toko.id_toko' => $id_toko
        ))->row_array();
        $data = array(
            'js' => 'sales/js_lokasi',
            'konten' => 'sales/form_lokasi',
            'parsing' => array('akses' => $akses,'id_toko' => $id_toko),
        );
        $this->load->view('_partials/template', $data);
    }

    public function aksi_atur($id_toko){
        $data_lokasi = $this->input->post();
        if($this->toko_m->update($data_lokasi,array('id_toko' => $id_toko))){
			$this->session->set_flashdata(array(
				'status' => 1,
				'message' => 'Lokasi Berhasil Diatur'
			));
		} else {
			$this->session->set_flashdata(array(
				'status' => 0,
				'message' => 'Lokasi Gagal Diatur'
			));
		}
		redirect(base_url('lokasi'));
    }

}
