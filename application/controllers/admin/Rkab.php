<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rkab extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('toko_m');
        $this->load->model('transaksi_sales_m');
        $this->load->model('item_transaksi_m');
        $this->load->model('rkab_m');
        $this->load->model('group_rkab_m');
        $this->load->model('driver_m');
        $this->load->model('rkab_item_m');
        if ($this->session->userdata('role') != null) {
            if ($this->session->userdata('role') != 'admin') {
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

    public function id($id_transaksi = NULL)
    {
        if ($id_transaksi == NULL) {
            redirect(base_url('admin/laporan_penjualan'));
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
        $group_rkab = $this->group_rkab_m->read_where(array(
            'status_group' => 0
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
            'konten' => 'admin/rkab',
            'parsing' => array(
                'item_rkab' => $item_rkab, 'id_transaksi_sales' => $id_transaksi,
                'toko' => $toko, 'id_rkab' => $rkab['id_rkab'],
                'status_proses' => $rkab['status_proses'],
                'sisa' => $sisa,
                'group_rkab' => $group_rkab
            )
        );
        $this->load->view('_partials/template', $data);
    }

    // public function tambah($id_rkab = NULL)
    // {
    //     if ($id_rkab == NULL) {
    //         redirect(base_url('admin/laporan_penjualan'));
    //     }
    //     $rkab = $this->rkab_m->read_where(array(
    //         'id_rkab' => $id_rkab
    //     ));
    //     if ($rkab->num_rows() < 1) {
    //         redirect(base_url('admin/laporan_penjualan'));
    //     } else {
    //         $rkab = $rkab->row_array();
    //     }
    //     $rkab_item = $this->rkab_item_m->read_full_where(array(
    //         'id_rkab' => $id_rkab
    //     ));
    //     if ($rkab_item->num_rows()) {
    //         $rkab_item = $rkab_item->result_array();
    //         $kumpulan_id = array();
    //         foreach ($rkab_item as $data) {
    //             array_push($kumpulan_id, $data['id_item_transaksi']);
    //         }
    //         $item_transaksi = $this->item_transaksi_m->read_not_in($kumpulan_id, array(
    //             'item_transaksi.id_transaksi_sales' => $rkab['id_transaksi_sales']
    //         ))->result_array();
    //     } else {
    //         $item_transaksi = $this->item_transaksi_m->read_full_where(array(
    //             'item_transaksi.id_transaksi_sales' => $rkab['id_transaksi_sales']
    //         ))->result_array();
    //     }
    //     $driver = $this->driver_m->read()->result_array();
    //     $data = array(
    //         'konten' => 'admin/form_rkab',
    //         'parsing' => array(
    //             'item_transaksi' => $item_transaksi,
    //             'id_rkab' => $id_rkab,
    //             'id_transaksi_sales' => $rkab['id_transaksi_sales'], 
    //             'driver' => $driver
    //         )
    //     );
    //     $this->load->view('_partials/template', $data);
    // }

    public function tambah($id_transaksi_sales = NULL)
    {
        if ($id_transaksi_sales == NULL) {
            redirect(base_url('admin/rkab'));
        }
        $driver = $this->driver_m->read()->result_array();
        $rkab = $this->rkab_m->read_where(array(
            'id_transaksi_sales' => $id_transaksi_sales
        ))->row_array();
        $data = array(
            'konten' => 'admin/form_rkab_v2',
            'parsing' => array(
                'driver' => $driver,
                'id_rkab' => $rkab['id_rkab'],
                'id_transaksi_sales' => $rkab['id_transaksi_sales']
            )
        );
        $this->load->view('_partials/template', $data);
    }

    // public function aksi_tambah($id_rkab, $id_transaksi)
    // {
    //     $input = $this->input->post();
    //     if ($input['id_item_transaksi'] == 'all') {
    //         $item_transaksi = $this->item_transaksi_m->read_where(array(
    //             'id_transaksi_sales' => $id_transaksi
    //         ))->result_array();
    //         foreach ($item_transaksi as $data) {
    //             $this->rkab_item_m->create(array(
    //                 'id_rkab' => $id_rkab,
    //                 'id_item_transaksi' => $data['id_item_transaksi'],
    //                 'id_driver' => $input['id_driver']
    //             ));
    //         }
    //         $status = true;
    //     } else {
    //         $status = $this->rkab_item_m->create(array(
    //             'id_rkab' => $id_rkab,
    //             'id_item_transaksi' => $input['id_item_transaksi'],
    //             'id_driver' => $input['id_driver']
    //         ));
    //     }
    //     if ($status) {
    //         $this->session->set_flashdata(array(
    //             'status' => 1,
    //             'message' => 'Item RKAB Berhasil Ditambahkan'
    //         ));
    //     } else {
    //         $this->session->set_flashdata(array(
    //             'status' => 0,
    //             'message' => 'Item RKAB Gagal Ditambahkan'
    //         ));
    //     }
    //     redirect(base_url("admin/rkab/id/$id_transaksi"));
    // }

    public function aksi_tambah($id_group_rkab)
    {
        $input = $this->input->post();
        $cek = $this->rkab_item_m->read_where(array(
            'id_group_rkab' => $id_group_rkab,
            'id_transaksi_sales' => $input['id_transaksi_sales']
        ))->num_rows();
        if ($cek == 0) {
            $this->rkab_item_m->create(array(
                'id_group_rkab' => $id_group_rkab,
                'id_transaksi_sales' => $input['id_transaksi_sales']
            ));
            $status = true;
        } else {
            $status = false;
        }
        if ($status) {
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'Item RKAB Berhasil Ditambahkan'
            ));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Item RKAB Gagal Ditambahkan'
            ));
        }
        redirect(base_url("admin/rkab/item/$id_group_rkab"));
    }

    // public function hapus_item($id_rkab_item, $id_transaksi)
    // {
    //     if ($this->rkab_item_m->delete(array(
    //         'id_rkab_item' => $id_rkab_item
    //     ))) {
    //         $this->session->set_flashdata(array(
    //             'status' => 1,
    //             'message' => 'Item RKAB Berhasil Dihapus'
    //         ));
    //     } else {
    //         $this->session->set_flashdata(array(
    //             'status' => 0,
    //             'message' => 'Item RKAB Gagal Dihapus'
    //         ));
    //     }
    //     redirect(base_url("admin/rkab/id/$id_transaksi"));
    // }

    public function hapus($id_transaksi_sales)
    {
        $rkab = $this->rkab_m->read_no_group(array('rkab_item.id_transaksi_sales' => $id_transaksi_sales))->row_array();
        if ($this->rkab_item_m->delete(array(
            'id_transaksi_sales' => $id_transaksi_sales
        ))) {
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'RKAB Berhasil Dihapus'
            ));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'RKAB Gagal Dihapus'
            ));
        }
        redirect(base_url("admin/rkab/item/$rkab[id_group_rkab]"));
    }

    public function process($id_rkab, $id_transaksi)
    {
        $data_input = $this->input->post();
        if ($this->rkab_m->update(array(
            'status_proses' => 1,
            'id_group_rkab' => $data_input['id_group_rkab']
        ), array(
            'id_rkab' => $id_rkab
        ))) {
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'RKAB Sudah Berangkat'
            ));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'RKAB Gagal Diupdate'
            ));
        }
        redirect(base_url("admin/rkab/id/$id_transaksi"));
    }

    public function index()
    {
        $group_rkab = $this->group_rkab_m->read_full()->result_array();
        $data = array(
            'konten' => 'admin/group_rkab',
            'parsing' => array(
                'group_rkab' => $group_rkab
            )
        );
        $this->load->view('_partials/template', $data);
    }

    public function item($id_group_rkab)
    {
        $group_rkab = $this->group_rkab_m->read_where(array(
            'id_group_rkab' => $id_group_rkab
        ))->row_array();
        $item_rkab = $this->rkab_m->read_full_status_where_group(array(
            'rkab_item.id_group_rkab' => $id_group_rkab
        ))->result_array();
        $data = array(
            'konten' => 'admin/rkab_semua',
            'parsing' => array(
                'rkab' => $item_rkab,
                'id_group_rkab' => $id_group_rkab,
                'status_group' => $group_rkab['status_group']
            )
        );
        $this->load->view('_partials/template', $data);
    }

    public function tambah_group()
    {
        $driver = $this->driver_m->read()->result_array();
        $data = array(
            'konten' => 'admin/form_group_rkab',
            'parsing' => array(
                'driver' => $driver
            )
        );
        $this->load->view('_partials/template', $data);
    }

    public function aksi_tambah_group()
    {
        $data_input = $this->input->post();
        if ($this->group_rkab_m->create(array(
            'tanggal' => $data_input['tanggal'],
            'id_driver' => $data_input['id_driver']
            
        ))) {
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'Group RKAB Berhasil Ditambahkan'
            ));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Group RKAB Gagal Ditambahkan'
            ));
        }
        redirect(base_url("admin/rkab"));
    }

    public function selesai_group($id_group_rkab)
    {
        if ($this->group_rkab_m->update(array(
            'status_group' => 1
        ), array(
            'id_group_rkab' => $id_group_rkab
        ))) {
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'Group RKAB Terselesaikan'
            ));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Group RKAB Gagal Diselesaikan'
            ));
        }
        redirect(base_url("admin/rkab/item/$id_group_rkab"));
    }



    public function print($id_group_rkab)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5],  'orientation' => 'P', 'margin_top' => 0, 'margin_bottom' => 0]);
        $group_rkab = $this->group_rkab_m->read_print_where(array(
            'rkab_item.id_group_rkab' => $id_group_rkab
        ))->result_array();
        $data = array(
            'group_rkab' => $group_rkab,
            'driver' => $group_rkab[0]['nama_driver']
        );
        // echo '<pre>' . var_export($group_rkab, true) . '</pre>';
        // die();
        $jumlah_item = count($group_rkab);
        $hasil_bagi = $jumlah_item / 10;
        $hasil_bagi = floor($hasil_bagi);
        $sisa_bagi = $jumlah_item % 10;
        $data['status_ttd'] = false;
        $list_faktur = array_column($this->group_rkab_m->read_list_no_faktur(array('group_rkab.id_group_rkab' => $id_group_rkab))->result_array(), 'id_transaksi_sales');
        $data['list_faktur'] = implode(',', $list_faktur);
        if ($jumlah_item < 10) {
            $data['index_awal'] = 1;
            $data['index_akhir'] = $sisa_bagi;
            $data['status_ttd'] = true;
            $tampilan = $this->load->view('template_rkab', $data, TRUE);
            $mpdf->WriteHTML($tampilan);
        } else if ($jumlah_item == 10) {
            $data['index_awal'] = 1;
            $data['index_akhir'] = 10;
            $data['status_ttd'] = true;
            $tampilan = $this->load->view('template_rkab', $data, TRUE);
            $mpdf->WriteHTML($tampilan);
        } else if ($jumlah_item > 10 && $sisa_bagi == 0) {
            $data['index_awal'] = 1;
            $data['index_akhir'] = 10;
            while ($hasil_bagi > 0) {
                if ($hasil_bagi == 1) {
                    $data['status_ttd'] = true;
                }
                $tampilan = $this->load->view('template_rkab', $data, TRUE);
                $mpdf->WriteHTML($tampilan);
                if ($hasil_bagi > 1) {
                    $mpdf->AddPage();
                    $data['index_akhir'] += 10;
                }
                $hasil_bagi--;
                $data['index_awal'] += 10;
            }
        } else if ($jumlah_item > 10 && $sisa_bagi != 0) {
            $hasil_bagi += 1;
            $data['index_awal'] = 1;
            $data['index_akhir'] = 10;
            while ($hasil_bagi > 0) {
                if ($hasil_bagi == 1) {
                    $data['status_ttd'] = true;
                    $data['index_akhir'] = $data['index_akhir'] - 10 + $sisa_bagi;
                }
                $tampilan = $this->load->view('template_rkab', $data, TRUE);
                $mpdf->WriteHTML($tampilan);
                if ($hasil_bagi > 1) {
                    $mpdf->AddPage();
                    $data['index_akhir'] += 10;
                }
                $hasil_bagi--;
                $data['index_awal'] += 10;
            }
            //die();
        }
        $mpdf->Output();
    }
}
