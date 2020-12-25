<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkab extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rkab_m');
        $this->load->model('toko_m');
        $this->load->model('transaksi_sales_m');
        $this->load->model('item_transaksi_m');
        $this->load->model('rkab_m');
        $this->load->model('driver_m');
        $this->load->model('rkab_item_m');
        if ($this->session->userdata('role') != null) {
            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url('admin/laporan_penjualan'));
            }
            if ($this->session->userdata('role') == 'sales') {
                redirect(base_url('home'));
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
        $id_user = $this->session->userdata('id');
        $rkab = $this->rkab_m->read_full_status_where(array(
            'driver.id_driver' => $id_user
        ))->result_array();
        $data = array(
            'konten' => 'driver/rkab',
            'parsing' => array(
                'rkab' => $rkab,
                'id_transaksi_sales' => $rkab[0]['id_transaksi_sales'],
                'id_rkab' => $rkab[0]['id_rkab']
            )
        );
        $this->load->view('_partials/template', $data);
    }
    
    public function selesai($id_rkab)
    {
        if ($this->rkab_m->update(array(
            'status_proses' => 2
        ),array(
            'id_rkab' => $id_rkab
        ))) {
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'RKAB Sudah Selesai'
            ));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'RKAB Gagal Selesai'
            ));
        }
        $rkab = $this->rkab_m->read_where(array(
            'id_rkab' => $id_rkab
        ))->row_array();
        redirect(base_url("rkab/id/$rkab[id_transaksi_sales]"));
    }

    public function id($id_transaksi)
    {
        if ($id_transaksi == NULL) {
            redirect(base_url('home'));
        }
        $rkab = $this->rkab_m->read_where(
            array('id_transaksi_sales' => $id_transaksi)
        );
        if ($rkab->num_rows() < 1) {
            $this->rkab_m->create(array(
                'id_transaksi_sales' => $id_transaksi
            ));
            $rkab = array(
                'id_rkab' => $this->db->insert_id(),
                'id_transaksi_sales' => $id_transaksi,
                'status_proses' => 0
            );
        } else {
            $rkab = $rkab->row_array();
        }
        $transaksi = $this->transaksi_sales_m->read_where(array(
            'id_transaksi_sales' => $id_transaksi
        ))->row_array();
        $toko = $this->toko_m->read_where(array(
            'id_toko' => $transaksi['id_toko']
        ))->row_array();
        $item_rkab = $this->rkab_item_m->read_full_where(array(
            'id_rkab' => $rkab['id_rkab']
        ))->result_array();
        $item_transaksi_dipilih = array();
        if ($item_rkab) {
            foreach ($item_rkab as $data) {
                array_push($item_transaksi_dipilih, $data['id_item_transaksi']);
            }
            $sisa = $this->item_transaksi_m->cek_sisa_item($item_transaksi_dipilih, array(
                'id_transaksi_sales' => $id_transaksi
            ))->num_rows();
        } else {
            $sisa = $this->item_transaksi_m->read_where(array(
                'id_transaksi_sales' => $id_transaksi
            ))->num_rows();
        }
        $data = array(
            'konten' => 'driver/rkab_detail',
            'parsing' => array(
                'item_rkab' => $item_rkab, 'id_transaksi_sales' => $id_transaksi,
                'toko' => $toko, 'id_rkab' => $rkab['id_rkab'],
                'status_proses' => $rkab['status_proses'],
                'sisa' => $sisa
            )
        );
        $this->load->view('_partials/template', $data);
    }

}
