<!-- by pass : u/ ngetes absen auto  -->
<!-- <form action="./konfig/absen.php" method="post">
	<input name="id" type="text" value="8667E073">
	<button>ok</button>
</form> -->

<!-- <title>anu</title> -->
<?php
// print_r($_SESSION);
// if (isset($_SESSION['page'])) {
// } else {
// 	header("location: ../index.php?page=dashboard&error=true");
// }

if (!isset($_SESSION['page'])) {
	echo '<script>alert("Anda tidak mempunyai hak akses");window.location.replace("index.php?page=dashboard")</script>';
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
// pr($_SESSION);

$link_tambah = isset($_SESSION['id_karyawan']) ? 'tambah_absensi_user' : 'tambah_absensi';

$tanggal_awal = (isset($_POST['tanggal_awal'])) ? $_POST['tanggal_awal'] : date('Y-m-d');
$tanggal_akhir = (isset($_POST['tanggal_akhir'])) ? $_POST['tanggal_akhir'] : date('Y-m-d');
// pr($tanggal_awal);
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
					k.uid,
					tp.nama_tipepresensi,
					tp.kode_tipepresensi,
					k.id_divisi,
					a.masuk_minus,
					a.keluar_minus,
					d.nama_divisi
				FROM tb_absen a
					JOIN tb_id k ON k.id = a.id_karyawan
					JOIN vw_divisi d ON d.id_divisi= k.id_divisi
					JOIN vw_tipepresensi tp ON tp.id_tipepresensi = a.id_tipe_presensi
				WHERE
					a.date >= "' . $tanggal_awal . '"
					AND a.date <=  "' . $tanggal_akhir . '" ' . (isset($_SESSION['id_karyawan']) ? '
					and a.id_karyawan = ' . $_SESSION['id_karyawan'] : '');
// pr($query);
$sql = mysqli_query($dbconnect, $query);
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

			<!-- <form action="./konfig/absen.php" method="post">
				<input value="3" type="text" name="id">
				<button type="submit">absen auto</button>
			</form> -->

			<div class="card">

				<div class="card-header " style="height: 82px;">

					<form action="" method="POST">
						<div class="row">
							<div class="col-sm-3">
								<br>
								<a href="./index.php?page=<?php echo $link_tambah; ?>">
									<button type="button" class="btn btn-primary btn-md float-left"><i class="fas fa-plus-square"></i> Absen Manual</button>
								</a>
							</div>
							<div class="col-sm-3">
								<label>Tanggal Awal</label>
								<input required onchange="this.form.submit()" class="form-control" type="date" max="<?php echo $tanggal_akhir; ?>" value="<?php echo $tanggal_awal ? $tanggal_awal : date('Y-m-d'); ?>" name="tanggal_awal" id="tanggal_awal">
							</div>
							<div class="col-sm-3">
								<label>Tanggal Akhir</label>
								<input required onchange="this.form.submit()" class="form-control" type="date" max="<?php echo $tanggal_akhir; ?>" value="<?php echo $tanggal_akhir ? $tanggal_akhir : date('Y-m-d'); ?>" name="tanggal_akhir" id="tanggal_akhir">
							</div>
							<div class="col-sm-3">
								<label>.</label>
								<button type="submit" class=" form-control btn btn-md btn-secondary"><i class="fas fa-search"></i> Tampilkan</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="card-body">
					<div class="row mt-2">
						<div class="col-md-12 col-md-offset-2">
							<div class="table table-hover">

								<table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;">
									<thead>
										<tr>
											<th>No.</th>
											<th>Tipe</th>
											<th>UID</th>
											<th>NIP </th>
											<th>Nama</th>
											<th>Tanggal</th>
											<th>Jam Masuk</th>
											<th>Jam Keluar</th>
											<th>Status</th>
											<th>Mode</th>
											<th>Capture</th>
											<th>Keterangan</th>
											<th>Potongan</th>
											<th>Total Telat</th>
											<th>Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$potTotal = 0;
										$no = 0;
										while ($data = mysqli_fetch_assoc($sql)) {
											$no++;
											$jdw = getJadwalAbsen($data['id_divisi']);
											// pr($jdw);
											// col : jam masuk 
											if ($data['masuk_minus'] > 0) {
												$clrMas = "danger";
											} else if ($data['masuk_minus'] == 0) {
												$clrMas = "success";
											}
											// else if ($data['masuk_minus'] < 0) {
											// 	$clrMas = "primary";
											// }
											else {
												$clrMas = "secondary";
											}

											// col : jam keluar 
											// pr($data['keluar_minus'] );
											if ($data['keluar_minus'] > 0) {
												$clrKel = "danger";
											} else if ($data['keluar_minus'] == 0) {
												$clrKel = "success";
											} else {
												$clrKel = "secondary";
											}

											// row : status
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

											$jamSkrg = date('H:i');
											$maxFinger = $jdw['kel_bts_2'] . ':00';
											$potTdkFinger = 0;

											// if ($data['masuk'] == '' || $data['keluar'] == '') {
											// 	if ($jamSkrg > $maxFinger) {
											// 		$potTdkFinger = 2;
											// 	}
											// }

											$potongan = $potTdkFinger + $data['potongan'];

										?>
											<tr class="table-<?php echo $color; ?>">
												<td><?php echo $no; ?></td>
												<td><?php echo $data['nama_tipepresensi']; ?></td>
												<td><?php echo $data['uid']; ?></td>
												<td><?php echo $data['nip']; ?></td>
												<td>
													<?php echo $data['nama']; ?>
													<br>
													Divisi
													<span class="badge badge-secondary">
														<?php echo $data['nama_divisi'] ?>
													</span>
												</td>
												<td><?php echo $data['tanggal']; ?></td>
												<td>
													<?php if ($data['kode_tipepresensi'] == 'harian') { ?>
														<?php echo $data['masuk_minus'] > 0 ? 'Telat  <span class="badge badge-danger">' . $data['masuk_minus'] . ' </span> menit<br>' : '' ?>
														Real <span class="badge badge-<?php echo $clrMas; ?>"> <?php echo $data['masuk']; ?></span>
														<br>Rule <span class="badge badge-secondary"> <?php echo $jdw['mas_jam'] . ':' . $jdw['mas_menit']; ?></span>
													<?php } else { ?>
														<center>-</center>
													<?php } ?>
												</td>
												<td>
													<?php if ($data['kode_tipepresensi'] == 'harian') { ?>
														<?php echo $data['keluar_minus'] > 0 ? 'Lbh cpt  <span class="badge badge-danger">' . $data['keluar_minus'] . ' </span> menit<br>' : '' ?>
														Real <span class="badge badge-<?php echo $clrKel; ?>"> <?php echo $data['keluar']; ?></span>
														<br>Rule <span class="badge badge-secondary"> <?php echo $jdw['kel_jam'] . ':' . $jdw['kel_menit']; ?></span>
													<?php } else { ?>
														<center>-</center>
													<?php } ?>
												</td>
												<td><?php echo $status; ?></td>
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
												<td>
													<?php if ($data['kode_tipepresensi'] == 'harian') { ?>
														<?php echo $potongan ?> %
													<?php } else { ?>
														<center>-</center>
													<?php } ?>
												</td>
												<td>
													<?php if ($data['kode_tipepresensi'] == 'harian') { ?>
														<?php echo $data['terlambat']; ?> menit
													<?php } else { ?>
														<center>-</center>
													<?php } ?>
												</td>
												<td>
													<?php //if ($data['mode'] == 'manual') { 
													?>
													<center>
														<a href="index.php?page=edit_absensi&id=<?php echo $data['id']; ?>" class="btn btn-primary btn-sm text-center">
															<i class="fas fa-pencil-alt"></i>
														</a>
														<a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">
															<i class="fas fa-trash"></i>
														</a>
													</center>
													<?php //} 
													?>

												</td>
											</tr>

										<?php
											$potTotal += $potongan;
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
	let title = '<h2>wkwkwk</h2>'
	// $('#absensiTbl').append(title);
	// $('#absensiTbl').append('<caption style="caption-side: bottom">huhuhuhu</caption>');

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

	$(document).ready(function() {
		var table = $('#absensiTbl').DataTable({
			dom: 'Bfrtip',
			paging: true,
			pageLength: 5,
			blengthChange: false,
			bPaginate: false,
			bInfo: false,
			buttons: [{
					// extend: 'pdf',
					filename: 'hahah',
					extend: 'pdfHtml5',
					className: 'btn-danger',
					orientation: 'landscape',
					download: 'open',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
						// modifier: {
						// 	page: 'current'
						// }
					},
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?> \nTotal Potongan : <?php echo $potTotal; ?> %',
					title: function() {
						let title = 'Daftar Presensi Satpol PP Sidoarjo\n'
						return title;
					},
				},
				{
					extend: 'excel',
					className: 'btn-success',
					filename: 'hahah',
					orientation: 'landscape',
					download: 'open',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
					},
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?> \nTotal Potongan : <?php echo $potTotal; ?> %',
					title: function() {
						let title = 'Daftar Presensi Satpol PP Sidoarjo\n'
						return title;
					},
				},
				{
					extend: 'print',
					className: 'btn-info'
				}
			]
		});

		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');

	})
</script>