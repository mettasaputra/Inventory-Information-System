<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stock</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <style>
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $a = $brg->row_array();
    ?>
    <table class="table table-sm">
        <thead>
            <tr>
                <th style="border:none;font-size:12pt" colspan="6"><b>KARTU STOCK</b></th>
            </tr>
            <tr>
                <th style="border:none" colspan="3" style="text-align: left;">Nama Barang : <?= $a['nama_barang'] ?></th>
                <th style="border:none" colspan="3">Harga : __________</th>
            </tr>
            <tr>
                <th colspan="6" style="border: none;"></th>
            </tr>
        </thead>
    </table>

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped">
            <thead>
                <th class="text-center">Tgl</th>
                <th class="text-center">No. Nota</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Masuk</th>
                <th class="text-center">Keluar</th>
                <th class="text-center">Sisa</th>
            </thead>
            <tbody>
                <?php
                $saldo = 0;
                foreach ($data->result_array() as $a) :
                    $tgl = date("d/m/Y", strtotime($a['tanggal']));
                    $ket = $a['keterangan'];
                    $jmlh = $a['qty'];
                    $saldo += $jmlh;
                ?>
                    <tr>
                        <td><?= $tgl ?></td>
                        <td style="text-align: center;"></td>
                        <td><?= $ket ?></td>
                        <?php if ($jmlh < 0) : ?>
                            <td width="15%"></td>
                            <td width="15%" style="text-align: center;"><?= $jmlh ?></td>
                        <?php else : ?>
                            <td width="15%" style="text-align: center;"><?= $jmlh ?></td>
                            <td width="15%"></td>
                        <?php endif; ?>
                        <td width="15%" style="text-align: center;"><?= $saldo ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Total Akhir</td>
                    <td style="text-align: center;"><?= $brg->row_array()['stok'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
</body>

</html>