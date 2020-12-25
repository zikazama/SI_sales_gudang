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
                        <!-- <select class="mb-5" name="" id="periode" width="600px">
                            <option value="" selected disabled>Pilih Periode</option>
                            <option value="">Semua</option>
                            <option value="harian">Hari Ini</option>
                            <option value="mingguan">1 Minggu Kebelakang</option>
                            <option value="bulanan">Bulan Ini</option>
                        </select> -->
                        <div class="box border border-success p-3">
                            <h4 class="text text-primary">Nama Toko : <?= $parsing['toko']['nama_toko'] ?></h4>
                            <h4 class="text text-primary">Alamat Toko : <?= $parsing['toko']['alamat'] ?></h4>
                        </div>
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
                        <?php if ($parsing['sisa'] > 0) { ?>
                            <a href="<?= base_url("admin/rkab/tambah/$parsing[id_rkab]") ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Tambah Item RKAB</button></a>
                        <?php } else if ($parsing['sisa'] == 0 && $parsing['status_proses'] == 0) { ?>
                            <form action="<?= base_url("admin/rkab/process/$parsing[id_rkab]/$parsing[id_transaksi_sales]") ?>" method="post">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Group RKAB</label>
                                    <select id="id_group_rkab" name="id_group_rkab" class="form-control" tabindex="-1" style="width: 100%">
                                        <option value="0" disabled selected>Pilih Group RKAB</option>
                                        <?php foreach ($parsing['group_rkab'] as $data) { ?>
                                            <option value="<?= $data['id_group_rkab'] ?>"><?= $data['id_group_rkab'] ?> | <?= $data['tanggal'] ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <a href="#"><button type="submit" class="btn btn-info btn-lg btn-block">Berangkat</button></a>
                            </form>
                        <?php } else if ($parsing['status_proses'] == 1) { ?>
                            <a href="#"><button type="button" class="btn btn-warning btn-lg btn-block">Sedang Dalam Perjalanan</button></a>
                        <?php } else if ($parsing['status_proses'] == 2) { ?>
                            <a href="#"><button type="button" class="btn btn-primary btn-lg btn-block">Sudah Diantar</button></a>
                        <?php } ?>
                        <br>
                        <table id="zero-conf" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Driver</th>
                                    <th>Nama Item</th>
                                    <th>PCS</th>
                                    <th>BOX</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($parsing['item_rkab'] != 0) {
                                    $no = 1;
                                    foreach ($parsing['item_rkab'] as $data) {
                                ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data['nama_driver'] ?></td>
                                            <td><?= $data['nama_barang'] ?></td>
                                            <td><?= $data['kuantitas'] ?></td>
                                            <td><?= $data['kuantitas_perbox'] ?></td>
                                            <td>
                                                <?php if ($parsing['status_proses'] == 0) { ?>
                                                    <a href="<?= base_url('admin/rkab/hapus_item/') . $data['id_rkab_item'] . '/' . $parsing["id_transaksi_sales"] ?>"><button type="submit" class="btn btn-danger">Hapus</button></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php $no++;
                                    }
                                } ?>

                            </tbody>

                        </table>
                        <br>
                        <a href="#"><button type="button" onclick="history.back()" class="btn btn-danger btn-lg btn-block">Kembali</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>