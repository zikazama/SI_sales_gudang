<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Kelola Lokasi</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Tabel Kelola Lokasi</h5>
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
			
						<br>
						<table id="zero-conf" class="display" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Toko</th>
									<th>Latitude</th>
									<th>Longitude</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if($parsing['akses'] != 0) { 
                                        $no = 1;
                                                    foreach($parsing['akses'] as $data) {
                                                    ?>

								<tr>
									<td><?= $no ?></td>
									<td><?= $data['nama_toko'] ?></td>
									<td><?= $data['latitude'] ?></td>
									<td><?= $data['longitude'] ?></td>
									<td>
										<a href="<?= base_url('lokasi/atur/').$data['id_toko'] ?>"><button
												type="submit" class="btn btn-warning">Atur</button></a>
										<hr>
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
