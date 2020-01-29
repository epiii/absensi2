<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
	require 'dev.php';
	include 'connection.php';
	// pr($_REQUEST);

	$username = $_POST['username'];
	$password = $_POST['password'];
	// $username = mysql_real_escape_string(trim($_POST['username']));
	// $password = mysql_real_escape_string(trim($_POST['password']));
	$role = $_POST['role'];
	$id_karyawan = $_POST['id_karyawan'];

	// if ($role == 'Admin') {
	// 	$role = '0';
	// }

	if ($role == '1') { // user
		$ss = 'SELECT *
			FROM tb_pengguna
			WHERE
				level = "1" 
				and id_karyawan = "' . $id_karyawan . '"';
		$ee = mysqli_query($dbconnect, $ss);
		$nn = mysqli_num_rows($ee);

		if ($nn > 0) {
			$out = ['msg' => 'pegawai sudah mempunyai user login', 'status' => false];
		} else {
			$query = "INSERT INTO tb_pengguna(username, password, level, id_karyawan) VALUES ('$username', '$password', '$role','$id_karyawan')";
			// pr($query);
			$sql = mysqli_query($dbconnect, $query);

			if ($sql) {
				$out = ['msg' => 'berhasil menyimpan data', 'status' => true];
			} else {
				$out = ['msg' => 'gagal, ' . mysqli_error($dbconnect), 'status' => false];
			}
		}
	} else { // admin 
		$query = "INSERT INTO tb_pengguna(username, password, level) VALUES ('$username', '$password', '$role')";
		$sql = mysqli_query($dbconnect, $query);

		if ($sql) {
			$out = ['msg' => 'berhasil menyimpan data', 'status' => true];
		} else {
			$out = ['msg' => 'gagal, ' . mysqli_error($dbconnect), 'status' => false];
		}
	}
} else {
	$out = ['msg' => 'unauthorized, method is invalid', 'status' => false];
	// $error = 'true';
}
echo json_encode($out);
// header("location:../index.php?page=pengguna&error=" . $error);
