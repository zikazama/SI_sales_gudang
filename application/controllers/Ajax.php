<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
	public function get_barang(){
        $this->load->model('barang_m');
        $id_barang = $this->input->post('id_barang');
        $barang = $this->barang_m->read_where(array(
            'id_barang' => $id_barang
        ))->result_array();
        echo json_encode($barang);
    }

    public function tambah_barang(){
        $this->load->model('barang_m');
        $id_barang = $this->input->post('idBarang');
        $kuantitas = $this->input->post('kuantitas');
        $harga = $this->input->post('harga');
        $nama = $this->input->post('nama');
        $data_barang = $this->barang_m->read_where(array('id_barang' => $id_barang))->row();
        if($kuantitas >= $data_barang->minimal_kuantitas_diskon){
            if($data_barang->minimal_kuantitas_diskon != 0) {
            $strata = $kuantitas / $data_barang->minimal_kuantitas_diskon;
            } else {
                $strata = 0;
            }
            $potongan_harga = $data_barang->diskon * $strata;
        } else {
            $potongan_harga = 0;
        }
        $data_barang->potongan_harga = $potongan_harga;
        $data_input = array(
            'id' => $id_barang,
            'qty' => $kuantitas,
            'price' => $harga,
            'name' => $nama,
            'options' => $data_barang
        );
        $kumpulan_id = array();
        foreach($this->cart->contents() as $data){
            array_push($kumpulan_id, $data['id']);
        }

        if(in_array($id_barang, $kumpulan_id)) {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Barang tersebut sudah dimasukan ke keranjang. Silahkan hapus dahulu untuk mengganti kuantitas.'
            ));
        } else {
            if($data_barang->stok >= $kuantitas){
                $hasil = $this->cart->insert($data_input);
            } else {
                $this->session->set_flashdata(array(
                    'status' => 0,
                    'message' => 'Stok barang tidak cukup'
                ));
            }
        }
        
        echo var_dump($data_input['price']);
        echo json_encode($hasil); 
    }

    public function get_cart(){
        $data = $this->cart->contents();
        echo json_encode($data);        
    }

    public function remove_cart($rowid){
        $data = $this->cart->remove($rowid);
        echo json_encode($data);
    }

    public function test(){
        echo var_dump($this->cart->contents());
    }

}

