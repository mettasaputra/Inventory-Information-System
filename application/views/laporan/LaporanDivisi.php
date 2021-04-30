<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemakaian</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">
</head>

<body>
    <?php
    $dt = $data->row_array();
    ?>
    <div class="container-fluid">
        <p class="text-center font-weight-bold text-uppercase">LAPORAN PEMAKAIAN BULAN <?= $dt['bulans'] ?></p>
        <p>Divisi : <?= $dt['nama_divisi'] ?></p>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="bg-warning">
                    <th class="text-center" width="10%">No</th>
                    <th class="text-center" width="10%">Kode Barang</th>
                    <th class="text-center" width="60%">Nama Barang</th>
                    <th class="text-center" width="10%">Jumlah</th>
                    <th class="text-center" width="10%">Unit</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $a) :
                        $no++;
                        $kode = $a['kode_barang'];
                        $nama = $a['nama_barang'];
                        $unit = $a['satuan'];
                        $jmlh = $a['jlh'];
                    ?>
                        <tr>
                            <td class="align-middle text-center"><?= $no ?></td>
                            <td class="align-middle text-center"><?= $kode ?></td>
                            <td class="align-middle"><?= $nama ?></td>
                            <td class="align-middle text-center"><?= $jmlh ?></td>
                            <td class="align-middle"><?= $unit ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>

</body>

</html>