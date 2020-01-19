<?php
session_start();
require_once './dev.php';

if (isset($_SESSION['page'])) {

	if (isset($_POST['id'])) {
		include 'connection.php';
		$id = trim($_POST['id']);
		$value = trim($_POST['value']);
		// $id = mysql_real_escape_string(trim($_POST['id']));
		// $parameter = mysql_real_escape_string(trim($_POST['param']));

		$kolom = "";
		$query = 'UPDATE tb2_setting SET 
					value ="' . $value . '"
					WHERE id=' . $id;

					// vd($query);
		$sql = mysqli_query($dbconnect, $query);

		if ($sql) {
			header("location:../index.php?page=konfigurasi");
		} else {
			header("location:../index.php?page=konfigurasi&error=true");
		}
	} else {
		header("location:../index.php?page=konfigurasi&error=true");
	}
} else {
	header("location:../index.php?page=konfigurasi&error=true");
}
