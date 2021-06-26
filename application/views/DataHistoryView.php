<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Data</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
    <?php $this->load->view('partials/nav'); ?>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-md-12">
                <h4 class="font-weight-bold navy">History Data Master</h4>
            </div>
        </div>
        <hr />


        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                    <th class="text-center font-weight-normal">No</th>
                    <th class="text-center font-weight-normal">Nama Data</th>
                    <th class="text-center font-weight-normal">Pengguna</th>
                    <th class="text-center font-weight-normal">Tanggal & Waktu Kejadian</th>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $a) :
                        $no++;
                        $nama = $a['nama_data'];
                        $user = $a['nama_user'];
                        $ca = date('d-M-Y H:i', strtotime($a['created_at']));
                    ?>
                        <tr>
                            <td class="text-center align-items-middle"><?= $no ?></td>
                            <td class="align-items-middle"><?= $nama ?></td>
                            <td class="text-center align-items-middle"><?= $user ?></td>
                            <td class="text-center align-items-middle"><?= $ca ?></td>
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