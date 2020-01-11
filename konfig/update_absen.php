<?php
session_start();
if(isset($_SESSION['page'])){

if(isset($_POST['id']) && isset($_POST['status']) && isset($_POST['flag'])){

	include 'connection.php';
	$id = mysql_real_escape_string(trim($_POST['id']));
	$tanggal = mysql_real_escape_string(trim($_POST['tanggal']));
	$status = mysql_real_escape_string(trim($_POST['status']));
	$keterangan = mysql_real_escape_string(trim($_POST['keterangan']));
	$flag = mysql_real_escape_string(trim($_POST['flag']));
	$error = "false";

	if($flag == '0'){
		$sql = mysqli_query($dbconnect, "UPDATE tb_absen SET status='$status', keterangan='$keterangan' WHERE date='$tanggal' AND id='$id'");
	}else{
		$sql = mysqli_query($dbconnect,"INSERT INTO tb_absen VALUES ('$id','-','-','$tanggal','$status','$keterangan')");
	}

	if($sql){
		$error = "false";
	}else{
		$error= "true";
	}

}else{
	$error = "true";
}

}else{
	$error = "true";
}
header("location:../index.php?page=absensi&error=".$error);
?>