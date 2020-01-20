<?php
session_start();
require_once './dev.php';
require_once 'connection.php';

if (isset($_SESSION['page'])) {
	if (isset($_POST['id'])) {
		$query = "DELETE  FROM `tb2_setting` WHERE id='" . $_POST['id'] . "'";
		$sql = mysqli_query($dbconnect, $query);
		$msg = $sql ? 'berhasil menghapus data' : 'failed,' . mysqli_error($dbconnect);
		$out = ['status' => $sql ? true : false, 'msg' => $msg];
	} else {
		$out = ['status' => false, 'msg' => 'hak akses ditolak'];
	}
} else {
	$out = ['status' => false, 'msg' => 'session habis'];
}
echo json_encode($out);
