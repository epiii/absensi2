<?php

require 'connection.php'; 
// require 'dev.php';

//=====================================Load Settings From Datbase=======================================
$sql= mysqli_query($dbconnect, "SELECT * FROM tb_settings");
while($data = mysqli_fetch_array($sql)){
	$masuk_mulai = $data['masuk_mulai'];
	$masuk_akhir = $data['masuk_akhir'];
	$keluar_mulai = $data['keluar_mulai'];
	$keluar_akhir = $data['keluar_akhir'];
	$libur1 = $data['libur1'];
	$libur2 = $data['libur2'];
	$timezone = $data['timezone'];
	$email = $data['email'];
	$pwdemail = $data['pwdemail'];
	$admin_uid = $data['admin_uid'];
}
// pr($masuk_mulai);
//====================================load timezone====================================================
date_default_timezone_set($timezone);
//=====================================Cek Hari Libur================================================
function getday($tanggal){
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);
    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };
}
//=====================================Cek UID di DB==============================================
function uid($id){
	global $dbconnect; 
	$sql = mysqli_query($dbconnect,"select * from tb_id where id='$id'");
	$auth = mysqli_num_rows($sql);
		if($auth > 0){
			return("0");
		}else{ 
			return("1");
		}
}
//=====================================Cek jam absen==============================================
function cektime($time, $m_mulai, $m_akhir, $k_mulai, $k_akhir){

	if($time > $m_mulai && $time < $m_akhir){
		return "in"; //parameter absen masuk
	}
	else if ($time >  $m_akhir && $time < $k_mulai){
		return "terlambat"; //parameter absen masuk terlambat
	}
	else if($time > $k_mulai && $time < $k_akhir){
		return "out"; //parameter absen pulang
	}
	else if($time > $k_akhir){
		return "bolos"; //parameter absen bolos
	}
	else{
		return "bolos"; //parameter tidak diset
	}	

}

//===============================Insert or Update Database Absen==================================
function postdata($uid, $hari_ini, $time, $cek_absen){
	global $dbconnect;
	$sql = mysqli_query($dbconnect,"select * from tb_absen where id='$uid' and date='$hari_ini'");
	$auth = mysqli_num_rows($sql);
		if ($auth > 0){
			if($cek_absen == "in"){
				mysqli_query($dbconnect, "UPDATE tb_absen SET masuk='$time', status = 'B' WHERE id='$uid' AND date='$hari_ini'");
				return("Presensi Masuk");
			}
			else if($cek_absen == "terlambat"){
				mysqli_query($dbconnect, "UPDATE tb_absen SET masuk='$time', status = 'T' WHERE id='$uid' AND date='$hari_ini'");
				return("Presensi Terlambat");
			}
			else if($cek_absen == "out"){
				$cek_masuk = mysqli_query($dbconnect, "select * from tb_absen WHERE id='$uid' AND date='$hari_ini'");
					while($data = mysqli_fetch_array($cek_masuk)){
						$masuk = $data['masuk'];
						$status = $data['status'];
							if($masuk != "" && $status != "T"){
								mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'H' WHERE id='$uid' AND date='$hari_ini'");
								return ("Presensi Hadir");
							}
							else if ($masuk != "" && $status == "T"){
								mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'T' WHERE id='$uid' AND date='$hari_ini'");
								return ("Presensi Terlambat");
							}
							else if ($masuk == "" && $status == "B"){
								mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'B' WHERE id='$uid' AND date='$hari_ini'");
								return ("Presensi Bolos");
							}			
					}	
			}
			else if($cek_absen == "bolos"){
				mysqli_query($dbconnect, "UPDATE tb_absen SET keluar='$time', status = 'B' WHERE id='$uid' AND date='$hari_ini'");
				return ("Presensi Selesai");
			}
			
		}
		else{	
			if($cek_absen == "in"){
				mysqli_query($dbconnect,"INSERT INTO tb_absen VALUES ('$uid','$time','','$hari_ini','B','')");
				return ("Presensi Masuk");
			}
			else if($cek_absen == "terlambat"){
				mysqli_query($dbconnect,"INSERT INTO tb_absen VALUES ('$uid','$time','','$hari_ini','T','')");
				return ("Presensi Terlambat");
			}
			else if($cek_absen == "out"){
				mysqli_query($dbconnect,"INSERT INTO tb_absen VALUES ('$uid','','$time','$hari_ini','B','')");
				return ("Presensi Keluar");
			}
			else if($cek_absen == "bolos"){
				mysqli_query($dbconnect,"INSERT INTO tb_absen VALUES ('$uid','','$time','$hari_ini','B','')");
				return ("Presensi Bolos");
			}
		}
		mysqli_close($dbconnect);
}

?>