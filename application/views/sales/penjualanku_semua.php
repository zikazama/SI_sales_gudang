<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Penjualanku</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Tabel Penjualanku</h5>
						<?php 
                                    if($this->session->flashdata('status') === 0){
                                ?>
						<div class="alert alert-danger" role="alert">
							<?= $this->session->flashdata('message') ?>
						</div>
						<?php
                                    } else if ($this->session->flashdata('status') === 1){
								?>
						<div class="alert alert-success" role="alert">
							<?= $this->session->flashdata('message') ?>
						</div>
						<?php
									}
								?>
								 <div class="box border border-success p-3">
                        <h4 class="text text-primary">Nama Toko     : <?= $parsing['penjualanku'][0]['nama_toko'] ?></h4>
                        <h4 class="text text-primary">Alamat Toko   : <?= $parsing['penjualanku'][0]['alamat'] ?></h4>
                        </div>
								<br>
						<a href="<?= base_url('penjualanku/buat') ?>"><button type="button"
								class="btn btn-primary btn-lg btn-block">Buat Transaksi</button></a>
						<br>
						<table id="zero-conf" class="display" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Subtotal</th>
									<th>Diskon</th>
									<th>Total</th>
									<th>Pembayaran</th>
									<th>Created At</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if($parsing['penjualanku'] != 0) { 
                                        $no = 1;
                                                    foreach($parsing['penjualanku'] as $data) {
														if($data['total'] > 0) {
                                                    ?>
								<tr>
									<td><?= $no ?></td>
									<td>Rp<?= number_format($data['total']+$data['diskon'],0,',','.') ?></td>
									<td>Rp<?= number_format($data['diskon'],0,',','.') ?></td>
									<td>Rp<?= number_format($data['total'],0,',','.') ?></td>
									<td class="text <?= ($data['is_lunas'] == 0 ? 'text-danger' : 'text-success' ) ?>"><?= ($data['is_lunas'] == 0 ? 'Belum Lunas' : 'Lunas' ) ?></td>
									<td><?= $data['waktu'] ?></td>
								
									<td>
										<?php if($data['status'] == 'diterima') { ?>
										<a href="<?= base_url('penjualanku/detail/').$data['id_transaksi_sales'] ?>"><button
												type="submit" class="btn btn-primary">Detail</button></a>
										<?php } else if ($data['status'] == 'pending') { ?>
											<a href="<?= base_url('penjualanku/edit/').$data['id_transaksi_sales'] ?>"><button class="btn btn-warning">Pending (edit)</button></a>
										<?php } else if ($data['status'] == 'ditolak') { ?>
											<button class="btn btn-danger">Ditolak</button>
										<?php } ?>
										<!-- <hr>
										<a href="<?= base_url('penjualanku/print/').$data['id_transaksi_sales'] ?>"><button
												type="submit" class="btn btn-info">Print</button></a> -->
									</td>
								</tr>
								<?php $no++; }}
                                            } ?>

							</tbody>

						</table>
						<br>
                        <a href="<?= base_url('penjualanku/') ?>"><button type="button" class="btn btn-danger btn-lg btn-block">Kembali</button></a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
