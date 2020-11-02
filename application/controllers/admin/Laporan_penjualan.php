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

	public function pilah_export()
	{
		$post = $this->input->post();
		if ($post['awal'] == null || $post['akhir'] || null) {
		}
	}

	public function print($id_transaksi)
	{
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 148.5],  'orientation' => 'P']);

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
		$hasil_bagi = $jumlah_item / 5;
		$hasil_bagi = floor($hasil_bagi);
		$sisa_bagi = $jumlah_item % 5;
		if ($jumlah_item < 5) {
			$data['index_awal'] = 1;
			$data['index_akhir'] = $sisa_bagi;
			$data['status_ttd'] = true;
			$tampilan = $this->load->view('template_faktur', $data, TRUE);
			$mpdf->WriteHTML($tampilan);
		} else if($jumlah_item == 5){
			$data['index_awal'] = 1;
			$data['index_akhir'] = 5;
			$data['status_ttd'] = true;
			$tampilan = $this->load->view('template_faktur', $data, TRUE);
			$mpdf->WriteHTML($tampilan);
		} else if ($jumlah_item > 5 && $sisa_bagi == 0) {
			$data['index_awal'] = 1;
			$data['index_akhir'] = 5;
			while ($hasil_bagi > 0) {
				if ($hasil_bagi == 1) {
					$data['status_ttd'] = true;
				} 
				$tampilan = $this->load->view('template_faktur', $data, TRUE);
				$mpdf->WriteHTML($tampilan);
				if ($hasil_bagi > 1) {
					$mpdf->AddPage();
					$data['index_akhir'] += 5;
				} 
				$hasil_bagi--;
				$data['index_awal'] += 5;
			}
		} else if ($jumlah_item > 5 && $sisa_bagi != 0) {
			$hasil_bagi += 1;
			$data['index_awal'] = 1;
			$data['index_akhir'] = 5;
			while ($hasil_bagi > 0) {
				if ($hasil_bagi == 1) {
					$data['status_ttd'] = true;
					$data['index_akhir'] = $data['index_akhir'] - 5 + $sisa_bagi;
				}
				$tampilan = $this->load->view('template_faktur', $data, TRUE);
				$mpdf->WriteHTML($tampilan);
				if ($hasil_bagi > 1) {
					$mpdf->AddPage();
					$data['index_akhir'] += 5;
				} 
				$hasil_bagi--;
				$data['index_awal'] += 5;
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
}
