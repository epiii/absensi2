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


$query = '	SELECT
				d.id_divisi,
				d.nama_divisi,
				GROUP_CONCAT(l.hari) hari
			FROM vw_divisi d 
			LEFT JOIN 
				vw_hari_libur_2 l ON d.id_divisi = l.id_divisi
			GROUP BY l.id_divisi
			ORDER BY d.nama_divisi';
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
							<label for="param_sub">Divisi</label>
							<input type="hidden" name="id_sub" id="id_sub">
							<input disabled class="form-control " type="text" id="param_sub">
							<small id="param_sub_msg" style="display:none" class="text-danger">
								required
							</small>
						</div>

						<div class="form-group text-left">
							<label for="hari">Hari</label><br>
							<select class="form-control" id="value_sub" name="value_sub[]" multiple="multiple">
								<option value="senin">Senin</option>
								<option value="selasa">Selasa</option>
								<option value="rabu">Rabu</option>
								<option value="kamis">Kamis</option>
								<option value="jumat">Jumat</option>
								<option value="sabtu">Sabtu</option>
								<option value="minggu">Minggu</option>
							</select>
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

							<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
								<!-- <table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;"> -->
								<thead>
									<tr class="bg-secondary text-center">
										<th>id</th>
										<th>Divisi</th>
										<th>Hari</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									while ($data = mysqli_fetch_assoc($sql)) {
									?>
										<tr class="table-<?php echo $color; ?>">
											<td><?php echo $data['id_divisi']; ?></td>
											<td><?php echo $data['nama_divisi']; ?></td>
											<td><?php echo $data['hari']; ?> </td>
											<td class="text-center">
												<button href="#" class="btn btn-primary btn-sm edit-btn text-center"><i class="fas fa-pencil-alt"></i></button>
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
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	function openModal(urlx) {
		$('#myModal').modal('show');
	}

	function resetFormSub() {
		console.log('masuk reset ')
		$('#value_sub').val('');
		$('#value_sub_msg').attr('style', 'display:none')
		$('#value_sub').removeClass('is-invalid')
		$('#value_sub').multiselect('deselectAll', true);
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
						url: './konfig/update_konfigurasi.php',
						data: 'update_konfigurasi&ajax=multi&id_parent=<?php echo $id; ?>&' + $(el).serialize(),
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

		// $('#value_sub').multiselect();

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

		$('#detKonfigTbl tbody').on('click', '.edit-btn', function() {
			var data = table.row($(this).parents('tr')).data();
			let hari = data[2].split(',');
			console.log(hari)
			$('#id_sub').val(data[0])
			$('#param_sub').val(data[1])
			$('#value_sub').val(data[2])
			$('#value_sub').multiselect('select', hari);

			openModal()
		});

		function onClickEdit(par) {
			var data = table.row($(par).parents('tr')).data();
			console.log(data)
		}
		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');

	})
</script>

<style>
	.mt-100 {
		margin-top: 100px
	}
</style>