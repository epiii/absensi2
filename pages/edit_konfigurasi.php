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

$query = "SELECT * from tb2_setting where id_parent =" . $id;
$sql = mysqli_query($dbconnect, $query);
?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT PARAMETER</h1>
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
					<form id="formParam" onsubmit="alert(9999);onsubmitForm(this);return false;" method="POST">
						<div class="form-group text-left">
							<label for="param_sub">Parameter</label>
							<input type="hidden" name="id_sub" id="id_sub">
							<input required class="form-control" type="text" name="param_sub" id="param_sub" placeholder="Masukan Parameter">
						</div>
						<div class="form-group text-left">
							<label for="param_sub">Value</label>
							<input required class="form-control" type="text" name="value_sub" id="value_sub" placeholder="Masukan Value">
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

			<form action="./konfig/update_konfigurasi.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Parameter</label>
					<input type="hidden" name="id" value=<?php echo $id; ?>>
					<input readonly class="form-control" type="text" name="param" id="param" placeholder="Masukan Parameter" value="<?php echo $parameter ?>">
					<!-- <small id="emailHelp" class="form-text text-muted"><?php echo $keterangan; ?></small> -->
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Value</label>
					<input required class="form-control" type="text" name="value" id="value" placeholder="Masukan Value" value="<?php echo $value ?>">
				</div>
				<button type="submit" class="btn btn-primary mt-3" value="simpan">Simpan Konfigurasi</button>
				<!-- <button type="submit" class="btn btn-outline-primary mt-3" value="simpan">Simpan Konfigurasi</button> -->
			</form>

			<div class="card-body">
				<div class="row mt-2">
					<div class="col-md-12 col-md-offset-2">

						<h3 class="text-center">Sub Parameter</h3>
						<div class="table table-hover">

							<div class="text-right">
								<button onclick="openModal()" class="btn btn-primary ">
									<i class="fas fa-plus" data-toggle="tooltip" title="Edit"></i>
								</button>
							</div>

							<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
								<!-- <table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;"> -->
								<thead>
									<tr class="bg-secondary text-center">
										<th>id</th>
										<th>Parameter</th>
										<th>Value</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									while ($data = mysqli_fetch_assoc($sql)) {
										$status = $data['isActive'];
										$txt = $status == '1' ? 'Active' : 'Inactive';
										$clr = $status == '1' ? 'success' : 'secondary';
									?>
										<tr class="table-<?php echo $color; ?>">
											<td><?php echo $data['id']; ?></td>
											<td><?php echo $data['param']; ?></td>
											<td><?php echo $data['value']; ?> </td>
											<td class="text-center"><span class="badge badge-<?php echo $clr; ?>"><?php echo $txt; ?></span></td>
											<td class="text-center">
												<button href="#" class="btn btn-primary btn-sm text-center">edit</button>
												<a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">delete</a>
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
		$('#param_sub').val('');
		$('#value_sub').val('');
	}

	function onsubmitForm(el) {
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
						})
					},
				})
			}
		});
		return false;
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

		$('#detKonfigTbl tbody').on('click', 'button', function() {
			var data = table.row($(this).parents('tr')).data();
			$('#id_sub').val(data[0])
			$('#param_sub').val(data[1])
			$('#value_sub').val(data[2])
			openModal()
		});

		function onClickEdit(par) {
			var data = table.row($(par).parents('tr')).data();
			console.log(data)

			// alert(data[0] + "'s salary is: " + data[5]);
		}
		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');

	})
</script>