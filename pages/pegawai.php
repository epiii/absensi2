<?php
if (!isset($_SESSION['page']) || $_SESSION['level'] == '1') {
	echo '<script>alert("Anda tidak mempunyai hak akses");window.location.replace("index.php?page=dashboard")</script>';
}
$query = "SELECT
			d.*, i.*
		FROM tb_id i
			LEFT JOIN vw_divisi d ON d.id_divisi = i.id_divisi
		ORDER BY i.nama ASC";
// $query = "SELECT
// 			d.*, k.*
// 		FROM tb1_karyawan k
// 			LEFT JOIN vw_divisi d ON d.id_divisi = k.id_divisi
// 		ORDER BY k.nama ASC";
$sql = mysqli_query($dbconnect, $query);
// vd($query);
// }
$ss = 'UPDATE tb_id SET notifikasi =0 WHERE notifikasi =1';
$ee = mysqli_query($dbconnect, $ss);
if (!$ee) {
	echo '<div class="alert alert-warning">
		<strong>Failed!</strong> update status pegawai, silakan refresh halaman
	</div>';
}
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

								<table id="pegawaiTbl" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
									<thead>
										<tr>
											<!-- <th>no</th> -->
											<th>UID</th>
											<th>NIP</th>
											<th>Nama</th>
											<th>Divisi</th>
											<th>HP</th>
											<th>Email</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$no = 0;
										while ($data = mysqli_fetch_assoc($sql)) {
											$clr = $data['notifikasi'] == '1' || $data['nama'] == '' || $data['id_divisi'] == '' ? 'success' : '';
											$uid = $data['notifikasi'] == '1' || $data['nama'] == '' || $data['id_divisi'] == '' ? $data['uid'].' <span class="badge badge-success"> new</span>' : $data['uid'];
											$no++;
										?>
											<tr class="table-<?php echo $clr; ?>">
												<td><?php echo $uid; ?></td>
												<td><?php echo $data['nip']; ?></td>
												<td><?php echo $data['nama']; ?></td>
												<td><?php echo $data['nama_divisi']; ?></td>
												<td><?php echo $data['no_hp']; ?></td>
												<td><?php echo $data['email']; ?></td>
												<td>
													<center>
														<a href="index.php?page=edit_pegawai&id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm text-center">edit</a>
														<a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">delete</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	// $('.delete_data').on("click", function(e) {
	// 	var choice = confirm(id);

	// 	if (choice) {
	// 		window.location.href = 'index.php?page=update_pegawai&' + id;
	// 		// window.location.href = $(this).attr('href');
	// 	}
	// 	e.preventDefault();
	// });

	$(document).ready(function() {
		var table = $('#pegawaiTbl').DataTable({
			dom: 'Bfrtip',
			paging: true,
			pageLength: 5,
			pageSize: 'A4',
			alignment: 'center',
			blengthChange: false,
			bPaginate: false,
			bInfo: false,
			buttons: [{
					// extend: 'pdf',
					// orientation: 'landscape',
					// messageTop: 'Januari 2020 || Divisi Keuangan ',
					// footer:true,
					extend: 'pdfHtml5',
					className: 'btn-danger',
					download: 'open',
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?>',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: function() {
						let title = 'Daftar Pegawai Satpol PP Sidoarjo\n'
						return title;
					},
				},
				{
					extend: 'excel',
					className: 'btn-success',
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?>',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: function() {
						let title = 'Daftar Pegawai Satpol PP Sidoarjo\n'
						return title;
					},

				},
				{
					extend: 'print',
					className: 'btn-info',
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?>',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: function() {
						let title = 'Daftar Pegawai Satpol PP Sidoarjo\n'
						return title;
					},

				}
			]
		});

	});

	// $('form').on('submit', function() {
	// 	alert('wkwk')
	// })


	// function onDelete(id) {
	// 	var action = 'index.php?page=update_pegawai'; 
	// 	var choice = confirm('yakin mau menghapus data ' + id + ' ?');
	// 	alert(choice)
	// 	return false

	// 	if (choice) {

	// 		window.location.href = 'index.php?page=update_pegawai&id=' + id;
	// 	}
	// }

	function onDelete(id) {
		// alert(id)
		var choice = confirm('yakin mau menghapus data ' + id + ' ?');
		if (choice) {
			window.location.href = 'konfig/delete_pegawai.php?id=' + id;
		}
	}
</script>