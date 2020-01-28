<?php
require_once './dev.php';
require_once 'connection.php';

if (isset($_POST['add_pegawai'])) {

	// $username = mysql_real_escape_string(trim($_POST['username']));
	// $password = mysql_real_escape_string(trim($_POST['password']));

	$id = $_POST['id'];
	$uid = $_POST['uid'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$provinsi = $_POST['provinsi'];
	$email = $_POST['email'];
	$agama = $_POST['agama'];
	$status_kawin = $_POST['status_kawin'];
	$divisi = $_POST['divisi'];
	$nip = $_POST['nip'];
	$kategori_karyawan = $_POST['kategori_karyawan'];
	$npwp = $_POST['npwp'];

	// -- $query = "INSERT INTO `tb1_karyawan` (
	$query = "INSERT INTO `tb_id` (
		`uid`,
		`nama`,
		`id_jabatan`,
		`jenis_kelamin`,
		`tanggal_lahir`,
		`no_hp`,
		`alamat`,
		`kota`,
		`provinsi`,
		`email`,
		`id_agama`,
		`id_status_kawin`,
		`id_divisi`,
		`nip`,
		`id_kategori_karyawan`,
		`npwp`
	)
	VALUES (
		'$uid',
		'$nama',
		'$jabatan',
		'$jenis_kelamin',
		'$tanggal_lahir',
		'$no_hp',
		'$alamat',
		'$kota',
		'$provinsi',
		'$email',
		'$agama',
		'$status_kawin',
		'$divisi',
		'$nip',
		'$kategori_karyawan',
		'$npwp'
	)";

	// pr($query);
	// vd($query);
	$sql = mysqli_query($dbconnect, $query);
	if ($sql) {
		$error = 'false';
	} else {
		$error = 'true';
	}
} else {
	$error = 'true';
}
header("location:../index.php?page=pegawai&error=" . $error);
