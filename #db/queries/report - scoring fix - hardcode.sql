SELECT 
	tb_accum.*
-- 	,tb_accum.persen
from(
	SELECT
		k.tag,
		k.nama,
		dv.id id_divisi,
		dv.kode_divisi,
		dv.nama_divisi,
	-- 	k.nip,
		sum(if(cast(d.telat as INT)>5 and cast(d.telat as INT)<=30,1,0))telat_30,
		sum(if(cast(d.telat as INT)>30 and cast(d.telat as INT)<=60,1,0))telat_60,
		sum(if(cast(d.telat as INT)>60 and cast(d.telat as INT)<=120,1,0))telat_120,
		sum(if(cast(d.telat as INT)>120,1,0))telat_max,
		s2.persen1 persen_30,
		s2.persen2 persen_60,
		s2.persen3 persen_120,
		s2.persen4 persen_max,
		
-- 		DISTINCT(d.persen)persen_30,
-- 		sum(if(cast(d.persen as FLOAT)>0,'ada',0))persen_30,
	-- 	d.persen,
	-- 	d.tanggal,
		COUNT(*)tot_presensi,
	-- 	STR_TO_DATE(d.tanggal, '%d-%m-%Y')datex,
		MONTH (STR_TO_DATE(d.tanggal, '%d-%m-%Y'))monthx
	FROM
		karyawan k
	LEFT JOIN DATA d ON d.tag = k.tag
	LEFT JOIN divisi dv on dv.kode_divisi = k.divisi
 	LEFT JOIN setting2 s2 on s2.tag = k.divisi
	WHERE
		MONTH (STR_TO_DATE(d.tanggal, '%d-%m-%Y')) = 6 
		and k.tag = "8919414280"
		and d.keterangan="Masuk"
		and s2.no=1
	GROUP BY
		k.tag
	ORDER BY
		k.nama ASC
) tb_accum 