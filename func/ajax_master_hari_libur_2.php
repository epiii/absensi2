<?php
require_once '../konfig/connection.php';
require_once '../konfig/dev.php';

function Update()
{
	global $dbconnect;
	$id_param = $_POST['id_param'];
	$value_sub = $_POST['value_sub'];
	$id_parent = $_POST['id_parent'];

	if (isset($id_param) && $id_param != '' && isset($value_sub)) { // edit 
		$sd = 'DELETE FROM tb2_setting WHERE param =' . $id_param . ' AND id_parent =' . $id_parent;
		$ed = mysqli_query($dbconnect, $sd);
		$status = false;
		if ($ed) {
			foreach ($value_sub as $k => $v) {
				$ss = 'INSERT INTO tb2_setting SET 
								param ="' . $id_param . '",
								id_parent ="' . $id_parent . '",
								value ="' . $v . '"';
				$ee = mysqli_query($dbconnect, $ss);
				// pr($ee);
				$status = $ee ? true : false;
				$msg = $ee ? 'berhasil menyimpan data' : 'gagal,' . mysqli_error($dbconnect);
			}
			// exit();
		}
		$ret = ['status' => $status, 'msg' => $msg];
	} else { // add 
		$ret = ['status' => false, 'msg' => 'gagal, invalid method post/get request'];
	}
	echo json_encode($ret);
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
	$ss = '	SELECT
				d.id_divisi,
				d.nama_divisi,
				GROUP_CONCAT(l.hari) hari
			FROM
				vw_divisi d
				LEFT JOIN vw_hari_libur_2 l ON d.id_divisi = l.id_divisi
			WHERE d.id_divisi = ' . $id . '
			GROUP BY
				l.id_divisi
			ORDER BY
				d.nama_divisi';
	// pr($ss);
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

// pr($_POST);
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
