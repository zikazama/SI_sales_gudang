<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Form TTS</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">


        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form TTS</h5>
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/laporan_penjualan/aksi_edit_tts/') . $parsing['id_transaksi_sales'] ?>">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Total Setoran</label>
                                <input type="text" class="form-control" id="totalSetoran" value="<?= $parsing['pembayaran'] ?>" placeholder="Nama Toko" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Potongan</label>
                                <input name="potongan" onkeyup="rupiah(this)" type="text" class="form-control" id="potongan" value="<?= $parsing['transaksi']['potongan'] ?>" placeholder="Nama Toko" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Total Masuk TTS</label>
                                <input type="text" class="form-control" onclick="rupiah(this)" id="totalMasuk" value="<?= (int)$parsing['pembayaran'] - (int)$parsing['transaksi']['potongan'] ?>" placeholder="Nama Toko" readonly>
                            </div>


                            <button type="submit" class="btn btn-block btn-primary">Transfer</button>

                        </form>
                        <br>
                        <hr>
                        <br>
                        <button class="btn btn-block btn-danger" onclick="window.history.back()">Batalkan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>