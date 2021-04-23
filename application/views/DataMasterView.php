<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <style>
        .card {
            height: 100%;
            color: white;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php $this->load->view('partials/nav'); ?>
    <div class="container my-3">
        <h3 class="text-left navy">Data Master</h3>
        <div class="row mt-2">
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/barang' ?>" class="text-decoration-none">
                    <div class="card bg-info rounded-0">
                        <div class="card-body text-center text-white">
                            <h4 class="card-title"><i class="fas fa-warehouse fa-3x"></i></h4>
                            <h4 class="card-text">Data Barang</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/supplier' ?>" class="text-decoration-none">
                    <div class="card bg-dark rounded-0">
                        <div class="card-body text-center text-white">
                            <h4 class="card-title"><i class="fas fa-address-book fa-3x"></i></h4>
                            <h4 class="card-text">Data Supplier</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/karyawan' ?>" class="text-decoration-none">
                    <div class="card bg-success rounded-0">
                        <div class="card-body text-center text-white">
                            <h4 class="card-title"><i class="fa fa-users fa-3x" aria-hidden="true"></i></h4>
                            <h4 class="card-text">Data Karyawan</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/user' ?>" class="text-decoration-none">
                    <div class="card bg-primary rounded-0">
                        <div class="card-body text-center text-white">
                            <h4 class="card-title"><i class="fas fa-user-friends fa-3x"></i></h4>
                            <h4 class="card-text">Data User</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#modelId">
                    <div class="card bg-danger rounded-0">
                        <div class="card-body text-center text-white">
                            <h4 class="card-title"><i class="fas fa-file-archive fa-3x"></i></h4>
                            <h4 class="card-text">Laporan Bulanan</h4>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'laporan' ?>" method="POST">
                                <div class="modal-body">
                                    <select name="bln">
                                        <option value="4">April</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Cetak</button>
                                </div>
                            </form>
                        </div>
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