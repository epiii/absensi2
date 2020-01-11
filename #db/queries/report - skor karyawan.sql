SELECT
	k.tag,
	k.nama,

-- 	k.nip,
	sum(if(cast(d.telat as INT)>5 and cast(d.telat as INT)<=30,1,0))telat_30,
	sum(if(cast(d.telat as INT)>30 and cast(d.telat as INT)<=60,1,0))telat_60,
	sum(if(cast(d.telat as INT)>60 and cast(d.telat as INT)<=120,1,0))telat_120,
	sum(if(cast(d.telat as INT)>120,1,0))telat_max,
-- 	d.persen,
-- 	d.tanggal,
	COUNT(*)tot_presensi,
-- 	STR_TO_DATE(d.tanggal, '%d-%m-%Y')datex,
	MONTH (STR_TO_DATE(d.tanggal, '%d-%m-%Y'))monthx
FROM
	karyawan k
LEFT JOIN DATA d ON d.tag = k.tag
WHERE
	MONTH (STR_TO_DATE(d.tanggal, '%d-%m-%Y')) = 6 AND
	k.tag = "8666223115"
GROUP BY
	k.tag
ORDER BY
	k.nama ASC