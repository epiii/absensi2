SELECT
	k.tag,
	k.nama,
	k.nip,
	d.telat,
	cast(d.telat as INT),
	if(cast(d.telat as INT)<30,'ada','gakk'),
	CAST(d.persen  as FLOAT)persen_30,
	if(CAST(d.persen  as FLOAT)>0,'telu','')persen_30,
	d.tanggal, 
	d.jam, 
	d.keterangan
FROM
	karyawan k
LEFT JOIN DATA d ON d.tag = k.tag

WHERE
	MONTH (STR_TO_DATE(d.tanggal, '%d-%m-%Y')) = 6 
	and k.tag =8919414280
	and d.keterangan='Masuk'
ORDER BY
	k.nama ASC