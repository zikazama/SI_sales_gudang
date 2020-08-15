<div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                        
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ubah Password</h5>
                                        <?php 
                                    if($this->session->flashdata('status') === 0){
                                ?>
								<div class="alert alert-danger" role="alert">
									<?= $this->session->flashdata('message') ?>
								</div>
								<?php
                                    } else if ($this->session->flashdata('status') === 1){
								?>
								<div class="alert alert-success" role="alert">
									<?= $this->session->flashdata('message') ?>
								</div>
								<?php
									}
                                ?>
                                        <form method="POST" action="<?= base_url('setting/aksi_ubah_password/').$this->session->userdata('id') ?>">
                                        <div class="form-group">
                                                <label for="exampleInputPassword1">Password Lama</label>
                                                <input name="password_lama" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password Lama">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Password Baru</label>
                                                <input name="password_baru" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password Baru">
                                            </div>
                                          
                                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="page-content">
                   
                    <div class="main-wrapper">
                        
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ubah Foto</h5>
                                        <?php 
                                    if($this->session->flashdata('status') === 4){
                                ?>
								<div class="alert alert-danger" role="alert">
									<?= $this->session->flashdata('message') ?>
								</div>
								<?php
                                    } else if ($this->session->flashdata('status') === 3){
								?>
								<div class="alert alert-success" role="alert">
									<?= $this->session->flashdata('message') ?>
								</div>
								<?php
									}
                                ?>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('setting/aksi_ubah_foto/').$this->session->userdata('id') ?>">
                                        <div class="form-group">
                                                <label for="exampleInputPassword1">Foto</label>
                                                <?php if($this->session->userdata('foto') != null) { ?>
                                                <img src="<?= base_url() ?>upload/sales/<?= $this->session->userdata('foto') ?>" height="200px" width="300px" alt="Foto Sales">
                                                <?php } ?>
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto" required>
                                            </div>
                                          
                                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>