<?php

require_once '../konfig/connection.php';
require_once '../konfig/dev.php';

// pr($_POST);
function Update()
{
	global $dbconnect;
	require_once '../konfig/connection.php';
	require_once '../konfig/dev.php';
	require_once '../func/func_absensi.php';

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

function GetMasterJam($id)
{
	global $dbconnect;
	$ss = '	SELECT * 
			FROM tb1_setting2 
			WHERE  id="' . $id . '"';
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

if (isset($_POST['insert'])) {
	Insert();
} else if (isset($_POST['update'])) {
	Update();
} else if (isset($_POST['delete'])) {
	Delete($_POST['id']);
} else if (isset($_POST['get_master_jam'])) {
	echo GetMasterJam($_POST['id']);
} else if (isset($_POST['update_status'])) {
	echo UpdateStatus($_POST['id']);
}
