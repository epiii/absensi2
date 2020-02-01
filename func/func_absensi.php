<?php

if (isset($_REQUEST['ajax'])) {
	// var_dump('$_REQUEST');
	// exit();
	require_once '../konfig/connection.php';
	require_once '../konfig/dev.php';

	if (isset($_GET['karyawan_absensi'])) {
		global $dbconnect;
		$page       = $_GET['page']; // get the requested page
		$limit      = $_GET['rows']; // get how many rows we want to have into the grid
		$sidx       = 'nama'; // get index row - i.e. user click to sort
		// $sidx       = $_GET['sidx']; // get index row - i.e. user click to sort
		$sord       = $_GET['sord']; // get the direction
		$searchTerm = trim($_GET['searchTerm']);
		// $tanggal = '2020-01-17';
		// $tanggal = $_GET['tanggal'];

		$ss = 'SELECT 
				i.id,
				i.nama,
				i.nip,
				j.*,
				d.*,
				kk.*
			FROM tb_id i
				LEFT JOIN vw_jabatan j on j.id_jabatan= i.id_jabatan
				LEFT JOIN vw_divisi d on d.id_divisi = i.id_divisi
				LEFT JOIN vw_katkaryawan kk on kk.id_katkaryawan= i.id_kategori_karyawan
			WHERE 
				i.nama LIKE "%' . $searchTerm . '%"  
				OR i.nip LIKE "%' . $searchTerm . '%"  
			';
		// pr($ss);
		// $ss = 'SELECT 
		// 		k.id,
		// 		k.nama,
		// 		k.nip,
		// 		j.*,
		// 		d.*,
		// 		kk.*
		// 	FROM tb1_karyawan k
		// 		LEFT JOIN vw_jabatan j on j.id_jabatan= k.id_jabatan
		// 		LEFT JOIN vw_divisi d on d.id_divisi = k.id_divisi
		// 		LEFT JOIN vw_katkaryawan kk on kk.id_katkaryawan= k.id_kategori_karyawan
		// 	WHERE 
		// 		k.nama LIKE "%' . $searchTerm . '%"  
		// 		OR k.nip LIKE "%' . $searchTerm . '%"  
		// 	';
		// $ss = 'SELECT 
		// 			k.id,
		// 			k.nip,
		// 			k.nama
		// 		FROM tb1_karyawan k 
		// 		WHERE 
		// 			k.nama LIKE "%' . $searchTerm . '%"  
		// 			AND k.id NOT IN (
		// 				SELECT id_karyawan FROM tb_absen where date ="' . $tanggal . '"
		// 			)
		// 			';
		// pr($ss);
		$result = mysqli_query($dbconnect, $ss);
		$row    = mysqli_fetch_array($result);
		$count  = mysqli_num_rows($result);

		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page = $total_pages;
		$start 	= $limit * $page - $limit; // do not put $limit*($page - 1)
		if ($total_pages != 0) {
			$ss .= 'ORDER BY ' . $sidx . ' ' . $sord . ' LIMIT ' . $start . ',' . $limit;
		} else {
			$ss .= 'ORDER BY ' . $sidx . ' ' . $sord;
		}
		$result = mysqli_query($dbconnect, $ss); //or die("Couldn t execute query." . mysqli_error());
		$rows 	= array();
		while ($row = mysqli_fetch_assoc($result)) {
			$s = 'SELECT *
			FROM tb1_setting2 
			WHERE id_divisi = "' . $row['id_divisi'] . '" AND isActive="1"';
			$e = mysqli_query($dbconnect, $s);
			$detRows = [];
			while ($r = mysqli_fetch_assoc($e)) {
				$detRows[] = $r;
			}

			$rows[] = array(
				'id' => $row['id'],
				'nip' => $row['nip'] ? $row['nip'] : '-',
				'nama' => $row['nama'],
				'jabatan' => $row['nama_jabatan'] ? $row['nama_jabatan'] : '-',
				'id_jabatan' => $row['id_jabatan'] ? $row['id_jabatan'] : '-',
				'divisi' => $row['nama_divisi'] ? $row['nama_divisi'] : '-',
				'id_divisi' => $row['id_divisi'] ? $row['id_divisi'] : '-',

				//detail
				'rule_masuk' => $row['id_divisi'] != null ? $detRows[0] : '',
				'rule_keluar' => $row['id_divisi'] != null ? $detRows[1] : '',
			);
		}

		$response = array(
			'page'    => $page,
			'total'   => $total_pages,
			'records' => $count,
			'rows'    => $rows,
		);
		$out = json_encode($response);
		echo $out;
	} elseif (isset($_GET['karyawan_pengguna'])) {
		global $dbconnect;
		$page       = $_GET['page']; // get the requested page
		$limit      = $_GET['rows']; // get how many rows we want to have into the grid
		$sidx       = 'nama'; // get index row - i.e. user click to sort
		// $sidx       = $_GET['sidx']; // get index row - i.e. user click to sort
		$sord       = $_GET['sord']; // get the direction
		$searchTerm = $_GET['searchTerm'];

		$ss = 'SELECT
					i.*, d.*, j.*
				FROM
					tb_id i
				LEFT JOIN vw_divisi d ON d.id_divisi = i.id_divisi
				LEFT JOIN vw_jabatan j ON j.id_jabatan = i.id_jabatan
				WHERE
					i.id NOT IN (
						SELECT
							id_karyawan
						FROM
							tb_pengguna
						WHERE
							LEVEL = 1
							' . (isset($_GET['id_karyawan']) && $_GET['id_karyawan'] != '' ? ' AND id_karyawan != ' . $_GET['id_karyawan'] : '') . '
					) 
					AND i.nama LIKE "%' . $searchTerm . '%"  
					OR i.nip LIKE "%' . $searchTerm . '%"  
			';
		// pr($ss);
		$result = mysqli_query($dbconnect, $ss);
		$row    = mysqli_fetch_array($result);
		$count  = mysqli_num_rows($result);

		if ($count > 0) {
			$total_pages = ceil($count / $limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages) $page = $total_pages;
		$start 	= $limit * $page - $limit; // do not put $limit*($page - 1)
		if ($total_pages != 0) {
			$ss .= 'ORDER BY ' . $sidx . ' ' . $sord . ' LIMIT ' . $start . ',' . $limit;
		} else {
			$ss .= 'ORDER BY ' . $sidx . ' ' . $sord;
		}
		$result = mysqli_query($dbconnect, $ss); //or die("Couldn t execute query." . mysqli_error());
		$rows 	= array();
		while ($row = mysqli_fetch_assoc($result)) {
			$s = 'SELECT *
			FROM tb1_setting2 
			WHERE id_divisi = "' . $row['id_divisi'] . '" AND isActive="1"';
			$e = mysqli_query($dbconnect, $s);
			$detRows = [];
			while ($r = mysqli_fetch_assoc($e)) {
				$detRows[] = $r;
			}

			$rows[] = array(
				'id' => $row['id'],
				'nip' => $row['nip'] ? $row['nip'] : '-',
				'nama' => $row['nama'],
				'jabatan' => $row['nama_jabatan'] ? $row['nama_jabatan'] : '-',
				'id_jabatan' => $row['id_jabatan'] ? $row['id_jabatan'] : '-',
				'divisi' => $row['nama_divisi'] ? $row['nama_divisi'] : '-',
				'id_divisi' => $row['id_divisi'] ? $row['id_divisi'] : '-',

				//detail
				'rule_masuk' => $row['id_divisi'] != null ? $detRows[0] : '',
				'rule_keluar' => $row['id_divisi'] != null ? $detRows[1] : '',
			);
		}

		$response = array(
			'page'    => $page,
			'total'   => $total_pages,
			'records' => $count,
			'rows'    => $rows,
		);
		$out = json_encode($response);
		echo $out;
	}


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
} else {
	// print_r($_REQUEST);
	require_once './konfig/connection.php';
	// require_once '../konfig/dev.php';

	// vd($_GET);////
	// include './konfig/function.php';
	// var_dump($dbconnect);
	// exit();

	// libur : tanggal merah 
	function IsHoliday($date)
	{
		global $dbconnect;
		$ss = 'SELECT * FROM vw_hari_libur WHERE isActive ="1" AND kode_hari_libur = "' . $date . '"';
		$ee = mysqli_query($dbconnect, $ss);
		$nn = mysqli_num_rows($ee);
		return $nn; // 1=libur, 0=tdk libur 
	}

	function GetDayName($date)
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

	// libur : weekend rutin per divisi 
	function IsHoliday2($date, $id_divisi)
	{
		global $dbconnect;
		$hari = GetDayName($date);
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


	function GetDivisiRule()
	{
		global $dbconnect;
		$query = "SELECT
					vw.id_divisi,
					vw.kode_divisi,
					vw.nama_divisi,
					mas.persen1 as mas_per_1,
					mas.persen2 as mas_per_2,
					mas.persen3 as mas_per_3,
					mas.persen4 as mas_per_4,
					
					kel.persen1 as kel_per_1,
					kel.persen2 as kel_per_2,
					kel.persen3 as kel_per_3,
					kel.persen4 as kel_per_4
				FROM
					vw_divisi vw
					LEFT JOIN tb1_setting2 mas on mas.id_divisi = vw.id_divisi and mas.no='1'
					LEFT JOIN tb1_setting2 kel on kel.id_divisi = vw.id_divisi and kel.no='2'
				";
		$exe = mysqli_query($dbconnect, $query);
		while ($r = mysqli_fetch_assoc($exe)) {
			$datas[] = array(
				'id' => $r['id_divisi'],
				'kode_divisi' => $r['kode_divisi'],
				'nama_divisi' => $r['nama_divisi'],

				// masuk 
				'mas_per_1' => $r['mas_per_1'],
				'mas_per_2' => $r['mas_per_2'],
				'mas_per_3' => $r['mas_per_3'],
				'mas_per_4' => $r['mas_per_4'],

				// keluar 
				'kel_per_1' => $r['kel_per_1'],
				'kel_per_2' => $r['kel_per_2'],
				'kel_per_3' => $r['kel_per_3'],
				'kel_per_4' => $r['kel_per_4'],
			);
		}
		return $datas;
	}

	function GetKaryawanAbsensi($id)
	{
		global $dbconnect;
		$query = '	SELECT 
			-- DATE_FORMAT(a.date, "%d %M %Y") as tanggal,
			a.id,
			a.date,
			a.masuk,
			a.terlambat,
			a.potongan,
			a.masuk_minus,
			a.keluar,
			a.keluar_minus,
			a.capture,
			a.keterangan,
			a.status,
			a.id_karyawan,
			k.nama
		FROM tb_absen a
		JOIN tb1_karyawan k ON k.id = a.id_karyawan
		WHERE a.id=' . $id;
		// vd($query);

		$exe = mysqli_query($dbconnect, $query);
		$data = mysqli_fetch_assoc($exe);
		$res = array(
			'id' => $data['id'],
			'id_karyawan' => $data['id_karyawan'],
			'masuk' => $data['masuk'],
			'keluar' => $data['keluar'],
			'masuk_minus' => $data['masuk_minus'],
			'keluar_minus' => $data['keluar_minus'],
			'date' => $data['date'],
			'status' => $data['status'],
			'capture' => $data['capture'],
			'keterangan' => $data['keterangan'],
			'terlambat' => $data['terlambat'],
			'potongan' => $data['potongan'],
			// 'mode' => $data['mode'],
		);
		return $res;
	}



	function GetTipePresensi2()
	{
		global $dbconnect;
		$query = "	SELECT *
		FROM
			tb2_setting
		WHERE
			id_parent= (
				SELECT id from tb2_setting where param =LOWER('tipe_presensi')
			)";
		$exe = mysqli_query($dbconnect, $query);
		// pr($exe);
		// $exe = mysqli_query(Connect(), $query);
		while ($data = mysqli_fetch_assoc($exe)) {
			$datas[] = array(
				'id' => $data['id'],
				'kode_tipe_presensi' => $data['param'],
				'nama_tipe_presensi' => $data['value']
			);
		}
		return $datas;
	}


	function GetJadwalByDivisi($id_divisi)
	{
		global $dbconnect;
		$sql = 'SELECT *
			FROM tb1_setting2
			WHERE id_divisi =' . $id_divisi . ' AND isActive ="1"';
		$exe = mysqli_query($dbconnect, $sql);
		$r = [];
		while ($row = mysqli_fetch_assoc($exe)) {
			if ($row['no'] == '1') {
				// masuk 
				$mas_jam = $row['jam'];
				$mas_menit = $row['menit'];

				// batas absen 
				$mas_bts_1 = $row['batas1'];
				$mas_bts_2 = $row['batas2'];

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

				// batas absen 
				$kel_bts_1 = $row['batas1'];
				$kel_bts_2 = $row['batas2'];

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

		$out = array(
			// masuk 
			'mas_jam' => $mas_jam,
			'mas_menit' => $mas_menit,

			// batas 
			'mas_bts_1' => $mas_bts_1,
			'mas_bts_2' => $mas_bts_2,
			'kel_bts_1' => $kel_bts_1,
			'kel_bts_2' => $kel_bts_2,

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
		);
		return $out;
	}


	if (isset($_POST['insert'])) {
		Insert();
	} else if (isset($_POST['update'])) {
		Update($_POST['ID']);
	} else if (isset($_POST['delete'])) {
		Delete($_POST['ID']);
	}
}
