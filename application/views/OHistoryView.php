<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Penerimaan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">
</head>

<body>
    <?php $this->load->view('partials/nav'); ?>
    <div class="container-fluid">
        <h4 class="font-weight-bold my-3">History Pengeluaran Barang (Retur, Stock Opname, dll)</h4>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <p class="font-weight-bold">Dari Tanggal : <?= date("d-M-Y", strtotime($this->session->userdata('from'))) ?> sampai Tanggal : <?= date("d-M-Y", strtotime($this->session->userdata('to'))) ?></p>
            </div>
            <div class="col-md-6">
                <button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-search" aria-hidden="true"></i> Cari History
                </button>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cari History Pengeluaran</h5>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-sm btn-primary" value="Cari">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Karyawan</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Nama Barang</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Satuan</th>
                    <th class="text-center">Keterangan</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $a) :
                        $no++;
                        $sup = $a['nama_karyawan'];
                        $format = date("d-M-Y", strtotime($a['tanggal']));
                        $nm = $a['nama_barang'];
                        $qty = $a['jumlah'];
                        $satuan = $a['satuan'];
                        $ket = $a['ket'];
                    ?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td><?= $sup ?></td>
                            <td class="text-center"><?= $format ?></td>
                            <td><?= $nm ?></td>
                            <td class="text-center"><?= $qty ?></td>
                            <td class="text-center"><?= $satuan ?></td>
                            <td><?= $ket ?></td>
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
    <script>
        $(document).ready(function() {
            $('table').DataTable();
            $('select').select2({
                width: '100%'
            });
        });
    </script>
</body>

</html>