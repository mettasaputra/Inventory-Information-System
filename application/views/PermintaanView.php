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
            height: 490px;
        }
    </style>
</head>

<body>
    <?php
    if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) {
        $this->load->view('partials/nav');
    }
    $usr = $user->row_array() ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 class="my-3 navy">Formulir Permintaan Barang</h4>
            </div>
            <?php
            if ($this->session->userdata('akses') == '3') : ?>
                <div class="col-md-6">
                    <a href="<?= base_url() . 'permintaan/detail_permintaan' ?>" class="my-3 btn btn-sm btn-primary float-right"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Permintaan</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card rounded-0">
                    <div class="card-body">
                        <form action="<?= base_url() . 'permintaan/add_to_cart' ?>" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tanggal Dibutuhkan</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tgl" value="<?= $this->session->userdata('tgl') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Atas Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" value="<?= $usr['id_karyawan'] ?>" name="karyawan" hidden>
                                    <input type="text" value="<?= $this->session->userdata('nama') ?>" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea name="keterangan" class="form-control orm-control-sm"><?= $this->session->userdata('keterangan') ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Barang</label>
                                <div class="col-sm-8">
                                    <select name="brg" id="brg" class="form-control">
                                        <option disabled selected></option>
                                        <?php
                                        foreach ($brg->result_array() as $a) :
                                            $id = $a['id_barang'];
                                            $nm = $a['nama_barang'];
                                        ?>
                                            <option value="<?= $id ?>"><?= $nm ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div id="detail_barang" style="position: relative;"></div>
                        </form>
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
                                            <td class="align-items-middle text-center"><?= $items['units']; ?></td>
                                            <td class="align-items-middle text-center"><?= $items['qty']; ?></td>
                                            <td class="align-items-middle"><?= $items['comment']; ?></td>
                                            <td class="align-items-middle text-center"><a href="<?php echo base_url() . 'permintaan/remove_row/' . $items['rowid']; ?>" class="btn btn-info btn-sm"><span class="fa fa-close"></span> Batal</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="<?php echo base_url() . 'permintaan/permintaan_karyawan' ?>" class=" btn btn-primary btn-sm"><span class="fa fa-save"></span> Simpan</a>
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
                    url: "<?php echo base_url() . 'permintaan/get_detail_barang'; ?>",
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