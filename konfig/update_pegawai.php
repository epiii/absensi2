<?php
require_once './dev.php';
require_once 'connection.php';

if (isset($_POST['update_pegawai'])) {

	$no = $_POST['no'];
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

	$query = "UPDATE `tb1_karyawan` SET
		`no`='$no',
		`tag`='$tag',
		`nama`='$nama',
		`jabatan`='$jabatan',
		`jenis_kelamin`='$jenis_kelamin',
		`tanggal_lahir`='$tanggal_lahir',
		`no_hp`='$no_hp',
		`alamat`='$alamat',
		`kota`='$kota',
		`provinsi`='$provinsi',
		`email`='$email',
		`agama`='$agama',
		`status_kawin`='$status_kawin',
		`divisi`='$divisi',
		`nip`='$nip',
		`kategori_karyawan`='$kategori_karyawan',
		`npwp`='$npwp'
	WHERE no ='" . $no."'";
	// pr($query);

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
