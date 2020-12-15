<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function get_barang()
    {
        $this->load->model('barang_m');
        $id_barang = $this->input->post('id_barang');
        $barang = $this->barang_m->read_where(array(
            'id_barang' => $id_barang,
        ))->result_array();
        echo json_encode($barang);
    }

    public function tambah_barang()
    {
        $this->load->model('barang_m');
        $id_barang = $this->input->post('idBarang');
        $kuantitas = $this->input->post('kuantitas');
        $kuantitas_perbox = $this->input->post('kuantitas_perbox');
        $pengajuan_pcs = $this->input->post('pengajuan_pcs');
        $pengajuan_box = $this->input->post('pengajuan_box');
        $harga = $this->input->post('harga');
        $harga_perbox = $this->input->post('harga_perbox');
        $nama = $this->input->post('nama');
        $nama = explode('|', $nama);
        $data_barang = $this->barang_m->read_where(array('id_barang' => $id_barang))->row();
        if ($kuantitas >= $data_barang->minimal_kuantitas_diskon) {
            if ($data_barang->minimal_kuantitas_diskon != 0) {
                $strata = $kuantitas;
            } else {
                $strata = 0;
            }
            //$strata = floor($strata);
            $potongan_harga = $data_barang->diskon * $strata;
        } else {
            $potongan_harga = 0;
        }
        if ($kuantitas_perbox >= $data_barang->minimal_kuantitas_diskon_perbox) {
            if ($data_barang->minimal_kuantitas_diskon_perbox != 0) {
                $strata_perbox = $kuantitas_perbox;
            } else {
                $strata_perbox = 0;
            }
            //$strata_perbox = floor($strata_perbox);
            $potongan_harga_perbox = $data_barang->diskon_perbox * $strata_perbox;
        } else {
            $potongan_harga_perbox = 0;
        }
        $data_barang->potongan_harga = $potongan_harga + $potongan_harga_perbox;
        $data_barang->kuantitas = $kuantitas;
        $data_barang->kuantitas_perbox = $kuantitas_perbox;
        $data_barang->sebelum_total = ($kuantitas * $harga) + ($kuantitas_perbox * $harga_perbox);
        $data_barang->pengajuan_pcs = $pengajuan_pcs;
        $data_barang->pengajuan_box = $pengajuan_box;
        $kuantitas_fix = $kuantitas + $kuantitas_perbox;
        $harga_fix = $harga + $harga_perbox;
        $data_barang->harga = $harga;
        $data_barang->harga_perbox = $harga_perbox;
        $data_input = array(
            'id' => $id_barang,
            'qty' => $kuantitas_fix,
            'price' => $harga_fix,
            'name' => $nama[0],
            'options' => $data_barang,
        );
        $kumpulan_id = array();
        foreach ($this->cart->contents() as $data) {
            array_push($kumpulan_id, $data['id']);
        }

        if (in_array($id_barang, $kumpulan_id)) {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Barang tersebut sudah dimasukan ke keranjang. Silahkan hapus dahulu untuk mengganti kuantitas.',
            ));
        } else {
            if ($data_barang->stok >= $kuantitas && $data_barang->stok_perbox >= $kuantitas_perbox) {
                $hasil = $this->cart->insert($data_input);
            } else if ($data_barang->stok < $kuantitas) {
                if ($data_barang->stok_perbox > $kuantitas_perbox) {
                    $isi_pcs_perbox = $data_barang->isi_pcs_perbox;
                    $stok_pcs_sekarang = $data_barang->stok + $isi_pcs_perbox;
                    $stok_perbox_sekarang = $data_barang->stok_perbox - 1;
                    $this->barang_m->update(array('stok' => $stok_pcs_sekarang, 'stok_perbox' => $stok_perbox_sekarang), array('id_barang' => $data_barang->id_barang));
                    $hasil = $this->cart->insert($data_input);
                } else {
                    $this->session->set_flashdata(array(
                        'status' => 0,
                        'message' => 'Stok barang dalam pcs tidak cukup',
                    ));
                }
            } else if ($data_barang->stok_perbox < $kuantitas_perbox) {
                $this->session->set_flashdata(array(
                    'status' => 0,
                    'message' => 'Stok barang dalam box tidak cukup',
                ));
            }
        }

        echo var_dump($data_input['price']);
        echo json_encode($hasil);
    }

    public function get_cart()
    {
        $data = $this->cart->contents();
        echo json_encode($data);
    }

    public function remove_cart($rowid)
    {
        $data = $this->cart->remove($rowid);
        echo json_encode($data);
    }

    public function test()
    {
        echo var_dump($this->cart->contents());
    }
}
