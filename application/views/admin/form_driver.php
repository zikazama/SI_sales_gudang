<div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Form driver</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                       
                       <?php if($this->uri->segment(3) == 'tambah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tambah driver</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_driver/aksi_tambah') ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama driver</label>
                                                <input name="nama_driver" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama driver" required>
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
                                                <label for="exampleInputPassword1">Foto driver</label>
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto driver" required>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_driver') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } else if ($this->uri->segment(3) == 'ubah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ubah driver</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_driver/aksi_ubah/').$parsing['driver'][0]['id_driver'] ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama driver</label>
                                                <input name="nama_driver" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama driver" value="<?= $parsing['driver'][0]['nama_driver'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">NIK</label>
                                                <input name="nik" type="number" class="form-control" id="exampleInputPassword1" placeholder="NIK" value="<?= $parsing['driver'][0]['nik'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" value="<?= $parsing['driver'][0]['email'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?= $parsing['driver'][0]['password'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Foto driver</label>
                                                <img src="<?= base_url() ?>upload/driver/<?= $parsing['driver'][0]['foto'] ?>" height="200px" width="300px" alt="Foto driver">
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto driver">
                                                <span>Kosongkan jika tidak ingin mengganti foto</span>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_driver') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                        
                    </div>
                </div>