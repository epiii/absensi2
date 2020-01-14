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
		$searchTerm = $_GET['searchTerm'];
		// $tanggal = '2020-01-17';
		// $tanggal = $_GET['tanggal'];

		$ss = 'SELECT 
				k.id,
				k.nama,
				k.nip,
				j.*,
				d.*,
				kk.*
			FROM tb1_karyawan k
				LEFT JOIN vw_jabatan j on j.id_jabatan= k.id_jabatan
				LEFT JOIN vw_divisi d on d.id_divisi = k.id_divisi
				LEFT JOIN vw_katkaryawan kk on kk.id_katkaryawan= k.id_kategori_karyawan
			WHERE 
				k.nama LIKE "%' . $searchTerm . '%"  
				OR k.nip LIKE "%' . $searchTerm . '%"  
			';
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
	}

	function IsNotDuplicate($par)
	{
		global $dbconnect;
		$sql = 'SELECT * from tb_absen WHERE id_karyawan = ' . $par['id_karyawan'] . ' AND date ="' . $par['tanggal'] . '"';
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

		// vd($mas_jam_rule);
		if ($mas_jam_real > $mas_jam_rule) {
			if ($mas_selisih >= $mas_tel_1a && $mas_selisih <= $mas_tel_1b) {
				$mas_pot_per = $mas_per_1;
				// vd('1');
			} elseif ($mas_selisih >= $mas_tel_2a && $mas_selisih <= $mas_tel_2b) {
				// vd('2');
				$mas_pot_per = $mas_per_2;
			} elseif ($mas_selisih >= $mas_tel_3a && $mas_selisih <= $mas_tel_3b) {
				$mas_pot_per = $mas_per_3;
				// vd('3');
			} else {
				$mas_pot_per = $mas_per_4;
				// vd('5');
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
			} elseif ($kel_selisih >= $kel_tel_2a && $kel_selisih <= $kel_tel_2b) {
				$kel_pot_per = $kel_per_2;
			} elseif ($kel_selisih >= $kel_tel_3a && $kel_selisih <= $kel_tel_3b) {
				$kel_pot_per = $kel_per_3;
				vd('3');
			} else {
				$kel_pot_per = $kel_per_4;
			}
		}
		$ret = [
			'tot_potongan' => $mas_pot_per + $kel_pot_per,
			'tot_terlambat' => $mas_selisih + $kel_selisih,
		];
		// vd($ret);
		return $ret;
	}
} else {
	require_once './konfig/connection.php';
	// require_once '../konfig/dev.php';

	// vd($_GET);////
	// include './konfig/function.php';
	// var_dump($dbconnect);
	// exit();



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

	if (isset($_POST['insert'])) {
		Insert();
	} else if (isset($_POST['update'])) {
		Update($_POST['ID']);
	} else if (isset($_POST['delete'])) {
		Delete($_POST['ID']);
	}
}
