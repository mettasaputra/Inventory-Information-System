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
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">

    <style>
        .card {
            height: 100%;
            color: white;
            padding: 10px;
        }

        .arialfont {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <?php $this->load->view('partials/nav');
    ?>
    <div class="container my-3">
        <h3 class="text-left navy">Data Master</h3>
        <div class="row mt-2">
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/barang' ?>" class="text-decoration-none">
                    <div class="card bg-info rounded-0">
                        <div class="card-body text-left text-white">
                            <?php
                            $sql = $this->db->query("SELECT COUNT(*) as data FROM barang");
                            $a = $sql->row_array();
                            ?>
                            <h4 class="card-title"><i class="fas fa-warehouse fa-2x"> <span class="ml-2 arialfont"><?= $a['data'] ?></span></i></h4>
                            <p class="card-text">Data Barang</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/supplier' ?>" class="text-decoration-none">
                    <div class="card bg-success rounded-0">
                        <div class="card-body text-left text-white">
                            <?php
                            $sql = $this->db->query("SELECT COUNT(*) as data FROM supplier");
                            $b = $sql->row_array();
                            ?>
                            <h4 class="card-title"><i class="fas fa-address-book fa-2x"><span class="ml-3 arialfont"><?= $b['data'] ?></span></i></h4>
                            <p class="card-text">Data Supplier</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/karyawan' ?>" class="text-decoration-none">
                    <div class="card bg-dark rounded-0">
                        <div class="card-body text-left text-white">
                            <?php
                            $sql = $this->db->query("SELECT COUNT(*) as data FROM karyawan");
                            $c = $sql->row_array();
                            ?>
                            <h4 class="card-title"><i class="fa fa-users fa-2x" aria-hidden="true"><span class="ml-3 arialfont"><?= $c['data'] ?></span></i></h4>
                            <p class="card-text">Data Karyawan</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="<?= base_url() . 'master/user' ?>" class="text-decoration-none">
                    <div class="card bg-primary rounded-0">
                        <div class="card-body text-left text-white">
                            <?php
                            $sql = $this->db->query("SELECT COUNT(*) as data FROM user");
                            $d = $sql->row_array();
                            ?>
                            <h4 class="card-title"><i class="fas fa-user-friends fa-2x"><span class="ml-3 arialfont"><?= $d['data'] ?></span></i></h4>
                            <p class="card-text">Data User</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mt-3">
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#modelId">
                    <div class="card bg-secondary rounded-0">
                        <div class="card-body text-left">
                            <h4 class="card-title"><i class="fas fa-file-archive fa-2x"></i></h4>
                            <p class="card-text">Laporan Bulanan</p>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Laporan Bulanan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'laporan' ?>" method="POST">
                                <div class="modal-body">
                                    Pilih Bulan
                                    <input type="month" name="bln" class="form-control form-control-sm">
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
            <div class="col-md-3 mt-3">
                <a href="" class="text-decoration-none" data-toggle="modal" data-target="#modelIds">
                    <div class="card bg-danger rounded-0">
                        <div class="card-body text-left text-white">
                            <h4 class="card-title"><i class="fas fa-file-archive fa-2x"></i></h4>
                            <p class="card-text">Laporan Pemakaian per Divisi</p>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="modelIds" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Laporan Pemakaian per Divisi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url() . 'laporan/laporandivisi' ?>" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        Divisi
                                        <select name="iddivisi" class="form-control form-control-sm">
                                            <?php
                                            $sql = $this->db->query("SELECT * FROM divisi");
                                            foreach ($sql->result_array() as $a) :
                                                $id = $a['id_divisi'];
                                                $divisi = $a['nama_divisi'];
                                            ?>
                                                <option value="<?= $id ?>"><?= $divisi ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        Bulan
                                        <select name="bln" class="form-control form-control-sm">
                                            <?php
                                            $bln = $this->db->query("SELECT DATE_FORMAT(tanggal,'%m-%Y') as databulan, DATE_FORMAT(tanggal,'%M %Y') as bln FROM pengeluaran GROUP BY tanggal");
                                            foreach ($bln->result_array() as $dt) :
                                                $bulan = $dt['databulan'];
                                                $nama = $dt['bln'];
                                            ?>
                                                <option value="<?= $bulan ?>"><?= $nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
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
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>
    <script>
        $('select').select2({
            width: '100%'
        });
    </script>
</body>

</html>