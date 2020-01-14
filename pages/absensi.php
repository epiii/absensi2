<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
$absent = '';
$flag = '0';
// if (isset($_POST['tanggal_awal'])) {
// 	$flag = '0';
// 	$date = $_POST['tanggal_awal'];
// 	$absent = $date;
// 	$query = "SELECT tb_absen.id, tb_id.nama, tb_absen.masuk, tb_absen.keluar, tb_absen.date, tb_absen.status, tb_absen.keterangan FROM tb_absen INNER JOIN tb_id ON tb_absen.id=tb_id.id WHERE date='$date'";
// 	$sql = mysqli_query($dbconnect, $query);
// } else {
$flag = '0';
$date = date('Y-m-d');
$absent = $date;

$tanggal_awal = (isset($_POST['tanggal_awal'])) ? $_POST['tanggal_awal'] : date('Y-m-d');
$tanggal_akhir = (isset($_POST['tanggal_akhir'])) ? $_POST['tanggal_akhir'] : date('Y-m-d');
$query = ' 	SELECT 
					DATE_FORMAT(a.date, "%d %M %Y") as tanggal,
					a.id,
					a.masuk,
					a.keluar,
					a.capture,
					a.keterangan,
					a.status,
					a.mode,
					a.id_karyawan,
					a.potongan,
					a.terlambat,
					k.nip,
					k.nama,
					tp.nama_tipepresensi
				FROM tb_absen a
				JOIN tb1_karyawan k ON k.id = a.id_karyawan
				JOIN vw_tipepresensi tp ON tp.id_tipepresensi = a.id_tipe_presensi
				WHERE
					a.date >= "' . $tanggal_awal . '"
				AND a.date <=  "' . $tanggal_akhir . '"';
$sql = mysqli_query($dbconnect, $query);
// pr($query);
// }

?>
<!-- <span class="label label-default">Default</span> -->
<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">DATA PRESENSI</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Data Presensi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>


<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">
			<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Capture</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body text-center">
							<p id="modalTxt"></p>
							<img class="rounded img-fluid" id="modalImg">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>


			<div class="card">
				<div class="card-header bg-secondary" style="height: 82px;">
					<div class="row">
						<div class="col-md-6 pt-3">
							<a href="./index.php?page=tambah_absensi">
								<button type="button" class="btn btn-light btn-sm float-left"><i class="fas fa-plus-square"></i> Absen Manual</button>
							</a>
						</div>
						<div class="col-md-push-6 pt-3 col-right">
							<form method="POST">
								<input type="date" value="<?php echo $tanggal_awal ? $tanggal_awal : date('Y-m-d'); ?>" name="tanggal_awal">
								s/d
								<input type="date" value="<?php echo $tanggal_akhir ? $tanggal_akhir : date('Y-m-d'); ?>" name="tanggal_akhir">
								<button type="submit" class="btn btn-light btn-sm mb-1 ml-1"><i class="fas fa-search"></i> Tampilkan</button>
							</form>
						</div>

						<!-- <div class="col-md-3 pt-3 pull-right" style="font-size:18px; text-align: right;">
							<?php echo "Menampilkan tanggal, " . $date; ?>
						</div> -->
					</div>
				</div>

				<div class="card-body">
					<div class="row mt-2">
						<div class="col-md-12 col-md-offset-2">
							<div class="table table-hover">

								<table id="example" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-example" style="width: 100%;">
									<thead>
										<tr>
											<th>Tipe</th>
											<th>NIP </th>
											<th>Nama Pegawai</th>
											<th>Jam Masuk</th>
											<th>Jam Keluar</th>
											<th>Tanggal</th>
											<th>Status</th>
											<th>Mode</th>
											<th>Capture</th>
											<th>Keterangan</th>
											<th>Potongan</th>
											<th>Keterlambatan</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
										while ($data = mysqli_fetch_assoc($sql)) {
											// pr($data);
											$status = '';
											$color = '';
											if ($data['status'] == 'H') {
												$status = "Hadir";
												// $color = "table-success";
												$color = "success";
											} else if ($data['status'] == 'T') {
												$status = "Terlambat";
												$color = "secondary";
											} else if ($data['status'] == 'A') {
												$status = "Alpha";
												$color = "danger";
											} else if ($data['status'] == 'I') {
												$status = "Ijin";
												$color = "primary";
											} else if ($data['status'] == 'S') {
												$status = "Sakit";
												$color = "info";
											} else if ($data['status'] == 'B') {
												$status = "Bolos";
												$color = "warning";
											} else if ($data['status'] == 'D') {
												$status = "Dinas";
												$color = "primary";
											} else {
												$status = "";
												$color = "";
											}
											$capture =  'img/' . ($data['capture'] == '' ? 'no-image-icon.png' : 'captures/' . $data['capture']);
											// vd($capture);
										?>

											<tr class="table-<?php echo $color; ?>">
												<!-- <tr> -->
												<td><?php echo $data['nama_tipepresensi']; ?></td>
												<td><?php echo $data['nip']; ?></td>
												<td><?php echo $data['nama']; ?></td>
												<td><?php echo $data['masuk']; ?></td>
												<td><?php echo $data['keluar']; ?></td>
												<td><?php echo $data['tanggal']; ?></td>
												<td>
													<!-- <div class="alert alert-<?php echo $color; ?>" role="alert"> -->
													<?php echo $status; ?>
													<!-- </div> -->
												</td>
												<td><?php echo $data['mode']; ?></td>
												<td class="text-center">
													<a href="#" style="display:block;" onclick="openModal('<?php echo $capture; ?>')" class="">
														<img style="
																width: 30px;
																height: 30px;
																border-radius: 50%;" src="<?php echo $capture; ?>">
														<!-- <img width="150" xclass="rounded img-fluid" src="<?php echo $capture; ?>"> -->
													</a>
												</td>
												<td><?php echo $data['keterangan']; ?></td>
												<td><?php echo $data['potongan']; ?>%</td>
												<td><?php echo $data['terlambat']; ?> min</td>
												<td>
													<?php if ($data['mode'] == 'manual') { ?>
														<center>
															<a href="index.php?page=edit_absensi&id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm text-center">edit</a>
															<a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">delete</a>
														</center>
													<?php } ?>

												</td>
											</tr>

										<?php
										}
										?>

										<?php
										$flag = '1';
										$sql1 = mysqli_query($dbconnect, "select * from tb_id where id not in(select id from tb_absen where date='$absent')");
										while ($data1 = mysqli_fetch_assoc($sql1)) {
										?>

											<tr class="table-danger">
												<td><?php echo $data1['id']; ?></td>
												<td><?php echo $data1['nama']; ?></td>
												<td>-</td>
												<td>-</td>
												<td><?php echo $absent; ?></td>
												<td><a href="./index.php?page=edit_absen&id=<?php echo $data1['id']; ?>&nama=<?php echo $data1['nama']; ?>&tanggal=<?php echo $absent; ?>&status=A&flag=<?php echo $flag; ?>">
														<center><b>A</b></center>
													</a></td>
												<td></td>
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
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script>
	function onDelete(id) {
		var choice = confirm('yakin mau menghapus data ' + id + ' ?');
		if (choice) {
			window.location.href = 'konfig/delete_absensi.php?id=' + id;
		}
	}

	$('.pop').on('click', function() {
		$('.imagepreview').attr('src', $(this).find('img').attr('src'));
		$('#imagemodal').modal('show');
	});

	function openModal(urlx) {
		$('#modalImg').attr('src', urlx);
		$('#myModal').modal('show');
	}
</script>