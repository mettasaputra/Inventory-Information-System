<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permintaan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
    <div class="container-fluid my-3">
        <div class="card rounded-0 bg-light" style="height: 530px; overflow-y:auto">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title navy">Daftar Permintaan Barang</h4>
                        <p class="lead">
                            Nama Karyawan : <?= $this->session->userdata('nama') ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url() . 'administrator/logout' ?>" class="ml-2 btn btn-sm btn-info float-right"> Logout</a>
                        <a href="<?= base_url() . 'permintaan' ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-pencil" aria-hidden="true"></i> Ajukan Permintaan Barang</a>
                    </div>
                </div>


                <div class="card-text">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-primary text-white">
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Tanggal Permintaan</th>
                                <th class="text-center align-middle">Tgl Dibutuhkan</th>
                                <th class="text-center align-middle">Keterangan</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Opsi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                foreach ($data->result_array() as $a) :
                                    $no++;
                                    $id = $a['id_permintaan'];
                                    $tglpermintaan = date("d-m-Y H:i", strtotime($a['created_at']));
                                    $tgl = date("d-m-Y", strtotime($a['tanggal_kebutuhan']));
                                    $ket = $a['keterangan'];
                                ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $no ?></td>
                                        <td class="text-center align-middle"><?= $tglpermintaan ?></td>
                                        <td class="text-center align-middle"><?= $tgl ?></td>
                                        <td class="align-middle"><?= $ket ?></td>
                                        <td class="align-middle bg-danger text-white">Menunggu</td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-sm btn-primary" href="<?= base_url() . 'permintaan/detail?id=' . $id ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
                                            <a class="btn btn-sm btn-danger" href="<?= base_url() . 'permintaan/delete_permintaan?id=' . $id ?>"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
                                        </td>
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
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        })
    </script>
</body>

</html>