<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
    <?php $this->load->view('partials/nav'); ?>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-md-6">
                <h4 class="font-weight-bold">Data Karyawan</h4>
            </div>
            <div class="col-md-6">
                <button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Karyawan
                </button>

                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Karyawan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'karyawan/input_data' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Karyawan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Karyawan.." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Divisi</label>
                                        <div class="col-sm-8">
                                            <select name="divisi" class="form-control form-control-sm">
                                                <?php
                                                $sql = $this->db->query("SELECT * FROM divisi ORDER BY nama_divisi");
                                                foreach ($sql->result_array() as $data) :
                                                    $id = $data['id_divisi'];
                                                    $nm = $data['nama_divisi'];
                                                ?>
                                                    <option value="<?= $id ?>"><?= $nm ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
                    <th class="text-center font-weight-normal">Divisi</th>
                    <th class="text-center font-weight-normal">Opsi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($dt->result_array() as $a) :
                        $no++;
                        $id = $a['id_karyawan'];
                        $nama = $a['nama_karyawan'];
                        $divisi = $a['nama_divisi'];
                    ?>
                        <tr>
                            <td class="text-center align-items-middle"><?= $no ?></td>
                            <td class="align-items-middle"><?= $nama ?></td>
                            <td class="align-items-middle"><?= $divisi ?></td>
                            <td class="text-center align-items-middle">
                                <a href="<?= base_url() . 'karyawan/delete_data?id=' . $id ?>" class="btn btn-sm btn-danger">Hapus</a>
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