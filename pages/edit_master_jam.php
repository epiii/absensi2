<?php
if (isset($_SESSION['page'])) {
	if (isset($_GET['id']) || isset($_GET['param'])) {
		//lajut
	} else {
		echo '<h4><center> Permintaan ditolak :( </center></h3>';
		exit;
	}
} else {
	header("location: ../index.php?page=dashboard&error=true");
}

$id = $_GET['id'];
$mode = $id == '1' ? 'Masuk' : 'Keluar';
$query = "	SELECT s.*,v.nama_divisi
			FROM tb1_setting2 s 
			LEFT JOIN vw_divisi v on v.id_divisi = s.id_divisi 
			WHERE s.no =" . $id;
$sql = mysqli_query($dbconnect, $query);

// pr($query);
require_once './func/func_pegawai.php';
$divisi = GetDivisi2();
?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT KONFIGURASI </h1>
				<h4 class="m-0 text-muted">Jam <?php echo $mode; ?></h4>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=master">master</a></li>
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
						<input type="hidden" name="mode" value="<?php echo $mode; ?>" id="mode">
						<input type="hidden" name="id" id="id">

						<div class="form-group text-left">
							<label for="id_divisi">Divisi</label>
							<select id="id_divisi" name="id_divisi" required class="select2_category form-control input-large input" data-placeholder="Choose a Category" tabindex="1">
								<option value="">-Pilih Divisi-</option>
								<?php
								foreach ($divisi as $data) { ?>
									<option value="<?php echo $data['id']; ?>"><?php echo '(' . $data['kode_divisi'] . ') ' . $data['nama_divisi']; ?></option>
								<?php } ?>
							</select>
							<small id="id_divisi_msg" style="display:none" class="text-danger">
								required
							</small>
						</div>

						<div class="row mb-2">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="jam_masuk">Jam <?php echo $mode; ?></label>
									<input placeholder="HH:MM" id="jam" name="jam" class="form-control input-jam input" />
									<small id="jam_msg" style="display:none" class="text-danger">
										required
									</small>

									<!-- <input placeholder="HH:MM" id="jam_masuk" name="jam_masuk" class="form-control input-jam input" />
									<input style="display:none" placeholder="HH:MM" id="jam_keluar" name="jam_keluar" class="form-control input-jam input" />
									<small id="jam_masuk_msg" style="display:none" class="text-danger">
										required
									</small>
									<small id="jam_keluar_msg" style="display:none" class="text-danger">
										required
									</small> -->
								</div>
							</div>
						</div>

						<h5 class="text-left text-muted">Telat 1</h5>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Dari</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num input" type="text" name="telat1a" id="telat1a" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="telat1a_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num input" type="text" name="telat1b" id="telat1b" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="telat1b_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Potongan</label>
									<div class="input-group mb-3">
										<input required class="form-control input-pers" type="text" name="persen1" id="persen1" placeholder="25">
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
									<small id="persen1_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
						</div>

						<h4 class="text-left text-muted">Telat 2</h4>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Dari</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat2a" id="telat2a" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="telat2a_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat2b" id="telat2b" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="telat2b_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Potongan</label>
									<div class="input-group mb-3">
										<input required class="form-control input-pers" type="text" name="persen2" id="persen2" placeholder="25">
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
									<small id="persen2_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
						</div>

						<h4 class="text-left text-muted">Telat 3</h4>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Dari</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat3a" id="telat3a" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="telat3a_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat3b" id="telat3b" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="telat3b_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Potongan</label>
									<div class="input-group mb-3">
										<input required class="form-control input-pers" type="text" name="persen3" id="persen3" placeholder="25">
										<div class="input-group-append">
											<span class="input-group-text">%</span>
										</div>
									</div>
									<small id="persen3_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
						</div>

						<h4 class="text-left text-muted">Telat 4</h4>
						<div class="col-md-4">
							<div class="form-group text-left">
								<label for="param_sub">Potongan</label>
								<div class="input-group mb-3">
									<input required class="form-control input-pers" type="text" name="persen4" id="persen4" placeholder="25">
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
								<small id="persen4_msg" style="display:none" class="text-danger">
									required
								</small>
							</div>
						</div>

						<h4 class="text-left text-muted">Batas Absen</h4>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Dari</label>
									<div class="input-group mb-3">
										<input required class="form-control input-hourz" type="text" name="batas1" id="batas1" placeholder="09">
										<div class="input-group-append">
											<span class="input-group-text">:00</span>
										</div>
									</div>
									<small id="batas1_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
							<!-- <span>s/d</span> -->
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-hourz" type="text" name="batas2" id="batas2" placeholder="16">
										<div class="input-group-append">
											<span class="input-group-text">:00</span>
										</div>
									</div>
									<small id="batas2_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
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

			<!-- <form action="./konfig/update_konfigurasi.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Parameter</label>
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
						<div class="table table-hover">

							<div class="text-right">
								<button onclick="openModal()" class="btn btn-primary ">
									<i class="fas fa-plus" data-toggle="tooltip" title="Tambah"></i>
								</button>
							</div>

							<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
								<!-- <table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;"> -->
								<thead>
									<tr class="bg-secondary text-center">
										<th>ID</th>
										<th>id_divisi</th>
										<th>No</th>
										<th>Divisi</th>
										<th>Jam <?php echo $mode; ?></th>
										<th>Batas Absen</th>
										<th>Telat 1</th>
										<th>Telat 2</th>
										<th>Telat 3</th>
										<th>Telat 4</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$no = 1;
									while ($data = mysqli_fetch_assoc($sql)) {
										$status = $data['isActive'];

										$ico = $status == '1' ? 'check' : 'minus';
										$txt = $status == '1' ? 'Active' : 'Inactive';
										$clr = $status == '1' ? 'success' : 'default';
										$color = $status == '1' ? 'success' : 'default';
									?>
										<tr class="text-center table-<?php echo $color; ?>">
											<td><?php echo $data['id']; ?></td>
											<td><?php echo $data['id_divisi']; ?></td>
											<td><?php echo $no; ?></td>
											<td class="text-left"><?php echo $data['nama_divisi']; ?></td>
											<td><?php echo $data['jam'] . ':' . $data['menit']; ?></td>
											<td><?php echo $data['batas1'] . ':00' . ' - ' . $data['batas2'] . ':00'; ?></td>
											<td class="text-left"><?php echo $data['telat1a'] . ' s/d ' . $data['telat1b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen1'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo $data['telat2a'] . ' s/d ' . $data['telat2b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen2'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo $data['telat3a'] . ' s/d ' . $data['telat3b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen3'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo '> ' . $data['telat3b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen4'] . ' %'; ?></b><?php echo ''; ?></td>
											<!-- <td class="text-center"><span class="badge badge-<?php echo $clr; ?>"><?php echo $txt; ?></span></td> -->
											<td class="text-center">
												<button onclick="changeStatus(<?php echo $data['id']; ?>);return false;" class="btn btn-sm btn-<?php echo $clr; ?>">
													<i class="fas fa-<?php echo $ico; ?>"></i>
													<?php echo ' ' . $txt; ?>
												</button>
											</td>
											<td class="text-center">
												<!-- <button  class="btn btn-primary btn-sm edit-btn text-center"><i class="fas fa-pencil-alt"></i></button> -->
												<button onclick="onEdit(<?php echo $data['id']; ?>)" class="btn btn-primary btn-sm edit-btn text-center"><i class="fas fa-pencil-alt"></i></button>
												<a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center"><i class="fas fa-trash"></i></a>
											</td>

										</tr>
									<?php
										$no++;
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="vendor/js/inputmask/jquery.inputmask.js"></script>
<script>
	Inputmask("datetime", {
		inputFormat: "HH:MM",
		max: 24,
		hourFormat: 24,
	}).mask("input.input-jam");

	Inputmask("numeric", {
		inputFormat: "999",
		max: 999,
	}).mask("input.input-num");

	Inputmask("numeric", {
		inputFormat: "999",
		max: 100,
	}).mask("input.input-pers");

	Inputmask("numeric", {
		inputFormat: "99",
		max: 23,
	}).mask("input.input-hourz");

	function openModal(urlx) {
		$('#myModal').modal('show');
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
			if (res.value) {
				$.ajax({
					// url: './konfig/update_master.php',
					url: './func/ajax_master_jam.php',
					data: 'id=' + par + '&update_status&ajax',
					// url: './konfig/update_konfigurasi.php',
					// data: 'id=' + par + '&update_konfigurasi_status&ajax',
					dataType: 'json',
					method: 'post',
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

			if (res.value) {
				console.log(par)

				$.ajax({
					url: './func/ajax_master_jam.php',
					data: 'delete&ajax&id=' + par,

					// url: './konfig/delete_master.php',
					// data: 'master_jam&id=' + par,

					dataType: 'json',
					method: 'post',
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

	function onEdit(par) {
		console.log(par)
		$.ajax({
			url: './func/ajax_master_jam.php',
			data: 'get_master_jam&id=' + par,
			dataType: 'json',
			method: 'post',
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
					$('#id').val(dt.msg.id)

					$('#id_divisi').val(dt.msg.id_divisi)
					$('#jam').val(dt.msg.jam + ':00')

					$('#persen1').val(dt.msg.persen1)
					$('#persen2').val(dt.msg.persen2)
					$('#persen3').val(dt.msg.persen3)
					$('#persen4').val(dt.msg.persen4)

					$('#telat1a').val(dt.msg.telat1a)
					$('#telat1b').val(dt.msg.telat1b)

					$('#telat2a').val(dt.msg.telat2a)
					$('#telat2b').val(dt.msg.telat2b)

					$('#telat3a').val(dt.msg.telat3a)
					$('#telat3b').val(dt.msg.telat3b)

					$('#batas1').val(dt.msg.batas1)
					$('#batas2').val(dt.msg.batas2)
					openModal()
				}
			}
		})
	}

	function onsubmitForm(el) {
		let id_divisi = $('#id_divisi').val()

		let jam = $('#jam').val()

		let persen1 = $('#persen1').val()
		let persen2 = $('#persen2').val()
		let persen3 = $('#persen3').val()
		let persen4 = $('#persen4').val()

		let telat1a = $('#telat1a').val()
		let telat1b = $('#telat1b').val()

		let telat2a = $('#telat2a').val()
		let telat2b = $('#telat2b').val()

		let telat3a = $('#telat3a').val()
		let telat3b = $('#telat3b').val()

		let batas1 = $('#batas1').val()
		let batas2 = $('#batas2').val()

		if (
			jam == '' ||
			id_divisi == '' ||
			persen1 == '' ||
			persen1 == '' ||
			telat1a == '' ||
			telat1b == '' ||
			persen2 == '' ||
			telat2a == '' ||
			telat2b == '' ||
			persen3 == '' ||
			telat3a == '' ||
			telat3b == '' ||
			persen4 == '' ||
			batas1 == '' ||
			batas2 == ''
		) {
			if (id_divisi == '') {
				$('#id_divisi').addClass('is-invalid')
				$('#id_divisi_msg').removeAttr('style')
			} else {
				$('#id_divisi').removeClass('is-invalid')
				$('#id_divisi_msg').attr('style', 'display:none')
			}

			if (jam == '') {
				$('#jam').addClass('is-invalid')
				$('#jam_msg').removeAttr('style')
			} else {
				$('#jam').removeClass('is-invalid')
				$('#jam_msg').attr('style', 'display:none')
			}

			if (persen1 == '') {
				$('#persen1').addClass('is-invalid')
				$('#persen1_msg').removeAttr('style')
			} else {
				$('#persen1').removeClass('is-invalid')
				$('#persen1_msg').attr('style', 'display:none')
			}

			if (persen2 == '') {
				$('#persen2').addClass('is-invalid')
				$('#persen2_msg').removeAttr('style')
			} else {
				$('#persen2').removeClass('is-invalid')
				$('#persen2_msg').attr('style', 'display:none')
			}

			if (persen3 == '') {
				$('#persen3').addClass('is-invalid')
				$('#persen3_msg').removeAttr('style')
			} else {
				$('#persen3').removeClass('is-invalid')
				$('#persen3_msg').attr('style', 'display:none')
			}

			if (persen4 == '') {
				$('#persen4').addClass('is-invalid')
				$('#persen4_msg').removeAttr('style')
			} else {
				$('#persen4').removeClass('is-invalid')
				$('#persen4_msg').attr('style', 'display:none')
			}

			if (telat1a == '') {
				$('#telat1a').addClass('is-invalid')
				$('#telat1a_msg').removeAttr('style')
			} else {
				$('#telat1a').removeClass('is-invalid')
				$('#telat1a_msg').attr('style', 'display:none')
			}

			if (telat1b == '') {
				$('#telat1b').addClass('is-invalid')
				$('#telat1b_msg').removeAttr('style')
			} else {
				$('#telat1b').removeClass('is-invalid')
				$('#telat1b_msg').attr('style', 'display:none')
			}

			if (telat2a == '') {
				$('#telat2a').addClass('is-invalid')
				$('#telat2a_msg').removeAttr('style')
			} else {
				$('#telat2a').removeClass('is-invalid')
				$('#telat2a_msg').attr('style', 'display:none')
			}

			if (telat2b == '') {
				$('#telat2b').addClass('is-invalid')
				$('#telat2b_msg').removeAttr('style')
			} else {
				$('#telat2b').removeClass('is-invalid')
				$('#telat2b_msg').attr('style', 'display:none')
			}

			if (telat3a == '') {
				$('#telat3a').addClass('is-invalid')
				$('#telat3a_msg').removeAttr('style')
			} else {
				$('#telat3a').removeClass('is-invalid')
				$('#telat3a_msg').attr('style', 'display:none')
			}

			if (telat3b == '') {
				$('#telat3b').addClass('is-invalid')
				$('#telat3b_msg').removeAttr('style')
			} else {
				$('#telat3b').removeClass('is-invalid')
				$('#telat3b_msg').attr('style', 'display:none')
			}

			if (batas1 == '') {
				$('#batas1').addClass('is-invalid')
				$('#batas1_msg').removeAttr('style')
			} else {
				$('#batas1').removeClass('is-invalid')
				$('#batas1_msg').attr('style', 'display:none')
			}

			if (batas2 == '') {
				$('#batas2').addClass('is-invalid')
				$('#batas2_msg').removeAttr('style')
			} else {
				$('#batas2').removeClass('is-invalid')
				$('#batas2_msg').attr('style', 'display:none')
			}
		} else {

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
				console.log('masuk')
				if (res.value) {
					console.log($(el).serialize())

					$.ajax({
						// url: './konfig/update_master_jam.php',
						url: './func/ajax_master_jam.php',
						data: 'update&ajax&' + $(el).serialize(),
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
								// $('#myModal').modal('hide');
							} else {
								titlex = 'Failed'
								textx = dt.msg
								typex = 'error'
								colorx = 'btn btn-danger'
							}

							// resetFormSub()
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

	function resetFormSub() {
		console.log('masuk reset ')
		$('#id_divisi').val('')
		$('#jam').val('')

		$('#persen1').val('')
		$('#persen2').val('')
		$('#persen3').val('')
		$('#persen4').val('')

		$('#telat1a').val('')
		$('#telat1b').val('')

		$('#telat2a').val('')
		$('#telat2b').val('')

		$('#telat3a').val('')
		$('#telat3b').val('')

		$('#batas1').val('')
		$('#batas2').val('')

		$('#param_sub_msg').attr('style', 'display:none')
		$('#value_sub_msg').attr('style', 'display:none')

		$('#param_sub').removeClass('is-invalid')
		$('#value_sub').removeClass('is-invalid')
	}

	$(document).ready(function() {

		$('#myModal').on('hidden.bs.modal', function() {
			console.log('modal closed')
			resetFormSub()
			$('#id_sub').val('')
		})

		var table = $('#detKonfigTbl').DataTable({
			paging: true,
			columnDefs: [{
					targets: [0],
					visible: false,
					searchable: false
				},
				{
					targets: [1],
					visible: false,
					searchable: false
				}
			],
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			blengthChange: false,
			bPaginate: false,
			bInfo: false,
		});


		/* $('#detKonfigTbl tbody').on('click', '.edit-btn', function() {
			// var dt = table.row(this).data();
			let tr = $(this).parents('tr')
			let dt = table.row(tr)
			console.log(tr)

			// id 
			$('#id').val(dt[0])

			// telat 1 
			let tel1 = dt[6].split(' ')
			console.log('tel 1', tel1)

			// telat 2 
			let tel2 = dt[7].split(' ')
			console.log('tel 2', tel2)

			// telat 3 
			let tel3 = dt[8].split(' ')
			console.log('tel 3', tel3)

			// telat 4 
			let tel4 = dt[9].split(' ')
			console.log('tel 4', tel4)

			// batas  
			let bts = dt[5].split('-')
			let bts1 = bts[0].split(':')[0]
			let bts2 = bts[1].split(':')[0]
			console.log('bts', bts)

			// return false;
			$('#id_divisi').val(dt[1])
			$('#jam').val(dt[4])

			$('#persen1').val(tel1[5])
			$('#persen2').val(tel2[5])
			$('#persen3').val(tel3[5])
			$('#persen4').val(tel4[4])

			$('#telat1a').val(tel1[0])
			$('#telat1b').val(tel1[2])

			$('#telat2a').val(tel2[0])
			$('#telat2b').val(tel2[2])

			$('#telat3a').val(tel3[0])
			$('#telat3b').val(tel3[2])

			$('#batas1').val(bts1)
			$('#batas2').val(bts2)

			openModal()
		}); */
	})
</script>