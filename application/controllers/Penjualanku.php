<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualanku extends CI_Controller
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
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != null) {
            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url('admin/laporan_penjualan'));
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
        $this->load->model('toko_m');
        $laporan_penjualan = $this->toko_m->read()->result_array();
        $data = array(
            'js' => 'admin/js_laporan_penjualan',
            'konten' => 'sales/penjualanku',
            'parsing' => array('penjualanku' => $laporan_penjualan),
        );
        $this->load->view('_partials/template', $data);
    }

    public function toko($id_toko)
    {
        $this->load->model('transaksi_sales_m');
        $laporan_penjualan = $this->transaksi_sales_m->read_full_where(array('toko.id_toko' => $id_toko))->result_array();
        $data = array(
            'js' => 'admin/js_laporan_penjualan',
            'konten' => 'sales/penjualanku_semua',
            'parsing' => array('penjualanku' => $laporan_penjualan),
        );
        $this->load->view('_partials/template', $data);
    }

    public function semua()
    {
        $this->load->model('transaksi_sales_m');
        $id_user = $this->session->userdata('id');
        $penjualanku = $this->transaksi_sales_m->read_where(array('id_sales' => $id_user))->result_array();
        $data = array(
            'konten' => 'sales/penjualanku',
            'parsing' => array('penjualanku' => $penjualanku),
        );
        $this->load->view('_partials/template', $data);
    }

    public function buat()
    {
        $this->load->model('barang_m');
        $this->load->model('toko_m');
        $barang = $this->barang_m->read()->result_array();
        $toko = $this->toko_m->read()->result_array();
        $potongan_harga = 0;
        $sebelum_total = 0;
        if ($this->cart->contents() != null) {
            foreach ($this->cart->contents() as $item) {
                $sebelum_total += $this->cart->product_options($item['rowid'])->sebelum_total;
                $potongan_harga += $this->cart->product_options($item['rowid'])->potongan_harga;
            }
        }
        $data = array(
            'konten' => 'sales/form_penjualan',
            'parsing' => array(
                'barang' => $barang,
                'toko' => $toko,
                'potongan_harga' => $potongan_harga,
                'sebelum_total' => $sebelum_total,
            ),
            'js' => 'sales/js_penjualan',
        );
        $this->load->view('_partials/template', $data);
    }

    public function aksi_tambah()
    {
        $this->load->model('transaksi_sales_m');
        $this->load->model('item_transaksi_m');
        $this->load->model('barang_m');
        $this->load->model('pembayaran_m');
        if ($this->cart->contents() == null) {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Tambahkan minimal satu barang',
            ));
            redirect(base_url('penjualanku/buat'));
        } else {
            $data_transaksi = $this->input->post();
            $id_sales = $this->session->userdata('id');

            $stok_habis = false;
            $stok_habis_perbox = false;
            $pengajuan_pcs = false;
            $pengajuan_box = false;
            $jumlah_diskon = 0;
            $sebelum_total = 0;
            foreach ($this->cart->contents() as $item) {
                $barang = $this->barang_m->read_where(array('id_barang' => $item['id']))->row();
                if ($barang->stok < $this->cart->product_options($item['rowid'])->kuantitas) {
                    $stok_habis = true;
                } else if ($barang->stok_perbox < $this->cart->product_options($item['rowid'])->kuantitas_perbox) {
                    $stok_habis_perbox = true;
                }
                $jumlah_diskon += $this->cart->product_options($item['rowid'])->potongan_harga;
                $sebelum_total += $this->cart->product_options($item['rowid'])->sebelum_total;
                if ($this->cart->product_options($item['rowid'])->pengajuan_pcs > 0) {
                    $pengajuan_pcs = true;
                }
                if ($this->cart->product_options($item['rowid'])->pengajuan_box > 0) {
                    $pengajuan_box = true;
                }
            }

            if (!$stok_habis && !$stok_habis_perbox) {
                $data_input = array(
                    'id_sales' => $id_sales,
                    'id_toko' => $data_transaksi['id_toko'],
                    'total' => $sebelum_total - $jumlah_diskon,
                    'diskon' => $jumlah_diskon,
                );
                if ($this->priceToFloat($data_transaksi['pembayaran']) == $data_input['total']) {
                    $data_input['is_lunas'] = 1;
                }
                if ($pengajuan_pcs == true || $pengajuan_box == true) {
                    $data_input['status'] = 'pending';
                }
                $this->transaksi_sales_m->create($data_input);
                $id_transaksi_sales = $this->db->insert_id();
                foreach ($this->cart->contents() as $item) {
                    $barang = $this->barang_m->read_where(array('id_barang' => $item['id']))->row();
                    $item_input = array(
                        'id_transaksi_sales' => $id_transaksi_sales,
                        'id_barang' => $item['id'],
                        'kuantitas' => $this->cart->product_options($item['rowid'])->kuantitas,
                        'kuantitas_perbox' => $this->cart->product_options($item['rowid'])->kuantitas_perbox,
                        'harga_fix_pcs' => $this->cart->product_options($item['rowid'])->harga,
                        'harga_fix_box' => $this->cart->product_options($item['rowid'])->harga_perbox,
                        'subtotal' => $this->cart->product_options($item['rowid'])->sebelum_total,
                        'subdiskon' => $this->cart->product_options($item['rowid'])->potongan_harga,
                    );
                    $this->item_transaksi_m->create($item_input);
                    $this->barang_m->update(array(
                        'stok' => $barang->stok - $this->cart->product_options($item['rowid'])->kuantitas,
                        'stok_perbox' => $barang->stok_perbox - $this->cart->product_options($item['rowid'])->kuantitas_perbox,
                    ), array(
                        'id_barang' => $item['id'],
                    ));
                }
                $data_pembayaran = array(
                    'id_transaksi_sales' => $id_transaksi_sales,
                    'jumlah_pembayaran' => $this->priceToFloat($data_transaksi['pembayaran']),
                );
                $this->pembayaran_m->create($data_pembayaran);
                $this->cart->destroy();
                $this->session->set_flashdata(array(
                    'status' => 1,
                    'message' => 'Berhasil Membuat Transaksi',
                ));
                redirect(base_url("penjualanku/toko/$data_transaksi[id_toko]"));
            } else {
                $this->cart->destroy();
                $this->session->set_flashdata(array(
                    'status' => 0,
                    'message' => 'Stok barang tidak mencukupi, silahkan ulangi',
                ));
                redirect(base_url('penjualanku/buat'));
            }
        }
    }

    public function edit($id_transaksi_sales)
    {
		$this->cart->destroy();
		$this->load->model('barang_m');
        $this->load->model('toko_m');
        $barang = $this->barang_m->read()->result_array();
        $toko = $this->toko_m->read()->result_array();
        $potongan_harga = 0;
		$sebelum_total = 0;

		//ambil data dari db dan taro di sesi
		

        if ($this->cart->contents() != null) {
            foreach ($this->cart->contents() as $item) {
                $sebelum_total += $this->cart->product_options($item['rowid'])->sebelum_total;
                $potongan_harga += $this->cart->product_options($item['rowid'])->potongan_harga;
            }
        }
        $data = array(
            'konten' => 'sales/form_penjualan',
            'parsing' => array(
                'barang' => $barang,
                'toko' => $toko,
                'potongan_harga' => $potongan_harga,
                'sebelum_total' => $sebelum_total,
            ),
            'js' => 'sales/js_penjualan',
        );
        $this->load->view('_partials/template', $data);
	}
	
	public function aksi_edit()
	{

	}

    public function detail($id_transaksi)
    {
        $this->load->model('transaksi_sales_m');
        $this->load->model('item_transaksi_m');
        $this->load->model('pembayaran_m');
        $data_transaksi = $this->transaksi_sales_m->read_full_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
        $data_item = $this->item_transaksi_m->read_full_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
        $data_pembayaran = $this->pembayaran_m->read_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
        $data_pembayaran_masuk = $this->pembayaran_m->pembayaran_masuk(array('id_transaksi_sales' => $id_transaksi))->row_array();
        $data = array(
            'konten' => 'sales/detail_penjualan',
            'js' => 'sales/js_detail_penjualan',
            'parsing' => array(
                'transaksi' => $data_transaksi,
                'item' => $data_item,
                'pembayaran' => $data_pembayaran,
                'pembayaran_masuk' => $data_pembayaran_masuk,
            ),
        );
        $this->load->view('_partials/template', $data);
    }

    public function buat_pembayaran($id_transaksi)
    {
        $this->load->model('pembayaran_m');
        $this->load->model('transaksi_sales_m');
        $data = array(
            'id_transaksi_sales' => $id_transaksi,
            'jumlah_pembayaran' => $this->priceToFloat($this->input->post('pembayaran')),
        );
        if ($this->pembayaran_m->create($data)) {
            $hitung_pembayaran = $this->pembayaran_m->pembayaran_masuk(array('id_transaksi_sales' => $id_transaksi))->row_array();
            $total = $this->transaksi_sales_m->read_full_where(array('id_transaksi_sales' => $id_transaksi))->row_array();
            //  var_dump($hitung_pembayaran['pembayaran_masuk']);
            //  var_dump($total['total']);
            //  die();
            if ($hitung_pembayaran['pembayaran_masuk'] == $total['total']) {
                $this->transaksi_sales_m->update(array('is_lunas' => '1'), array('id_transaksi_sales' => $id_transaksi));
            }
            $this->session->set_flashdata(array(
                'status' => 1,
                'message' => 'Berhasil Membuat Pembayaran',
            ));
            redirect(base_url("penjualanku/detail/$id_transaksi"));
        } else {
            $this->session->set_flashdata(array(
                'status' => 0,
                'message' => 'Gagal Membuat Pembayaran',
            ));
            redirect(base_url("penjualanku/detail/$id_transaksi"));
        }
    }

    function print($id_transaksi) {
        $this->load->model('transaksi_sales_m');
        $this->load->model('item_transaksi_m');
        $this->load->model('pembayaran_m');
        $data_transaksi = $this->transaksi_sales_m->read_full_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
        $data_item = $this->item_transaksi_m->read_full_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
        $data_pembayaran = $this->pembayaran_m->read_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
        $data_pembayaran_masuk = $this->pembayaran_m->pembayaran_masuk(array('id_transaksi_sales' => $id_transaksi))->row_array();
        $data = array(
            'transaksi' => $data_transaksi,
            'item' => $data_item,
            'pembayaran' => $data_pembayaran,
            'pembayaran_masuk' => $data_pembayaran_masuk,
        );
        $this->load->view('template_print', $data);
    }

    private function priceToFloat($s)
    {
        // convert "," to "."
        $s = str_replace(',', '.', $s);

        // remove everything except numbers and dot "."
        $s = preg_replace("/[^0-9\.]/", "", $s);

        // remove all seperators from first part and keep the end
        $s = str_replace('.', '', substr($s, 0, -3)) . substr($s, -3);

        // return float
        return (float) $s;
    }

    public function test()
    {
        var_dump($this->cart->contents());
    }
}
