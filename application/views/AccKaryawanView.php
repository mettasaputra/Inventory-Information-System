<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permintaan</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">
    <style>
        .card {
            height: 440px;
        }
    </style>
</head>

<body>
    <?php
    if ($this->session->userdata('akses') == 1 || $this->session->userdata('akses') == 2) {
        $this->load->view('partials/nav');
    }
    $a = $req->row_array();
    ?>
    <div class="container-fluid">
        <h4 class="navy my-3">Form Permintaan Barang</h4>
        <form action="<?= base_url() . 'permintaan/into_pengeluaran' ?>" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <input name="ids" value="<?= $a['id_permintaan'] ?>" readonly hidden>
                                    <input type="date" class="form-control" name="tgl" value="<?= $this->session->userdata('tgl') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Karyawan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?= $a['nama_karyawan'] ?>" readonly>
                                    <input type="hidden" class="form-control" name="karyawan" value="<?= $this->session->userdata('kyw') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea name="keterangan" class="form-control form-control-sm" readonly><?= $this->session->userdata('ket') ?></textarea>
                                </div>
                            </div>

                            <div id="detail_barang" style="position: relative;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card rounded-0" style="overflow-y: auto;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Opsi</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($this->cart->contents() as $items) : ?>
                                            <tr>
                                                <td class="align-items-middle text-center"><?= $no++; ?></td>
                                                <td class="align-items-middle text-center"><?= $items['kode']; ?></td>
                                                <td class="align-items-middle"><?= $items['name']; ?></td>
                                                <td class="align-items-middle text-center"><?= $items['qty']; ?></td>
                                                <td class="align-items-middle text-center"><?= $items['units']; ?></td>
                                                <td class="align-items-middle"><?= $items['comment']; ?></td>
                                                <td class="align-items-middle text-center"><a href="<?php echo base_url() . 'permintaan/remove?id=' . $a['id_permintaan'] . '&idbrg=' . $items['id'] ?>" class="btn btn-danger btn-sm"><span class="fa fa-close"></span> Batal</a></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                                <?php
                                if ($this->session->userdata('akses') == 1 || $this->session->userdata('akses') == 2) : ?>
                                    <a href="<?php echo base_url() . 'permintaan/into_pengeluaran?id=' . $a['id_permintaan'] ?>" class=" btn btn-primary btn-sm"><span class="fa fa-check"></span> Acc Permintaan</a>
                                <?php else : ?>
                                    <a href="<?php echo base_url() . 'permintaan/detail_permintaan' ?>" class=" btn btn-primary btn-sm"><span class="fa fa-home"></span> Daftar Permintaan Karyawan</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/select2/dist/js/select2.min.js' ?>" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('select').select2({
                width: '100%'
            });

            // $("#brg").focus();
            $("#brg").on("select2:select", function() {
                var barang = {
                    brg: $(this).val()
                };
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'pengeluaran/get_detail_barang'; ?>",
                    data: barang,
                    success: function(msg) {
                        $('#detail_barang').html(msg);
                    }
                });

            });
        });
    </script>
</body>

</html>