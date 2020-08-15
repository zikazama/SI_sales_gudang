<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Detail Penjualan</h5>
						<?php
						if ($this->session->flashdata('status') === 0) {
						?>
							<div class="alert alert-danger" role="alert">
								<?= $this->session->flashdata('message') ?>
							</div>
						<?php
						} else if ($this->session->flashdata('status') === 1) {
						?>
							<div class="alert alert-success" role="alert">
								<?= $this->session->flashdata('message') ?>
							</div>
						<?php
						}
						?>

						<table width="350px" style="font-size:20px">
							<tr>
								<td>Nama Toko</td>
								<td>: <?= $parsing['transaksi'][0]['nama_toko'] ?></td>
							</tr>
							<tr>
								<td>Nama Sales</td>
								<td>: <?= $parsing['transaksi'][0]['nama_sales'].' - '.$parsing['transaksi'][0]['nik'] ?></td>
							</tr>
							<tr>
								<td>Subtotal</td>
								<td>: Rp<?= number_format($parsing['transaksi'][0]['total'], 0, ',', '.') ?></td>
							</tr>
							<tr>
								<td>Diskon</td>
								<td>: Rp<?= number_format($parsing['transaksi'][0]['diskon'], 0, ',', '.') ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td>: Rp<?= number_format($parsing['transaksi'][0]['total'] - $parsing['transaksi'][0]['diskon'], 0, ',', '.') ?></td>
							</tr>
							<tr>
								<td>Waktu</td>
								<td>: <?= $parsing['transaksi'][0]['created_at'] ?></td>
							</tr>
						</table>
						<br>
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-barang" role="tab" aria-controls="pills-barang" aria-selected="true">Barang</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pembayaran" role="tab" aria-controls="pills-pembayaran" aria-selected="false">Pembayaran</a>
							</li>
						</ul>

						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-barang" role="tabpanel" aria-labelledby="pills-home-tab">
								<table id="zero-conf" class="display" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Harga</th>
											<th>Kuantitas</th>
											<th>Jumlah</th>
											<th>Diskon</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>

										<?php if ($parsing['item'] != 0) {
											$no = 1;
											foreach ($parsing['item'] as $data) {
										?>

												<tr>
													<td><?= $no ?></td>
													<td><?= $data['nama_barang'] ?></td>
													<td>Rp<?= number_format($data['harga'], 0, ',', '.') ?></td>
													<td><?= $data['kuantitas'] ?></td>
													<td>Rp<?= number_format($data['subtotal'], 0, ',', '.') ?></td>
													<td>Rp<?= number_format($data['subdiskon'], 0, ',', '.') ?></td>
													<td>Rp<?= number_format($data['subtotal'] - $data['subdiskon'], 0, ',', '.') ?></td>

												</tr>
										<?php $no++;
											}
										} ?>

									</tbody>

								</table>
								<br>
								<a href="<?= base_url('admin/laporan_penjualan/print/') . $parsing['transaksi'][0]['id_transaksi_sales'] ?>"><button type="button" class="btn btn-info btn-lg btn-block">Print</button></a>
								<br>
								<a href="<?= base_url('admin/laporan_penjualan/toko/') . $parsing['transaksi'][0]['id_toko'] ?>"><button type="button" class="btn btn-danger btn-lg btn-block">Kembali</button></a>
							</div>
							<div class="tab-pane fade" id="pills-pembayaran" role="tabpanel" aria-labelledby="pills-profile-tab">
								<?php if (($parsing['transaksi'][0]['total'] - $parsing['transaksi'][0]['diskon']) > $parsing['pembayaran_masuk']['pembayaran_masuk']) { ?>
									<h5 class="text-danger text-center">Sisa Pembayaran adalah Rp<span id="harus_dibayar" data-nilai="<?= ($parsing['transaksi'][0]['total'] - $parsing['transaksi'][0]['diskon']) - $parsing['pembayaran_masuk']['pembayaran_masuk'] ?>"><?= number_format(($parsing['transaksi'][0]['total'] - $parsing['transaksi'][0]['diskon']) - $parsing['pembayaran_masuk']['pembayaran_masuk'], 0, ',', '.') ?></span></h5>
								<?php } else { ?>
									<h5 class="text-success text-center">Pembayaran Lunas</h5>
								<?php } ?>
								<hr>
								<table id="zero-conf2" class="display" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Jumlah</th>
											<th>Tanggal</th>
										</tr>
									</thead>
									<tbody>

										<?php if ($parsing['pembayaran'] != 0) {
											$no = 1;
											foreach ($parsing['pembayaran'] as $data) {
										?>

												<tr>
													<td><?= $no ?></td>
													<td>Rp<?= number_format($data['jumlah_pembayaran'], 0, ',', '.') ?></td>
													<td><?= $data['created_at'] ?></td>

												</tr>
										<?php $no++;
											}
										} ?>

									</tbody>

								</table>
								<br>
								<a href="<?= base_url('admin/laporan_penjualan/print/') . $parsing['transaksi'][0]['id_transaksi_sales'] ?>"><button type="button" class="btn btn-info btn-lg btn-block">Print</button></a>
								<br>
								<a href="<?= base_url('admin/laporan_penjualan/toko/') . $parsing['transaksi'][0]['id_toko'] ?>"><button type="button" class="btn btn-danger btn-lg btn-block">Kembali</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>