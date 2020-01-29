<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}

require_once './func/func_pegawai.php';
// $pegawai = GetPegawai2();
$no = $_GET['no'];
$username = $_GET['username'];
$password = $_GET['password'];
$role = $_GET['role'];
$id_karyawan = $_GET['id_karyawan'];

if ($id_karyawan) $karyawan = GetOne($id_karyawan);

// pr($karyawan);
// if ($role == '0') {
// 	$role = "Admin";
// }

?>
<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT PENGGUNA</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=pengguna">Daftar Pengguna</a></li>
					<li class="breadcrumb-item active">Tambah Pengguna</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">

			<form onsubmit="onsubmitForm(this);return false;" action="./konfig/add_absensi.php" method="POST">
				<!-- <form action="./konfig/add_pengguna.php" method="POST"> -->
				<div class="form-group">
					<input type="hidden" id="id" value="<?php echo $no; ?>" name="id">
					<label for="exampleInputEmail1">Username</label>
					<input required class="form-control" type="text" value="<?php echo $username; ?>" name="username" placeholder="Masukan Username">

				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Password</label>
					<input required class="form-control" type="text" name="password" value="<?php echo $password; ?>" placeholder="Masukan Password">
				</div>

				<div class="form-group pt-2">
					<label for="exampleFormControlSelect1">Level</label>
					<select onchange="onchangeLevel(this.value)" class="form-control" name="role">
						<option <?php echo $role == '0' ? 'selected' : ''; ?> value="0">Admin</option>
						<option <?php echo $role == '1' ? 'selected' : ''; ?> value="1">User</option>
					</select>
				</div>

				<div class="form-group karyawan-group" style="<?php echo $role == '1' ? '' : 'display:none'; ?>">
					<label for="exampleInputEmail1">Karyawan</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">search</span>
						</div>
						<input type="hidden" id="id_karyawan" value="<?php echo $id_karyawan ? $karyawan['id'] : ''; ?>" name="id_karyawan">
						<input id="karyawan" value="<?php echo $id_karyawan ? $karyawan['nama'] : ''; ?>" name="karyawan" type="text" class="form-control" placeholder="ketik nama atau nip karyawan ..." aria-label="ketik nama atau nip karyawan ..." aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button id="resetKaryawanBtn" class="btn btn-secondary" onclick="resetInput('karyawan')" type="button">x</button>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-outline-primary mt-3 float-right" value="simpan">Update</button>
			</form>

		</div>
	</div>
</section>

<script src="vendor/js/jquery/jquery-3.4.1.min.js"></script>
<script src="vendor/js/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="vendor/js/inputmask/jquery.inputmask.js"></script>

<script>
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
			// return false;
			if (res.value) {
				$.ajax({
					url: './konfig/update_pengguna.php',
					data: 'ajax&' + $(el).serialize(),
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
						} else {
							titlex = 'Failed'
							textx = 'Gagal menyimpan data, ' + dt.msg
							typex = 'error'
							colorx = 'btn btn-danger'
						}

						// swal({
						// 	title: titlex,
						// 	text: textx,
						// 	type: typex,
						// 	confirmButtonColor: colorx,
						// 	confirmButtonText: 'ok',
						// })

						swal({
							title: titlex,
							text: textx,
							type: typex,
							confirmButtonColor: colorx,
							confirmButtonText: 'ok',
						}).then(function() {
							if (dt.status) {
								window.location.href = "?page=pengguna";
							}
							// location.reload()
						})
					},
				})
			}
		});
		return false;
	}

	function resetInput(el) {
		if (el != '') {
			$('#resetKaryawanBtn').addClass('btn-danger')
		} else {
			$('#resetKaryawanBtn').removeClass('btn-danger')
		}
		$('#' + el).val('').focus() 
		$('#' + el).removeAttr('readonly')
		// $('#resetKaryawanBtn').removeClass('btn-danger')
		$('.karyawan-info>input').val('')
		$('#id_karyawan').val('')
	}

	function onchangeLevel(val) {
		if (val == '1') { // user 
			$('#karyawan').attr('required', true)
			$('.karyawan-group').removeAttr('style')
		} else { // admin
			$('#karyawan').removeAttr('required')
			$('.karyawan-group').attr('style', 'display:none')
			resetInput('karyawan')
			resetInput('id_karyawan')
		}
	}

	$(document).ready(function() {

		let hasSelectedKary = false
		$('#karyawan').combogrid({
			debug: true,
			width: '700px',
			colModel: [{
				'align': 'left',
				'columnName': 'nip',
				// 'hide': true,
				'width': '25',
				'label': 'NIP'
			}, {
				'align': 'left',
				'columnName': 'nama',
				'width': '25',
				'label': 'Nama'
			}, {
				'align': 'left',
				'columnName': 'jabatan',
				'width': '25',
				'label': 'Jabatan'
			}, {
				'align': 'left',
				'columnName': 'divisi',
				'width': '25',
				'label': 'Divisi'
			}],
			url: './func/func_absensi.php?karyawan_pengguna&ajax&id_karyawan='+$('#id_karyawan').val(),
			// url: './func/func_absensi.php?karyawan_absensi=&tanggal='+$('#date').val(),
			select: function(event, ui) {
				// resetInput('masuk')
				// resetInput('keluar')

				hasSelectedKary = true;
				console.table(ui)

				// set : header 
				$('#karyawan').val(ui.item.nama);
				$('#id_karyawan').val(ui.item.id);
				$('#karyawan').attr('readonly', true);

				// set detail
				// jabatan  
				$('.karyawan-info').removeAttr('style')
				$('#nip').val(ui.item.nip);
				$('#jabatan').val(ui.item.jabatan);
				$('#id_jabatan').val(ui.item.id_jabatan);
				$('#divisi').val(ui.item.divisi);
				$('#id_divisi').val(ui.item.id_divisi);

				// jam dll
				let mas = ui.item.rule_masuk
				let masuk_rule = mas.jam == undefined ? '' : (mas.jam + ':' + mas.menit)
				$('#masuk_rule').val(masuk_rule);

				let kel = ui.item.rule_keluar
				let keluar_rule = kel.jam == undefined ? '' : (kel.jam + ':' + kel.menit)
				$('#keluar_rule').val(keluar_rule);

				// validasi input (tidak sesuai data dr server)
				console.log('masuk set value')
				return false;
			}
		});
	})
</script>