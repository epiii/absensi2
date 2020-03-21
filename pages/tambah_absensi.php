<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
require_once './func/func_pegawai.php';
require_once './func/func_absensi.php';
$tipe_presensi = GetTipePresensi2();
?>

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
			<!-- <button onclick="onsubmitFormx();">o</button> -->

			<form onsubmit="onsubmitForm(this);return false;" action="./konfig/add_absensi.php" method="POST">

				<div class="form-group">
					<label for="exampleInputEmail1">Tipe Presensi</label>
					<input type="hidden" name="add_absensi">
					<select id="id_tipe_presensi" name="id_tipe_presensi" required onchange="tipePresensiFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
						<option value="">-Pilih Tipe Presensi-</option>
						<?php
						foreach ($tipe_presensi as $data) { ?>
							<option value="<?php echo $data['id'] . '-' . $data['kode_tipe_presensi']; ?>"><?php echo $data['nama_tipe_presensi']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group mb-3">
					<label for="exampleInputEmail1">Karyawan</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">search</span>
						</div>
						<input type="hidden" required id="id_karyawan" name="id_karyawan">
						<input required onkeyup="onkeyupKaryawan(this.value)" id="karyawan" name="karyawan" type="text" class="form-control" placeholder="ketik nama atau nip karyawan ..." aria-label="ketik nama atau nip karyawan ..." aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button id="resetKaryawanBtn" class="btn btn-secondary" onclick="resetKaryawan()" type="button">x</button>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-4">

						<div class="form-group karyawan-info">
							<label for="kode_jabatan"> NIP:</label>
							<input type="text" class="form-control " id="nip" name='nip' placeholder='NIP' readonly>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group karyawan-info">
							<label for="kode_jabatan"> jabatan:</label>
							<input type="hidden" name="id_jabatan" id="id_jabatan">
							<input type="text" class="form-control " id="jabatan" name='jabatan' placeholder='jabatan' readonly>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group karyawan-info">
							<label for="kode_jabatan"> divisi:</label>
							<input type="hidden" name="id_divisi" id="id_divisi">
							<input type="text" class="form-control " id="divisi" name='divisi' placeholder='divisi' readonly>
						</div>
					</div>
				</div>

				<label for="kode_jabatan">Status</label>
				<div class="status-presensi">
					<div class="form-check-inline">
						<input required class="form-check-input" type="radio" name="status" id="hadir" value="H">
						<label class="form-check-label" for="hadir">
							Hadir
						</label>
					</div>
					<div class="form-check-inline">
						<input required class="form-check-input" type="radio" name="status" id="ijin" value="I">
						<label class="form-check-label" for="ijin">
							Ijin
						</label>
					</div>
					<div class="form-check-inline">
						<input required class="form-check-input" type="radio" name="status" id="dinas" value="D">
						<label class="form-check-label" for="dinas">
							Dinas Luar
						</label>
					</div>
					<div class="form-check-inline">
						<input required class="form-check-input" type="radio" name="status" id="alpha" value="A">
						<label class="form-check-label" for="alpha">
							Alpha
						</label>
					</div>
				</div><br>

				<div class="form-group keterangan" style="display:none;">
					<label for="exampleInputEmail1">Keterangan</label>
					<textarea placeholder="keterangan" class="form-control" name="keterangan"></textarea>
				</div>

				<div class="form-group">
					<label for="exampleInputEmail1">Tanggal</label>
					<input required id="date" type="date" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date">
				</div>


				<div class="row mb-2">
					<div class="col-md-6">

						<div class="form-group jam" style="display:none;">
							<label for="exampleInputEmail1">Jam Masuk (real)</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<button id="resetKaryawanBtn" class="btn btn-success" onclick="setNow('masuk')" type="button">now</button>
								</div>
								<input placeholder="HH:MM" id="masuk" name="masuk" class="form-control input-jam" />
								<div class="input-group-append">
									<button id="resetKaryawanBtn" class="btn btn-danger" onclick="resetInput('masuk')" type="button">x</button>
								</div>
							</div>

						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group jam-rule" style="display:none;">
							<label for="exampleInputEmail1">Jam Masuk (rule)</label>
							<input id="masuk_rule" type="text" class="form-control" readonly>
							<!-- <input id="masuk_rule" type="time" value="<?php echo date('h:i'); ?>" class="form-control" readonly> -->
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-6">
						<div class="form-group jam" style="display:none;">
							<label for="exampleInputEmail1">Jam Pulang (real)</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<button id="resetKaryawanBtn" class="btn btn-success" onclick="setNow('keluar')" type="button">now</button>
								</div>
								<input placeholder="HH:MM" id="keluar" name="keluar" class="form-control input-jam" />
								<div class="input-group-append">
									<button id="resetKaryawanBtn" class="btn btn-danger" onclick="resetInput('keluar')" type="button">x</button>
								</div>
							</div>

						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group jam-rule" style="display:none;">
							<label for="exampleInputEmail1">Jam Pulang (rule)</label>
							<input id="keluar_rule" type="text" class="form-control" readonly>
						</div>
					</div>
				</div>

				<input type='submit' name='add_absensi' value='Simpan Data' class='btn btn-primary'>
			</form>

		</div>
	</div>
</section>


<!-- <script src="vendor/js/jquery/jquery.min.js"></script> -->
<!-- <script src="vendor/js/combogrid/jquery-1.9.1.min.js"></script> -->
<script src="vendor/js/jquery/jquery-3.4.1.min.js"></script>
<script src="vendor/js/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="vendor/js/inputmask/jquery.inputmask.js"></script>

<!-- <script src="vendor/js/combogrid/jquery-ui-1.10.1.custom.min.js"></script>
<script src="vendor/js/combogrid/jquery.ui.combogrid-1.6.3.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery-ui-1.10.1.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery.ui.combogrid.css" /> -->

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
			url: './func/func_absensi.php?karyawan_absensi&ajax',
			// url: './func/func_absensi.php?karyawan_absensi=&tanggal='+$('#date').val(),
			select: function(event, ui) {
				resetInput('masuk')
				resetInput('keluar')

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
				// $('#' + el.elemFrom).on('keyup', function(e) {
				// 	var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
				// 	console.log('has selected', key);
				// 	var keyCode = $.ui.keyCode;
				// 	if (key != keyCode.ENTER && key != keyCode.LEFT && key != keyCode.RIGHT && key != keyCode.UP && key != keyCode.DOWN) {
				// 		if ($('#' + el.elemFrom).val() != '') {
				// 			$('#' + el.elemFrom).val('')
				// 		}
				// 	}
				// });
				return false;
			}
		});

	})

	function resetInput(el) {
		$('#' + el).val('').focus()
	}

	function setNow(el) {
		let d = new Date();
		let h = d.getHours();
		let m = d.getMinutes();
		$('#' + el).val((h < 10 ? '0' + h : h) + ':' + (m < 10 ? '0' + m : m))
	}

	function convertTime12to24(time12h) {
		const [time, modifier] = time12h.split(' ');
		let [hours, minutes] = time.split(':');
		if (hours === '12') {
			hours = '00';
		}
		if (modifier === 'PM') {
			hours = parseInt(hours, 10) + 12;
		}
		return `${hours}:${minutes}`;
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
			console.log('swal value', res)
			if (res.value) {
				let jamMasuk = $('#masuk').val()
				let jamKeluar = $('#keluar').val()
				let tipeP = $('#id_tipe_presensi').val()
				let tp = tipeP.split('-')
				// console.log(jamMasuk, jamKeluar, tp[1])
				// return false
				let statusx = $('input[type=radio][name=status]:checked').val()
				console.log('status khdiran', statusx)
				// return false

				if (
					tp[1] == 'harian' &&
					statusx == 'H' &&
					(jamMasuk == '' && jamKeluar == '')
				) {
					swal({
						title: 'Failed',
						text: 'JAM MASUK atau JAM PULANG, silakan diisi, minimal salah satu',
						type: 'error',
						confirmButtonColor: 'btn btn-danger',
						confirmButtonText: 'ok',
					})
				} else {
					$.ajax({
						url: './konfig/add_absensi.php',
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
			}
		});
		return false;
	}

	function onkeyupKaryawan(x) {
		if (x != '')
			$('#resetKaryawanBtn').addClass('btn-danger')
		else
			$('#resetKaryawanBtn').removeClass('btn-danger')
	}

	function resetKaryawan() {
		resetInput('karyawan')
		$('#karyawan').removeAttr('readonly')
		$('#resetKaryawanBtn').removeClass('btn-danger')
		$('.karyawan-info>input').val('')
		$('#id_karyawan').val('')
		$('#masuk_rule').val('')
		$('#keluar_rule').val('')
	}

	function statusPresensiFunc(sel) {

		let el = $('#id_tipe_presensi').val()
		let tipex = el.split('-')
		let tp = tipex[1]
		console.log('status-=', sel);
		console.log('tipe=', tp);

		resetInput('masuk')
		resetInput('keluar')

		if (tp == 'harian') { // presensi harian
			if (sel == 'H') {
				$('.jam').removeAttr('style')
				// $('.input-jam').attr('required', true)
				$('.keterangan').attr('style', 'display:none;')
			} else {
				$('.keterangan').removeAttr('style')
				// $('.input-jam').removeAttr('required')
				$('.jam-rule').attr('style', 'display:none;')
				$('.jam').attr('style', 'display:none')
			}
		} else { // ijin , dll
			if (sel == 'H') {
				$('.keterangan').attr('style', 'display:none;')
			} else {
				$('.keterangan').removeAttr('style')
			}
			$('.jam').attr('style', 'display:none;')
			// $('.input-jam').removeAttr('required')
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
		console.log('tipe', kode)

		resetInput('masuk')
		resetInput('keluar')

		if (kode == 'harian') {
			$('#hadir').removeAttr('disabled')
			$('.jam').removeAttr('style')
			$('.jam-rule').removeAttr('style')
			// $('.status-presensi').removeAttr('style')
		} else if (kode == 'skj' || kode == 'dispensasi') {
			$('#hadir').attr('disabled', true)
			$('.jam-rule').attr('style', 'display:none;')
			$('.jam').attr('style', 'display:none;')
			// } else if (kode == 'skj' || kode == '' || kode == undefined) { // tidak ikut skj
			// statusPresensiFunc($('input[type=radio]').val())
		} else { // 
			$('#hadir').removeAttr('disabled')
			$('.jam-rule').attr('style', 'display:none;')
			$('.jam').attr('style', 'display:none;')
			// $('.status-presensi').removeAttr('style')
			// $('.status-presensi #hadir').removeAttr('disabled')
			// statusPresensiFunc($('input[type=radio]').val())
		}
	}

	// $('input#masuk').inputmask(
	// 	"hh:mm", {
	// 		placeholder: "HH:MM",
	// 		// insertMode: false,
	// 		showMaskOnHover: false,
	// 		hourFormat: 12
	// 	}
	// );

	Inputmask("datetime", {
		inputFormat: "HH:MM",
		max: 24,
		hourFormat: 24,
	}).mask("input.input-jam");

	// Inputmask("datetime", {
	// 	inputFormat: "HH:MM",
	// 	max: 24,
	// 	hourFormat: 24,
	// }).mask("input");

	// function jamFunc(sel) {
	// 	if (sel == '1') {
	// 		$('.status-presensi').removeAttr('style')
	// 	} else {
	// 		$('.status-presensi').attr('style', 'display:none')
	// 	}
	// 	statusPresensiFunc($('input[type=radio]').val())
	// }
</script>