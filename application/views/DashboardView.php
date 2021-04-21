<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
	<?php $this->load->view('partials/nav'); ?>
	<div class="container">
		<div class="table-responsive">
			<table class="table table-sm table-bordered">
				<thead>
					<th class="text-center align-middle">No</th>
					<th class="text-center align-middle">Tanggal Permintaan</th>
					<th class="text-center align-middle">Nama Karyawan</th>
					<th class="text-center align-middle">Tgl Dibutuhkan</th>
					<th class="text-center align-middle">Keterangan</th>
					<th class="text-center align-middle">Opsi</th>
				</thead>
				<tbody>
					<?php
					$no = 0;
					foreach ($data->result_array() as $a) :
						$no++;
						$id = $a['id_permintaan'];
						$user = $a['nama_user'];
						$tglpermintaan = date("d-m-Y H:i", strtotime($a['created_at']));
						$tgl = date("d-m-Y", strtotime($a['tanggal_kebutuhan']));
						$ket = $a['ket'];
					?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $tglpermintaan ?></td>
							<td><?= $user ?></td>
							<td><?= $tgl ?></td>
							<td><?= $ket ?></td>
							<td>
								<a class="btn btn-sm btn-primary" id="tampilpmt" href="<?= base_url() . 'permintaan/detail?id=' . $id ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
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
			var tampil = document.getElementById('tampipmt');
		})
	</script>
</body>

</html>