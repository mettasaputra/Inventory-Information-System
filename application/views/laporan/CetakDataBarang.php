<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
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
    ?>
    <div class="container-fluid my-3">
        <table>
            <tr>
                <?php
                if ($this->session->userdata('id') == "all") :
                ?>
                    <td style="text-align: left; border:none; font-weight: bold; font-size:18pt" colspan="8">Data Barang</td>
                <?php else : ?>
                    <td style="text-align: left; border:none; font-weight: bold; font-size:18pt" colspan="8">Data Barang <?= $dt['kat'] ?></td>
                <?php endif; ?>
            </tr>
        </table>
        <div class="row">
            <div class="table-responsive my-3">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <?php if ($this->session->userdata('id') == "all") : ?>
                            <th>Kategori</th>
                        <?php endif; ?>
                        <th>Satuan</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data->result_array() as $a) :
                            $no++;
                            $kode = $a['kode_barang'];
                            $nama = $a['nama_barang'];
                            $satuan = $a['satuan'];
                            $kat = $a['kat'];
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $kode ?></td>
                                <td style="text-align: left !important;"><?= $nama ?></td>
                                <?php if ($this->session->userdata('id') == "all") : ?>
                                    <td><?= $kat ?></td>
                                <?php endif; ?>
                                <td><?= $satuan ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p>Tanggal Cetak : <?= Date('d-m-Y H:i') ?></p>
            <p>Dicetak dan divalidasi oleh,</p>
            <p style="height:30px"></p>
            <p><?= $this->session->userdata('nama') ?></p>
        </div>
    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>

</body>

</html>