<div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Form Sales</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                       
                       <?php if($this->uri->segment(3) == 'tambah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tambah Sales</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_sales/aksi_tambah') ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Sales</label>
                                                <input name="nama_sales" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Sales" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">NIK</label>
                                                <input name="nik" type="number" class="form-control" id="exampleInputPassword1" placeholder="NIK" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Foto Sales</label>
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto Sales" required>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_sales') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
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
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_sales/aksi_ubah/').$parsing['sales'][0]['id_sales'] ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Sales</label>
                                                <input name="nama_sales" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Sales" value="<?= $parsing['sales'][0]['nama_sales'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">NIK</label>
                                                <input name="nik" type="number" class="form-control" id="exampleInputPassword1" placeholder="NIK" value="<?= $parsing['sales'][0]['nik'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" value="<?= $parsing['sales'][0]['email'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?= $parsing['sales'][0]['password'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Foto Sales</label>
                                                <img src="<?= base_url() ?>upload/sales/<?= $parsing['sales'][0]['foto'] ?>" height="200px" width="300px" alt="Foto Sales">
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto Sales">
                                                <span>Kosongkan jika tidak ingin mengganti foto</span>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_sales') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                        
                    </div>
                </div>