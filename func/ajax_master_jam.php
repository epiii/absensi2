<?php

require_once '../konfig/connection.php';
require_once '../konfig/dev.php';

function Submit()
{
	global $dbconnect;
	// require_once '../konfig/connection.php';
	// require_once '../konfig/dev.php';
	// require_once '../func/func_absensi.php';

	// pr($id);
	$id = $_POST['id'];
	$id_divisi = $_POST['id_divisi'];
	$jam = $_POST['jam'];
	$mode = strtolower($_POST['mode']);

	$no = $mode == 'masuk' ? '1' : '2';
	$jam = explode(':', $jam);
	$telat1a = $_POST['telat1a'];
	$telat1b = $_POST['telat1b'];
	$persen1 = $_POST['persen1'];
	$telat2a = $_POST['telat2a'];
	$telat2b = $_POST['telat2b'];
	$persen2 = $_POST['persen2'];
	$telat3a = $_POST['telat3a'];
	$telat3b = $_POST['telat3b'];
	$persen3 = $_POST['persen3'];
	$persen4 = $_POST['persen4'];
	$batas1 = $_POST['batas1'] < 10 ? '0' . $_POST['batas1'] : $_POST['batas1'];
	$batas2 = $_POST['batas2'] < 10 ? '0' . $_POST['batas2'] : $_POST['batas2'];

	if (isset($_POST['id']) && $_POST['id'] != '') { // edit 
		$query = 'UPDATE tb1_setting2 SET 
					no="' . $no . '", 
					jam="' . $jam[0] . '", 
					menit="' . $jam[1] . '", 
					telat1a="' . $telat1a . '", 
					telat1b="' . $telat1b . '", 
					persen1="' . $persen1 . '", 
					telat2a="' . $telat2a . '", 
					telat2b="' . $telat2b . '", 
					persen2="' . $persen2 . '", 
					telat3a="' . $telat3a . '", 
					telat3b="' . $telat3b . '", 
					persen3="' . $persen3 . '", 
					persen4="' . $persen4 . '", 
					batas1="' . $batas1 . '", 
					batas2="' . $batas2 . '",
					id_divisi="' . $id_divisi . '"
			WHERE id=' . $_POST['id'] . ' 	
					';
	} else { // add 
		$query = 'INSERT INTO tb1_setting2 SET 
				id_divisi="' . $id_divisi . '", 
				no="' . $no . '", 
				jam="' . $jam[0] . '", 
				menit="' . $jam[1] . '", 
				telat1a="' . $telat1a . '", 
				telat1b="' . $telat1b . '", 
				persen1="' . $persen1 . '", 
				telat2a="' . $telat2a . '", 
				telat2b="' . $telat2b . '", 
				persen2="' . $persen2 . '", 
				telat3a="' . $telat3a . '", 
				telat3b="' . $telat3b . '", 
				persen3="' . $persen3 . '", 
				persen4="' . $persen4 . '", 
				batas1="' . $batas1 . '", 
				batas2="' . $batas2 . '"';
	}
	// pr($query);
	$exe = mysqli_query($dbconnect, $query);
	$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
	$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
	echo $ret;
}

function Delete($id)
{
	global $dbconnect;

	$query = "DELETE  FROM `tb1_setting2` WHERE id='" . $id . "'";
	// pr($query);

	$sql = mysqli_query($dbconnect, $query);
	$msg = $sql ? 'berhasil menghapus data' : 'failed,' . mysqli_error($dbconnect);
	$ret = json_encode(['status' => $sql ? true : false, 'msg' => $msg]);
	echo $ret;
}

function GetMasterJam($id, $id_divisi, $mode)
{
	global $dbconnect;
	if ($id == '') {
		$ss = 'SELECT
					v.id_divisi as id_div,
					v.kode_divisi,
					v.nama_divisi,
					s.*
				FROM vw_divisi v
					LEFT JOIN tb1_setting2 s ON v.id_divisi = s.id_divisi
					AND s. NO = ' . (strtolower($mode) == 'masuk' ? '1' : '2') . '
				WHERE 
					v.isActive=1 AND v.id_divisi = ' . $id_divisi;
	} else {
		$ss = '	SELECT *, id_divisi as id_div  
			FROM tb1_setting2 
			WHERE isActive=1 AND id="' . $id . '"';
	}
	// pr($ss);
	$exe = mysqli_query($dbconnect, $ss);
	$num = mysqli_num_rows($exe);

	if ($num <= 0) {
		$ret = ['sts' => false, 'msg' => 'data kosong'];
	} else {
		$row = mysqli_fetch_assoc($exe);
		$ret = ['sts' => true, 'msg' => $row];
	}
	return json_encode($ret);
}

function GetDetail($id = 16)
{
	global $dbconnect;
	$ss = '	SELECT * 
			FROM tb1_setting2 
			WHERE  id="' . $id . '"';
	pr($ss);
	$exe = mysqli_query($dbconnect, $ss);
	$num = mysqli_num_rows($exe);

	if ($num <= 0) {
		$ret = ['sts' => false, 'msg' => 'data kosong'];
	} else {
		$row = mysqli_fetch_assoc($exe);
		$ret = ['sts' => true, 'msg' => $row];
	}
	return json_encode($ret);
}

/* 
function GetDetail($id)
{
	global $dbconnect;
	$table = 'datatables_demo';

	// Table's primary key
	$primaryKey = 'id';

	$columns = array(
		array('db' => 'first_name', 'dt' => 0),
		array('db' => 'last_name', 'dt' => 1),
		array('db' => 'position', 'dt' => 2),
		array('db' => 'office', 'dt' => 3),
		array(
			'db' => 'start_date',
			'dt' => 4,
			'formatter' => function ($d, $row) {
				return date('jS M y', strtotime($d));
			}
		),
		array(
			'db' => 'salary',
			'dt' => 5,
			'formatter' => function ($d, $row) {
				return '$' . number_format($d);
			}
		)
	);

	// SQL server connection information
	$sql_details = array(
		'user' => '',
		'pass' => '',
		'db'   => '',
		'host' => ''
	);

	require('ssp.class.php');

	echo json_encode(
		SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
	);
} */

function UpdateStatus($id)
{

	global $dbconnect;
	$id_sub = $_POST['id'];

	$s = 'select isActive from tb1_setting2 where id=' . $id;

	$e = mysqli_query($dbconnect, $s);
	$r = mysqli_fetch_assoc($e);

	$query = 'UPDATE tb1_setting2 SET 
				isActive ="' . ($r['isActive'] == '1' ? '0' : '1') . '"
				WHERE id=' . $id;
	// pr($query);
	$exe = mysqli_query($dbconnect, $query);
	$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
	$ret = ['msg' => $msg, 'status' => $exe ? true : false];
	return json_encode($ret);
}

// pr($_POST);

if (isset($_POST['submit'])) {
	Submit();
}
// else if (isset($_POST['submit']) && $_POST['id'] != '') {
// 	Update();
// }
else if (isset($_POST['delete'])) {
	Delete($_POST['id']);
} else if (isset($_GET['get_detail'])) {
	echo GetDetail($_GET['id']);
} else if (isset($_GET['get_master_jam'])) {
	echo GetMasterJam($_GET['id'], $_GET['id_divisi'], $_GET['mode']);
} else if (isset($_POST['update_status'])) {
	echo UpdateStatus($_POST['id']);
}
