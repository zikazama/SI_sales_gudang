<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Detail Penjualan</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Penjualan</h5>
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

                        <table width="350px" style="font-size:20px">
                            <tr>
                                <td>Nama Toko</td>
                                <td>: <?= $parsing['transaksi'][0]['nama_toko'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Sales</td>
                                <td>: <?= $parsing['transaksi'][0]['nama_sales'] . ' - ' . $parsing['transaksi'][0]['nik'] ?></td>
                            </tr>
                            <tr>
                                <td>Subtotal</td>
                                <td>: Rp<?= number_format($parsing['transaksi'][0]['total'] + $parsing['transaksi'][0]['diskon'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Diskon</td>
                                <td>: Rp<?= number_format($parsing['transaksi'][0]['diskon'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>: Rp<?= number_format($parsing['transaksi'][0]['total'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>: <?= $parsing['transaksi'][0]['created_at'] ?></td>
                            </tr>
                        </table>
                        <br>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-barang" role="tab" aria-controls="pills-barang" aria-selected="true">Barang</a>
                            </li>
                           
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-barang" role="tabpanel" aria-labelledby="pills-home-tab">
                                <table id="zero-conf" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kuantitas/pcs</th>
                                            <th>Kuantitas/box</th>
                                            <th>Subtotal</th>
                                            <th>Subtotal yang diajukan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if ($parsing['item'] != 0) {
                                            $no = 1;
                                            foreach ($parsing['item'] as $data) {
                                        ?>

                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $data['nama_barang'] ?></td>
                                                    <td><?= $data['kuantitas'] ?></td>
                                                    <td><?= $data['kuantitas_perbox'] ?></td>
                                                    <td>Rp<?= number_format(($data['harga'] * $data['kuantitas'])+($data['harga_perbox'] * $data['kuantitas_perbox']), 0, ',', '.') ?></td>
                                                    <td>Rp<?= number_format($data['subtotal'], 0, ',', '.') ?></td>
                                                </tr>
                                        <?php $no++;
                                            }
                                        } ?>

                                    </tbody>

                                </table>
                                <a href="<?= base_url('admin/laporan_penjualan/edit/') . $parsing['transaksi'][0]['id_transaksi_sales'] ?>"><button type="button" class="btn btn-info btn-lg btn-block">Edit</button></a>
                                <br>
                                <a href="<?= base_url('admin/laporan_penjualan/edit_tts/') . $parsing['transaksi'][0]['id_transaksi_sales'] ?>"><button type="button" class="btn btn-info btn-lg btn-block">Edit TTS</button></a>
                                <br>
                                <a href="<?= base_url('admin/laporan_penjualan/terima/') . $parsing['transaksi'][0]['id_transaksi_sales'] ?>"><button type="button" class="btn btn-success btn-lg btn-block">Terima</button></a>
                                <br>
                                <a href="<?= base_url('admin/laporan_penjualan/tolak/') . $parsing['transaksi'][0]['id_transaksi_sales'] ?>"><button type="button" class="btn btn-danger btn-lg btn-block">Tolak</button></a>
                                <br>
                                <a href="<?= base_url('admin/laporan_penjualan/toko/') . $parsing['transaksi'][0]['id_toko'] ?>"><button type="button" class="btn btn-warning btn-lg btn-block">Kembali</button></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>