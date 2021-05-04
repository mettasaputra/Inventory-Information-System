<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Data</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
    <?php $this->load->view('partials/nav');
    $a = $brg->row_array();
    ?>
    <div class="container-fluid my-4">
        <h3 class="text-center">DAFTAR SUPPLIER</h3>
        <table>
            <tr>
                <td class="font-weight-bold" width="180px">Kategori</td>
                <td> : <?= $a['nama_kategori'] ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Nama Barang</td>
                <td> : <?= $a['nama_barang'] ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Satuan</td>
                <td> : <?= $a['satuan'] ?></td>
            </tr>
        </table>
        <div class="card rounded-0 my-2" style="height: 350px; overflow-y:auto;">
            <div class="card-body p-0">
                <div class="card-text">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Contact Person</th>
                                <th>No Telp</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($data->result_array() as $dt) :
                                    $no++;
                                    $nama = $dt['nama_supplier'];
                                    $cp = $dt['contact_person'];
                                    $telp = $dt['no_telp'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td><?= $nama ?></td>
                                        <td><?= $cp ?></td>
                                        <td class="text-center"><?= $telp ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
</body>

</html>