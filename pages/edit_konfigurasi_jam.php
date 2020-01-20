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


require_once './func/func_pegawai.php';
$divisi = GetDivisi2();
?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT KONFIGURASI </h1>
				<h4 class="m-0 text-muted">Jam <?php echo $mode; ?></h4>
				<!-- <small id="emailHelp" class="form-text text-muted"><?php echo $keterangan; ?></small> -->

			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=konfigurasi">Konfigurasi</a></li>
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
						<input type="hidden" name="id_sub" id="id_sub">

						<div class="form-group text-left">
							<label for="id_divisi">Divisi</label>
							<select id="id_divisi" name="id_divisi" required class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
								<option value="">-Pilih Divisi-</option>
								<?php
								foreach ($divisi as $data) { ?>
									<option value="<?php echo $data['id']; ?>"><?php echo '(' . $data['kode_divisi'] . ') ' . $data['nama_divisi']; ?></option>
								<?php } ?>
							</select>
							<small id="value_sub_msg" style="display:none" class="text-danger">
								required
							</small>
						</div>

						<div class="row mb-2">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Jam <?php echo $mode; ?></label>
									<input placeholder="HH:MM" id="jam_masuk" name="jam_masuk" class="form-control input-jam" required />
									<small id="value_sub_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>
						</div>

						<h4 class="text-left text-muted">Telat 1</h4>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Dari</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat1a" id="telat1a" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="value_sub_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat1b" id="telat1b" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="value_sub_msg" style="display:none" class="text-danger">
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
									<small id="value_sub_msg" style="display:none" class="text-danger">
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
										<input required class="form-control input-num" type="text" name="telat1a" id="telat1a" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="value_sub_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat1b" id="telat1b" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="value_sub_msg" style="display:none" class="text-danger">
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
									<small id="value_sub_msg" style="display:none" class="text-danger">
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
										<input required class="form-control input-num" type="text" name="telat1a" id="telat1a" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="value_sub_msg" style="display:none" class="text-danger">
										required
									</small>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group text-left">
									<label for="param_sub">Sampai</label>
									<div class="input-group mb-3">
										<input required class="form-control input-num" type="text" name="telat1b" id="telat1b" placeholder="20">
										<div class="input-group-append">
											<span class="input-group-text">menit</span>
										</div>
									</div>
									<small id="value_sub_msg" style="display:none" class="text-danger">
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
									<small id="value_sub_msg" style="display:none" class="text-danger">
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
								<small id="value_sub_msg" style="display:none" class="text-danger">
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

							<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-example" style="width: 100%;">
								<!-- <table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;"> -->
								<thead>
									<tr class="bg-secondary text-center">
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
										$txt = $status == '1' ? 'Active' : 'Inactive';
										$clr = $status == '1' ? 'success' : 'secondary';
									?>
										<tr class="text-center table-<?php echo $color; ?>">
											<td><?php echo $no; ?></td>
											<td class="text-left"><?php echo $data['nama_divisi']; ?></td>
											<td><?php echo $data['jam'] . ':' . $data['menit']; ?></td>
											<td><?php echo $data['batas1'] . ':00' . ' - ' . $data['batas2'] . ':00'; ?></td>
											<td class="text-left"><?php echo $data['telat1a'] . ' s/d ' . $data['telat1b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen1'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo $data['telat2a'] . ' s/d ' . $data['telat2b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen2'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo $data['telat3a'] . ' s/d ' . $data['telat3b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen3'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo '> ' . $data['telat3b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen4'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-center"><span class="badge badge-<?php echo $clr; ?>"><?php echo $txt; ?></span></td>
											<td>
												<center>
													<!-- <a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-primary btn-sm text-center">edit</a> -->
													<a href="#" onclick="openModal(<?php echo $data['id']; ?>)" class="btn btn-primary btn-sm text-center"><i class="fas fa-edit"></i></a>
													<!-- <a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">delete</a> -->
												</center>
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
					console.log($(el).serialize())
					return false;

					$.ajax({
						url: './konfig/update_konfigurasi.php',
						data: 'update_konfigurasi&ajax&id_parent=<?php echo $id; ?>&' + $(el).serialize(),
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

		var table = $('#detKonfigTbl').DataTable({
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