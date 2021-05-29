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
                                    <div class="col-md-6">
                                        <a href="#" class="form-control-label" data-toggle="modal" data-target="#modelLupa">Lupa Personal ID / Daftar Personal ID</a>
                                        <div class="modal fade" id="modelLupa" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Silahkan mengisi data berikut</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                Nama
                                                                <select name="nama" class="form-control form-control-sm">
                                                                    <?php
                                                                    foreach ($kyw->result_array() as $data) :
                                                                        $id = $data['id_karyawan'];
                                                                        $nama = $data['nama_karyawan'];
                                                                    ?>
                                                                        <option value="<?= $id ?>"><?= $nama ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                Permasalahan
                                                                <select name="status" class="form-control form-control-sm">
                                                                    <option value="Lupa Personal ID">Lupa Personal ID</option>
                                                                    <option value="Pendaftaran">Pendaftaran</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                Masukkan Personal ID yang baru
                                                                <input type="text" class="form-control form-control-sm" placeholder="Personal ID">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                                            <input type="submit" class="btn btn-primary btn-sm" value="Ajukan">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="float-right btn btn-outline-primary">LOGIN</button>
                                    </div>
                                </div>
                            </div>

                        </form>
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