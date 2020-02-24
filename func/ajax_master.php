<?php
require_once '../konfig/connection.php';
require_once '../konfig/dev.php';

// pr($_POST);
function Update()
{
	global $dbconnect;
	// require_once '../konfig/connection.php';
	// require_once '../konfig/dev.php';
	// require_once '../func/func_absensi.php';

	$id_sub = $_POST['id_sub'];
	$param_sub = $_POST['param_sub'];
	$value_sub = $_POST['value_sub'];

	if (isset($_POST['id_sub']) && $_POST['id_sub'] != '') { // edit 
		// if ($_POST['ajax'] == 'multi') {

		// 	foreach ($value_sub as $k => $v) {
		// 		pr($v);
		// 	}

		// 	pr($_POST['value_sub']);
		// 	$query = 'UPDATE tb2_setting SET 
		// 			param ="' . $param_sub . '",
		// 			value ="' . $value_sub . '"
		// 			WHERE id=' . $id_sub;
		// } else {
		$query = 'UPDATE tb2_setting SET 
					param ="' . $param_sub . '",
					value ="' . $value_sub . '"
					WHERE id=' . $id_sub;
		// }
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

	// hapus master jam 
	$sJam = 'DELETE  FROM tb1_setting2 WHERE id_divisi=' . $id;
	$eJam = mysqli_query($dbconnect, $sJam);

	if (!$eJam) {
		$stat =  false;
		$msg =  'failed to delete tb1_setting2 ,' . mysqli_error($dbconnect);
	} else {
		// hapus master jam 
		$sKary = 'UPDATE tb_id SET id_divisi=NULL WHERE id_divisi=' . $id;
		$eKary = mysqli_query($dbconnect, $sKary);
		if (!$eKary) {
			$stat =  false;
			$msg =  'failed to update tb_id ,' . mysqli_error($dbconnect);
		} else {
			$query = "DELETE  FROM `tb2_setting` WHERE id='" . $id . "'";
			$sql = mysqli_query($dbconnect, $query);
			$msg = $sql ? 'berhasil menghapus data' : 'failed,' . mysqli_error($dbconnect);
			$stat = $sql ? true : false;
		}
	}
	$ret = json_encode(['status' => $stat, 'msg' => $msg]);
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
	echo json_encode($ret);
}

function UpdateStatus($id_sub)
{
	global $dbconnect;

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

// pr($_GET);
if (isset($_POST['insert'])) {
	Insert();
} else if (isset($_POST['update'])) {
	Update();
} else if (isset($_GET['delete'])) {
	Delete($_GET['id']);
} else if (isset($_GET['update_status'])) {
	UpdateStatus($_GET['id']);
} else if (isset($_GET['get_master'])) {
	GetMaster($_GET['id']);
}
