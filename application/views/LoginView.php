<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Portal</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/login.css' ?>">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <img class="img-fluid mt-2" width="40%" src="<?= base_url() . 'assets/images/logo.png' ?>">
                </div>
                <div class="col-lg-12 login-title">
                    KAMPOENG KAYOE'S PORTAL
                </div>

                <div class="col-lg-12 login-form" style="margin-top:10px">
                    <div class="col-lg-12 login-form">
                        <form class="user" method="POST" action="<?= base_url() . 'administrator/auth' ?>">
                            <div class="form-group">
                                <label class="form-control-label">PERSONAL ID</label>
                                <input type="password" class="form-control form-control-user" name="idpersonal" placeholder="Input Personal ID" required>
                                <div class="row">
                                    <div class="col-md-7">
                                        <a href="#" class="form-control-label" data-toggle="modal" data-target="#modelLupa">Lupa Personal ID</a> &nbsp; | &nbsp;
                                        <a href="#" class="form-control-label" data-toggle="modal" data-target="#modelDaftar">Daftar Personal ID</a>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="submit" class="float-right btn btn-outline-primary">LOGIN</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="modal fade" id="modelLupa" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Lupa Personal ID</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="<?= base_url() . 'administrator/lupa' ?>" method="POST">
                                    <div class="modal-body">
                                        <small class="text-danger">Silahkan mengisi data berikut untuk ditindaklanjuti oleh bagian yang berwenang!</small>
                                        <div class="form-group mb-0">
                                            Nama
                                            <select name="nama" class="form-control form-control-sm">
                                                <?php
                                                foreach ($user->result_array() as $data) :
                                                    $id = $data['id_user'];
                                                    $nama = $data['nama_user'];
                                                ?>
                                                    <option value="<?= $id ?>"><?= $nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2 ">
                                            Permasalahan
                                            <textarea class="form-control form-control-sm" name="status" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <input type="submit" class="btn btn-primary btn-sm" value="Laporkan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modelDaftar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Daftar Personal ID</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="<?= base_url() . 'administrator/registrasi' ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group mb-0">
                                            Nama
                                            <select name="nama" class="form-control form-control-sm">
                                                <?php
                                                $sql = $this->db->query("SELECT nama_karyawan FROM karyawan WHERE NOT EXISTS (SELECT nama_user FROM user WHERE karyawan.nama_karyawan = user.nama_user)");
                                                foreach ($sql->result_array() as $data) :
                                                    $nama = $data['nama_karyawan'];
                                                ?>
                                                    <option value="<?= $nama ?>"><?= $nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group mt-3 mb-0">
                                            <label>Level Akses</label><br />
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="level" value="2" required>
                                                <label class="form-check-label" for="inlineRadio2">Administrator</label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input" type="radio" name="level" value="3" required>
                                                <label class="form-check-label" for="inlineRadio3">User</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3 ">
                                            Personal ID
                                            <input type="text" max="8" class="form-control form-control-sm" name="personal" placeholder="Personal ID.." required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('select').select2({
                width: '100%'
            });
        });
    </script>
</body>

</html>