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
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
		Launch
	</button>

	<!-- Modal -->
	<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url() . 'laporan' ?>" method="POST">
					<div class="modal-body">
						<select name="bln">
							<option value="4">April</option>
						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-bordered">
			<thead>
				<th>No</th>
				<th>Tanggal Permintaan</th>
				<th>Nama Karyawan</th>
				<th>Tgl Dibutuhkan</th>
				<th>Keterangan</th>
				<th>Opsi</th>
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
							<a class="btn btn-sm btn-primary" href="<?= base_url() . 'permintaan/detail?id=' . $id ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
</body>

</html>