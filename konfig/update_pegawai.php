<?php
require_once './dev.php';
require_once 'connection.php';

if (isset($_POST['update_pegawai'])) {

	$id = $_POST['id'];
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

	// $tag = $_POST['tag'];
	// $no_induk = $_POST['no_induk'];
	// $kode_pos = $_POST['kode_pos'];
	// $goldar = $_POST['goldar'];
	// $pendidikan = $_POST['pendidikan'];
	// $gelar = $_POST['gelar'];
	// $no_sk = $_POST['no_sk'];
	// $norek = $_POST['norek'];
	// $status = $_POST['status'];
	// $created_at = $_POST['created_at'];
	// $created_by = $_POST['created_by'];

		// `tag`='$tag',
	$query = "UPDATE `tb1_karyawan` SET
		`nama`='$nama',
		`id_jabatan`='$jabatan',
		`jenis_kelamin`='$jenis_kelamin',
		`tanggal_lahir`='$tanggal_lahir',
		`no_hp`='$no_hp',
		`alamat`='$alamat',
		`kota`='$kota',
		`provinsi`='$provinsi',
		`email`='$email',
		`id_agama`='$agama',
		`id_status_kawin`='$status_kawin',
		`id_divisi`='$divisi',
		`nip`='$nip',
		`id_kategori_karyawan`='$kategori_karyawan',
		`npwp`='$npwp'
	WHERE id='" . $id."'";
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
