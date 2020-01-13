<?php

if (isset($_GET['karyawan_absensi'])) {
	require_once '../konfig/connection.php';
	require_once '../konfig/dev.php';

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
		$rows[] = array(
			'id' => $row['id'],
			'nip' => $row['nip']?$row['nip']:'-',
			'nama' => $row['nama'],
			'jabatan' => $row['nama_jabatan']?$row['nama_jabatan']:'-',
			'id_jabatan' => $row['id_jabatan']?$row['id_jabatan']:'-',
			'divisi' => $row['nama_divisi']?$row['nama_divisi']:'-',
			'id_divisi' => $row['id_divisi']?$row['id_divisi']:'-',
		);
	}
	// vd($rows);
	// exit();
	$response = array(
		'page'    => $page,
		'total'   => $total_pages,
		'records' => $count,
		'rows'    => $rows,
	);
	$out = json_encode($response);
	echo $out;
} else {
	require_once './konfig/connection.php';
	// vd($_GET);
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
