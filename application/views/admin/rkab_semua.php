<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">RKAB</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">RKAB</h5>
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
						<?php if ($parsing['status_group'] == 0) { ?>
							<a href="<?= base_url("admin/rkab/tambah/") . $this->uri->segment(4) ?>"><button type="button" class="btn btn-success btn-lg btn-block">Tambah</button></a>
						<?php } ?>
						<table id="zero-conf" class="display" style="width:100%">
							<br>
							<a href="<?= base_url("admin/rkab/print_simpler/$parsing[id_group_rkab]") ?>"><button type="button" class="btn btn-info btn-lg btn-block">Print</button></a>
							<table id="zero-conf" class="display" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>No Faktur</th>
										<th>Nama Toko</th>
										<th>Alamat</th>
										<!-- <th>Status</th> -->
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($parsing['rkab'] != 0) {
										$no = 1;
										foreach ($parsing['rkab'] as $data) {
									?>

											<tr>
												<td><?= $no ?></td>
												<td><?= $data['id_transaksi_sales'] ?></td>
												<td><?= $data['nama_toko'] ?></td>
												<td><?= $data['alamat'] ?></td>
												<!-- <td>
                                        <?php
											switch ($data['status_proses']) {
												case '1':
													echo 'Sedang Diperjalanan';
													break;
												case '2':
													echo 'Telah Diantar';
													break;

												default:
													echo 'Tidak Diketahui';
													break;
											}
										?>
                                    </td> -->
												<td>
													<a href="<?= base_url("admin/laporan_penjualan/detail/$data[id_transaksi_sales]") ?>"><button type="submit" class="btn btn-warning">Detail</button></a>

													<?php if ($parsing['status_group'] == 0) { ?>
														<a href="<?= base_url("admin/rkab/hapus/$data[id_transaksi_sales]") ?>"><button type="submit" class="btn btn-danger">Hapus</button></a>
													<?php } ?>

												</td>
											</tr>
									<?php $no++;
										}
									} ?>

								</tbody>

							</table>
							<?php if ($parsing['status_group'] == 0) { ?>
								<br>
								<a href="<?= base_url("admin/rkab/selesai_group/$parsing[id_group_rkab]") ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Selesai</button></a>
							<?php } else { ?>
								<br>
								<a href="#"><button type="button" class="btn btn-primary btn-lg btn-block">Telah Selesai</button></a>
							<?php } ?>
							<br>
							<a href="<?= base_url("admin/rkab") ?>"><button type="button" class="btn btn-danger btn-lg btn-block">Kembali</button></a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>