<div class="page-content">
                    <div class="page-info">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Form Lokasi</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="main-wrapper">
                       
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Atur Lokasi</h5>
                                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("lokasi/aksi_atur/$parsing[id_toko]") ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Latitude</label>
                                                <input id="latitude" name="latitude" type="text" class="form-control" id="exampleInputPassword1" placeholder="Latitude" required readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Longitude</label>
                                                <input id="longitude" name="longitude" type="text" class="form-control" id="exampleInputPassword1" placeholder="Longitude" required readonly>
                                            </div>
                                            <button id="getLocation" class="btn btn-block btn-info">Dapatkan Lokasi</button>
                                            <button type="submit" class="btn btn-block btn-primary">Atur</button>
                                           
                                        </form>
                                        <br>
                                        <hr>
                                        <br>
                                        <a href="<?= base_url('lokasi') ?>"><button class="btn btn-block btn-danger">Batalkan</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>