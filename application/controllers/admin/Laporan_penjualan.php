<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_penjualan extends CI_Controller
{

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
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role') != null) {
			if ($this->session->userdata('role') == 'sales') {
				redirect(base_url('penjualanku'));
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
		$this->load->model('toko_m');
		$laporan_penjualan = $this->toko_m->read()->result_array();
		$data = array(
			'js' => 'admin/js_laporan_penjualan',
			'konten' => 'admin/laporan_penjualan',
			'parsing' => array('laporan_penjualan' => $laporan_penjualan)
		);
		$this->load->view('_partials/template', $data);
	}

	public function toko($id_toko)
	{
		$this->load->model('transaksi_sales_m');
		$laporan_penjualan = $this->transaksi_sales_m->read_full_where(array('toko.id_toko' => $id_toko))->result_array();
		$data = array(
			'js' => 'admin/js_laporan_penjualan',
			'konten' => 'admin/laporan_penjualan_semua',
			'parsing' => array('laporan_penjualan' => $laporan_penjualan)
		);
		$this->load->view('_partials/template', $data);
	}

	public function semua()
	{
		$this->load->model('transaksi_sales_m');
		$laporan_penjualan = $this->transaksi_sales_m->read_full()->result_array();
		$data = array(
			'js' => 'admin/js_laporan_penjualan',
			'konten' => 'admin/laporan_penjualan_semua',
			'parsing' => array('laporan_penjualan' => $laporan_penjualan)
		);
		$this->load->view('_partials/template', $data);
	}

	public function harian()
	{
		$this->load->model('transaksi_sales_m');
		$laporan_penjualan = $this->transaksi_sales_m->read_full_where(array('transaksi_sales.created_at' => 'CURDATE()'))->result_array();
		$data = array(
			'js' => 'admin/js_laporan_penjualan',
			'konten' => 'admin/laporan_penjualan',
			'parsing' => array('laporan_penjualan' => $laporan_penjualan)
		);
		$this->load->view('_partials/template', $data);
	}

	public function mingguan()
	{
		$this->load->model('transaksi_sales_m');
		$laporan_penjualan = $this->transaksi_sales_m->read_minggu_ini()->result_array();
		$data = array(
			'js' => 'admin/js_laporan_penjualan',
			'konten' => 'admin/laporan_penjualan',
			'parsing' => array('laporan_penjualan' => $laporan_penjualan)
		);
		$this->load->view('_partials/template', $data);
	}

	public function bulanan()
	{
		$this->load->model('transaksi_sales_m');
		$laporan_penjualan = $this->transaksi_sales_m->read_bulan_ini()->result_array();
		$data = array(
			'js' => 'admin/js_laporan_penjualan',
			'konten' => 'admin/laporan_penjualan',
			'parsing' => array('laporan_penjualan' => $laporan_penjualan)
		);
		$this->load->view('_partials/template', $data);
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
			'konten' => 'admin/detail_penjualan',
			'parsing' => array(
				'transaksi' => $data_transaksi,
				'item' => $data_item,
				'pembayaran' => $data_pembayaran,
				'pembayaran_masuk' => $data_pembayaran_masuk
			),
		);
		$this->load->view('_partials/template', $data);
	}

	public function detail_pending($id_transaksi)
	{
		$this->load->model('transaksi_sales_m');
		$this->load->model('item_transaksi_m');
		$this->load->model('pembayaran_m');
		$data_transaksi = $this->transaksi_sales_m->read_full_where(array('transaksi_sales.id_transaksi_sales' => $id_transaksi))->result_array();
		$data_item = $this->item_transaksi_m->read_full_where(array('transaksi_sales.id_transaksi_sales' => $id_transaksi))->result_array();
		$data_pembayaran = $this->pembayaran_m->read_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
		$data_pembayaran_masuk = $this->pembayaran_m->pembayaran_masuk(array('id_transaksi_sales' => $id_transaksi))->row_array();
		$data = array(
			'konten' => 'admin/pending_penjualan',
			'parsing' => array(
				'transaksi' => $data_transaksi,
				'item' => $data_item,
				'pembayaran' => $data_pembayaran,
				'pembayaran_masuk' => $data_pembayaran_masuk
			),
		);
		$this->load->view('_partials/template', $data);
	}

	public function terima($id_transaksi){
		$this->load->model('transaksi_sales_m');
		$transaksi = $this->transaksi_sales_m->read_where(array('id_transaksi_sales' => $id_transaksi))->row_array();
		$this->transaksi_sales_m->update(array('status' => 'diterima'),array('id_transaksi_sales' => $id_transaksi));
		redirect(base_url('admin/laporan_penjualan/toko/'.$transaksi['id_toko']));
	}

	public function tolak($id_transaksi){
		$this->load->model('transaksi_sales_m');
		$this->load->model('item_transaksi_m');
		$this->load->model('barang_m');
		$transaksi = $this->transaksi_sales_m->read_where(array('id_transaksi_sales' => $id_transaksi))->row_array();
		$tiap_transaksi = $this->item_transaksi_m->read_full_where(array('id_transaksi_sales' => $id_transaksi))->result_array();
		foreach($tiap_transaksi as $data){
			$barang = $this->barang_m->read_where(array('id_barang' => $data['id_barang']))->row_array();
			$pcs_sekarang = $barang['stok'] + $data['kuantitas'];
			$box_sekarang = $barang['stok_perbox'] + $data['kuantitas_perbox'];
			$this->barang_m->update(array('stok' => $pcs_sekarang, 'stok_perbox' => $box_sekarang),array('id_barang' => $data['id_barang']));
		}
		$this->transaksi_sales_m->update(array('status' => 'ditolak'),array('id_transaksi_sales' => $id_transaksi));
		redirect(base_url('admin/laporan_penjualan/toko/'.$transaksi['id_toko']));
	}

	public function pilah_export()
	{
		$post = $this->input->post();
		if ($post['awal'] == null || $post['akhir'] || null) {
		}
	}

	public function print($id_transaksi)
	{
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5],  'orientation' => 'P', 'margin_top' => 0, 'margin_bottom' => 0]);

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
			'status_ttd' => false
		);
		$jumlah_item = count($data_item);
		$hasil_bagi = $jumlah_item / 10;
		$hasil_bagi = floor($hasil_bagi);
		$sisa_bagi = $jumlah_item % 10;
		if ($jumlah_item < 10) {
			$data['index_awal'] = 1;
			$data['index_akhir'] = $sisa_bagi;
			$data['status_ttd'] = true;
			$tampilan = $this->load->view('template_faktur', $data, TRUE);
			$mpdf->WriteHTML($tampilan);
		} else if($jumlah_item == 10){
			$data['index_awal'] = 1;
			$data['index_akhir'] = 10;
			$data['status_ttd'] = true;
			$tampilan = $this->load->view('template_faktur', $data, TRUE);
			$mpdf->WriteHTML($tampilan);
		} else if ($jumlah_item > 10 && $sisa_bagi == 0) {
			$data['index_awal'] = 1;
			$data['index_akhir'] = 10;
			while ($hasil_bagi > 0) {
				if ($hasil_bagi == 1) {
					$data['status_ttd'] = true;
				} 
				$tampilan = $this->load->view('template_faktur', $data, TRUE);
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
				$tampilan = $this->load->view('template_faktur', $data, TRUE);
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

	private function export()
	{
		$this->load->model('item_transaksi_m');
		$data = $this->item_transaksi_m->read_print()->result_array();
		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A2', 'No')
			->setCellValue('B2', 'Nama Sales')
			->setCellValue('C2', 'Barang')
			->setCellValue('D2', 'Merek')
			->setCellValue('E2', 'Kuantitas')
			->setCellValue('F2', 'Subtotal')
			->setCellValue('G2', 'Subdiskon')
			->setCellValue('H2', 'Total')
			->setCellValue('I2', 'Tanggal');

		$kolom = 2;
		$nomor = 1;
		foreach ($data as $d) {
			$total = (int) $d['subtotal'] - (int) $d['subdiskon'];
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $d['nama_sales'])
				->setCellValue('C' . $kolom, $d['nama_barang'])
				->setCellValue('D' . $kolom, $d['merek'])
				->setCellValue('E' . $kolom, $d['kuantitas'])
				->setCellValue('F' . $kolom, number_format($d['subtotal'], 0, '.', ','))
				->setCellValue('G' . $kolom, number_format($d['subdiskon'], 0, '.', ','))
				->setCellValue('H' . $kolom, number_format($total, 0, '.', ','))
				->setCellValue('I' . $kolom, date('d-m-Y', strtotime($d['created_at'])));

			$kolom++;
			$nomor++;
		}

		$gtot = $this->item_transaksi_m->grand_total()->row_array();
		$grand_total = $gtot['subtotal'] - $gtot['subdiskon'];
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('G' . $kolom, 'Grand Total')
			->setCellValue('H' . $kolom, number_format($grand_total, 0, '.', ','));

		$writer = new Xlsx($spreadsheet);
		$tanggal = date('d-m-Y');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Rekap data ' . $tanggal . ' .xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_where()
	{
		$this->load->model('item_transaksi_m');
		$post = $this->input->post();
		$data = $this->item_transaksi_m->read_print_where(array('date(item_transaksi.created_at) >=' => $post['awal'], 'date(item_transaksi.created_at) <=' => $post['akhir']))->result_array();
		$spreadsheet = new Spreadsheet;
		$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Data Penjualan Barang $post[awal] hingga $post[akhir]");
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A2', 'No')
			->setCellValue('B2', 'Nama Sales')
			->setCellValue('C2', 'Barang')
			->setCellValue('D2', 'Merek')
			->setCellValue('E2', 'Kuantitas')
			->setCellValue('F2', 'Subtotal')
			->setCellValue('G2', 'Subdiskon')
			->setCellValue('H2', 'Total')
			->setCellValue('I2', 'Tanggal');

		$kolom = 3;
		$nomor = 1;
		foreach ($data as $d) {
			$total = (int) $d['subtotal'] - (int) $d['subdiskon'];
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $d['nama_sales'])
				->setCellValue('C' . $kolom, $d['nama_barang'])
				->setCellValue('D' . $kolom, $d['merek'])
				->setCellValue('E' . $kolom, $d['kuantitas'])
				->setCellValue('F' . $kolom, number_format($d['subtotal'], 0, '.', ','))
				->setCellValue('G' . $kolom, number_format($d['subdiskon'], 0, '.', ','))
				->setCellValue('H' . $kolom, number_format($total, 0, '.', ','))
				->setCellValue('I' . $kolom, date('d-m-Y', strtotime($d['created_at'])));

			$kolom++;
			$nomor++;
		}

		$gtot = $this->item_transaksi_m->grand_total_where(array('date(item_transaksi.created_at) >=' => $post['awal'], 'date(item_transaksi.created_at) <=' => $post['akhir']))->row_array();
		$grand_total = $gtot['subtotal'] - $gtot['subdiskon'];
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('G' . $kolom, 'Grand Total')
			->setCellValue('H' . $kolom, number_format($grand_total, 0, '.', ','));

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Rekap Data Penjualan ' . $post['awal'] . ' hingga ' . $post['akhir'] . ' .xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function edit($id_transaksi_sales)
    {
        $this->load->model('barang_m');
        $this->load->model('toko_m');
        $this->load->model('pembayaran_m');
        $this->load->model('transaksi_sales_m');
		$this->load->model('item_transaksi_m');
        $item = $this->item_transaksi_m->read_full_where(array(
            'item_transaksi.id_transaksi_sales' => $id_transaksi_sales
        ))->result();
        $transaksi = $this->transaksi_sales_m->read_where(array(
            'id_transaksi_sales' => $id_transaksi_sales
		))->row_array();
        if($transaksi['status'] != 'pending'){
            redirect(base_url('admin/laporan_penjualan'));
        }
        // $this->cart->destroy();
        // $this->session->unset_userdata('activity_edit_sales');
        if($this->session->userdata('activity_edit_sales') == NULL){
            if($this->session->userdata('activity_create_sales') == true){
                $this->cart->destroy();
                $this->session->unset_userdata('activity_create_sales');
                redirect(base_url("admin/laporan_penjualan/edit/$id_transaksi_sales"));
            }
            $this->session->set_userdata('activity_edit_sales',$id_transaksi_sales);
            foreach($item as $data_barang){
                $data_barang->potongan_harga = $data_barang->subdiskon;
                $data_barang->sebelum_total = $data_barang->subtotal;
                $data_input = array(
                    'id' => $data_barang->id_barang,
                    'qty' => (int)$data_barang->kuantitas + $data_barang->kuantitas_perbox,
                    'price' => (int)$data_barang->harga + $data_barang->harga_perbox,
                    'name' => $data_barang->nama_barang,
                    'options' => $data_barang
                );
                $this->cart->insert($data_input);
            }
        } else {
            if($this->session->userdata('activity_edit_sales') != $id_transaksi_sales){
                $this->cart->destroy();
                $this->session->unset_userdata('activity_edit_sales');
                redirect(base_url("admin/laporan_penjualan/edit/$id_transaksi_sales"));
            }
        }
		
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
        $pembayaran = $this->pembayaran_m->read_where(array(
            'id_transaksi_sales' => $id_transaksi_sales
        ))->row_array();
      
        $data = array(
            'konten' => 'admin/form_penjualan',
            'parsing' => array(
                'barang' => $barang,
                'toko' => $toko,
                'potongan_harga' => $potongan_harga,
                'sebelum_total' => $sebelum_total,
                'toko_dipilih' => $transaksi['id_toko'],
                'pembayaran' => $pembayaran['jumlah_pembayaran'],
                'id_transaksi_sales' => $id_transaksi_sales,
            ),
            'js' => 'admin/js_penjualan',
        );
        $this->load->view('_partials/template', $data);
	}
	
	public function aksi_edit($id_transaksi_sales)
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
            redirect(base_url("admin/laporan_penjualan/edit/$id_transaksi_sales"));
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
                $this->transaksi_sales_m->update($data_input,array('id_transaksi_sales' => $id_transaksi_sales));
                $item_hapus = $this->item_transaksi_m->read_where(array(
                    'id_transaksi_sales' => $id_transaksi_sales
                ))->result_array();
                foreach($item_hapus as $item){
                    $barang = $this->barang_m->read_where(array('id_barang' => $item['id_barang']))->row();
                    $this->barang_m->update(array(
                        'stok' => $barang->stok + $item['stok'],
                        'stok_perbox' => $barang->stok_perbox + $item['stok_perbox']
                    ), array(
                        'id_barang' => $barang->id_barang
                    ));
                }
                $this->item_transaksi_m->delete(array(
                    'id_transaksi_sales' => $id_transaksi_sales 
                ));
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
                    'jumlah_pembayaran' => $this->priceToFloat($data_transaksi['pembayaran']),
                );
                $this->pembayaran_m->update($data_pembayaran,array(
                    'id_transaksi_sales' => $id_transaksi_sales
                ));
                $this->cart->destroy();
                $this->session->unset_userdata('activity_edit_sales');
                $this->session->set_flashdata(array(
                    'status' => 1,
                    'message' => 'Berhasil Mengedit Transaksi',
                ));
                redirect(base_url("admin/laporan_penjualan/detail_pending/$id_transaksi_sales"));
            } else {
                $this->cart->destroy();
                $this->session->unset_userdata('activity_edit_sales');
                $this->session->set_flashdata(array(
                    'status' => 0,
                    'message' => 'Stok barang tidak mencukupi, silahkan ulangi',
                ));
                redirect(base_url("admin/laporan_penjualan/edit/$id_transaksi_sales"));
            }
        }
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
}
