<?php
require_once './dev.php';
require_once 'connection.php';

if (isset($_POST['submit_pegawai'])) {

	// $username = mysql_real_escape_string(trim($_POST['username']));
	// $password = mysql_real_escape_string(trim($_POST['password']));

	// [tag] => 3
	// [nama] => 3
	// [tanggal] => 
	// [jenis_kelamin] => 1
	// [agama] => 01
	// [status_kawin] => 02
	// [divisi] => 02
	// [no_hp] => 22
	// [alamat] => 33
	// [kota] => 11
	// [provinsi] => 44
	// [email] => 55
	// [nip] => 44
	// [jabatan] => 02
	// [kategori_karyawan] => 02
	// [npwp] => 1234

	$tag = $_POST['tag'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	// $no_induk = $_POST['no_induk'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$provinsi = $_POST['provinsi'];
	// $kode_pos = $_POST['kode_pos'];
	$email = $_POST['email'];
	// $goldar = $_POST['goldar'];
	$agama = $_POST['agama'];
	$status_kawin = $_POST['status_kawin'];
	$divisi = $_POST['divisi'];
	// $pendidikan = $_POST['pendidikan'];
	// $gelar = $_POST['gelar'];
	// $no_sk = $_POST['no_sk'];
	$nip = $_POST['nip'];
	$kategori_karyawan = $_POST['kategori_karyawan'];
	$npwp = $_POST['npwp'];
	// $norek = $_POST['norek'];
	// $status = $_POST['status'];
	// $created_at = $_POST['created_at'];
	// $created_by = $_POST['created_by'];

	$query = "INSERT INTO `tb1_karyawan` (
		`no`,
		`tag`,
		`nama`,
		`jabatan`,
		`jenis_kelamin`,
		`tanggal_lahir`,
		`no_hp`,
		`alamat`,
		`kota`,
		`provinsi`,
		`email`,
		`agama`,
		`status_kawin`,
		`divisi`,
		`nip`,
		`kategori_karyawan`,
		`npwp`
	)
	VALUES (
		NULL,
		'$tag',
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
	// -- `no_induk`,
	// -- `kode_pos`,
	// -- `goldar`,
	// -- `pendidikan`,
	// -- `gelar`,
	// -- `no_sk`,
	// -- `norek`,
	// -- `status`,
	// -- `created_at`,
	// -- `created_by`

	// -- '$no_induk',
	// -- '$kode_pos',
	// -- '$goldar',
	// -- '$pendidikan',
	// -- '$gelar',
	// -- '$no_sk',
	// -- '$norek',
	// -- '$status',
	// -- '$created_at',
	// -- '$created_by'

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
