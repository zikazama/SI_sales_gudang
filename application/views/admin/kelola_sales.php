<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Kelola Sales</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Tabel Kelola Sales</h5>
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
						<a href="<?= base_url('admin/kelola_sales/tambah') ?>"><button type="button"
								class="btn btn-primary btn-lg btn-block">Tambah Sales</button></a>
						<br>
						<table id="zero-conf" class="display" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>NIK</th>
									<th>Email</th>
									<th>Create At</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if($parsing['sales'] != 0) { 
                                        $no = 1;
                                                    foreach($parsing['sales'] as $data) {
                                                    ?>

								<tr>
									<td><?= $no ?></td>
									<td><?= $data['nama_sales'] ?></td>
									<td><?= $data['nik'] ?></td>
									<td><?= $data['email'] ?></td>
									<td><?= $data['created_at'] ?></td>
									<td>
										<a href="<?= base_url('admin/kelola_sales/ubah/').$data['id_sales'] ?>"><button
												type="submit" class="btn btn-warning">Ubah</button></a>
										<hr>
										<a href="<?= base_url('admin/kelola_sales/hapus/').$data['id_sales'] ?>"><button
												type="submit" class="btn btn-danger">Hapus</button></a>
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
