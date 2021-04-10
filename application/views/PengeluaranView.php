<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengeluaran</title>
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
        <h3 class="text-center text-dark">Dashboard Pengeluaran</h3>
        <hr />
        <div class="row mt-3">
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'pengeluaran/requestby' ?>" class="text-decoration-none">
                    <div class="card rounded-0 bg-primary">
                        <div class="card-body">
                            <div class="card-title"><i class="fas fa-truck-loading fa-3x"></i></div>
                            <p class="card-text">Pengeluaran Barang</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'pengeluaran/opsional' ?>" class="text-decoration-none">
                    <div class="card rounded-0 bg-info">
                        <div class="card-body">
                            <div class="card-title"><i class="fa fa-exchange-alt fa-3x" aria-hidden="true"></i></div>
                            <p class="card-text">Pengeluaran Barang Lain-Lain</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#modelId">
                    <div class="card rounded-0 bg-danger">
                        <div class="card-body">
                            <div class="card-title"><i class="fas fa-calendar-alt fa-3x" aria-hidden="true"></i></div>
                            <p class="card-text">History Pengeluaran Barang</p>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">History pengeluaran ke internal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'pengeluaran/datahistory' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dari</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sampai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="to">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                    <input type="submit" class="btn btn-sm btn-primary" value="Cari">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#modelll">
                    <div class="card rounded-0 bg-success">
                        <div class="card-body">
                            <div class="card-title"><i class="far fa-calendar-alt fa-3x" aria-hidden="true"></i></div>
                            <p class="card-text">History Pengeluaran Barang Lain-Lain</p>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="modelll" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">History pengeluaran barang lain-lain</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'pengeluaran/datahistorylain' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dari</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sampai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="to">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                    <input type="submit" class="btn btn-sm btn-primary" value="Cari">
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
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
</body>

</html>