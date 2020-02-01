<?php

require 'connection.php';
// require '../func/func_pegawai.php';
// require 'dev.php';

//=====================================Load Settings From Datbase=======================================
$sql = mysqli_query($dbconnect, "SELECT * FROM tb_settings");
while ($data = mysqli_fetch_assoc($sql)) {
	$masuk_mulai = $data['masuk_mulai'];
	$masuk_akhir = $data['masuk_akhir'];
	$keluar_mulai = $data['keluar_mulai'];
	$keluar_akhir = $data['keluar_akhir'];
	$libur1 = $data['libur1'];
	$libur2 = $data['libur2'];
	$timezone = $data['timezone'];
	$email = $data['email'];
	$pwdemail = $data['pwdemail'];
	$admin_uid = $data['admin_uid'];
}
// pr($masuk_mulai);
//====================================load timezone====================================================
date_default_timezone_set($timezone);
//=====================================Cek Hari Libur================================================
function getday($tanggal)
{
	$tgl = substr($tanggal, 8, 2);
	$bln = substr($tanggal, 5, 2);
	$thn = substr($tanggal, 0, 4);
	$info = date('w', mktime(0, 0, 0, $bln, $tgl, $thn));
	switch ($info) {
		case '0':
			return "Minggu";
			break;
		case '1':
			return "Senin";
			break;
		case '2':
			return "Selasa";
			break;
		case '3':
			return "Rabu";
			break;
		case '4':
			return "Kamis";
			break;
		case '5':
			return "Jumat";
			break;
		case '6':
			return "Sabtu";
			break;
	};
}
//=====================================Cek UID di DB==============================================
function uid($id)
{
	global $dbconnect;
	$s = "select * from tb_id where id='$id'";
	$sql = mysqli_query($dbconnect, $s);
	$auth = mysqli_num_rows($sql);
	// pr($s);
	if ($auth > 0) {
		return ("0");
	} else {
		return ("1");
	}
}
//=====================================Cek jam absen==============================================
function cektime($time, $m_mulai, $m_akhir, $k_mulai, $k_akhir)
{

	if ($time > $m_mulai && $time < $m_akhir) {
		return "in"; //parameter absen masuk
	} else if ($time >  $m_akhir && $time < $k_mulai) {
		return "terlambat"; //parameter absen masuk terlambat
	} else if ($time > $k_mulai && $time < $k_akhir) {
		return "out"; //parameter absen pulang
	} else if ($time > $k_akhir) {
		return "bolos"; //parameter absen bolos
	} else {
		return "bolos"; //parameter tidak diset
	}
}


function getPegawaiById($id)
{
	global $dbconnect;
	$query = "SELECT * FROM  `tb_id` WHERE  `id` =  '$id'";
	// $query = "SELECT * FROM  `tb1_karyawan` WHERE  `id` =  '$id'";
	// vd($query);
	$exe = mysqli_query($dbconnect, $query);
	$data = mysqli_fetch_assoc($exe);
	// $tgl = $data['tanggal_lahir'];
	// $tglx = explode('-', $tgl);
	$res = array(
		'id' => $data['id'],
		'uid' => $data['uid'],
		// 'tag' => $data['tag'],
		'nama' => $data['nama'],
		'id_jabatan' => $data['id_jabatan'],
		'jenis_kelamin' => $data['jenis_kelamin'],
		'no_induk' => $data['no_induk'],
		'tanggal_lahir' => $data['tanggal_lahir'],
		// 'tanggal_lahir' => $tglx[2].'/'.$tglx[1].'/'.$tglx[0],
		'no_hp' => $data['no_hp'],
		'alamat' => $data['alamat'],
		'kota' => $data['kota'],
		'provinsi' => $data['provinsi'],
		'kode_pos' => $data['kode_pos'],
		'email' => $data['email'],
		'goldar' => $data['goldar'],
		'id_agama' => $data['id_agama'],
		'id_status_kawin' => $data['id_status_kawin'],
		'id_divisi' => $data['id_divisi'],
		'pendidikan' => $data['pendidikan'],
		'gelar' => $data['gelar'],
		'no_sk' => $data['no_sk'],
		'nip' => $data['nip'],
		'id_kategori_karyawan' => $data['id_kategori_karyawan'],
		'npwp' => $data['npwp'],
		'norek' => $data['norek'],
		'status' => $data['status'],
		'created_at' => $data['created_at'],
		'created_by' => $data['created_by'],
	);
	return $res;
}


function IsHoliday_($date)
{
	global $dbconnect;
	$ss = 'SELECT * FROM vw_hari_libur WHERE isActive ="1" AND kode_hari_libur = "' . $date . '"';
	$ee = mysqli_query($dbconnect, $ss);
	$nn = mysqli_num_rows($ee);
	return $nn; // 1=libur, 0=tdk libur 
}


function IsHoliday2_($date, $id_divisi)
{
	global $dbconnect;
	$hari = GetDayName_($date);
	$ss = '	SELECT * 
			FROM vw_hari_libur_2 
			WHERE 
				isActive ="1" AND
				id_divisi=' . $id_divisi . '
				AND	LOWER(hari) = "' . $hari . '"';
	$ee = mysqli_query($dbconnect, $ss);
	$nn = mysqli_num_rows($ee);
	// vd($nn);
	return $nn; // 1=libur, 0 = tidak libur
	// > 0 ? 'true' : false;
}

function GetDayName_($date)
{
	$dayName = [
		'mon' => 'senin',
		'tue' => 'selasa',
		'wed' => 'rabu',
		'thu' => 'kamis',
		'fri' => 'jumat',
		'sat' => 'sabtu',
		'sun' => 'minggu',
	];
	return $dayName[strtolower(date('D', strtotime($date)))];
}

function getModeAbsen($id_divisi)
{
	$jdw = getJadwalAbsen($id_divisi);
	$currTime = date('H:i');

	if ($currTime >= $jdw['mas_bts_1'] && $currTime <= $jdw['mas_bts_2']) {
		$mode = 'masuk';
	} else if ($currTime >= $jdw['kel_bts_1']  && $currTime <= $jdw['kel_bts_2']) {
		$mode = 'keluar';
	} else {
		$mode = 'off';
	}
	// pr($mode);
	return $mode;
}

function getJadwalAbsen($id_divisi)
{
	global $dbconnect;
	$sql = 'SELECT *
		FROM tb1_setting2
		WHERE id_divisi =' . $id_divisi . ' AND isActive ="1"';
	$exe = mysqli_query($dbconnect, $sql);

	while ($row = mysqli_fetch_assoc($exe)) {
		if ($row['no'] == '1') {
			// batas absensi
			$mas_bts_1 = $row['batas1'];
			$mas_bts_2 = $row['batas2'];

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
			// batas absensi
			$kel_bts_1 = $row['batas1'];
			$kel_bts_2 = $row['batas2'];

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
	}

	$ret = [
		// batas abs masuk 
		'mas_bts_1' => $mas_bts_1,
		'mas_bts_2' => $mas_bts_2,

		// batas abs keluar 
		'kel_bts_1' => $kel_bts_1,
		'kel_bts_2' => $kel_bts_2,

		// jam 
		'mas_jam' => $mas_jam,
		'mas_menit' => $mas_menit,

		// telat 
		'mas_tel_1a' => $mas_tel_1a,
		'mas_tel_1b' => $mas_tel_1b,
		'mas_tel_2a' => $mas_tel_2a,
		'mas_tel_2b' => $mas_tel_2b,
		'mas_tel_3a' => $mas_tel_3a,
		'mas_tel_3b' => $mas_tel_3b,

		// potongan %
		'mas_per_1' => $mas_per_1,
		'mas_per_2' => $mas_per_2,
		'mas_per_3' => $mas_per_3,
		'mas_per_4' => $mas_per_4,

		// keluar
		'kel_jam' => $kel_jam,
		'kel_menit' => $kel_menit,

		// telat 
		'kel_tel_1a' => $kel_tel_1a,
		'kel_tel_1b' => $kel_tel_1b,
		'kel_tel_2a' => $kel_tel_2a,
		'kel_tel_2b' => $kel_tel_2b,
		'kel_tel_3a' => $kel_tel_3a,
		'kel_tel_3b' => $kel_tel_3b,

		// potongan %
		'kel_per_1' => $kel_per_1,
		'kel_per_2' => $kel_per_2,
		'kel_per_3' => $kel_per_3,
		'kel_per_4' => $kel_per_4,
	];
	return $ret;
}

function getTimeDiff_($a, $b)
{
	$x = (strtotime($a) - strtotime($b)) / 60;
	return $x;
}

function getKalkulasi($id_divisi, $mode)
{
	global $dbconnect;
	$jdw = getJadwalAbsen($id_divisi);

	// pr($mode);

	if ($mode == 'masuk') {
		// absen masuk 
		$mas_jam_real = $mode == 'masuk' ? date('H:i') : ''; // $par['masuk'];
		$mas_jam_rule = $jdw['mas_jam'] . ':' . $jdw['mas_menit'];
		$mas_selisih = getTimeDiff_($mas_jam_real, $mas_jam_rule);
		$mas_pot_per = 0;
		$mas_kat = 0;
		$kel_kat = 0;

		if ($mas_jam_real > $mas_jam_rule) {
			if ($mas_selisih >= $jdw['mas_tel_1a'] && $mas_selisih <= $jdw['mas_tel_1b']) {
				$mas_pot_per = $jdw['mas_per_1'];
				$mas_kat = '1';
			} elseif ($mas_selisih >= $jdw['mas_tel_2a'] && $mas_selisih <= $jdw['mas_tel_2b']) {
				$mas_pot_per = $jdw['mas_per_2'];
				$mas_kat = '2';
			} elseif ($mas_selisih >= $jdw['mas_tel_3a'] && $mas_selisih <= $jdw['mas_tel_3b']) {
				$mas_pot_per = $jdw['mas_per_3'];
				$mas_kat = '3';
			} elseif ($mas_selisih > $jdw['mas_tel_3b']) {
				$mas_pot_per = $jdw['mas_per_4'];
				$mas_kat = '4';
			}
		}

		$terlambat_masuk = $mas_selisih < 0 || $mode == 'masuk' ?  $mas_selisih : 0;
		// $terlambat_keluar = $kel_selisih < 0 || $mode == 'keluar' ?  $kel_selisih : 0;

		$kat_terlambat_masuk = $mode == 'masuk' ?  $mas_kat : '0';
		// $kat_terlambat_keluar = $mode == 'keluar' ?  $kel_kat : '0';

		$ret = [
			'kat_terlambat_masuk' => $kat_terlambat_masuk,
			// 'kat_terlambat_keluar' => $kat_terlambat_keluar,

			'potongan_masuk' =>  $mas_pot_per,
			// 'potongan_keluar' =>  $kel_pot_per,
			// 'potongan_total' =>  $mas_pot_per + $kel_pot_per,

			'terlambat_masuk' =>  $terlambat_masuk,
			// 'terlambat_keluar' =>  $terlambat_keluar,
			// 'terlambat_total' => $terlambat_masuk + $terlambat_keluar,
		];
	} else {
		// absen keluar 
		$kel_jam_real = $mode == 'keluar' ? date('H:i') : ''; // $par['keluk'];
		$kel_jam_rule = $jdw['kel_jam'] . ':' . $jdw['kel_menit'];
		$kel_selisih = getTimeDiff_($kel_jam_rule, $kel_jam_real);
		$kel_pot_per = 0;

		if ($kel_jam_real < $kel_jam_rule) {
			if ($kel_selisih >= $jdw['kel_tel_1a'] && $kel_selisih <= $jdw['kel_tel_1b']) {
				$kel_pot_per = $jdw['kel_per_1'];
				$kel_kat = '1';
			} elseif ($kel_selisih >= $jdw['kel_tel_2a'] && $kel_selisih <= $jdw['kel_tel_2b']) {
				$kel_pot_per = $jdw['kel_per_2'];
				$kel_kat = '2';
			} elseif ($kel_selisih >= $jdw['kel_tel_3a'] && $kel_selisih <= $jdw['kel_tel_3b']) {
				$kel_pot_per = $jdw['kel_per_3'];
				$kel_kat = '3';
			} else {
				$kel_pot_per = $jdw['kel_per_4'];
				$kel_kat = '4';
			}
		}

		// $terlambat_masuk = $mas_selisih < 0 || $mode == 'masuk' ?  $mas_selisih : 0;
		$terlambat_keluar = $kel_selisih < 0 || $mode == 'keluar' ?  $kel_selisih : 0;

		// $kat_terlambat_masuk = $mode == 'masuk' ?  $mas_kat : '0';
		$kat_terlambat_keluar = $mode == 'keluar' ?  $kel_kat : '0';

		$ret = [
			// 'kat_terlambat_masuk' => $kat_terlambat_masuk,
			'kat_terlambat_keluar' => $kat_terlambat_keluar,

			// 'potongan_masuk' =>  $mas_pot_per,
			'potongan_keluar' =>  $kel_pot_per,
			// 'potongan_total' =>  $mas_pot_per + $kel_pot_per,

			// 'terlambat_masuk' =>  $terlambat_masuk,
			'terlambat_keluar' =>  $terlambat_keluar,
			// 'terlambat_total' => $terlambat_masuk + $terlambat_keluar,
		];
	}

	// pr($mas_selisih);
	// pr($mas_kat);
	// vd($ret);
	return $ret;
}

function isExistAbsensiToday($uid)
{
	global $dbconnect;
	$sql = 'SELECT * 
			FROM tb_absen
			WHERE
				id_karyawan = ' . $uid . '
				AND id_tipe_presensi = "47"
				AND date ="' . (date('Y-m-d')) . '"';
	$exe = mysqli_query($dbconnect, $sql);
	$num = mysqli_num_rows($exe);
	// pr($num);
	return $num;
}

function isExistAbsensiByMode($uid, $mode)
{
	global $dbconnect;
	$sql = 'SELECT * 
			FROM tb_absen
			WHERE
				id_karyawan = ' . $uid . '
				AND id_tipe_presensi = "47"
				AND date ="' . (date('Y-m-d')) . '"';
	$exe = mysqli_query($dbconnect, $sql);
	$num = mysqli_num_rows($exe);
	return $num > 0 ? false : true;
}

function getAbsensiByKaryawan($uid)
{
	global $dbconnect;
	$sql = 'SELECT * 
			FROM tb_absen
			WHERE
				id_karyawan = ' . $uid . '
				AND id_tipe_presensi = "47"
				AND date ="' . (date('Y-m-d')) . '"';
	$exe = mysqli_query($dbconnect, $sql);
	$num = mysqli_num_rows($exe);
	$r = $num > 0 ? mysqli_fetch_assoc($exe) : '';
	return $r;
}

//===============================Insert or Update Database Absen==================================
function postdata($uid, $id_divisi, $mode)
// function postdata($uid, $id_divisi, $hari_ini, $time, $cek_absen)
{
	global $dbconnect;
	$id_tipe_presensi = '47';

	$cek = isExistAbsensiToday($uid);
	$kalku = getKalkulasi($id_divisi, $mode);
	$query =  ' id_karyawan="' . $uid . '"
				,id_tipe_presensi="' . $id_tipe_presensi . '"
				,masuk="' . ($mode == 'masuk' ? date('H:i') : '') . '"
				,masuk_minus="' . ($mode == 'masuk' ? $kalku['terlambat_masuk'] : '') . '"
				,keluar="' . ($mode == 'keluar' ? date('H:i') : '') . '"
				,keluar_minus="' . ($mode == 'keluar' ? $kalku['terlambat_keluar'] : '') . '"
				,date="' . (date('Y-m-d')) . '"
				,status="H"
				,mode="otomatis"
				,keterangan=""
				,potongan_masuk="' . ($mode == 'masuk' ? $kalku['potongan_masuk'] : '') . '"
				,potongan_keluar="' . ($mode == 'keluar' ? $kalku['potongan_keluar'] : '') . '"
				,kat_terlambat_masuk="' . ($mode == 'masuk' ? $kalku['kat_terlambat_masuk'] : '') . '"
				,kat_terlambat_keluar="' . ($mode == 'keluar' ? $kalku['kat_terlambat_keluar'] : '') . '"';

	if ($cek == '0') { // belun ada
		$query = "INSERT INTO tb_absen SET ";
		$exe = mysqli_query($dbconnect, $query);
		if ($exe) {
			$ret = $kalku['kat_terlambat_masuk'] > 0 || $kalku['kat_terlambat_keluar'] > 0 ? 'Terlambat' : 'Tidak Terlambat';
		} else {
			$ret = 'error,' . mysqli_error($dbconnect);
		}
	} else { // sudah ada
		$abs = getAbsensiByKaryawan($uid);
		if ($mode == 'masuk' && $abs['masuk'] == '') { // absen masuk masih kosong
			$query = 'UPDATE tb_absen SET ' . $query . ' WHERE id=' . $abs['id'];
			$exe = mysqli_query($dbconnect, $query);
			if ($exe) {
				$ret = $kalku['kat_terlambat_masuk'] > 0 || $kalku['kat_terlambat_keluar'] > 0 ? 'Terlambat' : 'Tidak Terlambat';
			} else {
				$ret = 'error,' . mysqli_error($dbconnect);
			}
		} else if ($mode == 'keluar' && $abs['keluar'] == '') { // absen keluar masih kosong 
			$query = 'UPDATE tb_absen SET ' . $query . ' WHERE id=' . $abs['id'];
			$exe = mysqli_query($dbconnect, $query);
			if ($exe) {
				$ret = $kalku['kat_terlambat_masuk'] > 0 || $kalku['kat_terlambat_keluar'] > 0 ? 'Terlambat' : 'Tidak Terlambat';
			} else {
				$ret = 'error,' . mysqli_error($dbconnect);
			}
		} else {
			$ret = 'sudah melakukan absensi';
			// $query = 'UPDATE tb_absen SET ' . $query . ' WHERE id=' . $abs['id'];
		}
	}
	echo $ret;
}

function postdatax($uid, $hari_ini, $time, $cek_absen)
{
	global $dbconnect;
	$sql = mysqli_query($dbconnect, "select * from tb_absen where id='$uid' and date='$hari_ini'");
	$auth = mysqli_num_rows($sql);

	if ($auth > 0) {
		if ($cek_absen == "in") {
			mysqli_query($dbconnect, "UPDATE tb_absen SET masuk='$time', status = 'B' WHERE id='$uid' AND date='$hari_ini'");
			return ("Presensi Masuk");
		} else if ($cek_absen == "terlambat") {
			mysqli_query($dbconnect, "UPDATE tb_absen SET masuk='$time', status = 'T' WHERE id='$uid' AND date='$hari_ini'");
			return ("Presensi Terlambat");
		} else if ($cek_absen == "out") {
			$cek_masuk = mysqli_query($dbconnect, "select * from tb_absen WHERE id='$uid' AND date='$hari_ini'");
			while ($data = mysqli_fetch_assoc($cek_masuk)) {
				$masuk = $data['masuk'];
				$status = $data['status'];
				if ($masuk != "" && $status != "T") {
					mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'H' WHERE id='$uid' AND date='$hari_ini'");
					return ("Presensi Hadir");
				} else if ($masuk != "" && $status == "T") {
					mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'T' WHERE id='$uid' AND date='$hari_ini'");
					return ("Presensi Terlambat");
				} else if ($masuk == "" && $status == "B") {
					mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'B' WHERE id='$uid' AND date='$hari_ini'");
					return ("Presensi Bolos");
				}
			}
		} else if ($cek_absen == "bolos") {
			mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'B' WHERE id='$uid' AND date='$hari_ini'");
			return ("Presensi Selesai");
		}
	} else {
		if ($cek_absen == "in") {
			mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','$time','','$hari_ini','B','')");
			return ("Presensi Masuk");
		} else if ($cek_absen == "terlambat") {
			mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','$time','','$hari_ini','T','')");
			return ("Presensi Terlambat");
		} else if ($cek_absen == "out") {
			mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','','$time','$hari_ini','B','')");
			return ("Presensi Keluar");
		} else if ($cek_absen == "bolos") {
			mysqli_query($dbconnect, "INSERT INTO tb_absen VALUES ('$uid','','$time','$hari_ini','B','')");
			return ("Presensi Bolos");
		}
	}
	mysqli_close($dbconnect);
}
