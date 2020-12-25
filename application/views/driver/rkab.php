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
									<th>Nama Toko</th>
									<th>Alamat</th>
									<th>Lokasi</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if($parsing['rkab'] != 0) { 
                                        $no = 1;
                                                    foreach($parsing['rkab'] as $data) {
                                                    ?>

								<tr>
									<td><?= $no ?></td>
									<td><?= $data['nama_toko'] ?></td>
									<td><?= $data['alamat'] ?></td>
                                    <td>
                                        <?php if($data['latitude'] != NULL && $data['longitude']) { ?>
                                    <a target="_blank" href="https://www.google.com/maps/?q=<?= $data['latitude'] ?>,<?= $data['longitude'] ?>"><button
                                                type="submit" class="btn btn-warning">Buka Maps</button></a>
                                                <?php } else { ?>
                                                    Lokasi Toko Belum Ditentukan
                                                    <?php } ?>
                                    </td>
                                    <td>
                                        <?php 
                                        switch($data['status_proses']) {
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
                                    </td>
									<td>
										<a href="<?= base_url("rkab/id/$parsing[id_transaksi_sales]") ?>"><button
                                                type="submit" class="btn btn-warning">Detail</button></a>
                                        
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
