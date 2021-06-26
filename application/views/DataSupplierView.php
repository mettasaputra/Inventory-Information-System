<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
    <?php $this->load->view('partials/nav'); ?>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-md-6">
                <h4 class="font-weight-bold navy">Data Supplier</h4>
            </div>
            <div class="col-md-6">
                <button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Supplier
                </button>

                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Supplier</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'supplier/input_data' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Supplier</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" name="sup" placeholder="Nama Supplier.." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Contact Person</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" name="ctc" placeholder="Contact Person.." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">No Telp</label>
                                        <div class="col-sm-8">
                                            <input type="text" maxlength="13" class="form-control form-control-sm" name="telp" placeholder="No Telp..">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" name="alamat" placeholder="Alamat..">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                    <input type="submit" value="Simpan" class="btn btn-primary btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />


        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <th class="text-center font-weight-normal">No</th>
                    <th class="text-center font-weight-normal">Nama Supplier</th>
                    <th class="text-center font-weight-normal">Contact Person</th>
                    <th class="text-center font-weight-normal">No Telp</th>
                    <th class="text-center font-weight-normal">Alamat</th>
                    <th class="text-center font-weight-normal">Opsi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $a) :
                        $no++;
                        $id = $a['id_supplier'];
                        $nama = $a['nama_supplier'];
                        $ctc = $a['contact_person'];
                        $alamat = $a['alamat'];
                        $telp = $a['no_telp'];
                    ?>
                        <tr>
                            <td class="text-center align-items-middle"><?= $no ?></td>
                            <td class="align-items-middle"><?= $nama ?></td>
                            <td class="align-items-middle"><?= $ctc ?></td>
                            <td class="text-center align-items-middle"><?= $telp ?></td>
                            <td class="text-center align-items-middle"><?= $alamat ?></td>
                            <td class="text-center align-items-middle">
                                <a href="<?= base_url() . 'supplier/list_data?id=' . $id  ?>" class="btn btn-sm btn-success">List Barang</a>
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#model<?= $id ?>">
                                    Edit Data
                                </a>

                                <div class="modal fade" id="model<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Supplier</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url() . 'supplier/update_data' ?>" method="POST">
                                                <div class="modal-body text-left">
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Nama Supplier</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control-sm" value="<?= $nama ?>" readonly>
                                                            <input type="text" class="form-control form-control-sm" value="<?= $id ?>" name="id" hidden>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Alamat Supplier</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control-sm" name="alamat" value="<?= $alamat ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Contact Person</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control form-control-sm" name="ctc" value="<?= $ctc ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label">Telp</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" maxlength="13" class="form-control form-control-sm" name="telp" value="<?= $telp ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url() . 'supplier/delete_data?id=' . $id . '&nama=' . $nama ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
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
    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
</body>

</html>