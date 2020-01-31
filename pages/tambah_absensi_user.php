<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
require_once './func/func_pegawai.php';
require_once './func/func_absensi.php';
// pr($_SESSION);
$karyawan = GetKaryawan2();
$tipe_presensi = GetTipePresensi2();
$ss = 'SELECT * FROM tb1_setting2 WHERE id_divisi = ' . $_SESSION['karyawan']['id_divisi'];
$ee = mysqli_query($dbconnect, $ss);
$rr = mysqli_fetch_assoc($ee);
$liburHariBesar = IsHoliday(date('Y-m-d'));
$liburWeekend = IsHoliday2(date('Y-m-d'), $_SESSION['karyawan']['id_divisi']);

if ($liburHariBesar == '1' || $liburWeekend == '1') {
	echo '<script>alert("Sekarang hari libur");window.location.replace("index.php?page=absensi")</script>';
} else {
	$jadwal = GetJadwalByDivisi($_SESSION['karyawan']['id_divisi']);
	// pr($jadwal);
	$rule_jam_masuk = $jadwal['mas_jam'] . ':' . $jadwal['mas_menit'];
	$rule_jam_keluar = $jadwal['kel_jam'] . ':' . $jadwal['kel_menit'];

	// batas absen
	// 'mas_bts_1' => $mas_bts_1,
	// 'mas_bts_2' => $mas_bts_2,
	// 'kel_bts_1' => $kel_bts_1,
	// 'kel_bts_2' => $kel_bts_2,

	$rule_batas_masuk = $jadwal['mas_bts_1'] . ':00 - ' . $jadwal['mas_bts_2'] . ':00';
	$rule_batas_keluar = $jadwal['kel_bts_1'] . ':00 - ' . $jadwal['kel_bts_2'] . ':00';

	// $valid = IsNotDuplicate([
	// 	'id_karyawan' => $_SESSION['id_karyawan'],
	// 	'id_tipe_presensi' => $id_tipe_presensi[0],
	// 	'tanggal' => $date,
	// ]);


	// $mode = $jadwal['mas_']
?>

	<div class="content-header ml-3 mr-3">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">TAMBAH ABSENSI MANUAL</h1>
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
						<select id="id_tipe_presensi" name="id_tipe_presensi" required onchange="tipePresensiFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
							<option value="">-Pilih Tipe Presensi-</option>
							<?php
							foreach ($tipe_presensi as $data) { ?>
								<option value="<?php echo $data['id'] . '-' . $data['kode_tipe_presensi']; ?>"><?php echo $data['nama_tipe_presensi']; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group mb-3">
						<label for="exampleInputEmail1">Nama</label>

						<input id="masuk_batas_1" type="hidden" value="<?php echo $jadwal['mas_bts_1'] . ':00'; ?>">
						<input id="masuk_batas_2" type="hidden" value="<?php echo $jadwal['mas_bts_2'] . ':00'; ?>">
						<input id="keluar_batas_1" type="hidden" value="<?php echo $jadwal['kel_bts_1'] . ':00'; ?>">
						<input id="keluar_batas_2" type="hidden" value="<?php echo $jadwal['kel_bts_2'] . ':00'; ?>">

						<input type="hidden" value="<?php echo $_SESSION['id_karyawan']; ?>" required id="id_karyawan" name="id_karyawan">
						<input disabled value="<?php echo $_SESSION['karyawan']['nama']; ?>" id="karyawan" name="karyawan" type="text" class="form-control" aria-describedby="basic-addon2">
					</div>

					<div class="row mb-2">
						<div class="col-md-4">

							<div class="form-group karyawan-info">
								<label for="kode_jabatan"> NIP:</label>
								<input value="<?php echo $_SESSION['karyawan']['nip']; ?>" type="text" class="form-control " id="nip" name='nip' placeholder='NIP' readonly>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group karyawan-info">
								<label for="kode_jabatan"> jabatan:</label>
								<input type="hidden" name="id_jabatan" id="id_jabatan">
								<input type="text" value="<?php echo $_SESSION['karyawan']['nama_jabatan']; ?>" class="form-control " id="jabatan" name='jabatan' placeholder='jabatan' readonly>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group karyawan-info">
								<label for="kode_jabatan"> divisi:</label>
								<input type="hidden" value="<?php echo $_SESSION['karyawan']['id_divisi']; ?>" name="id_divisi" id="id_divisi">
								<input type="text" class="form-control " id="divisi" value="<?php echo $_SESSION['karyawan']['nama_divisi']; ?>" name='divisi' placeholder='divisi' readonly>
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
						<input required readonly id="date" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date">
					</div>


					<br>
					<div class="row mb-2 group-presensi-harian" style="display:none">
						<div class="col-md-3">
							<h4 class="">Rule</h4>
						</div>
					</div>

					<div class="row mb-2 group-presensi-harian" style="display:none">
						<div class="col-md-3">
							<div class="form-group jam">
								<label for="exampleInputEmail1">Jam Masuk</label>
								<input placeholder="HH:MM" readonly value="<?php echo $rule_jam_masuk; ?>" name="rule_jam_masuk" id="rule_jam_masuk" class="form-control input-jam" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Batas Absen Masuk</label>
								<input value="<?php echo $rule_batas_masuk; ?>" type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group jam">
								<label for="exampleInputEmail1">Jam Pulang</label>
								<input placeholder="HH:MM" readonly value="<?php echo $rule_jam_keluar; ?>" name="keluar" class="form-control input-jam" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Batas Absen Pulang</label>
								<input value="<?php echo $rule_batas_keluar; ?>" type="text" class="form-control" readonly>
							</div>
						</div>

					</div>

					<br>
					<div class="row mb-2 group-presensi-harian" style="display:none">
						<div class="col-md-3">
							<h4 id="label_mode">Now</h4>
						</div>
					</div>

					<div class="row mb-2 group-presensi-harian" style="display:none">
						<div class="col-md-3">
							<div class="form-group jam">
								<label for="exampleInputEmail1">Jam Sekarang</label>
								<input placeholder="HH:MM" readonly id="jam_now" name="jam_now" class="form-control input-jam" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Mode</label>
								<input readonly type="hidden" id="kode_mode_absen" name="kode_mode_absen" class="form-control " />
								<input readonly id="mode_absen" class="form-control " />
							</div>
						</div>
					</div>


					<div class="row mb-2 group-presensi-harian" style="display:none">
						<div id="status" class="col-md-6">
							<!-- status keterlambatan  -->
						</div>
					</div>

					<div class="row"><br />
						<div class="col-md-12">

							<!-- <hr />
							<div class="progress">
								<div class="one warning-color"></div>
								<div class="two warning-color"></div>
								<div class="three warning-color"></div>
								<div class="four warning-color"></div>
								<div class="progress-bar progress-bar-warning bg-warning" style="width: 75%"> lbh 5 menit</div>
							</div>
							<hr /> -->

						</div>
					</div>

					<input type='submit' name='add_absensi' id='add_absensi' value='Simpan Data' class='btn btn-primary'>
				</form>

			</div>
		</div>
	</section>

	<script src="vendor/js/jquery/jquery-3.4.1.min.js"></script>
	<script src="vendor/js/jquery/jquery-migrate-3.0.0.min.js"></script>
	<script src="vendor/js/inputmask/jquery.inputmask.js"></script>

	<script>
		$(document).ready(function() {
			startTime();

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
				console.log(res)
				if (res.value) {
					$.ajax({
						url: './konfig/add_absensi.php',
						data: 'add_absensi_user&ajax&' + $(el).serialize(),
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
					// $('.jam').removeAttr('style')
					$('.input-jam').attr('required', true)
					$('.keterangan').attr('style', 'display:none;')
				} else {
					$('.keterangan').removeAttr('style')
					$('.input-jam').removeAttr('required')
					// $('.jam-rule').attr('style', 'display:none;')
					// $('.jam').attr('style', 'display:none')
				}
			} else { // ijin , dll
				if (sel == 'H') {
					$('.keterangan').attr('style', 'display:none;')
				} else {
					$('.keterangan').removeAttr('style')
				}
				// $('.jam').attr('style', 'display:none;')
				$('.input-jam').removeAttr('required')
				// $('.jam-rule').attr('style', 'display:none;')
			}
		}

		function karyawanFunc(sel) {
			console.log('kary', sel)

			// set : karyawan detail 
			if (sel == '') {
				$('#nama').val()
			}

			// kosong | tidak skj 
			if ($('#karyawan').val() == '' || $('#karyawan').val() == '2') {
				$('.karyawan-info').attr('style', 'display:none')
				// if ($('input[type=radio][name=status]').val() == 'hadir') {
				// $('.jam-rule').attr('style', 'display:none')
				// } else {
				// 	$('.jam-rule').removeAttr('style')
				// }
			} else {
				$('.karyawan-info').removeAttr('style')
				// if ($('input[type=radio][name=status]').val() == 'hadir') {
				// 	$('.jam-rule').removeAttr('style')
				// } else {
				// 	$('.jam-rule').attr('style', 'display:none')
				// }
			}
		}

		function tipePresensiFunc(sel) {
			$('input[type=radio]').prop('checked', false);
			let selx = sel.split('-')
			let kode = selx[1]
			console.log('tipe', kode)

			resetInput('masuk')
			resetInput('keluar')

			if (kode == 'harian' || kode == "diklat") {
				$('#hadir').removeAttr('disabled')
				$('#ijin, #dinas, #alpha').attr('disabled', true)

				if (kode == 'harian') {
					let today = getCurrentDate()
					// console.log(today)
					$('#date').val(today).attr('readonly', true)
					$('.group-presensi-harian').removeAttr('style')

				} else {
					$('#date').removeAttr('readonly')
					$('.group-presensi-harian').attr('style', 'display:none')
				}

			} else if (kode == 'skj' || kode == 'dispensasi') {
				$('#ijin, #dinas, #alpha').removeAttr('disabled')
				$('#hadir').attr('disabled', true)
				$('#date').removeAttr('readonly')
				// $('.jam-rule').attr('style', 'display:none;')
				// $('.jam').attr('style', 'display:none;')
				// } else if (kode == 'skj' || kode == '' || kode == undefined) { // tidak ikut skj
				// statusPresensiFunc($('input[type=radio]').val())
				$('.group-presensi-harian').attr('style', 'display:none')
			} else { // 
				$('#ijin, #dinas, #alpha').removeAttr('disabled')
				$('#date').removeAttr('readonly')
				$('#hadir').removeAttr('disabled')
				// $('.jam-rule').attr('style', 'display:none;')
				// $('.jam').attr('style', 'display:none;')
				// $('.status-presensi').removeAttr('style')
				// $('.status-presensi #hadir').removeAttr('disabled')
				// statusPresensiFunc($('input[type=radio]').val())
				$('.group-presensi-harian').attr('style', 'display:none')
			}
		}

		Inputmask("datetime", {
			inputFormat: "HH:MM",
			max: 24,
			hourFormat: 24,
		}).mask("input.input-jam");

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}

		function getCurrentDate() {
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();

			today = yyyy + '-' + mm + '-' + dd;
			return today
		}

		function startTime() {
			let currTime = currentTime()
			$('#jam_now').val(currTime);

			t = setTimeout(function() {
				startTime()
			}, 500);

			let mode = getMode()
			enableSubmit(mode)
			setStatus(mode)
		}

		function setStatus(mode) {
			let ret = getStatus(mode)
			let menit = ret.menit
			let status = ret.status + ' ' + (Math.abs(menit) == '0' ? '' : Math.abs(menit) + ' menit')
			let clr = menit < 0 ? 'danger' : ($('#kode_mode_absen').val() == 'off' ? 'secondary' : 'success')
			console.log(menit)

			let statusTxt = '<span id="status" class="badge badge-' + clr + '">' +
				'<i class="fas fa-check"></i> ' +
				' ' + status +
				'</span>';
			$('#status').html(statusTxt)
		}

		function getStatus(mode) {
			let currTime = currentTime()
			let min = 0;

			if (mode != 'off') {
				let modeTime = ''
				if (mode == 'masuk') {
					modeTime = $('#rule_jam_masuk').val()
				} else {
					modeTime = $('#rule_jam_keluar').val()
				}
				let diffTime = getDiffTime(modeTime, currTime)
				min = diffTime

				if (diffTime < 0) {
					sts = 'Terlambat '
				} else if (diffTime > 0) {
					sts = 'Datang lebih awal '
				} else {
					sts = 'Tepat Waktu'
				}
			} else {
				sts = "Di luar jam kantor"
			}

			return {
				menit: min,
				status: sts,
			}
		}

		function enableSubmit(mode) {
			let tipe = $('#id_tipe_presensi').val()
			tipe = tipe.split('-')

			if (mode == 'off' && tipe[1] == 'harian') {
				$('#add_absensi').attr('disabled', true).removeClass('btn-primary')
			} else {
				$('#add_absensi').removeAttr('disabled').addClass('btn-primary')
			}
		}

		function getDiffTime(t1, t2) {
			let t1parts = t1.split(':');
			let t1cm = Number(t1parts[0]) * 60 + Number(t1parts[1]);

			let t2parts = t2.split(':');
			let t2cm = Number(t2parts[0]) * 60 + Number(t2parts[1]);

			let ret = t1cm - t2cm;
			// let hour = Math.floor((t1cm - t2cm) / 60);
			// let min = Math.floor((t1cm - t2cm) % 60);
			// return (hour + ':' + min + ':00');
			return ret
		}

		function getMode() {
			let masuk_batas_1 = $('#masuk_batas_1').val()
			let masuk_batas_2 = $('#masuk_batas_2').val()
			let keluar_batas_1 = $('#keluar_batas_1').val()
			let keluar_batas_2 = $('#keluar_batas_2').val()

			let mode = ''
			if (currentTime() >= masuk_batas_1 && currentTime() <= masuk_batas_2) {
				mode = 'masuk'
			} else if (currentTime() >= keluar_batas_1 && currentTime() <= keluar_batas_2) {
				mode = 'pulang'
			} else {
				mode = 'off'
			}

			$('#kode_mode_absen').val(mode)
			$('#mode_absen').val('Absen ' + mode)
			return mode
		}

		function currentTime() {
			var d = new Date(),
				h = (d.getHours() < 10 ? '0' : '') + d.getHours(),
				m = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();
			return h + ':' + m;
		}
	</script>
<?php } ?>

<style>
	.one,
	.two,
	.three {
		position: absolute;
		margin-top: -10px;
		z-index: 1;
		height: 40px;
		width: 40px;
		border-radius: 25px;

	}

	.one {
		left: 25%;
	}

	.two {
		left: 50%;
	}

	.three {
		left: 75%;
	}

	.primary-color {
		background-color: #4989bd;
	}

	.success-color {
		background-color: #5cb85c;
	}

	.danger-color {
		background-color: #d9534f;
	}

	.warning-color {
		background-color: #f0ad4e;
	}

	.info-color {
		background-color: #5bc0de;
	}

	.no-color {
		background-color: inherit;
	}
</style>