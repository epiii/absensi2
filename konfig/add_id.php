<?php
include 'function.php';
include 'dev.php';

// pr($_POST);
if (isset($_POST['status']) && isset($_POST['id'])) {

	$status = trim($_POST['status']);
	$tag = trim($_POST['id']);
	// $status = mysql_real_escape_string(trim($_POST['status']));
	// $tag = mysql_real_escape_string(trim($_POST['id']));


	if ($status ==  "cek_admin" && $tag == $admin_uid) {
		echo "Xx23er4tXWhz"; //Administrator OK
	} else if ($status == "Xx23er4tXWhz" && $tag != "") {
		if (uid($tag) == '1') {
			$query = 'INSERT INTO tb_id SET 
					uid ="' . $tag . '",
					notifikasi ="1"';
			$sql = mysqli_query($dbconnect, $query);
			// $sql = mysqli_query($dbconnect, "INSERT INTO tb_id VALUES ('$tag','','','1')");
			echo $sql ? 'ID ditambahkan' : 'gagal,' . mysqli_error($dbconnect);
		} else {
			echo 'UID sudah terdaftar';
		}
	} else {
		echo '1';
	}
} else {
	echo 'ss';
}
mysqli_close($dbconnect);
