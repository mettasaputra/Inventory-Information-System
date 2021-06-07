<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
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
                <h4 class="font-weight-bold navy">Data User</h4>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah User
                </button>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'user/input_data' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama User</label>
                                        <div class="col-sm-9">
                                            <select name="user" id="user" class="form-control form-control-sm">
                                                <?php
                                                $sql = $this->db->query("SELECT nama_karyawan FROM karyawan WHERE NOT EXISTS (SELECT nama_user FROM user WHERE karyawan.nama_karyawan = user.nama_user)");
                                                foreach ($sql->result_array() as $a) :
                                                    $nama = $a['nama_karyawan'];
                                                ?>
                                                    <option value="<?= $nama ?>"><?= $nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Personal ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" max="8" class="form-control form-control-sm" name="personal" placeholder="Personal ID.." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Level Akses</label>
                                        <div class="col-sm-9 mt-2">
                                            <div class="form-group form-check-inline">
                                                <input class="form-check-input" type="radio" name="level" value="1" required>
                                                <label class="form-check-label" for="inlineRadio1">Owner</label>
                                            </div>
                                            <div class="form-group form-check-inline">
                                                <input class="form-check-input" type="radio" name="level" value="2" required>
                                                <label class="form-check-label" for="inlineRadio2">Administrator</label>
                                            </div>
                                            <div class="form-group form-check-inline">
                                                <input class="form-check-input" type="radio" name="level" value="3" required>
                                                <label class="form-check-label" for="inlineRadio3">User</label>
                                            </div>
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
                    <th class="text-center font-weight-normal">Nama User</th>
                    <th class="text-center font-weight-normal">Divisi</th>
                    <th class="text-center font-weight-normal">Personal ID</th>
                    <th class="text-center font-weight-normal">Level Akses</th>
                    <th class="text-center font-weight-normal">Status</th>
                    <th class="text-center font-weight-normal">Opsi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $a) :
                        $no++;
                        $id = $a['id_user'];
                        $nama = $a['nama_user'];
                        $divisi = $a['nama_divisi'];
                        $personal = $a['personal_id'];
                        $ket = $a['keterangan'];
                        $lvl = $a['level_akses'];
                    ?>
                        <tr>
                            <td class="text-center align-items-middle"><?= $no ?></td>
                            <td class="align-items-middle"><?= $nama ?></td>
                            <td class="align-items-middle"><?= $divisi ?></td>
                            <td class="text-center align-items-middle"><?= $personal ?></td>
                            <?php
                            if ($lvl == 1) : ?>
                                <td class="text-center align-items-middle">Owner</td>
                            <?php elseif ($lvl == 2) : ?>
                                <td class="text-center align-items-middle">Administrator</td>
                            <?php elseif ($lvl == 3) : ?>
                                <td class="text-center align-items-middle">User</td>
                            <?php endif; ?>
                            <?php
                            if ($ket != 'Aktif') : ?>
                                <td class="align-items-middle font-weight-bold bg-warning"><?= $ket ?></td>
                            <?php else : ?>
                                <td class="align-items-middle"><?= $ket ?></td>
                            <?php endif; ?>
                            <td class="text-center align-items-middle">
                                <?php
                                if ($lvl != 1) :
                                    if ($ket == 'Aktif') : ?>
                                        <a href="<?= base_url() . 'user/set_nonactive?id=' . $id ?>" class="btn btn-sm btn-warning">Non-Aktifkan</a>
                                        <a href="<?= base_url() . 'user/delete_data?id=' . $id ?>" class="btn btn-sm btn-danger">Hapus</a>
                                    <?php else : ?>
                                        <a href="<?= base_url() . 'user/set_active?id=' . $id ?>" class="btn btn-sm btn-success text-white">Aktifkan</a>
                                        <a href="<?= base_url() . 'user/delete_data?id=' . $id ?>" class="btn btn-sm btn-danger">Hapus</a>
                                    <?php endif; ?>
                                <?php endif; ?>
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