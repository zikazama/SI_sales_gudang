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
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("admin/rkab/aksi_tambah/").$this->uri->segment(4) ?>">
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">No Faktur</label>
                                <input name="id_transaksi_sales" type="text" class="form-control" id="exampleInputPassword1" placeholder="No Faktur" required>
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