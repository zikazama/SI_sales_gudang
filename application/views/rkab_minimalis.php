<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur</title>
    <style>
        /* .konten {
            max-width: 297mm;
        } */

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
            width: 90%;
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
            font-size: 12px;
        }

        .kontab {
            width: 50%;
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
        .list_faktur {
            width: 400px;
        }
    </style>
</head>

<body>
    <h3>RKAB</h3>

    <table class="beda">
        <tr>
            <td style="width:130mm">CV. Andika Emas Abadi</td>
            <!-- <td style="width: 70mm"></td> -->
            <td rowspan="3" class="list_faktur" style="width:130mm">No Faktur:
            <?= $list_faktur ?> <br>
            Tanggal: <?= $group_rkab[0]['created_at'] ?>
            </td>

        </tr>
        <tr>
            <td>Jl. Raya Eyang Soemohardjo.</td>
            <!-- <td style="width: 70mm"></td> -->
            <!-- <td></td> -->


        </tr>
        <tr>
            <td>Desa Kediri Kecamatan Binong Subang</td>
            <!-- <td style="width: 70mm"></td> -->
            <!-- <td></td> -->

        </tr>
    </table>

    <div class="row" style="width:100%;">
        <?php if($table_a) { ?>
        <div class="column kontab">
            <table class="barang">
                <thead>
                    <tr class="double">
                        <th class="no barang">NO</th>

                        <th class="description barang">Barang</th>
                        <th class="quantity barang">Quantity (/Pcs)</th>
                        <th class="quantity barang">Quantity Besar (/Box)</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = $index_awal_a;
                    for ($i = $index_awal_a - 1; $i < $index_akhir_a; $i++) {
                    ?>
                        <tr class="">
                            <td class="no "><?= $no ?></td>
                            <td class="description "><?= $group_rkab[$i]['nama_barang'] . ' - ' . $group_rkab[$i]['merek'] ?></td>
                            <td class="quantity "><?= $group_rkab[$i]['kuantitas_group'] ?></td>
                            <td class="quantity "><?= $group_rkab[$i]['kuantitas_perbox_group'] ?></td>

                        </tr>
                    <?php $no++;
                    } ?>


                </tbody>
            </table>
        </div>
        <?php } ?>
        <?php if($table_b) { ?>
        <div class="column kontab">
            <table class="barang">
                <thead>
                    <tr class="double">
                        <th class="no barang">NO</th>

                        <th class="description barang">Barang</th>
                        <th class="quantity barang">Quantity (/Pcs)</th>
                        <th class="quantity barang">Quantity Besar (/Box)</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = $index_awal_b;
                    for ($i = $index_awal_b - 1; $i < $index_akhir_b; $i++) {
                    ?>
                        <tr class="">
                            <td class="no "><?= $no ?></td>
                            <td class="description "><?= $group_rkab[$i]['nama_barang'] . ' - ' . $group_rkab[$i]['merek'] ?></td>
                            <td class="quantity "><?= $group_rkab[$i]['kuantitas_group'] ?></td>
                            <td class="quantity "><?= $group_rkab[$i]['kuantitas_perbox_group'] ?></td>

                        </tr>
                    <?php $no++;
                    } ?>


                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <br>
    <?php if ($status_ttd) { ?>
        <div class="row">
            <div class="column keterangan">

            </div>
            <div class="column signature">
                Driver
                <br><br><br>
                <?= $driver ?>
                <hr>

            </div>
            <div class="column signature">
                B. Gudang
                <br><br><br><br>
                <hr>

            </div>
        </div>
    <?php } ?>
    <script>
        window.print();
    </script>
</body>

</html>