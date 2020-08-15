<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Dashboard Sales</li>
			</ol>
		</nav>

	</div>
	<div class="main-wrapper">
		<div class="row stats-row">
			<div class="col-lg-4 col-md-12">
				<div class="card card-transparent stats-card">
					<div class="card-body">
						<div class="stats-info">
							<h5 class="card-title">Rp<?= number_format($parsing['penjualan_hari'][0]['nilai'],0,',','.') ?? 0 ?>
							</h5>
							<p class="stats-text">Total Penjualan Hari Ini</p>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="card card-transparent stats-card">
					<div class="card-body">
						<div class="stats-info">
							<h5 class="card-title"><?= $parsing['transaksi_hari'][0]['nilai'] ?? 0 ?>
							</h5>
							<p class="stats-text">Total Transaksi Penjualan Hari Ini</p>
						</div>
					
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="card card-transparent stats-card">
					<div class="card-body">
						<div class="stats-info">
							<h5 class="card-title"><?= $parsing['barang_hari'][0]['nilai'] ?? 0 ?>
							</h5>
							<p class="stats-text">Total Penjualan Barang Hari Ini</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
