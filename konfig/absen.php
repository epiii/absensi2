<?php
if(isset($_POST['id'])){
	include 'function.php';
	$uid = mysql_real_escape_string(trim($_POST['id']));
	$hari_ini = date('Y-m-d');
	$day = getday($hari_ini);
	
	if($day == $libur1 || $day == $libur2){
		echo "Hari Libur";
	}else{
		$cek_uid = uid($uid);
		if($cek_uid == "0"){
			$time = date('H:i:s');
			$cek_absen = cektime($time, $masuk_mulai, $masuk_akhir, $keluar_mulai, $keluar_akhir); 
			$simpan_absen = postdata($uid, $hari_ini, $time, $cek_absen); 
			echo $simpan_absen;
			}else{
			echo "ID Tidak Ada";
		}
	}

}else{
	echo "Coba Lagi";
}
?>