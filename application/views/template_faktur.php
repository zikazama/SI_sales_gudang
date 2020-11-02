<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur</title>
    <style>
        .konten {
            max-width: 297mm;
        }

        h3 {
            text-align: center;
        }

        table.beda {
            width: 100%;

        }

        th {
            font-size: 10px;
        }

        td {
            font-size: 12px;
        }



        td.barang,
        th.barang,
        tr.barang {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-collapse: collapse;
        }

        table.barang {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        /*
        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.no,
        th.no {
            width: 20px;
            max-width: 20px;
            word-break: break-all;
        }

        td.quantity,
        th.quantity {
            width: 20px;
            max-width: 20px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 60px;
            max-width: 60px;
            word-break: break-all;
        } */
        table.barang {
            width: 100%;
            text-align: center;
        }

        .hide {
            border-bottom: none;
        }

        .double {
            border-top: double;
        }

        div.signature {
            margin-left: 70px;
            width: 60mm;
            text-align: center;
        }

        div.row {
            display: table;
            width: 100%;
            /*Optional*/
            table-layout: fixed;
            /*Optional*/
            border-spacing: 10px;
            /*Optional*/
        }

        div.column {
            display: table-cell;
            float: left;
        }
    </style>
</head>

<body>
    <h3>FAKTUR</h3>
    
    <table class="beda">
        <tr>
            <td>CV. Andika Emas Abadi</td>
            <td style="width: 70mm"></td>
            <td>Tanggal : <?= $transaksi[0]['waktu'] ?></td>
        </tr>
        <tr>
            <td>Jl. Raya Eyang Soemohardjo.</td>
            <td style="width: 70mm"></td>
            <td>Kepada Yth : Toko <?= $transaksi[0]['nama_toko'] ?></td>

        </tr>
        <tr>
            <td>Desa Kediri Kecamatan Binong Subang</td>
            <td style="width: 70mm"></td>
            <td>Sales : <?= $transaksi[0]['nama_sales'] ?></td>
        </tr>
    </table>

    <table class="barang">
        <thead>
            <tr class="double">
                <th class="no barang">NO</th>

                <th class="description barang">Barang</th>
                <th class="quantity barang">Quantity (/Pcs)</th>
                <th class="quantity barang">Quantity Besar (/Box)</th>
                <th class="quantity barang">Harga (/Pcs)</th>
                <th class="quantity barang">Harga (/Box)</th>
                <th class="quantity barang">Discount</th>
                <th class="quantity barang">Harga Total</th>
                <th class="price barang">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = $index_awal;
            for ($i=$index_awal-1; $i < $index_akhir; $i++) {
            ?>
                <tr class="">
                    <td class="no "><?= $no ?></td>
                    <td class="description "><?= $item[$i]['nama_barang'] . ' - ' . $item[$i]['merek'] ?></td>
                    <td class="quantity "><?= $item[$i]['kuantitas'] ?></td>
                    <td class="quantity "><?= $item[$i]['kuantitas_perbox'] ?></td>
                    <td class="quantity ">Rp<?= number_format($item[$i]['kuantitas'] ? $item[$i]['harga'] : 0 , 0, ',', '.') ?></td>
                    <td class="quantity ">Rp<?= number_format($item[$i]['kuantitas_perbox'] ? $item[$i]['harga_perbox'] : 0, 0, ',', '.') ?></td>
                    <td class="quantity ">Rp<?= number_format($item[$i]['subdiskon'], 0, ',', '.') ?></td>
                    <td class="quantity ">Rp<?= number_format($item[$i]['subtotal'] + $item[$i]['subdiskon'], 0, ',', '.') ?></td>
                    <td class="price ">Rp<?= number_format($item[$i]['subtotal'], 0, ',', '.') ?></td>
                </tr>
            <?php $no++;
            } ?>
            <tr class="">
                <td class="no hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="description barang">SUBTOTAL</td>
                <td class="price barang">Rp<?= number_format($transaksi[0]['total'] + $transaksi[0]['diskon'], 0, ',', '.') ?></td>
            </tr>
            <tr class="">
                <td class="no hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="description barang">DISKON</td>
                <td class="price barang">Rp<?= number_format($transaksi[0]['diskon'], 0, ',', '.') ?></td>
            </tr>
            <tr class="">
                <td class="no hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="description barang">TOTAL</td>
                <td class="price barang">Rp<?= number_format($transaksi[0]['total'], 0, ',', '.') ?></td>
            </tr>
            <tr class="">
                <td class="no hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="description barang">Terbayar</td>
                <td class="price barang">Rp<?= number_format($pembayaran_masuk['pembayaran_masuk'], 0, ',', '.') ?></td>
            </tr>
            <tr class="">
                <td class="no hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="quantity hide"></td>
                <td class="description barang">Sisa</td>
                <td class="price barang">Rp<?= number_format(($transaksi[0]['total']) - $pembayaran_masuk['pembayaran_masuk'], 0, ',', '.') ?></td>
            </tr>

        </tbody>
    </table>
            <br>
    <?php if($status_ttd) { ?>
    <div class="row">
        <div class="column keterangan">

        </div>
        <div class="column signature">
            Diterima Oleh,
            <br><br><br><br>
            <hr>
            Tanda Tangan & Nama Jelas
        </div>
        <div class="column signature">
            Hormat Kami,
            <br><br><br><br>
            <hr>
            ADK
        </div>
    </div>
    <?php } ?>
    <script>
        window.print();
    </script>
</body>

</html>