<?php
if (isset($_SESSION['page'])) {
	if (isset($_GET['id'])) {
		// lanjut
	} else {
		echo '<h3><center> Permintaan ditolak :( </center></h3>';
		exit;
	}
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
require_once './func/func_absensi.php';
// $karyawan = GetKaryawan();
// $agama = GetAgama();
// $status = GetStatus();
// $divisi = GetDivisi();
// $jabatan = GetJabatan();
// $kategori = GetKatKaryawan();
// $provinsi = GetProvinsi();

// $agama = GetAgama2();
// $status = GetStatus2();
// $divisi = GetDivisi2();
// $jabatan = GetJabatan2();
// $kategori = GetKatKaryawan2();
$karyawan = GetKaryawan2();
$data = GetKaryawanAbsensi2($_GET['id']);
// pr($data);
// $provinsi = GetProvinsi2();

?>

<script src="vendor/js/jquery/jquery.min.js"></script>

<script src="vendor/js/combogrid/jquery-ui-1.10.1.custom.min.js"></script>
<script src="vendor/js/combogrid/jquery.ui.combogrid-1.6.3.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery-ui-1.10.1.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery.ui.combogrid.css" />

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT ABSENSI (MANUAL)</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=absensi">Daftar Absensi</a></li>
					<li class="breadcrumb-item active">Tambah Absensi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">

			<form action="./konfig/add_absensi.php" method="POST">

				<div class="form-group">
					<label for="exampleInputEmail1">Tipe Presensi</label>
					<select required onchange="tipePresensiFunc(this.value)" class="form-control input-large" data-placeholder="Choose a Category" tabindex="1">
						<option value="">Pilih Tipe Presensi</option>
						<option value="1">Presensi Harian</option>
						<option value="2">Tidak SKJ</option>
					</select>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Pilih Karyawan</label>
					<!-- <input type="text" class="form-control input-medium" id="karyawan" name='karyawan' placeholder='karyawan'> -->
					<select id="karyawan" name="karyawan" required onchange="karyawanFunc(this)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
						<option value="">Pilih Karyawan</option>
						<?php
						foreach ($karyawan as $data_karyawan) { ?>
							<option <?php echo $data_karyawan['id'] == $data['id_karyawan'] ? 'selected' : ''; ?> value="<?php echo $data_karyawan['id']; ?>"><?php echo $data_karyawan['nama'] . " - <b>" . $data_karyawan['nip'] . "</b>"; ?></option>
						<?php } ?>
					</select>
				</div>

				<!-- <select id="cc" class="easyui-combogrid" name="dept" style="width:250px;" data-options="
					panelWidth:450,
					value:'006',
					idField:'code',
					textField:'name',
					url:'datagrid_data.json',
					columns:[[
						{field:'code',title:'Code',width:60},
						{field:'name',title:'Name',width:100},
						{field:'addr',title:'Address',width:120},
						{field:'col4',title:'Col41',width:100}
					]]
				"></select> -->

				<div class="form-group karyawan-info" style="display:none;">
					<label for="kode_jabatan"> jabatan:</label>
					<input type="text" class="form-control input-medium" id="tag" name='tag' placeholder='Tag' readonly>
				</div>

				<!-- <div class="form-group karyawan-info" style="display:none;">
					<label for="kode_jabatan"> kode_jabatan:</label>
					<input type="text" class="form-control input-medium" id="nama" name='nama' placeholder='Nama Karyawan' readonly>
				</div> -->

				<div class="form-group karyawan-info" style="display:none;">
					<label for="kode_jabatan"> NIP:</label>
					<input type="text" class="form-control input-medium" id="nip" name='nip' placeholder='NIP' readonly>
				</div>

				<div class="form-group status-presensi" style="display:none;">
					<div class="radio-list">
						<label class="radio-inline">
							<input type="radio" name="status" id="hadir" value="H" checked> Hadir </label>
						<label class="radio-inline">
							<input type="radio" name="status" id="ijin" value="I"> Ijin </label>
						<label class="radio-inline">
							<input type="radio" name="status" id="dinas" value="D"> Dinas Luar </label>
						<label class="radio-inline">
							<input type="radio" name="status" id="alpha" value="A"> Alpha </label>
					</div>
				</div>

				<div class="form-group keterangan" style="display:none;">
					<label for="exampleInputEmail1">Keterangan</label>
					<textarea placeholder="keterangan" class="form-control" name="keterangan"></textarea>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Tanggal</label>
					<input id="date_absensi" type="date" value="<?php echo $data['date']; ?>" class="form-control" name="date">
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
						<div class="form-group jam" style="display:none;">
							<label for="exampleInputEmail1">Jam Masuk (sekarang)</label>
							<input id="date_absensi" type="time" value="<?php echo date('h:i'); ?>" class="form-control" name="masuk">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group jam-rule" style="display:none;">
							<label for="exampleInputEmail1">Jam Masuk (seharusnya)</label>
							<input id="date_absensi" type="time" value="<?php echo date('h:i'); ?>" class="form-control" readonly>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
						<div class="form-group jam" style="display:none;">
							<label for="exampleInputEmail1">Jam Pulang (sekarang)</label>
							<input id="date_absensi" type="time" value="<?php echo date('h:i'); ?>" class="form-control" name="keluar">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group jam-rule" style="display:none;">
							<label for="exampleInputEmail1">Jam Pulang (sharusnya)</label>
							<input id="date_absensi" type="time" value="<?php echo date('h:i'); ?>" class="form-control" readonly>
						</div>
					</div>
				</div>



				<input type='submit' name='add_absensi' value='Edit Data' class='btn btn-primary'>
			</form>

			<!-- <form action="./konfig/add_pengguna.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Username</label>
					<input required class="form-control" type="text" name="username" placeholder="Masukan Username">

				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Password</label>
					<input required class="form-control" type="text" name="password" placeholder="Masukan Password">
				</div>

				<div class="form-group pt-2">
					<label for="exampleFormControlSelect1">Level</label>
					<select class="form-control" name="role">
						<option>Admin</option>
					</select>

				</div>

				<button type="submit" class="btn btn-outline-primary mt-3 float-right" value="simpan">Tambahkan</button>
			</form> -->

		</div>
	</div>
</section>

<!-- <script src="./vendor/js/jquery/2_2_1/jquery.min.js"></script> -->
<script src="~/assets/cube/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>

<script>
	// Date.prototype.toDateInputValue = (function() {
	// 	var local = new Date(this);
	// 	local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
	// 	return local.toJSON().slice(0, 10);
	// });

	// var dt = new Date().toDateInputValue()
	// $(document).ready(function() {
	// 	alert(dt)
	// 	$('#date_absensi').val(dt);
	// });​

	// $('#date').inputmask("h:s", {
	// 	"placeholder": "hh:mm"
	// });
</script>


<script>
	$(document).ready(function() {
		$('input[type=radio][name=status]').on('change', function() {
			statusPresensiFunc($(this).val())
		});


		$('#mySelect2').select2({
			ajax: {
				url: '/example/api',
				processResults: function(data) {
					// Transforms the top-level key of the response object from 'items' to 'results'
					return {
						results: data.items
					};
				}
			}
		});

		$("#karyawan").combogrid({
			debug: true,
			width: '600px',
			colModel: [{
				// 'align':'left',
				'columnName': 'kode',
				// 'hide':true,
				'width': '15',
				'label': 'KODE'
			}, {
				'align': 'left',
				'columnName': 'nama',
				'width': '85',
				'label': 'NAMA'
			}],
			url: './func/func_pegawai.php?karyawan_absensi',
			// url: '?aksi=autocomp',
			select: function(event, ui) {
				// $('#d_rekeningH').val(ui.item.replid);
				// $(this).val(ui.item.nama);

				alert('masuk select')
				// validasi input (tidak sesuai data dr server)
				$(this).on('keyup', function(e) {
					alert('masuk keyup')
					// var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
					// var keyCode = $.ui.keyCode;
					// if (key != keyCode.ENTER && key != keyCode.LEFT && key != keyCode.RIGHT && key != keyCode.UP && key != keyCode.DOWN) {
					// 	if ($('#d_rekeningH').val() != '') {
					// 		$('#d_rekeningH').val('');
					// 		$('#d_rekeningTB').val('');
					// 	}
					// }
				});
				return false;
			}
		});

	})

	function statusPresensiFunc(sel) {
		if (sel == 'hadir') {
			$('.jam').removeAttr('style')
			if ($('#karyawan').val() == '') {
				$('.keterangan').attr('style', 'display:none;')
				$('.jam-rule').attr('style', 'display:none;')
			} else {
				$('.keterangan').attr('style', 'display:none;')
				$('.jam-rule').removeAttr('style')
			}
		} else { // ijin , dll
			$('.keterangan').removeAttr('style')
			$('.jam').attr('style', 'display:none;')
			$('.jam-rule').attr('style', 'display:none;')
		}
	}

	function karyawanFunc(sel) {
		var tag = sel.options[sel.selectedIndex].value;
		var data = sel.options[sel.selectedIndex].text;
		// var nama = data.split(" - ")[0];
		var nip = data.split(" - ")[1];
		// console.log('nip',nip);

		if (tag == "") {
			// document.getElementById("jabatan").value = "";
			document.getElementById("tag").value = "";
			// document.getElementById("nama").value = "";
			document.getElementById("nip").value = "";
		} else {
			// document.getElementById("jabatan").value = tag ? tag : '';
			document.getElementById("tag").value = tag ? tag : '';
			// document.getElementById("nama").value = nama;
			document.getElementById("nip").value = nip ? nip : '';
		}

		// kosong | tidak skj 
		if ($('#karyawan').val() == '' || $('#karyawan').val() == '2') {
			$('.karyawan-info').attr('style', 'display:none')
			// if ($('input[type=radio][name=status]').val() == 'hadir') {
			$('.jam-rule').attr('style', 'display:none')
			// } else {
			// 	$('.jam-rule').removeAttr('style')
			// }
		} else {
			$('.karyawan-info').removeAttr('style')
			if ($('input[type=radio][name=status]').val() == 'hadir') {
				$('.jam-rule').removeAttr('style')
			} else {
				$('.jam-rule').attr('style', 'display:none')
			}
		}
	}

	function tipePresensiFunc(sel) {
		if (sel == '1') {
			$('.status-presensi').removeAttr('style')
			$('.jam-rule').removeAttr('style')
			statusPresensiFunc($('input[type=radio]').val())

		} else {
			$('.status-presensi').attr('style', 'display:none')
			$('.jam').attr('style', 'display:none;')
			$('.jam-rule').attr('style', 'display:none;')
		}
	}



	// function jamFunc(sel) {
	// 	if (sel == '1') {
	// 		$('.status-presensi').removeAttr('style')
	// 	} else {
	// 		$('.status-presensi').attr('style', 'display:none')
	// 	}
	// 	statusPresensiFunc($('input[type=radio]').val())
	// }
</script>