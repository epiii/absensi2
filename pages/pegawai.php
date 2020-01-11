<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
$absent = '';
$flag = '0';

// if (isset($_POST['tanggal'])) {
// 	$flag = '0';
// 	$date = $_POST['tanggal'];
// 	$absent = $date;
// 	$sql = mysqli_query($dbconnect, "SELECT tb_absen.id, tb_id.nama, tb_absen.masuk, tb_absen.keluar, tb_absen.date, tb_absen.status, tb_absen.keterangan FROM tb_absen INNER JOIN tb_id ON tb_absen.id=tb_id.id WHERE date='$date'");
// } else {
$flag = '0';
$date = date('Y-m-d');
$absent = $date;
$query = "SELECT * FROM tb1_karyawan";
$sql = mysqli_query($dbconnect, $query);
// pr($sql);
// }

?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">DATA PEGAWAI</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Data Pegawai</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">

			<div class="card">
				<div class="card-header " style="height: 82px;">
					<div class="row">
						<div class="col-md-12 mb-3 mt-4">
							<a href="./index.php?page=tambah_pegawai">
								<button type="button" class="btn btn-secondary btn-sm float-left"><i class="fas fa-plus-square"></i> pegawai</button>
							</a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<div class="row mt-2">
						<div class="col-md-12 col-md-offset-2">
							<div class="table table-hover">

								<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
									<thead>
										<tr>
											<th>UID </th>
											<th>Nama Pegawai</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
										while ($data = mysqli_fetch_array($sql)) {
											// if ($data['status'] == 'H') {
											// 	$color = "table-success";
											// } else if ($data['status'] == 'T') {
											// 	$color = "table-secondary";
											// } else if ($data['status'] == 'A') {
											// 	$color = "table-danger";
											// } else if ($data['status'] == 'I') {
											// 	$color = "table-primary";
											// } else if ($data['status'] == 'S') {
											// 	$color = "table-info";
											// } else if ($data['status'] == 'B') {
											// 	$color = "table-warning";
											// }
										?>

											<tr class="<?php echo $color; ?>">
												<td><?php echo $data['tag']; ?></td>
												<td><?php echo $data['nama']; ?></td>
												<td><?php echo $data['email']; ?></td>
												<td>
													<center>
														<a href="index.php?page=edit_pegawai&id=<?php echo $data['no']; ?>" class="btn btn-primary btn-sm text-center">edit</a>

														<!-- <form method="post" action="">
															<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
															<button 
																href="#" 
																onclick="onDelete(<?php echo $data['id']; ?>)" 
																type="button" 
																class="btn btn-danger btn-sm text-center"
															>
																delete
															</a>
														</form> -->

														<a href="#" onclick="onDelete(<?php echo $data['no']; ?>)" class="btn btn-danger btn-sm text-center">delete</a>
														<!-- <a href="#" onclick="alert('anu')" class="delete_data btn btn-danger btn-sm text-center">delete</a> -->
														<!-- <a onclick="return confirm('yakin mau menghapus data?')" data-confirm="<?php echo $data['no']; ?>" class="btn btn-danger btn-sm text-center">delete</a> -->
													</center>
												</td>
											</tr>

										<?php
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</div><!-- end row-->

				</div>
			</div>

		</div>
	</div>
</section>

<script>
	$('.delete_data').on("click", function(e) {
		var choice = confirm(id);

		if (choice) {
			window.location.href = 'index.php?page=update_pegawai&' + id;
			// window.location.href = $(this).attr('href');
		}
		e.preventDefault();
	});

	$(document).ready(function() {});

	$('form').on('submit', function() {
		alert('wkwk')
	})

	function onDelete(id) {
		var action = 'index.php?page=update_pegawai'; 
		var choice = confirm('yakin mau menghapus data ' + id + ' ?');
		alert(choice)
		return false

		if (choice) {

			window.location.href = 'index.php?page=update_pegawai&id=' + id;
		}
	}

	function onDelete(id) {
		var choice = confirm('yakin mau menghapus data ' + id + ' ?');
		if (choice) {
			window.location.href = 'konfig/delete_pegawai.php?id=' + id;
		}
	}
</script>