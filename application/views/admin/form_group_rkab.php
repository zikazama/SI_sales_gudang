<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Form Group RKAB</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Group RKAB</h5>
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("admin/rkab/aksi_tambah_group/") ?>">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal</label>
                                <input name="tanggal" type="date" class="form-control" id="exampleInputPassword1" placeholder="Tanggal" required>
                            </div>

                            <button type="submit" class="btn btn-block btn-primary">Tambah</button>

                        </form>
                        <br>
                        <hr>
                        <br>
                        <a href="<?= base_url("admin/rkab") ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>