<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/select2/dist/css/select2.min.css' ?>">
</head>

<body>
    <?php $this->load->view('partials/nav');
    ?>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-md-9">
                <h4 class="font-weight-bold navy">Data Barang</h4>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data Barang
                </button>
                <button type="button" class=" btn btn-primary btn-sm" data-toggle="modal" data-target="#modelIds">
                    <i class="fa fa-print" aria-hidden="true"></i> Cetak Data
                </button>
            </div>
        </div>
        <hr />
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title navy">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url() . 'barang/input_data' ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Kode Barang</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" name="kode" placeholder="Kode Barang..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Barang</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Barang..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Kategori</label>
                                <div class="col-sm-8">
                                    <select name="kategori" class="form-control form-control-sm">
                                        <?php
                                        $sql = $this->db->query("SELECT * FROM kategori");
                                        foreach ($sql->result_array() as $a) :
                                            $id = $a['id_kategori'];
                                            $nm = $a['nama_kategori'];
                                        ?>
                                            <option value="<?= $id ?>"><?= $nm ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Satuan</label>
                                <div class="col-sm-8">
                                    <select name="satuan" class="form-control form-control-sm">
                                        <option value="Ball">Ball</option>
                                        <option value="Bks">Bks</option>
                                        <option value="Botol">Botol</option>
                                        <option value="Drijen">Drijen</option>
                                        <option value="Dus">Dus</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Klg">Klg</option>
                                        <option value="Kotak">Kotak</option>
                                        <option value="Liter">Liter</option>
                                        <option value="Ons">Ons</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Unit">Unit</option>
                                    </select>
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
        <div class="modal fade" id="modelIds" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title navy">Cetak Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url() . 'barang/cetak_data' ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                Kategori Barang
                                <select name="id" class="form-control form-control-sm">
                                    <?php
                                    $sql = $this->db->query("SELECT * FROM kategori");
                                    foreach ($sql->result_array() as $kat) :
                                        $id = $kat['id_kategori'];
                                        $nama = $kat['nama_kategori'];
                                    ?>
                                        <option value="<?= $id ?>"><?= $nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <input type="submit" value="Cetak" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead class="bg-navy">
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Opsi</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $a) :
                        $no++;
                        $id = $a['id_barang'];
                        $kode = $a['kode_barang'];
                        $nama = $a['nama_barang'];
                        $satuan = $a['satuan'];
                        $stok = $a['stok'];
                        $kat = $a['kat'];
                    ?>
                        <tr>
                            <td class="text-center align-items-middle"><?= $no ?></td>
                            <td class="text-center align-items-middle"><?= $kode ?></td>
                            <td class="align-items-middle"><?= $nama ?></td>
                            <td class="text-center align-items-middle"><?= $kat ?></td>
                            <td class="text-center align-items-middle"><?= $satuan ?></td>
                            <?php
                            if ($stok == 0) : ?>
                                <td class="text-center align-items-middle bg-danger text-white"><?= $stok ?></td>
                            <?php else : ?>
                                <td class="text-center align-items-middle"><?= $stok ?></td>
                            <?php endif; ?>
                            <td class="text-center align-items-middle">
                                <a href="<?= base_url() . 'barang/history?id=' . $id ?>" class="btn btn-sm btn-success">Kartu Stock</a>
                                <a href="<?= base_url() . 'barang/tracking_data?id=' . $id ?>" class="btn btn-sm btn-primary">List Supplier</a>
                                <a href="<?= base_url() . 'barang/delete_data?id=' . $id ?>" class="btn btn-sm btn-danger">Hapus</a>
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