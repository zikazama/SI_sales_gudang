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
                        <h5 class="card-title">Laporan Penjualan</h5>
                        <!-- <select class="mb-5" name="" id="periode" width="600px">
                            <option value="" selected disabled>Pilih Periode</option>
                            <option value="">Semua</option>
                            <option value="harian">Hari Ini</option>
                            <option value="mingguan">1 Minggu Kebelakang</option>
                            <option value="bulanan">Bulan Ini</option>
                        </select> -->
                        <div class="box border border-success p-3">
                        <h4 class="text text-primary">Nama Toko     : <?= $parsing['laporan_penjualan'][0]['nama_toko'] ?></h4>
                        <h4 class="text text-primary">Alamat Toko   : <?= $parsing['laporan_penjualan'][0]['alamat'] ?></h4>
                        </div>
                       
                        <br>
                        <table id="zero-conf" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sales</th>
                                    <th>Subtotal</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Created At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($parsing['laporan_penjualan'] != 0) {
                                    $no = 1;
                                    foreach ($parsing['laporan_penjualan'] as $data) {
                                        if($data['total'] > 0) {
                                ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data['nama_sales'] ?></td>
                                            <td>Rp<?= number_format($data['total'], 0, ',', '.') ?></td>
                                            <td>Rp<?= number_format($data['diskon'], 0, ',', '.') ?></td>
                                            <td>Rp<?= number_format($data['total'] - $data['diskon'], 0, ',', '.') ?></td>
                                            <td><?= $data['waktu'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/laporan_penjualan/detail/') . $data['id_transaksi_sales'] ?>"><button type="submit" class="btn btn-primary">Detail</button></a>
                                                <hr>
                                                <a href="<?= base_url('admin/laporan_penjualan/print/') . $data['id_transaksi_sales'] ?>"><button type="submit" class="btn btn-info">Print</button></a>
                                            </td>
                                        </tr>
                                <?php $no++;
                                    }}
                                } ?>

                            </tbody>

                        </table>
                        <br>
                        <a href="<?= base_url('admin/laporan_penjualan/') ?>"><button type="button" class="btn btn-danger btn-lg btn-block">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>