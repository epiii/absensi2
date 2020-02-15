<?php
// require 'konfig/dev.php';

if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
?>
<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">KONFIGURASI</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Konfigurasi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">

			<div class="table-responsive">
				<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
					<!-- <table class="table table-bordered table-hover"> -->
					<thead class="bg-secondary">
						<tr>
							<th>No</th>
							<th>Variabel</th>
							<th>Parameter Konfigurasi</th>
							<th>Keterangan</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php
					$sql = mysqli_query($dbconnect, "SELECT * FROM tb_settings");
					$no = '1';
					while ($data = mysqli_fetch_assoc($sql)) {
					?>
						<tbody class="bg-white">
							<!-- <tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Mulai jam masuk</td>
								<td><?php echo $data['masuk_mulai']; ?></td>
								<td>Parameter jam akan dimulai presensi masuk</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['masuk_mulai']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php // $no += '1'; ?>
							</tr>

							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Akhir jam masuk</td>
								<td><?php echo $data['masuk_akhir']; ?></td>
								<td>Batas dari Parameter jam presensi masuk </td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['masuk_akhir']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php //$no += '1'; ?>
							</tr>

							</tr>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Mulai jam keluar</td>
								<td><?php echo $data['keluar_mulai']; ?></td>
								<td>Parameter jam akan dimulai presensi keluar / pulang</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['keluar_mulai']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php //$no += '1'; ?>
							</tr> 

							</tr>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Akhir jam keluar</td>
								<td><?php echo $data['keluar_akhir']; ?></td>
								<td>Batas dari parameter jam presensi keluar / pulang</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['keluar_akhir']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php //$no += '1'; ?>
							</tr>

							</tr>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Hari Libur 1</td>
								<td><?php echo $data['libur1']; ?></td>
								<td>Jika parameter ini diset pada hari tersebut presensi tidak berjalan</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['libur1']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php //$no += '1'; ?>
							</tr>

							</tr>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Hari Libur 2</td>
								<td><?php echo $data['libur2']; ?></td>
								<td>Jika parameter ini diset pada hari tersebut presensi tidak berjalan</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['libur2']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php //$no += '1'; ?>
							</tr>
							-->

							</tr>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Zona Waktu</td>
								<td><?php echo $data['timezone']; ?></td>
								<td>Parameter zona waktu berdasarkan area</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['timezone']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php $no += '1'; ?>
							</tr>

							</tr>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Email presensi</td>
								<td><?php echo $data['email']; ?></td>
								<td>Parameter untuk email presensi & hanya bisa Gmail</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['email']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php $no += '1'; ?>
							</tr>

							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Email Password</td>
								<td>********</td>
								<td>Password login dari email presensi</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php $no += '1'; ?>
							</tr>

							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td>Admin UID</td>
								<td><?php echo $data['admin_uid']; ?></td>
								<td>Tag UID Admin untuk menambahkan pegawai baru</td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['admin_uid']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
							</tr>

						<?php
					}
						?>
						</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<script src="./vendor/js/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		var table = $('#detKonfigTbl').DataTable({
			paging: true,
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			// "columnDefs": [{
			// 	"targets": [0],
			// 	"visible": false,
			// }],
			blengthChange: false,
			bPaginate: false,
			bInfo: false,

		});
	})
</script>