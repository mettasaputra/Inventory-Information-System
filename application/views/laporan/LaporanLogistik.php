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
    <div class="container-fluid my-3">
        <table>
            <tr>
                <td style="text-align: left; border:none; font-weight: bold; font-size:18pt" colspan="8">Laporan Stok Bulan <?= date("F Y", strtotime($this->session->userdata('bln'))); ?></td>
            </tr>
            <tr>
            <tr>
                <td colspan="4" style="text-align: left; border:none">Tanggal Cetak : <?= Date('d-m-Y H:i') ?></td>
                <td colspan="4" style="text-align: left; border:none">Dicetak oleh : <?= $this->session->userdata('nama') ?></td>
            </tr>
            </tr>
        </table>
        <div class="row">
            <div class="table-responsive my-3">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok Awal</th>
                        <th>Stok Terima</th>
                        <th>Stok Keluar</th>
                        <th>Stok Akhir</th>
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
                                <td><?= $no ?></td>
                                <td><?= $kode ?></td>
                                <td style="text-align: left !important;"><?= $nama ?></td>
                                <td><?= $unit ?></td>
                                <?php if ($awal == NULL) : ?>
                                    <td>0</td>
                                <?php else : ?>
                                    <td><?= $awal ?></td>
                                <?php endif; ?>

                                <?php if ($terima == NULL) : ?>
                                    <td>0</td>
                                <?php else : ?>
                                    <td><?= $terima ?></td>
                                <?php endif; ?>

                                <?php if ($keluar == NULL) : ?>
                                    <td>0</td>
                                <?php else : ?>
                                    <td><?= $keluar ?></td>
                                <?php endif; ?>

                                <td><?= $akhir ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>

</body>

</html>