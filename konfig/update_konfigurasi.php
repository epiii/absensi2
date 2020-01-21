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
} elseif (isset($_REQUEST['update_konfigurasi_jam']) && isset($_SESSION['page'])) {
	if (isset($_POST['ajax'])) {
		require_once '../konfig/connection.php';
		require_once '../konfig/dev.php';
		require_once '../func/func_absensi.php';

		$id = $_POST['id'];
		$id_divisi = $_POST['id_divisi'];
		$jam_keluar = $_POST['jam_keluar'];
		$jam_masuk = $_POST['jam_masuk'];

		$no = $jam_masuk == '' ? '2' : '1';
		$jam = $jam_masuk == '' ? $jam_keluar : $jam_masuk;
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
		$batas1 = $_POST['batas1'];
		$batas2 = $_POST['batas2'];

		if (isset($_POST['id']) && $_POST['id'] != '') { // edit 
			$query = 'UPDATE tb1_setting2 SET 
						param ="' . $param_sub . '",
						value ="' . $value_sub . '"
						WHERE id=' . $id_sub;
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
	} else {
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
