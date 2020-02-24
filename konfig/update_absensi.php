<?php

require_once '../konfig/dev.php';
require_once '../konfig/connection.php';
require_once '../konfig/function.php';
// require_once '../func/func_absensi.php';
function IsNotDuplicate($par)
{
	global $dbconnect;
	$sql = 'SELECT * 
				FROM tb_absen
				WHERE
					id_karyawan = ' . $par['id_karyawan'] . '
					AND id_tipe_presensi = ' . $par['id_tipe_presensi'] . '
					AND date ="' . $par['tanggal'] . '"';
	// vd($sql);
	$exe = mysqli_query($dbconnect, $sql);
	$num = mysqli_num_rows($exe);
	// pr($num);
	return $num > 0 ? false : true;
}

function GetTimeDiff($a, $b)
{
	$x = (strtotime($a) - strtotime($b)) / 60;
	// vd($x / 60);
	return $x;
}

function GetKeterlambatan($par)
{
	global $dbconnect;
	$sql = 'SELECT *
		FROM tb1_setting2
		WHERE id_divisi =' . $par['id_divisi'] . ' AND isActive ="1"';
	$exe = mysqli_query($dbconnect, $sql);
	// pr($par);
	$r = [];
	while ($row = mysqli_fetch_assoc($exe)) {
		if ($row['no'] == '1') {
			// masuk 
			$mas_jam = $row['jam'];
			$mas_menit = $row['menit'];

			// telat 
			$mas_tel_1a = $row['telat1a'];
			$mas_tel_1b = $row['telat1b'];
			$mas_tel_2a = $row['telat2a'];
			$mas_tel_2b = $row['telat2b'];
			$mas_tel_3a = $row['telat3a'];
			$mas_tel_3b = $row['telat3b'];

			// potongan %
			$mas_per_1 = $row['persen1'];
			$mas_per_2 = $row['persen2'];
			$mas_per_3 = $row['persen3'];
			$mas_per_4 = $row['persen4'];
		} else {
			// keluar 
			$kel_jam = $row['jam'];
			$kel_menit = $row['menit'];

			// telat 
			$kel_tel_1a = $row['telat1a'];
			$kel_tel_1b = $row['telat1b'];
			$kel_tel_2a = $row['telat2a'];
			$kel_tel_2b = $row['telat2b'];
			$kel_tel_3a = $row['telat3a'];
			$kel_tel_3b = $row['telat3b'];

			// potongan %
			$kel_per_1 = $row['persen1'];
			$kel_per_2 = $row['persen2'];
			$kel_per_3 = $row['persen3'];
			$kel_per_4 = $row['persen4'];
		}
		// $r[] = $row;
	}

	// masuk 
	$mas_jam_real = $par['masuk'];
	$mas_jam_rule = $mas_jam . ':' . $mas_menit;
	$mas_selisih = GetTimeDiff($mas_jam_real, $mas_jam_rule);
	$mas_pot_per = 0;
	$mas_kat = 0;
	$kel_kat = 0;

	// print_r($mas_jam_real);
	// print_r($mas_jam_rule);
	if ($mas_jam_real > $mas_jam_rule) {
		// print_r($mas_selisih <= $mas_tel_1b);
		if ($mas_selisih >= $mas_tel_1a && $mas_selisih <= $mas_tel_1b) {
			$mas_pot_per = $mas_per_1;
			$mas_kat = '1';
			// vd('1');
		} elseif ($mas_selisih >= $mas_tel_2a && $mas_selisih <= $mas_tel_2b) {
			$mas_pot_per = $mas_per_2;
			$mas_kat = '2';
			// vd('2');
		} elseif ($mas_selisih >= $mas_tel_3a && $mas_selisih <= $mas_tel_3b) {
			$mas_pot_per = $mas_per_3;
			$mas_kat = '3';
			// vd('3');
		} elseif ($mas_selisih > $mas_tel_3b) {
			$mas_pot_per = $mas_per_4;
			$mas_kat = '4';
			// vd('4');
		}
	}

	// keluar 
	$kel_jam_real = $par['keluar'];
	$kel_jam_rule = $kel_jam . ':' . $kel_menit;
	$kel_selisih = GetTimeDiff($kel_jam_rule, $kel_jam_real);
	$kel_pot_per = 0;

	// vd($kel_jam_rule);
	// var_dump($kel_jam_real, $kel_jam_rule);
	if ($kel_jam_real < $kel_jam_rule) {
		// vd('$kel_selisih');
		if ($kel_selisih >= $kel_tel_1a && $kel_selisih <= $kel_tel_1b) {
			$kel_pot_per = $kel_per_1;
			$kel_kat = '1';
		} elseif ($kel_selisih >= $kel_tel_2a && $kel_selisih <= $kel_tel_2b) {
			$kel_pot_per = $kel_per_2;
			$kel_kat = '2';
		} elseif ($kel_selisih >= $kel_tel_3a && $kel_selisih <= $kel_tel_3b) {
			$kel_pot_per = $kel_per_3;
			$kel_kat = '3';
			// vd('3');
		} else {
			$kel_pot_per = $kel_per_4;
			$kel_kat = '4';
		}
	}

	$terlambat_masuk = $mas_selisih < 0 || $par['masuk'] == '' ? 0 : $mas_selisih;
	$terlambat_keluar = $kel_selisih < 0 || $par['keluar'] == '' ? 0 : $kel_selisih;

	$ret = [
		'kat_terlambat_masuk' => $par['masuk'] == '' ? '0' : $mas_kat,
		'kat_terlambat_keluar' => $par['keluar'] == '' ? '0' : $kel_kat,
		// 'kat_terlambat_keluar' => $kel_kat,

		'potongan_masuk' =>  $mas_pot_per,
		'potongan_keluar' =>  $kel_pot_per,
		'potongan_total' =>  $mas_pot_per + $kel_pot_per,

		'terlambat_masuk' =>  $terlambat_masuk,
		'terlambat_keluar' =>  $terlambat_keluar,
		'terlambat_total' => $terlambat_masuk + $terlambat_keluar,
	];
	// vd($ret);
	return $ret;
}


if (isset($_POST['edit_absensi'])) {
	$id_tipe_presensi = $_POST['id_tipe_presensi'];
	$id_tipe_presensi = explode('-', $id_tipe_presensi);

	$id = $_POST['id'];
	$id_divisi = $_POST['id_divisi'];
	$id_karyawan = $_POST['id_karyawan'];
	$karyawan = $_POST['karyawan'];
	$masuk = $_POST['masuk'];
	$keluar = $_POST['keluar'];
	$date = $_POST['date'];
	$status = $_POST['status'];
	$mode = 'manual';
	$keterangan = $_POST['keterangan'];
	// $capture = $_POST['capture'];
	// $potongan = $_POST['potongan'];

	$liburHariBesar = IsHoliday_($date);
	$getNamaLibur = GetHoliday_($date);
	$liburWeekend = IsHoliday2_($date, $id_divisi);

	// pr($liburHariBesar);
	if ($liburWeekend == '1' || $liburHariBesar == '1') {
		$ret = json_encode([
			'msg' => $liburWeekend == '1' ? GetDayName_($date) . ' hari libur weekend' : date('d F Y', strtotime($date)) . ' hari libur ' . $getNamaLibur,
			'status' => false
		]);
		echo $ret;
	} else {
		// $valid = IsNotDuplicate([
		// 	'id_karyawan' => $id_karyawan,
		// 	'id_tipe_presensi' => $id_tipe_presensi[0],
		// 	'tanggal' => $date,
		// ]);
		// vd($valid);

		$terlambat_keluar = 0;
		$terlambat_masuk = 0;
		$terlambat_total = 0;
		$potongan_total = 0;
		$potongan_masuk = 0;
		$potongan_keluar = 0;

		$kat_terlambat_masuk = 0;
		$kat_terlambat_keluar = 0;

		$itp = $id_tipe_presensi[1];
		if ($itp == 'skj' || $itp == 'diklat') {
			$potongan_total = '2'; // 2 %
		} else if ($itp == 'dispensasi') {
			$potongan_total = '3'; // 3 %
		} else { // harian
			if ($status == 'H') {
				$kalku = GetKeterlambatan([
					'id_divisi' => $id_divisi,
					'masuk' => $masuk,
					'keluar' => $keluar,
				]);
				// vd($kalku);

				// kategori telat 
				$kat_terlambat_masuk = $kalku['kat_terlambat_masuk'];
				$kat_terlambat_keluar = $kalku['kat_terlambat_keluar'];

				// terlambat (menit)
				$terlambat_masuk = $kalku['terlambat_masuk'];
				$terlambat_keluar = $kalku['terlambat_keluar'];
				$terlambat_total = $kalku['terlambat_total'];

				// potongan (persen %)
				$potongan_masuk = $kalku['potongan_masuk'];
				$potongan_keluar = $kalku['potongan_keluar'];
				$potongan_total = $kalku['potongan_total'];
			} else if ($status == 'A') {
				$kat_terlambat_masuk = 4;
				$kat_terlambat_keluar = 4;
				$masuk = '';
				$keluar = '';
			}
		}

		$query = 'UPDATE  tb_absen SET 
					id_karyawan="' . $id_karyawan . '"
					,id_tipe_presensi="' . $id_tipe_presensi[0] . '"
					,masuk="' . $masuk . '"
					,masuk_minus="' . $terlambat_masuk . '"
					,keluar="' . $keluar . '"
					,keluar_minus="' . $terlambat_keluar . '"
					,date="' . $date . '"
					,status="' . $status . '"
					,mode="' . $mode . '"
					,keterangan="' . $keterangan . '"
					,potongan="' . $potongan_total . '"
					,potongan_masuk="' . $potongan_masuk . '"
					,potongan_keluar="' . $potongan_keluar . '"
					,terlambat="' . $terlambat_total . '"
					,kat_terlambat_masuk="' . $kat_terlambat_masuk . '"
					,kat_terlambat_keluar="' . $kat_terlambat_keluar . '" 
				WHERE id='.$id;
		// vd($query);
		$exe = mysqli_query($dbconnect, $query);
		$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
		$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
		echo $ret;
	}
} else if (isset($_POST['edit_absensi_user'])) {
	require_once '../konfig/connection.php';
	require_once '../konfig/dev.php';
	require_once '../func/func_absensi.php';

	$id_tipe_presensi = $_POST['id_tipe_presensi'];
	$id_tipe_presensi = explode('-', $id_tipe_presensi);

	$id_divisi = $_POST['id_divisi'];
	$id_karyawan = $_POST['id_karyawan'];
	// $karyawan = $_POST['karyawan'];

	$kode_mode_absen = $_POST['kode_mode_absen'];
	$masuk = strtolower($kode_mode_absen) == 'masuk' ? $_POST['jam_now'] : '';
	$keluar = strtolower($kode_mode_absen) == 'pulang' ? $_POST['jam_now'] : '';
	$date = $_POST['date'];
	$status = $_POST['status'];
	$mode = 'manual';
	$keterangan = $_POST['keterangan'];
	// $capture = $_POST['capture'];
	// $potongan = $_POST['potongan'];

	// pr($keluar);
	$valid = IsNotDuplicate([
		'id_karyawan' => $id_karyawan,
		'id_tipe_presensi' => $id_tipe_presensi[0],
		'tanggal' => $date,
	]);

	// vd($valid);
	$terlambat_keluar = 0;
	$terlambat_masuk = 0;
	$terlambat_total = 0;
	$potongan_total = 0;
	$potongan_masuk = 0;
	$potongan_keluar = 0;

	$kat_terlambat_masuk = 0;
	$kat_terlambat_keluar = 0;

	$itp = $id_tipe_presensi[1];
	// pr($itp);
	if ($itp == 'skj' || $itp == 'diklat') {
		$potongan_total = '2'; // 2 %
	} else if ($itp == 'dispensasi') {
		$potongan_total = '3'; // 3 %
	} else { // harian
		if ($status == 'H') {
			$kalku = GetKeterlambatan([
				'id_divisi' => $id_divisi,
				'masuk' => $masuk,
				'keluar' => $keluar,
			]);

			// vd($kalku);
			// kategori telat 
			$kat_terlambat_masuk = $kalku['kat_terlambat_masuk'];
			$kat_terlambat_keluar = $kalku['kat_terlambat_keluar'];

			// terlambat (menit)
			$terlambat_masuk = $kalku['terlambat_masuk'];
			$terlambat_keluar = $kalku['terlambat_keluar'];
			$terlambat_total = $kalku['terlambat_total'];

			// potongan (persen %)
			$potongan_masuk = $kalku['potongan_masuk'];
			$potongan_keluar = $kalku['potongan_keluar'];
			$potongan_total = $kalku['potongan_total'];
		} else if ($status == 'A') {
			$kat_terlambat_masuk = 4;
			$kat_terlambat_keluar = 4;
			$masuk = '';
			$keluar = '';
		}
	}

	if ($valid) {
		$query = "INSERT INTO `tb_absen` (
				`id_karyawan`
				,`id_tipe_presensi`
				,`masuk`
				,`masuk_minus`
				,`keluar`
				,`keluar_minus`
				,`date`
				,`status`
				,`mode`
				,`keterangan`
				,`potongan`
				,`potongan_masuk`
				,`potongan_keluar`
				,`terlambat`
				,`kat_terlambat_masuk`
				,`kat_terlambat_keluar`
			)
			VALUES (
				'$id_karyawan'
				,'$id_tipe_presensi[0]'
				,'$masuk'
				,'$terlambat_masuk'
				,'$keluar'
				,'$terlambat_keluar'
				,'$date'
				,'$status'
				,'$mode'
				,'$keterangan'
				,'$potongan_total'
				,'$potongan_masuk'
				,'$potongan_keluar'
				,'$terlambat_total'
				,'$kat_terlambat_masuk'
				,'$kat_terlambat_keluar'
			)";
		// vd($query);
		$exe = mysqli_query($dbconnect, $query);
		$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
		$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
		echo $ret;
	} else {
		$ret = json_encode(['msg' => 'data duplikat, (karyawan sudah melakukan presensi, tanggal dan tipe presensi sama) ', 'status' => false]);
		echo $ret;
	}
}
