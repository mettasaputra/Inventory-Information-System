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
    <style>
        th {
            background-color: orange;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    $dt = $data->row_array();
    error_reporting(0);
    ?>
    <div class="container-fluid">
        <table>
            <tr>
                <td style="text-align: left; border:none; font-weight: bold; font-size:18pt" colspan="8">Laporan Pemakaian Bulan <?= $dt['bulans'] ?></td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: left; border:none">Divisi : <?= $dt['nama_divisi'] ?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: left; border:none">Tanggal Cetak : <?= Date('d-m-Y H:i') ?></td>
                <td colspan="4" style="text-align: left; border:none">Dicetak oleh : <?= $this->session->userdata('nama') ?></td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead class="bg-warning">
                    <th width="10%">No</th>
                    <th width="10%">Kode Barang</th>
                    <th width="60%">Nama Barang</th>
                    <th width="10%">Jumlah</th>
                    <th width="10%">Unit</th>
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
                            <td><?= $no ?></td>
                            <td><?= $kode ?></td>
                            <td style="text-align: left;"><?= $nama ?></td>
                            <td><?= $jmlh ?></td>
                            <td><?= $unit ?></td>
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