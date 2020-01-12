<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
require_once './func/func_pegawai.php';
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
$tipe_presensi = GetTipePresensi2();
// pr($karyawan);
// $provinsi = GetProvinsi2();

?>

<script src="vendor/js/jquery/jquery.min.js"></script>
<script src="vendor/js/inputmask/jquery.inputmask.js"></script>

<!-- <script src="vendor/js/combogrid/jquery-ui-1.10.1.custom.min.js"></script>
<script src="vendor/js/combogrid/jquery.ui.combogrid-1.6.3.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery-ui-1.10.1.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery.ui.combogrid.css" />
 -->
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
				'align': 'left',
				'columnName': 'id',
				'hide': true,
				'width': '15',
				'label': 'ID'
			}, {
				'align': 'left',
				'columnName': 'nip',
				'hide': true,
				'width': '15',
				'label': 'NIP'
			}, {
				'align': 'left',
				'columnName': 'nama',
				'width': '85',
				'label': 'NAMA'
			}],
			// url: './func/func_absensi.php?karyawan_absensi',
			// url: './func/func_absensi.php?karyawan_absensi&tanggal=' + $('#date').val(),
			url: './func/func_absensi.php?karyawan_absensi',
			// url: '?aksi=autocomp',
			select: function(event, ui) {
				// $('#d_rekeningH').val(ui.item.replid);
				// $(this).val(ui.item.nama);

				// alert('masuk select')
				// validasi input (tidak sesuai data dr server)
				// $(this).on('keyup', function(e) {
					alert('masuk keyup')
					// var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
					// var keyCode = $.ui.keyCode;
					// if (key != keyCode.ENTER && key != keyCode.LEFT && key != keyCode.RIGHT && key != keyCode.UP && key != keyCode.DOWN) {
					// 	if ($('#d_rekeningH').val() != '') {
					// 		$('#d_rekeningH').val('');
					// 		$('#d_rekeningTB').val('');
					// 	}
					// }
				// });
				return false;
			}
		});

	})

	// function combogridFunc() {

	// 	$("#karyawan").combogrid({
	// 		debug: true,
	// 		width: '600px',
	// 		colModel: [{
	// 			'align': 'left',
	// 			'columnName': 'kode',
	// 			'hide': true,
	// 			'width': '15',
	// 			'label': 'KODE'
	// 		}, {
	// 			'align': 'left',
	// 			'columnName': 'nama',
	// 			'width': '85',
	// 			'label': 'NAMA'
	// 		}],
	// 		url: './func/func_pegawai.php?karyawan_absensi',
	// 		// url: '?aksi=autocomp',
	// 		select: function(event, ui) {
	// 			// $('#d_rekeningH').val(ui.item.replid);
	// 			// $(this).val(ui.item.nama);

	// 			alert('masuk select')
	// 			// validasi input (tidak sesuai data dr server)
	// 			$(this).on('keyup', function(e) {
	// 				alert('masuk keyup')
	// 				// var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
	// 				// var keyCode = $.ui.keyCode;
	// 				// if (key != keyCode.ENTER && key != keyCode.LEFT && key != keyCode.RIGHT && key != keyCode.UP && key != keyCode.DOWN) {
	// 				// 	if ($('#d_rekeningH').val() != '') {
	// 				// 		$('#d_rekeningH').val('');
	// 				// 		$('#d_rekeningTB').val('');
	// 				// 	}
	// 				// }
	// 			});
	// 			return false;
	// 		}
	// 	});
	// }

	function statusPresensiFunc(sel) {
		console.log('status pres', sel);
		if (sel == 'H') {
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
		console.log('kary', sel)
		// var tag = sel.options[sel.selectedIndex].value;
		// var data = sel.options[sel.selectedIndex].text;
		// // var nama = data.split(" - ")[0];
		// var nip = data.split(" - ")[1];
		// // console.log('nip',nip);

		// if (tag == "") {
		// 	// document.getElementById("jabatan").value = "";
		// 	document.getElementById("tag").value = "";
		// 	// document.getElementById("nama").value = "";
		// 	document.getElementById("nip").value = "";
		// } else {
		// 	// document.getElementById("jabatan").value = tag ? tag : '';
		// 	document.getElementById("tag").value = tag ? tag : '';
		// 	// document.getElementById("nama").value = nama;
		// 	document.getElementById("nip").value = nip ? nip : '';
		// }

		// set : karyawan detail 
		if (sel == '') {
			$('#nama').val()
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
		$('input[type=radio]').prop('checked', false);
		let selx = sel.split('-')
		let kode = selx[1]

		if (kode == 'skj') { // tidak ikut skj
			$('#hadir').attr('disabled', true)
			$('.jam-rule').attr('style', 'display:none;')
			$('.jam').attr('style', 'display:none;')
			// statusPresensiFunc($('input[type=radio]').val())
		} else { // 
			$('#hadir').removeAttr('disabled')
			$('.status-presensi #hadir').removeAttr('disabled')
			$('.status-presensi').removeAttr('style')
			$('.jam-rule').removeAttr('style')
			statusPresensiFunc($('input[type=radio]').val())
		}
	}

	$('input#masuk').inputmask(
		"hh:mm", {
			placeholder: "HH:MM",
			// insertMode: false,
			showMaskOnHover: false,
			hourFormat: 12
		}
	);

	Inputmask("datetime", {
		inputFormat: "HH:MM",
		max: 24,
		hourFormat: 24,
	}).mask("input");

	// function jamFunc(sel) {
	// 	if (sel == '1') {
	// 		$('.status-presensi').removeAttr('style')
	// 	} else {
	// 		$('.status-presensi').attr('style', 'display:none')
	// 	}
	// 	statusPresensiFunc($('input[type=radio]').val())
	// }
</script>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">TAMBAH ABSENSI (MANUAL)</h1>
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

				<!-- <div class="form-group">
					<label for="exampleInputEmail1">Tipe Presensi</label>
					<select required onchange="tipePresensiFunc(this.value)" class="form-control input-large" data-placeholder="Choose a Category" tabindex="1">
						<option value="">-Pilih Tipe Presensi-</option>
						<option value="1">Harian</option>
						<option value="2">SKJ</option>
						<option value="3">Diklat</option>
						<option value="4">Dispensasi</option>
					</select>
				</div> -->

				<div class="form-group">
					<label for="exampleInputEmail1">Tipe Presensi</label>
					<select id="id_tipe_presensi" name="id_tipe_presensi" required onchange="tipePresensiFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
						<option value="">-Pilih Tipe Presensi-</option>
						<?php
						foreach ($tipe_presensi as $data) { ?>
							<option value="<?php echo $data['id'] . '-' . $data['kode_tipe_presensi']; ?>"><?php echo $data['nama_tipe_presensi']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Karyawan</label>
					<input type="text" class="form-control input-medium" id="karyawan" name='karyawan' placeholder='karyawan'>
					<!-- <input type="text" onclick="combogridFunc();" class="form-control input-medium" id="karyawan" name='karyawan' placeholder='karyawan'> -->
					<!-- <select id="karyawan" name="karyawan" required onchange="karyawanFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
						<option value="">-Pilih Karyawan-</option>
						<?php
						foreach ($karyawan as $data) { ?>
							<option value="<?php echo $data['id']; ?>"><?php echo $data['nama'] . " - <b>" . $data['nip'] . "</b>"; ?></option>
						<?php } ?>
					</select> -->
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

				<div class="form-group status-presensi">
					<!-- <div class="form-group status-presensi" style="display:none;"> -->
					<div class="radio-list">
						<label class="radio-inline">
							<input required type="radio" name="status" id="hadir" value="H"> Hadir </label>
						<label class="radio-inline">
							<input required type="radio" name="status" id="ijin" value="I"> Ijin </label>
						<label class="radio-inline">
							<input required type="radio" name="status" id="dinas" value="D"> Dinas Luar </label>
						<label class="radio-inline">
							<input required type="radio" name="status" id="alpha" value="A"> Alpha </label>
					</div>
				</div>

				<div class="form-group keterangan" style="display:none;">
					<label for="exampleInputEmail1">Keterangan</label>
					<textarea placeholder="keterangan" class="form-control" name="keterangan"></textarea>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Tanggal</label>
					<input id="date" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date">
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
						<div class="form-group jam" style="display:none;">
							<label for="exampleInputEmail1">Jam Masuk (sekarang)</label>
							<input placeholder="HH:MM" id="masuk" name="masuk" class="form-control datetime" />
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
							<input placeholder="HH:MM" id="keluar" name="keluar" class="form-control datetime" />
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group jam-rule" style="display:none;">
							<label for="exampleInputEmail1">Jam Pulang (sharusnya)</label>
							<input id="date_absensi" type="time" value="<?php echo date('h:i'); ?>" class="form-control" readonly>
						</div>
					</div>
				</div>

				<input type='submit' name='add_absensi' value='Simpan Data' class='btn btn-primary'>
			</form>

		</div>
	</div>
</section>