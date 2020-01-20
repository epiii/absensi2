<?php
session_start();
require_once './dev.php';
if (isset($_REQUEST['update_konfigurasi_status']) && isset($_SESSION['page'])) {
	if (isset($_POST['ajax'])) {
		require_once '../konfig/connection.php';
		require_once '../konfig/dev.php';
		require_once '../func/func_absensi.php';

		$id_sub = $_POST['id'];

		$s = 'select isActive from tb2_setting where id=' . $id_sub;
		$e = mysqli_query($dbconnect, $s);
		$r = mysqli_fetch_assoc($e);

		$query = 'UPDATE tb2_setting SET 
					isActive ="' . ($r['isActive'] == '1' ? '0' : '1') . '"
					WHERE id=' . $id_sub;

		$exe = mysqli_query($dbconnect, $query);
		$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
		$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
		echo $ret;
	} else {
		include 'connection.php';
		$id = trim($_POST['id']);
		$value = trim($_POST['value']);
		$query = 'UPDATE tb2_setting SET 
					value ="' . $value . '"
					WHERE id=' . $id;
		$sql = mysqli_query($dbconnect, $query);

		if ($sql) {
			header("location:../index.php?page=konfigurasi");
		} else {
			header("location:../index.php?page=konfigurasi&error=true");
		}
	}
} else if (isset($_REQUEST['update_konfigurasi']) && isset($_SESSION['page'])) {
	if (isset($_POST['ajax'])) {
		require_once '../konfig/connection.php';
		require_once '../konfig/dev.php';
		require_once '../func/func_absensi.php';

		$id_sub = $_POST['id_sub'];
		$param_sub = $_POST['param_sub'];
		$value_sub = $_POST['value_sub'];

		pr($_POST);
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
	} else {
		include 'connection.php';
		$id = trim($_POST['id']);
		$value = trim($_POST['value']);
		$query = 'UPDATE tb2_setting SET 
					value ="' . $value . '"
					WHERE id=' . $id;
		$sql = mysqli_query($dbconnect, $query);

		if ($sql) {
			header("location:../index.php?page=konfigurasi");
		} else {
			header("location:../index.php?page=konfigurasi&error=true");
		}
	}
} else {

	header("location:../index.php?page=konfigurasi&error=true");
}
