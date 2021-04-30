<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">
</head>

<body>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead class="bg-warning">
                <th class="text-center">No</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Unit</th>
                <th class="text-center">Stok Awal</th>
                <th class="text-center">Stok Masuk</th>
                <th class="text-center">Stok Keluar</th>
                <th class="text-center">Stok Akhir</th>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $a) :
                    $no++;
                    $kode = $a['kode_barang'];
                    $nama = $a['nama_barang'];
                    $unit = $a['satuan'];
                    $awal = $a['qtyterima1'] - $a['qtykeluar1'];
                    $terima = $a['qtyterima'];
                    $keluar = $a['qtykeluar'];
                    $akhir = $awal + ($terima - $keluar);
                ?>
                    <tr>
                        <td class="align-middle text-center"><?= $no ?></td>
                        <td class="align-middle text-center"><?= $kode ?></td>
                        <td class="align-middle"><?= $nama ?></td>
                        <td class="align-middle"><?= $unit ?></td>
                        <?php if ($awal == NULL) : ?>
                            <td class="align-middle text-center">0</td>
                        <?php else : ?>
                            <td class="align-middle text-center"><?= $awal ?></td>
                        <?php endif; ?>
                        <?php if ($terima == NULL) : ?>
                            <td class="align-middle text-center">0</td>
                        <?php else : ?>
                            <td class="align-middle text-center"><?= $terima ?></td>
                        <?php endif; ?>
                        <?php if ($keluar == NULL) : ?>
                            <td class="align-middle text-center">0</td>
                        <?php else : ?>
                            <td class="align-middle text-center"><?= $keluar ?></td>
                        <?php endif; ?>
                        <td class="align-middle text-center"><?= $akhir ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>

</body>

</html>