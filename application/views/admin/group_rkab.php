<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Group RKAB</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Group RKAB</h5>
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
						<a href="<?= base_url("admin/rkab/tambah_group/") ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Tambah Group RKAB</button></a>
						<br>
						<table id="zero-conf" class="display" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if ($parsing['group_rkab'] != 0) {
									$no = 1;
									foreach ($parsing['group_rkab'] as $data) {
								?>

										<tr>
											<td><?= $no ?></td>
											<td><?= $data['tanggal'] ?></td>
											<td>
												<?php if ($data['status_group'] == 0) { ?>
													Belum Selesai
												<?php } else { ?>
													Selesai
												<?php } ?>
											</td>

											<td>
												<a href="<?= base_url("admin/rkab/item/$data[id_group_rkab]") ?>"><button type="submit" class="btn btn-warning">Detail</button></a>

											</td>
										</tr>
								<?php $no++;
									}
								} ?>

							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>