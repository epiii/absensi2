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

	$id_sub = $_POST['id_sub'];
	$param_sub = $_POST['param_sub'];
	$value_sub = $_POST['value_sub'];

	if (isset($_POST['id_sub']) && $_POST['id_sub'] != '') { // edit 
		if ($_POST['ajax'] == 'multi') {

			foreach ($value_sub as $k => $v) {
				pr($v);
			}

			pr($_POST['value_sub']);
			$query = 'UPDATE tb2_setting SET 
					param ="' . $param_sub . '",
					value ="' . $value_sub . '"
					WHERE id=' . $id_sub;
		} else {
			$query = 'UPDATE tb2_setting SET 
					param ="' . $param_sub . '",
					value ="' . $value_sub . '"
					WHERE id=' . $id_sub;
		}
	} else { // add 
		$query = 'INSERT INTO tb2_setting SET 
					id_parent ="' . $_POST['id_parent'] . '",
					param ="' . $param_sub . '",
					value ="' . $value_sub . '"';
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
	$query = "DELETE  FROM `tb2_setting` WHERE id='" . $id . "'";
	// pr($query);

	$sql = mysqli_query($dbconnect, $query);
	$msg = $sql ? 'berhasil menghapus data' : 'failed,' . mysqli_error($dbconnect);
	$ret = json_encode(['status' => $sql ? true : false, 'msg' => $msg]);
	echo $ret;
}

function GetMaster($id)
{
	global $dbconnect;
	$ss = '	SELECT * 
			FROM tb2_setting 
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

function UpdateStatus($id_sub)
{
	// pr($id_sub);
	global $dbconnect;
	// $id_sub = $_POST['id'];
	// $id_sub = $_POST['id'];

	$s = 'SELECT isActive FROM tb2_setting WHERE id=' . $id_sub;
	$e = mysqli_query($dbconnect, $s);
	$r = mysqli_fetch_assoc($e);

	$query = 'UPDATE tb2_setting SET 
			isActive ="' . ($r['isActive'] == '1' ? '0' : '1') . '"
			WHERE id=' . $id_sub;
	// pr($query);

	$exe = mysqli_query($dbconnect, $query);
	$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
	$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
	echo $ret;
}
// function UpdateStatus($id)
// {

// 	global $dbconnect;
// 	$id_sub = $_POST['id'];

// 	$s = 'select isActive from tb1_setting2 where id=' . $id;

// 	$e = mysqli_query($dbconnect, $s);
// 	$r = mysqli_fetch_assoc($e);

// 	$query = 'UPDATE tb1_setting2 SET 
// 				isActive ="' . ($r['isActive'] == '1' ? '0' : '1') . '"
// 				WHERE id=' . $id;
// 	// pr($query);
// 	$exe = mysqli_query($dbconnect, $query);
// 	$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
// 	$ret = ['msg' => $msg, 'status' => $exe ? true : false];
// 	return json_encode($ret);
// }

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
} else if (isset($_POST['get_master'])) {
	echo GetMaster($_POST['id']);
}