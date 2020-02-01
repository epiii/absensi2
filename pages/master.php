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
				<h1 class="m-0 text-dark">MASTER</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Master</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">

			<div class="table-responsive">

				<table id="konfigurasiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-example" style="width: 100%;">
					<!-- <table class="table table-bordered table-hover"> -->
					<thead class="bg-secondary">
						<tr class="text-center">
							<th>No</th>
							<th>Variabel</th>
							<th>Parameter</th>
							<th>Keterangan</th>
							<th>Action</th>
						</tr>
					</thead>

					<!-- <tbody> -->
					<tbody class="bg-white">
						<?php
						$query = "SELECT * from tb2_setting where id_parent is null ORDER BY param ASC";
						$sql = mysqli_query($dbconnect, $query);
						$no = '1';
						// vd($query);						
						while ($data = mysqli_fetch_assoc($sql)) {
						?>
							<tr class="odd gradeX">
								<td class="text-center"><?php echo $no; ?></td>
								<td><?php echo $data['param']; ?></td>
								<td><?php echo $data['value'] ? $data['value'] : '-'; ?></td>
								<td><?php echo $data['note']; ?></td>
								<td>
									<center>
										<a href="./index.php?page=<?php echo $data['param'] == 'hari_libur_2' ? 'edit_konfigurasi_hari_libur_2' : 'edit_master'; ?>&id=<?php echo $data['id']; ?>&param=<?php echo $data['param']; ?>&value=<?php echo $data['value']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a>
									</center>
								</td>
								<?php $no++; ?>
							</tr>
						<?php
						}
						?>
						<tr class="odd gradeX">
							<td class="text-center"><?php echo $no; ?></td>
							<td>jam_masuk</td>
							<td>Jam Masuk</td>
							<td>Jadwal Jam karyawan untuk melakukan absensi kehadiran </td>
							<td>
								<center>
									<a href="./index.php?page=edit_master_jam&id=1" class="btn btn-outline-primary btn-sm">
										<i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i>
									</a>
								</center>
							</td>
						</tr>
						<tr class="odd gradeX">
							<td class="text-center"><?php echo ++$no; ?></td>
							<td>jam_keluar</td>
							<td>Jam Keluar</td>
							<td>Jadwal Jam karyawan untuk melakukan absensi pulang</td>
							<td>
								<center>
									<a href="./index.php?page=edit_master_jam&id=2" class="btn btn-outline-primary btn-sm">
										<i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i>
									</a>
								</center>
							</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {

		var table = $('#konfigurasiTbl').DataTable({
			paging: true,
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			blengthChange: false,
			bPaginate: false,
			bInfo: false,

		});

		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');

	})
</script>