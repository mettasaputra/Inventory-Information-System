<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/css/style.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/bootstrap/dist/css/bootstrap.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/datatables/datatables.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url() . 'assets/vendor/fontawesome/css/all.min.css' ?>">
</head>

<body>
	<?php $this->load->view('partials/nav');
	header("refresh: 15");
	?>

	<?php
	if ($this->session->userdata('akses') == 1) : ?>
		<div class="container-fluid my-3">
			<p class="lead">Selamat datang di Kampoeng Kayoe's Portal</p>
			<hr />
			<p class="font-weight-bold">Informasi terkait Hak Akses</p>
			<div class="table-responsive">
				<table class="table table-sm">
					<thead>
						<th>No</th>
						<th>Nama</th>
						<th>Divisi</th>
						<th>Level Akses</th>
						<th>Status</th>
						<th>Opsi</th>
					</thead>
					<tbody>
						<?php
						$no = 0;
						foreach ($user->result_array() as $a) :
							$no++;
							$id = $a['id_user'];
							$nama = $a['nama_user'];
							$divisi = $a['nama_divisi'];
							$lvl = $a['level_akses'];
							$ket = $a['keterangan'];
						?>
							<tr>
								<td class="text-center align-items-middle"><?= $no ?></td>
								<td class="align-items-middle"><?= $nama ?></td>
								<td class="align-items-middle"><?= $divisi ?></td>
								<?php
								if ($lvl == 1) : ?>
									<td class="text-center align-items-middle">Manager</td>
								<?php elseif ($lvl == 2) : ?>
									<td class="text-center align-items-middle">Administrator</td>
								<?php elseif ($lvl == 3) : ?>
									<td class="text-center align-items-middle">User</td>
								<?php endif; ?>
								<td class="align-items-middle font-weight-bold"><?= $ket ?></td>

								<td>
									<a href="<?= base_url() . 'user/set_active_from_dashboard?id=' . $id ?>" class="btn btn-sm btn-success text-white">Aktifkan</a>
									<a href="<?= base_url() . 'user/delete_data?id=' . $id ?>" class="btn btn-sm btn-danger">Hapus</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php else : ?>
		<div class="container-fluid my-3">
			<div class="card rounded-0 bg-light" style="height: 480px; overflow-y:auto">
				<div class="card-body">
					<h4 class="card-title navy">Daftar Permintaan Karyawan</h4>
					<div class="card-text">
						<div class="table-responsive">
							<table class="table table-sm table-bordered">
								<thead class="bg-primary text-white">
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
										$user = $a['nama_karyawan'];
										$tglpermintaan = date("d-m-Y H:i", strtotime($a['created_at']));
										$tgl = date("d-m-Y", strtotime($a['tanggal_kebutuhan']));
										$ket = $a['ket'];
									?>
										<tr>
											<td class="text-center align-middle"><?= $no ?></td>
											<td class="text-center align-middle"><?= $tglpermintaan ?></td>
											<td class="align-middle"><?= $user ?></td>
											<td class="text-center align-middle"><?= $tgl ?></td>
											<td class="align-middle"><?= $ket ?></td>
											<td class="text-center align-middle">
												<a class="btn btn-sm btn-primary" href="<?= base_url() . 'permintaan/detail?id=' . $id ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detail</a>
												<a class="btn btn-sm btn-danger" href="<?= base_url() . 'permintaan/delete_permintaan?id=' . $id ?>"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<script src="<?= base_url() . 'assets/js/jquery-3.5.1.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/vendor/bootstrap/dist/js/bootstrap.min.js' ?>" type="text/javascript"></script>
	<script src="<?= base_url() . 'assets/vendor/datatables/datatables.min.js' ?>"></script>
	<script>
		// window.location.reload();

		$(document).ready(function() {
			$('table').DataTable();
		})
	</script>
</body>

</html>