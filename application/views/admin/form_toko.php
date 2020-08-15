<div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Form Toko</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                       
                       <?php if($this->uri->segment(3) == 'tambah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tambah Toko</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_toko/aksi_tambah') ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Toko</label>
                                                <input name="nama_toko" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Toko" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Alamat</label>
                                                <textarea name="alamat" type="number" class="form-control" id="exampleInputPassword1" placeholder="Alamat" required rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_toko') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } else if ($this->uri->segment(3) == 'ubah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ubah Sales</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_toko/aksi_ubah/').$parsing['toko'][0]['id_toko'] ?>">
                                        <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Toko</label>
                                                <input name="nama_toko" type="text" class="form-control" id="exampleInputPassword1" value="<?= $parsing['toko'][0]['nama_toko'] ?>" placeholder="Nama Toko" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Alamat</label>
                                                <textarea name="alamat" type="number" class="form-control" id="exampleInputPassword1" placeholder="Alamat" required rows="3"><?= $parsing['toko'][0]['alamat'] ?></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_toko') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                        
                    </div>
                </div>