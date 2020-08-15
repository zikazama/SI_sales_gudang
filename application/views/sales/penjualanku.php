<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Laporan Penjualan</h5>
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
                        	<a href="<?= base_url('penjualanku/buat') ?>"><button type="button"
								class="btn btn-primary btn-lg btn-block">Buat Transaksi</button></a>
                        <br>
                        <table id="zero-conf" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Toko</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($parsing['penjualanku'] != 0) {
                                    $no = 1;
                                    foreach ($parsing['penjualanku'] as $data) {
                                ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data['kode_toko'] ?></td>
                                            <td><?= $data['nama_toko'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td>
                                                <a href="<?= base_url('penjualanku/toko/') . $data['id_toko'] ?>"><button type="submit" class="btn btn-primary">Lihat</button></a>

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