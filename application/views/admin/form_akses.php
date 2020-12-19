<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Form Akses</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">

        <?php if ($this->uri->segment(3) == 'tambah') { ?>
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Akses</h5>
                            <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_akses/aksi_tambah') ?>">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Toko</label>
                                    <select id="id_toko" name="id_toko" class="form-control" tabindex="-1" style="width: 100%">
                                        <option value="0" disabled selected>Pilih Toko</option>
                                        <?php foreach ($parsing['toko'] as $data) { ?>
                                            <option value="<?= $data['id_toko'] ?>"><?= $data['nama_toko'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Sales</label>
                                    <select id="id_sales" name="id_sales" class="form-control" tabindex="-1" style="width: 100%">
                                        <option value="0" disabled selected>Pilih Sales</option>
                                        <?php foreach ($parsing['sales'] as $data) { ?>
                                            <option value="<?= $data['id_sales'] ?>"><?= $data['nama_sales'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Tambah</button>

                            </form>
                            <br>
                            <hr>
                            <br>
                            <a href="<?= base_url('admin/kelola_akses') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else if ($this->uri->segment(3) == 'ubah') { ?>
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ubah Akses</h5>
                            <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_akses/aksi_ubah/') . $parsing['id_akses_toko'] ?>">
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Toko</label>
                                    <select id="id_toko" name="id_toko" class="form-control" tabindex="-1" style="width: 100%">
                                        <option value="0" disabled>Pilih Toko</option>
                                        <?php foreach ($parsing['toko'] as $data) { ?>
                                            <option value="<?= $data['id_toko'] ?>" <?= $parsing['akses']['id_toko'] == $data['id_toko'] ? 'selected' : '' ?>><?= $data['nama_toko'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nama Sales</label>
                                    <select id="id_sales" name="id_sales" class="form-control" tabindex="-1" style="width: 100%">
                                        <option value="0" disabled>Pilih Sales</option>
                                        <?php foreach ($parsing['sales'] as $data) { ?>
                                            <option value="<?= $data['id_sales'] ?>" <?= $parsing['akses']['id_sales'] == $data['id_sales'] ? 'selected' : '' ?>><?= $data['nama_sales'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Ubah</button>

                            </form>
                            <br>
                            <hr>
                            <br>
                            <a href="<?= base_url('admin/kelola_akses') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>