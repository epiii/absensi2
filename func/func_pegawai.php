<?php

require_once './konfig/connection.php';
// include './konfig/function.php';
// var_dump($dbconnect);
// exit();

function GetAll()
{
	global $dbconnect;
	$query = "SELECT a.*, b.nama_jabatan as nama_jabatan, c.nama_divisi as nama_divisi FROM karyawan a left join jabatan b on a.jabatan = b.kode_jabatan left join divisi c on a.divisi = c.kode_divisi";
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'no' => $data['no'],
			'tag' => $data['tag'],
			'nama' => $data['nama'],
			'jabatan' => $data['nama_jabatan'],
			'jenis_kelamin' => $data['jenis_kelamin'],
			'no_induk' => $data['no_induk'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'no_hp' => $data['no_hp'],
			'alamat' => $data['alamat'],
			'kota' => $data['kota'],
			'provinsi' => $data['provinsi'],
			'kode_pos' => $data['kode_pos'],
			'email' => $data['email'],
			'goldar' => $data['goldar'],
			'agama' => $data['agama'],
			'status_kawin' => $data['status_kawin'],
			'divisi' => $data['nama_divisi'],
			'pendidikan' => $data['pendidikan'],
			'gelar' => $data['gelar'],
			'no_sk' => $data['no_sk'],
			'nip' => $data['nip'],
			'kategori_karyawan' => $data['kategori_karyawan'],
			'npwp' => $data['npwp'],
			'norek' => $data['norek'],
			'status' => $data['status'],
			'created_at' => $data['created_at'],
			'created_by' => $data['created_by'],

		);
	}
	return $datas;
}

function GetOne($id)
{
	// vd($id);
	global $dbconnect;
	$query = "SELECT * FROM  `tb1_karyawan` WHERE  `id` =  '$id'";
	$exe = mysqli_query($dbconnect, $query);
	$data = mysqli_fetch_assoc($exe);
	// $tgl = $data['tanggal_lahir'];
	// $tglx = explode('-', $tgl);
	$res = array(
		'id' => $data['id'],
		'tag' => $data['tag'],
		'nama' => $data['nama'],
		'id_jabatan' => $data['id_jabatan'],
		'jenis_kelamin' => $data['jenis_kelamin'],
		'no_induk' => $data['no_induk'],
		'tanggal_lahir' => $data['tanggal_lahir'],
		// 'tanggal_lahir' => $tglx[2].'/'.$tglx[1].'/'.$tglx[0],
		'no_hp' => $data['no_hp'],
		'alamat' => $data['alamat'],
		'kota' => $data['kota'],
		'provinsi' => $data['provinsi'],
		'kode_pos' => $data['kode_pos'],
		'email' => $data['email'],
		'goldar' => $data['goldar'],
		'id_agama' => $data['id_agama'],
		'id_status_kawin' => $data['id_status_kawin'],
		'id_divisi' => $data['id_divisi'],
		'pendidikan' => $data['pendidikan'],
		'gelar' => $data['gelar'],
		'no_sk' => $data['no_sk'],
		'nip' => $data['nip'],
		'id_kategori_karyawan' => $data['id_kategori_karyawan'],
		'npwp' => $data['npwp'],
		'norek' => $data['norek'],
		'status' => $data['status'],
		'created_at' => $data['created_at'],
		'created_by' => $data['created_by'],
	);
	return $res;
}

function GetKaryawan()
{
	global $dbconnect;
	$query = "SELECT no, upper(nama) as nama, tag, nip from `tb1_karyawan`";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'no' => $data['no'],
			'nama' => $data['nama'],
			'tag' => $data['tag'],
			'nip' => $data['nip']
		);
	}
	return $datas;
}

function GetKaryawan2()
{
	global $dbconnect;
	$query = "SELECT * from `tb1_karyawan`";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = $data;
	}
	return $datas;
}

function GetKatKaryawan()
{
	global $dbconnect;
	$query = "SELECT * FROM  `tb1_kategori_karyawan`";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'ID' => $data['ID'],
			'kode_katkaryawan' => $data['kode_katkaryawan'],
			'nama_katkaryawan' => $data['nama_katkaryawan']
		);
	}
	return $datas;
}

function GetKatKaryawan2()
{
	global $dbconnect;
	$query = "	SELECT *
		FROM
			tb2_setting
		WHERE
			id_parent= (
				SELECT id from tb2_setting where param =LOWER('kategori_karyawan')
			)";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'id' => $data['id'],
			'kode_katkaryawan' => $data['param'],
			'nama_katkaryawan' => $data['value']
		);
	}
	return $datas;
}

function GetProvinsi2()
{
	global $dbconnect;
	$query = "	SELECT *
		FROM
			tb2_setting
		WHERE
			id_parent= (
				SELECT id from tb2_setting where param =LOWER('provinsi')
			)";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'ID' => $data['id'],
			'kode_provinsi' => $data['param'],
			'nama_provinsi' => $data['value']
		);
	}
	return $datas;
}

function GetJabatan()
{
	global $dbconnect;
	$query = "SELECT * FROM  `tb1_jabatan`";
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'ID' => $data['ID'],
			'kode_jabatan' => $data['kode_jabatan'],
			'nama_jabatan' => $data['nama_jabatan']
		);
	}
	return $datas;
}

function GetJabatan2()
{
	global $dbconnect;
	$query = "	SELECT *
				FROM vw_jabatan
				WHERE isActive=1";
	// $query = "	SELECT *
	// 			FROM
	// 				tb2_setting
	// 			WHERE
	// 				id_parent= (
	// 					SELECT id from tb2_setting where param =LOWER('jabatan')
	// 				)";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'id' => $data['id_jabatan'],
			'kode_jabatan' => $data['kode_jabatan'],
			'nama_jabatan' => $data['nama_jabatan'],

			// 'id' => $data['id'],
			// 'kode_jabatan' => $data['param'],
			// 'nama_jabatan' => $data['value']
		);
	}
	return $datas;
}


function GetAgama()
{
	global $dbconnect;
	$query = "SELECT * FROM  `tb1_agama`";
	// $query = "SELECT * FROM  `agama`";
	$exe = mysqli_query($dbconnect, $query);
	// var_dump($$dbconnect);
	// exit();
	//   $$dbconnect = mysqli_query(Connect(),$query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'ID' => $data['ID'],
			'kode_agama' => $data['kode_agama'],
			'nama_agama' => $data['nama_agama']
		);
	}
	return $datas;
}

function GetAgama2()
{
	global $dbconnect;
	$query = "	SELECT *
				FROM vw_agama
				WHERE isActive=1";
	// $query = "	SELECT *
	// 			FROM
	// 				tb2_setting
	// 			WHERE
	// 				id_parent= (
	// 					SELECT id from tb2_setting where param ='agama'
	// 				)";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'id' => $data['id_agama'],
			'kode_agama' => $data['kode_agama'],
			'nama_agama' => $data['nama_agama']
			// 'id' => $data['id'],
			// 'kode_agama' => $data['param'],
			// 'nama_agama' => $data['value']
		);
	}
	return $datas;
}

function GetStatus()
{
	global $dbconnect;
	// var_dump($dbconnect);
	$query = "SELECT * FROM  tb1_status_pernikahan";
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'ID' => $data['ID'],
			'kode_nikah' => $data['kode_nikah'],
			'keterangan' => $data['keterangan']
		);
	}
	return $datas;
}

function GetStatus2()
{
	global $dbconnect;
	$query = "	SELECT *
		FROM
			tb2_setting
		WHERE
			id_parent= (
				SELECT id from tb2_setting where param =LOWER('status_pernikahan')
			)";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'id' => $data['id'],
			'kode_nikah' => $data['param'],
			'keterangan' => $data['value']
		);
	}
	return $datas;
}

function GetDivisi()
{
	global $dbconnect;
	$query = "SELECT * FROM  `tb1_divisi`";
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'ID' => $data['ID'],
			'kode_divisi' => $data['kode_divisi'],
			'nama_divisi' => $data['nama_divisi']
		);
	}
	return $datas;
}

function GetDivisi2()
{
	global $dbconnect;
	$query = "	SELECT *
		FROM
			tb2_setting
		WHERE
			id_parent= (
				SELECT id from tb2_setting where param =LOWER('Divisi')
			)";
	$exe = mysqli_query($dbconnect, $query);
	while ($data = mysqli_fetch_assoc($exe)) {
		$datas[] = array(
			'id' => $data['id'],
			'kode_divisi' => $data['param'],
			'nama_divisi' => $data['value']
		);
	}
	return $datas;
}

function Insert()
{
	global $dbconnect;
	$tag = $_POST['tag'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_induk = $_POST['no_induk'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$provinsi = $_POST['provinsi'];
	$kode_pos = $_POST['kode_pos'];
	$email = $_POST['email'];
	$goldar = $_POST['goldar'];
	$agama = $_POST['agama'];
	$status_kawin = $_POST['status_kawin'];
	$divisi = $_POST['divisi'];
	$pendidikan = $_POST['pendidikan'];
	$gelar = $_POST['gelar'];
	$no_sk = $_POST['no_sk'];
	$nip = $_POST['nip'];
	$kategori_karyawan = $_POST['kategori_karyawan'];
	$npwp = $_POST['npwp'];
	$norek = $_POST['norek'];
	$status = $_POST['status'];
	$created_at = $_POST['created_at'];
	$created_by = $_POST['created_by'];

	$query = "INSERT INTO `karyawan` (`no`,`tag`,`nama`,`jabatan`,`jenis_kelamin`,`no_induk`,`tanggal_lahir`,`no_hp`,`alamat`,`kota`,`provinsi`,`kode_pos`,`email`,`goldar`,`agama`,`status_kawin`,`divisi`,`pendidikan`,`gelar`,`no_sk`,`nip`,`kategori_karyawan`,`npwp`,`norek`,`status`,`created_at`,`created_by`)
VALUES (NULL,'$tag','$nama','$jabatan','$jenis_kelamin','$no_induk','$tanggal_lahir','$no_hp','$alamat','$kota','$provinsi','$kode_pos','$email','$goldar','$agama','$status_kawin','$divisi','$pendidikan','$gelar','$no_sk','$nip','$kategori_karyawan','$npwp','$norek','$status','$created_at','$created_by')";
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	if ($exe) {
		// kalau berhasil
		$_SESSION['message'] = " Data Sudah disimpan ";
		$_SESSION['mType'] = "success ";
		echo "<script>window.location.href = '?page=karyawan/index';</script>";
	} else {
		$_SESSION['message'] = " Data Gagal disimpan ";
		$_SESSION['mType'] = "danger ";
		echo "<script>window.location.href = '?page=karyawan/index';</script>";
	}
}
function Update($id)
{
	global $dbconnect;
	$tag = $_POST['tag'];
	$nama = $_POST['nama'];
	$jabatan = $_POST['jabatan'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_induk = $_POST['no_induk'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$kota = $_POST['kota'];
	$provinsi = $_POST['provinsi'];
	$kode_pos = $_POST['kode_pos'];
	$email = $_POST['email'];
	$goldar = $_POST['goldar'];
	$agama = $_POST['agama'];
	$status_kawin = $_POST['status_kawin'];
	$divisi = $_POST['divisi'];
	$pendidikan = $_POST['pendidikan'];
	$gelar = $_POST['gelar'];
	$no_sk = $_POST['no_sk'];
	$nip = $_POST['nip'];
	$kategori_karyawan = $_POST['kategori_karyawan'];
	$npwp = $_POST['npwp'];
	$norek = $_POST['norek'];
	$status = $_POST['status'];
	$created_at = $_POST['created_at'];
	$created_by = $_POST['created_by'];

	$query = "UPDATE `karyawan` SET `tag` = '$tag',`nama` = '$nama',`jabatan` = '$jabatan',`jenis_kelamin` = '$jenis_kelamin',`no_induk` = '$no_induk',`tanggal_lahir` = '$tanggal_lahir',`no_hp` = '$no_hp',`alamat` = '$alamat',`kota` = '$kota',`provinsi` = '$provinsi',`kode_pos` = '$kode_pos',`email` = '$email',`goldar` = '$goldar',`agama` = '$agama',`status_kawin` = '$status_kawin',`divisi` = '$divisi',`pendidikan` = '$pendidikan',`gelar` = '$gelar',`no_sk` = '$no_sk',`nip` = '$nip',`kategori_karyawan` = '$kategori_karyawan',`npwp` = '$npwp',`norek` = '$norek',`status` = '$status',`created_by` = '$created_by' WHERE  `no` =  '$id'";
	// echo $query;
	// exit;
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	if ($exe) {
		// kalau berhasil
		$_SESSION['message'] = " Data Sudah diubah ";
		$_SESSION['mType'] = "success ";
		echo "<script>window.location.href = '?page=karyawan/index';</script>";
	} else {
		$_SESSION['message'] = " Data Gagal diubah ";
		$_SESSION['mType'] = "danger ";
		echo "<script>window.location.href = '?page=karyawan/index';</script>";
	}
}
function Delete($id)
{
	global $dbconnect;
	$query = "DELETE FROM `karyawan` WHERE `no` = '$id'";
	$exe = mysqli_query($dbconnect, $query);
	// $exe = mysqli_query(Connect(), $query);
	if ($exe) {
		// kalau berhasil
		$_SESSION['message'] = " Data Sudah dihapus ";
		$_SESSION['mType'] = "success ";
		echo "<script>window.location.href = '?page=karyawan/index';</script>";
	} else {
		$_SESSION['message'] = " Data Gagal dihapus ";
		$_SESSION['mType'] = "danger ";
		echo "<script>window.location.href = '?page=karyawan/index';</script>";
	}
}


if (isset($_POST['insert'])) {
	Insert();
} else if (isset($_POST['update'])) {
	Update($_POST['ID']);
} else if (isset($_POST['delete'])) {
	Delete($_POST['ID']);
} else if (isset($_GET['karyawan_absensi'])) {
	pr('masuk');
	GetKaryawanAbsensi();
	// Delete($_POST['ID']);
}
