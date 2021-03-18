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
                        <h5 class="card-title">Laporan Penjualan Pertanggal</h5>
                        <!-- <select class="mb-5" name="" id="periode" width="600px">
                            <option value="" selected disabled>Pilih Periode</option>
                            <option value="">Semua</option>
                            <option value="harian">Hari Ini</option>
                            <option value="mingguan">1 Minggu Kebelakang</option>
                            <option value="bulanan">Bulan Ini</option>
                        </select> -->

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

                                <?php if ($parsing['laporan_penjualan'] != 0) {
                                    $no = 1;
                                    foreach ($parsing['laporan_penjualan'] as $data) {
                                        if ($parsing['total'] > 0) {
                                ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $data['tanggal'] ?></td>
                                                <td><?= $data['jumlah'] == 0 ? "<span class='text text-success'>Selesai</span>" : "<span class='text text-danger'>Belum Selesai</span>" ?></td>
                                                <td>
                                                <?php if ($data['jumlah'] != 0 ) { ?>
                                                <a href="<?= base_url('admin/laporan_penjualan/pertanggal/') . $data['tanggal'] ?>"><button type="submit" class="btn btn-info">Masuk</button></a>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                <?php $no++;
                                        }
                                    }
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