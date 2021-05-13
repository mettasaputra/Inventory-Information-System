<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stock</title>
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
        <h3 class="text-center">KARTU STOCK</h3>
        <div class="row">
            <div class="col-md-8">
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
            </div>
            <div class="col-md-4">
                <a href="<?= base_url() . 'barang/cetak_kartu?id=' . $a['id_barang'] ?>" class="btn btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i> Download Kartu Stock</a>
            </div>
        </div>
        <div class="card rounded-0 my-2" style="height: 350px; overflow-y:auto;">
            <div class="card-body p-0">
                <div class="card-text">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead class="bg-dark text-white ">
                                <th class="text-center" width="15%">Tgl</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Masuk</th>
                                <th class="text-center">Keluar</th>
                                <th class="text-center">Saldo</th>
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
                                        <td class="text-center"><?= $tgl ?></td>
                                        <td><?= $ket ?></td>
                                        <?php if ($jmlh < 0) : ?>
                                            <td></td>
                                            <td class="text-center"><?= $jmlh ?></td>
                                        <?php else : ?>
                                            <td class="text-center"><?= $jmlh ?></td>
                                            <td></td>
                                        <?php endif; ?>
                                        <td class="text-center"><?= $saldo ?></td>
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