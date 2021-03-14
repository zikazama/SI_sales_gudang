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
                        <a href="<?= base_url('admin/kelola_toko/tambah') ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Tambah Toko</button></a> <br>
                        <form action="<?= base_url('admin/laporan_penjualan/export_v2_where') ?>" method="post">
                            <input type="date" name="awal" required>
                            <input type="date" name="akhir" required>

                            <button type="submit" class="btn btn-primary">Export Excell</button>
                        </form>

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

                                <?php if ($parsing['laporan_penjualan'] != 0) {
                                    $no = 1;
                                    foreach ($parsing['laporan_penjualan'] as $data) {
                                ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data['kode_toko'] ?></td>
                                            <td><?= $data['nama_toko'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/laporan_penjualan/toko/') . $data['id_toko'] ?>"><button type="submit" class="btn btn-primary">Lihat</button></a>
                                                <hr>
                                                <a href="<?= base_url('admin/kelola_toko/ubah/') . $data['id_toko'] ?>"><button type="submit" class="btn btn-warning">Ubah</button></a>
                                                <hr>
                                                <a href="<?= base_url('admin/kelola_toko/hapus/') . $data['id_toko'] ?>"><button type="submit" class="btn btn-danger">Hapus</button></a>
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