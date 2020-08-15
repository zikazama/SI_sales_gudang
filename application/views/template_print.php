<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
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
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
    <title>Cetak Struk</title>
</head>

<body>
    <div class="ticket">
        <img src="<?= base_url() ?>/assets/images/logo2.png" alt="Logo">
        <p class="centered">Struk Pembelian CV. Andika Emas Abadi
            <br>Subang</p>
        <br>
        <table width="100%">
            <tr>
                <td>Nama Toko</td>
                <td>:</td>
                <td><?= $transaksi[0]['nama_toko'] ?></td>
            </tr>
        </table>
        <br>
        <h3>Barang</h3>
        <table>
            <thead>
                <tr>
                    <th class="quantity">Q.</th>
                    <th class="description">Barang</th>
                    <th class="price">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($item as $data) { ?>
                    <tr>
                        <td class="quantity"><?= $data['kuantitas'] ?></td>
                        <td class="description"><?= $data['nama_barang'] . ' - ' . $data['merek'] ?></td>
                        <td class="price">Rp<?= number_format($data['subtotal'],0,',','.') ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">SUBTOTAL</td>
                    <td class="price">Rp<?= number_format($transaksi[0]['total'],0,',','.') ?></td>
                </tr>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">DISKON</td>
                    <td class="price">Rp<?= number_format($transaksi[0]['diskon'],0,',','.') ?></td>
                </tr>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">TOTAL</td>
                    <td class="price">Rp<?= number_format($transaksi[0]['total'] - $transaksi[0]['diskon'],0,',','.') ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <h3>Pembayaran</h3>
        <table>
            <thead>
                <tr>
                    <th class="quantity">No</th>
                    <th class="description">Tanggal</th>
                    <th class="price">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($pembayaran as $data) { ?>
                    <tr>
                        <td class="quantity"><?= $no ?></td>
                        <td class="description"><?= $data['created_at'] ?></td>
                        <td class="price">Rp<?= number_format($data['jumlah_pembayaran'],0,',','.') ?></td>
                    </tr>
                <?php $no++;
                } ?>
                <tr>
                    <td class="quantity"></td>
                    <td class="description">TERBAYAR</td>
                    <td class="price">Rp<?= number_format($pembayaran_masuk['pembayaran_masuk'],0,',','.') ?></td>
                </tr>
                <?php if (($transaksi[0]['total'] - $transaksi[0]['diskon']) > $pembayaran_masuk['pembayaran_masuk']) { ?>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">Status</td>
                        <td class="price">Belum <br>Lunas</td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">SISA</td>
                        <td class="price">Rp<?= number_format(($transaksi[0]['total'] - $transaksi[0]['diskon']) - $pembayaran_masuk['pembayaran_masuk'],0,',','.') ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">Status</td>
                        <td class="price">Lunas</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <p class="centered">Terima kasih atas pembeliannya!
            <br>POWERED By SISAGU</p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>

</html>