<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Form Item RKAB</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Item RKAB</h5>
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("admin/rkab/aksi_tambah/$parsing[id_rkab]/$parsing[id_transaksi_sales]") ?>">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Driver</label>
                                <select id="id_driver" name="id_driver" class="form-control" tabindex="-1" style="width: 100%">
                                    <option value="0" disabled selected>Pilih Driver</option>
                                    <?php foreach ($parsing['driver'] as $data) { ?>
                                        <option value="<?= $data['id_driver'] ?>"><?= $data['nama_driver'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Item</label>
                                <select id="id_item_transaksi" name="id_item_transaksi" class="form-control" tabindex="-1" style="width: 100%">
                                    <option value="0" disabled selected>Pilih Item</option>
                                    <option value="all">Semua Item</option>
                                    <?php foreach ($parsing['item_transaksi'] as $data) { ?>
                                        <option value="<?= $data['id_item_transaksi'] ?>"><?= $data['nama_barang'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal</label>
                                <input name="tanggal" type="date" class="form-control" id="exampleInputPassword1" placeholder="Tanggal" required>
                            </div> -->
                            <button type="submit" class="btn btn-block btn-primary">Tambah</button>

                        </form>
                        <br>
                        <hr>
                        <br>
                        <a href="#"><button onclick="history.back()" class="btn btn-block btn-danger">Batalkan</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>