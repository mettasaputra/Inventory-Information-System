<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penerimaan Barang</title>
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
        <h3 class="navy">Dashboard Penerimaan</h3>
        <div class="row mt-2">
            <div class="col-md-3  mt-3">
                <a href="<?= base_url() . 'penerimaan/supplier' ?>" class="text-decoration-none">
                    <div class="card rounded-0 bg-danger">
                        <div class="card-body">
                            <div class="card-title"><i class="fas fa-handshake fa-3x" aria-hidden="true"></i></div>
                            <p class="card-text">Penerimaan Barang dari Supplier</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'penerimaan/opsional' ?>" class="text-decoration-none">
                    <div class="card rounded-0 bg-success">
                        <div class="card-body">
                            <div class="card-title"><i class="fa fa-undo fa-3x" aria-hidden="true"></i></div>
                            <p class="card-text">Penerimaan Lain-Lain</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#model">
                    <div class=" card rounded-0 bg-secondary">
                        <div class="card-body">
                            <div class="card-title">
                                <i class="fas fa-calendar-alt fa-3x" aria-hidden="true"></i>
                            </div>
                            <p class="card-text">History Penerimaan Barang dari Supplier</p>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="model" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">History penerimaan dari supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'penerimaan/datahistory' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dari</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="from" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sampai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="to" required>
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
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#modelId">
                    <div class="card rounded-0 bg-info">
                        <div class="card-body">
                            <div class="card-title">
                                <i class="far fa-calendar-alt fa-3x" aria-hidden="true"></i>
                            </div>
                            <p class="card-text">History Penerimaan Barang Lain-Lain</p>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">History penerimaan barang lain-lain</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'penerimaan/datahistoryopsional' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Dari</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="from" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Sampai</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" name="to" required>
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