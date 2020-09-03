<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Kelola Barang</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">
		
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Tabel Kelola Barang</h5>
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
						<a href="<?= base_url('admin/kelola_barang/tambah') ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Tambah Barang</button></a>
                                        <br>
						<table id="zero-conf" class="display" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Merek</th>
									<th>Harga</th>
									<th>Harga/Box</th>
									<th>Stok</th>
									<th>Diskon</th>
									<th>Minimal Pembelian Diskon</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if($parsing['barang'] != 0) { 
                                        $no = 1;
                                                    foreach($parsing['barang'] as $data) {
                                                    ?>

								<tr>
									<td><?= $no ?></td>
                                   <td><?= $data['nama_barang'] ?></td>
								   <td><?= $data['merek'] ?></td>
								   <td>Rp<?= number_format($data['harga'],0,',','.') ?></td>
								   <td>Rp<?= number_format($data['harga_perbox'],0,',','.') ?></td>
									<td><?= $data['stok'] ?></td>
									<td>Rp<?= number_format($data['diskon'],0,',','.') ?></td>
									<td><?= $data['minimal_kuantitas_diskon'] ?></td>
									<td>
									<a href="<?= base_url('admin/kelola_barang/ubah/').$data['id_barang'] ?>"><button type="submit" class="btn btn-warning">Ubah</button></a>
									<hr>
									<a href="<?= base_url('admin/kelola_barang/hapus/').$data['id_barang'] ?>"><button type="submit" class="btn btn-danger">Hapus</button></a>
									</td>
								</tr>
								<?php $no++; }
                                            } ?>

							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
