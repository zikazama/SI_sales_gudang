<div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Form Barang</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                       
                       <?php if($this->uri->segment(3) == 'tambah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tambah Barang</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_barang/aksi_tambah') ?>">
                                        <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Barang</label>
                                                <input name="nama_barang" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Barang" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Merek</label>
                                                <input name="merek" type="text" class="form-control" id="exampleInputPassword1" placeholder="Merek" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Harga</label>
                                                <div class="input-group-prepend">
                                                    <input name="harga" type="text" class="rupiah form-control" id="exampleInputPassword2" onkeyup="rupiah(this)" placeholder="Harga. Contoh: 10000" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Stok</label>
                                                <input name="stok" type="number" class="form-control" id="exampleInputPassword2" placeholder="Stok" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Diskon</label>
                                                <div class="input-group-prepend">
                                                <input name="diskon" type="text" class="form-control" id="exampleInputPassword2" onkeyup="rupiah(this)" placeholder="Diskon. Contoh: 1000" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Minimal Pembelian untuk Diskon</label>
                                                <input name="minimal_kuantitas_diskon" type="number" class="form-control" id="exampleInputPassword2" placeholder="Minimal Pembelian" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Foto Barang</label>
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto Barang" required>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_barang') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } else if ($this->uri->segment(3) == 'ubah') { ?>
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ubah Barang</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/kelola_barang/aksi_ubah/').$parsing['barang'][0]['id_barang'] ?>">
                                        <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Barang</label>
                                                <input name="nama_barang" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Barang" value="<?= $parsing['barang'][0]['nama_barang'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Merek</label>
                                                <input name="merek" type="text" class="form-control" id="exampleInputPassword1" placeholder="Merek" value="<?= $parsing['barang'][0]['merek'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Harga</label>
                                                <div class="input-group-prepend">
                                                    <!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
                                                    <input name="harga" type="text" class="form-control" id="exampleInputPassword2" placeholder="Harga. Contoh: 10000" onkeyup="rupiah(this)" value="<?= $parsing['barang'][0]['harga'] ?>" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Stok</label>
                                                <input name="stok" type="number" class="form-control" id="exampleInputPassword2" placeholder="Stok" value="<?= $parsing['barang'][0]['stok'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Diskon</label>
                                                <div class="input-group-prepend">
                                                <!-- <span class="input-group-text" id="inputGroupPrepend">Rp</span> -->
                                                <input name="diskon" type="text" class="form-control" id="exampleInputPassword2" placeholder="Diskon. Contoh: 10000" onkeyup="rupiah(this)" value="<?= $parsing['barang'][0]['diskon'] ?>" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword2">Minimal Pembelian untuk Diskon</label>
                                                <input name="minimal_kuantitas_diskon" type="number" class="form-control" id="exampleInputPassword2" placeholder="Minimal Pembelian" value="<?= $parsing['barang'][0]['minimal_kuantitas_diskon'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Foto Barang</label>
                                                <img src="<?= base_url() ?>upload/barang/<?= $parsing['barang'][0]['foto'] ?>" height="200px" width="300px" alt="Foto Barang">
                                                <input name="foto" type="file" class="form-control" id="exampleInputPassword1" placeholder="Foto Barang">
                                                <span>Kosongkan jika tidak ingin mengganti foto</span>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('admin/kelola_barang') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                        
                    </div>
                </div>