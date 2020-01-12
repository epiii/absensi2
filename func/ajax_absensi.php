<?php

require_once '../konfig/connection.php';
require_once '../konfig/dev.php';

function GetKaryawanAbsensi2()
{
	global $dbconnect;
	$page       = $_GET['page']; // get the requested page
	$limit      = $_GET['rows']; // get how many rows we want to have into the grid
	$sidx       = 'nama'; // get index row - i.e. user click to sort
	// $sidx       = $_GET['sidx']; // get index row - i.e. user click to sort
	$sord       = $_GET['sord']; // get the direction
	$searchTerm = $_GET['searchTerm'];
	$tanggal = $_GET['tanggal'];

	$ss = 'SELECT 
				k.id,
				k.nip,
				k.nama
			FROM tb1_karyawan k 
			WHERE 
				k.nama LIKE "%' . $searchTerm . '%"  
				AND k.id NOT IN (
					SELECT id_karyawan FROM tb_absen where date ="2020-01-13"
				)
				';
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
	// vd($ss);
	$rows 	= array();
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = array(
			'id' => $row['id'],
			'nama'   => $row['nama'],
			'nip'    => $row['nip']
		);
	}
	$response = array(
		'page'    => $page,
		'total'   => $total_pages,
		'records' => $count,
		'rows'    => $rows,
	);
	$out = json_encode($response);
	return $out;
}

if (isset($_POST['insert'])) {
	Insert();
} else if (isset($_POST['update'])) {
	Update($_POST['ID']);
} else if (isset($_POST['delete'])) {
	Delete($_POST['ID']);
} else if (isset($_GET['karyawan_absensi'])) {
	GetKaryawanAbsensi2();
}
