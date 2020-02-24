<?php
if (isset($_SESSION['page'])) {
	if (isset($_GET['id']) || isset($_GET['param'])) {
		//lajut
	} else {
		echo '<h3><center> Permintaan ditolak :( </center></h3>';
		exit;
	}
} else {
	header("location: ../index.php?page=dashboard&error=true");
}

$id = $_GET['id'];
$parameter = $_GET['param'];
$value = $_GET['value'];
$isVisible = true;

if ($parameter == 'hari_libur') {
	$query = 'SELECT
				v.id_hari_libur as id,
				v.kode_hari_libur as param,
				v.nama_hari_libur as value,
				v.isActive,
			null as hasUsed
			FROM vw_hari_libur v';
	$inputType = 'date';
} elseif ($parameter == 'tipe_presensi') {
	$query = 'SELECT
				v.id_tipepresensi as id,
				v.kode_tipepresensi as param,
				v.nama_tipepresensi as value,
				v.isActive,
				null as hasUsed
			FROM vw_tipepresensi v';
	$isVisible = false;
} elseif ($parameter == 'status_pernikahan') {
	$query = 'SELECT
				v.id_statuspernikahan AS id,
				v.kode_statuspernikahan AS param,
				v.nama_statuspernikahan AS value ,
				v.isActive,
				tb.id_status_kawin as hasUsed
			FROM
				vw_statuspernikahan v
				LEFT JOIN (
					SELECT DISTINCT(id_status_kawin) from tb1_karyawan 
				)tb on tb.id_status_kawin = v.id_statuspernikahan';
} elseif ($parameter == 'kategori_karyawan') {
	$query = 'SELECT
				v.id_katkaryawan AS id,
				v.kode_katkaryawan AS param,
				v.nama_katkaryawan AS value ,
				v.isActive,
				tb.id_kategori_karyawan as hasUsed
			FROM
				vw_katkaryawan v
				LEFT JOIN (
					SELECT DISTINCT(id_kategori_karyawan) from tb1_karyawan 
				)tb on tb.id_kategori_karyawan= v.id_katkaryawan';
} else { // divisi
	$query = 'SELECT
				v.id_divisi AS id,
				v.kode_divisi AS param,
				v.nama_divisi AS value ,
				v.isActive,
				null AS hasUsed
			FROM
				vw_divisi v';
	// $query = 'SELECT
	// 			v.id_' . $parameter . ' as id,
	// 			v.kode_' . $parameter . ' as param,
	// 			v.nama_' . $parameter . ' as value,
	// 			v.isActive,
	// 			tb.id_' . $parameter . ' as hasUsed
	// 		FROM vw_' . $parameter . ' v
	// 		left JOIN  (
	// 			SELECT
	// 				DISTINCT(k.id_' . $parameter . ')
	// 			FROM
	// 				tb1_karyawan k
	// 		) tb on tb.id_' . $parameter . ' = v.id_' . $parameter;
}
// $query = "SELECT * from tb2_setting where id_parent =" . $id;
// vd($query);
$sql = mysqli_query($dbconnect, $query);
$num = mysqli_num_rows($sql);
?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Edit <?php echo $value; ?></h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=master">Master</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Form Sub Parameter</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body text-center">
					<form id="formParam" method="POST">
						<div class="form-group text-left">
							<label for="param_sub">Parameter</label>
							<input type="hidden" name="update">
							<input type="hidden" name="id_sub" id="id_sub">
							<input required class="form-control " type="<?php echo $inputType == 'date' ? 'date' : 'text'; ?>" name="param_sub" id="param_sub" placeholder="Masukan Parameter">
							<small id="param_sub_msg" style="display:none" class="text-danger">
								required
							</small>
						</div>
						<div class="form-group text-left">
							<label for="param_sub">Value</label>
							<input required class="form-control" type="text" name="value_sub" id="value_sub" placeholder="Masukan Value">
							<small id="value_sub_msg" style="display:none" class="text-danger">
								required
							</small>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Reset</button> -->
					<button type="button" class="btn btn-default" onclick="resetFormSub()">Reset</button>
					<button type="button" onclick="onsubmitForm($('#formParam'));" class="btn btn-primary">Simpan</button>
				</div>
			</div>

		</div>
	</div>

</div>

<section class="content ml-3 mr-3" id="box">
	<div class="content">
		<div class="container-fluid">

			<!-- <form action="./konfig/update_master.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Parameter</label>
					<input type="hidden" name="update_master">
					<input type="hidden" name="id" value=<?php echo $id; ?>>
					<input readonly class="form-control" type="text" name="param" id="param" placeholder="Masukan Parameter" value="<?php echo $parameter ?>">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Value</label>
					<input required class="form-control" type="text" name="value" id="value" placeholder="Masukan Value" value="<?php echo $value ?>">
				</div>
				<button type="submit" class="btn btn-primary mt-3" value="simpan">Simpan Konfigurasi</button>
			</form> -->

			<div class="card-body">
				<div class="row mt-2">
					<div class="col-md-12 col-md-offset-2">

						<!-- <h3 class="text-center">Sub Parameter</h3> -->
						<div class="table table-hover">
							<?php if ($isVisible) { ?>
								<div class="text-right">
									<button onclick="openModal()" class="btn btn-primary ">
										<i class="fas fa-plus" data-toggle="tooltip" title="Edit"></i>
									</button>
								</div>
							<?php } ?>

							<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
								<!-- <table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;"> -->
								<thead>
									<tr class="bg-secondary text-center">
										<th>id</th>
										<th>Parameter</th>
										<th>Value</th>
										<?php if ($isVisible) { ?>
											<th>Status</th>
											<th>Action</th>
										<?php } ?>
									</tr>
								</thead>

								<tbody>
									<?php
									while ($data = mysqli_fetch_assoc($sql)) {
										// pr($data);
										$status = $data['isActive'];
										$ico = $status == '1' ? 'check' : 'minus';
										$txt = $status == '1' ? 'Active' : 'Inactive';
										$clr = $status == '1' ? 'success' : 'default';
										$isHidden = is_null($data['hasUsed']) || $data['hasUsed'] == '' ? '' : 'style=display:none';
										// pr($isHidden);
									?>
										<tr class="table-<?php echo $color; ?>">
											<td><?php echo $data['id']; ?></td>
											<td><?php echo $data['param']; ?></td>
											<td><?php echo $data['value']; ?> </td>

											<?php if ($isVisible) { ?>
												<td class="text-center">
													<button onclick="changeStatus(<?php echo $data['id']; ?>);return false;" class="btn btn-sm btn-<?php echo $clr; ?>">
														<i class="fas fa-<?php echo $ico; ?>"></i>
														<?php echo ' ' . $txt; ?>
													</button>
												</td>

												<td class="text-center">
													<!-- <button href="#" class="btn btn-primary btn-sm edit-btn text-center"><i class="fas fa-pencil-alt"></i></button> -->
													<button href="#" onclick="onEdit(<?php echo $data['id']; ?>)" class="btn btn-primary btn-sm edit-btn text-center"><i class="fas fa-pencil-alt"></i></button>
													<a <?php echo $isHidden; ?> href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center"><i class="fas fa-trash"></i></a>
												</td>
											<?php } ?>
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
</section>


<script src="./vendor/js/jquery/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

<script>
	function openModal(urlx) {
		$('#myModal').modal('show');
	}

	function resetFormSub() {
		console.log('masuk reset ')
		$('#param_sub').val('');
		$('#value_sub').val('');
		$('#param_sub_msg').attr('style', 'display:none')
		$('#value_sub_msg').attr('style', 'display:none')
		$('#param_sub').removeClass('is-invalid')
		$('#value_sub').removeClass('is-invalid')
	}

	function onDelete(par) {
		swal({
			title: 'Yakin menghapus data?',
			text: 'Pastikan data yang akan dihapus sudah benar',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'btn btn-success',
			// confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((res) => {
			console.log(res)
			// return false;

			if (res.value) {
				$.ajax({
					url: './func/ajax_master.php',
					data: 'delete&id=' + par,
					dataType: 'json',
					method: 'get',
					success: function(dt) {
						let titlex, textx, typex, colorx;
						if (dt.status) {
							titlex = 'Success'
							textx = 'Berhasil menghapus data'
							typex = 'success'
							colorx = 'btn btn-success'
						} else {
							titlex = 'Failed'
							textx = 'Gagal menghapus data, ' + dt.msg
							typex = 'error'
							colorx = 'btn btn-danger'
						}

						swal({
							title: titlex,
							text: textx,
							type: typex,
							confirmButtonColor: colorx,
							confirmButtonText: 'ok',
						}).then(function() {
							location.reload()
						})
					}
				})
			}
		})
	}

	function changeStatus(par) {
		swal({
			title: 'Yakin mengganti status?',
			text: '',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: 'btn btn-success',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((res) => {
			console.log(res)

			if (res.value) {
				$.ajax({
					url: './func/ajax_master.php',
					data: 'id=' + par + '&update_status',
					// url: './konfig/update_konfigurasi.php',
					// data: 'id=' + par + '&update_konfigurasi_status&ajax',
					dataType: 'json',
					method: 'get',
					success: function(dt) {
						let titlex, textx, typex, colorx;
						if (dt.status) {
							titlex = 'Success'
							textx = 'Berhasil mengganti status'
							typex = 'success'
							colorx = 'btn btn-success'
						} else {
							titlex = 'Failed'
							textx = 'Gagal mengganti status, ' + dt.msg
							typex = 'error'
							colorx = 'btn btn-danger'
						}

						swal({
							title: titlex,
							text: textx,
							type: typex,
							confirmButtonColor: colorx,
							confirmButtonText: 'ok',
						}).then(function() {
							location.reload()
						})
					}
				})
			}
		})
	}

	function onsubmitForm(el) {
		let val = $('#param_sub').val()
		let par = $('#param_sub').val()

		if (par == '' || val == '') {
			if (par == '') {
				$('#param_sub').addClass('is-invalid')
				$('#param_sub_msg').removeAttr('style')
			}

			if (val == '') {
				$('#value_sub').addClass('is-invalid')
				$('#value_sub_msg').removeAttr('style')
			}
		} else {
			$('#value_sub_msg').attr('style', 'display:none')
			$('#param_sub_msg').attr('style', 'display:none')
			$('#param_sub').removeClass('is-invalid')
			$('#value_sub').removeClass('is-invalid')
			swal({
				title: 'Yakin melanjutkan?',
				text: 'Pastikan semua data sudah terisi dengan benar',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: 'btn btn-success',
				// confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak'
			}).then((res) => {
				console.log(res)
				if (res.value) {
					$.ajax({
						url: './func/ajax_master.php',
						data: 'id_parent=<?php echo $id; ?>&' + $(el).serialize(),
						dataType: 'json',
						method: 'post',
						success: function(dt) {
							console.log(dt);
							let titlex, textx, typex, colorx;
							if (dt.status) {
								titlex = 'Success'
								textx = 'Berhasil menyimpan data'
								typex = 'success'
								colorx = 'btn btn-success'
								$('#myModal').modal('hide');
							} else {
								titlex = 'Failed'
								textx = dt.msg
								typex = 'error'
								colorx = 'btn btn-danger'
							}

							resetFormSub()
							swal({
								title: titlex,
								text: textx,
								type: typex,
								confirmButtonColor: colorx,
								confirmButtonText: 'ok',
							}).then(function() {
								location.reload()
							})
						},
					})
				}
			});
			return false;
		}
	}

	$(document).ready(function() {
		$('#myModal').on('hidden.bs.modal', function() {
			console.log('modal closed')
			resetFormSub()
			$('#id_sub').val('')
		})
		var table = $('#detKonfigTbl').DataTable({
			paging: true,
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			"columnDefs": [{
				"targets": [0],
				"visible": false,
			}],
			blengthChange: false,
			bPaginate: false,
			bInfo: false,

		});

		// $('#detKonfigTbl tbody').on('click', '.edit-btn', function() {
		// 	var data = table.row($(this).parents('tr')).data();
		// 	console.log(table)
		// 	console.log(data)
		// 	$('#id_sub').val(data[0])
		// 	$('#param_sub').val(data[1])
		// 	$('#value_sub').val(data[2])
		// 	openModal()
		// });

		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');
	})

	function onEdit(par) {
		console.log(par)
		$.ajax({
			url: './func/ajax_master.php',
			data: 'get_master&id=' + par,
			dataType: 'json',
			method: 'get',
			success: function(dt) {
				if (dt.sts == false) {
					titlex = 'Failed'
					textx = 'Gagal, ' + dt.msg
					typex = 'error'
					colorx = 'btn btn-danger'

					swal({
						title: titlex,
						text: textx,
						type: typex,
						confirmButtonColor: colorx,
						confirmButtonText: 'ok',
					})
				} else {
					// $('#id').val(dt.msg.id)
					$('#id_sub').val(dt.msg.id)
					$('#param_sub').val(dt.msg.param)
					$('#value_sub').val(dt.msg.value)
					openModal()
				}
			}
		})
	}
</script>