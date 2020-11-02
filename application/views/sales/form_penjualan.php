<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Form Penjualan</li>
			</ol>
		</nav>
	</div>
	<div class="main-wrapper">

		<?php if ($this->uri->segment(2) == 'buat') { ?>
			<div class="row">
				<div class="col-xl">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Buat Transaksi</h5>
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
							<form method="POST" enctype="multipart/form-data" action="<?= base_url('penjualanku/aksi_tambah') ?>">

								<div class="form-group">
									<label for="exampleInputPassword1">Nama Barang</label>
									<select id="namaBarang" class="form-control" tabindex="-1" style="width: 100%">
										<option value="0" disabled selected>Pilih Barang</option>
										<?php foreach ($parsing['barang'] as $data) { ?>
											<option value="<?= $data['id_barang'] ?>"><?= $data['nama_barang'] ?> - <?= $data['merek'] ?> | Stok/Pcs : <?= $data['stok'] ?> | Stok/Box : <?= $data['stok_perbox'] ?></option>
										<?php } ?>

									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword2">Harga / Pcs</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="harga" placeholder="Harga" value="0" readonly>

									</div>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword2">Harga / Box</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="harga_perbox" placeholder="Harga/Box" value="0" readonly>

									</div>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Kuantitas / Pcs</label>
									<input id="kuantitas" type="number" class="kuantitas form-control" placeholder="Kuantitas/Pcs" readonly>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Kuantitas / Box</label>
									<input id="kuantitas_perbox" type="number" class="kuantitas form-control" placeholder="Kuantitas/Box" readonly>
								</div>

								<div class="form-group">
									<label for="exampleInputPassword2">Subotal</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="subtotal" placeholder="Total" value="0" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="exampleInputPassword2">Diskon / Pcs</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="diskon" placeholder="Diskon" value="0" readonly>

									</div>
								</div>

								<div class="form-group">
									<label for="exampleInputPassword2">Diskon / Box</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="diskon_perbox" placeholder="Diskon" value="0" readonly>

									</div>
								</div>

								<div class="form-group">
									<label for="exampleInputPassword2">Total</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="total" placeholder="Total" value="0" readonly>
									</div>
								</div>

								<div class="row">
									<div class="col-xl-9 col-sm-8">

									</div>
									<div class="col-xl-3 col-sm-4">
										<button type="button" id="tambahBarang" class="btn btn-block mb-5 btn-info">Tambah
											Barang</button>
									</div>
								</div>



								<div class="row" id="cart_card">
									<?php $no = 1;
									foreach ($this->cart->contents() as $data) { ?>
										<div class="col-sm-6 col-md-6 col-xl-3">
											<div class="card">

												<img src="<?= base_url() ?>upload/barang/<?= $this->cart->product_options($data['rowid'])->foto ?>" class="card-img-top" alt="Placeholder">

												<div class="card-body">
													<h5 class="card-title"><?= $no ?>. <?= $data['name'] ?></h5>
													<!-- <h5 class="card-title">Harga: Rp<?= number_format($data['price'], 0, ',', '.') ?> x
														<?= number_format($data['qty'], 0, ',', '.') ?></h5> -->
														<h5 class="card-title">Harga/Pcs: Rp<?= number_format($this->cart->product_options($data['rowid'])->harga, 0, ',', '.') ?> x
														<?= number_format($this->cart->product_options($data['rowid'])->kuantitas, 0, ',', '.') ?></h5>
														<h5 class="card-title">Harga/Box: Rp<?= number_format($this->cart->product_options($data['rowid'])->harga_perbox, 0, ',', '.') ?> x
														<?= number_format($this->cart->product_options($data['rowid'])->kuantitas_perbox, 0, ',', '.') ?></h5>
													<h5 class="card-title">Diskon: Rp<?= number_format($this->cart->product_options($data['rowid'])->potongan_harga, 0, ',', '.') ?>
													</h5>
													<h5 class="card-title">Subtotal: Rp<?= number_format($this->cart->product_options($data['rowid'])->sebelum_total - $this->cart->product_options($data['rowid'])->potongan_harga, 0, ',', '.') ?>
													</h5>
													<button type="button" data-id="<?= $data['rowid'] ?>" class="hapus btn btn-block btn-danger">Hapus</button>
												</div>
											</div>
										</div>
									<?php $no++;
									} ?>


								</div>
								<hr>
								<div class="form-group">
									<label for="exampleInputPassword1">Nama Toko</label>
									
									<select name="id_toko" class="form-control" tabindex="-1" style="width: 100%" required>
										<option value="0" disabled selected>Pilih Toko</option>
										<?php foreach ($parsing['toko'] as $data) { ?>
											<option value="<?= $data['id_toko'] ?>"><?= $data['nama_toko'] ?> - <?= $data['alamat'] ?></option>
										<?php } ?>

									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword2">Jumlah yang harus dibayar</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input type="text" class="form-control" id="harus_dibayar" placeholder="Harga" value="Rp <?= number_format($parsing['sebelum_total'] - $parsing['potongan_harga'],0,',','.') ?>" readonly>

									</div>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword2">Jumlah yang dibayar</label>
									<div class="input-group-prepend">
										<!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
										<input name="pembayaran" type="text" class="form-control" onkeyup="rupiah(this)" id="pembayaran" placeholder="Jumlah yang dibayar" value="0" required>

									</div>
								</div>
								<button type="submit" class="btn btn-block btn-primary">Buat Transaksi</button>

							</form>
							<br>
							<hr>
							<br>
							<a href="<?= base_url('penjualanku') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>


	</div>
</div>