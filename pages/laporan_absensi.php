<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
require_once './func/func_pegawai.php';
require_once './func/func_absensi.php';

// filter : divisi 
$idArr = isset($_POST['id_divisi']) ?  explode('-', $_POST['id_divisi']) : null;
$id_divisi = isset($_POST['id_divisi']) ? $idArr[0] : '';

// potongan : masuk %/
// pr($_POST);
$mas_per_1 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[1] : '0.25';
$mas_per_2 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[2] : '1';
$mas_per_3 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[3] : '2';
$mas_per_4 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[4] : '2.5';

// potongan :keluar %
$kel_per_1 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[5] : '';
$kel_per_2 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[6] : '';
$kel_per_3 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[7] : '';
$kel_per_4 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[8] : '';

// total pot per kat (masuk )
$per_1_tot = isset($_POST['id_divisi'])  && $_POST['id_divisi'] != '' ? $mas_per_1 + $kel_per_1 : 0;

// filter : tanggal 
$tanggal_awal = (isset($_POST['tanggal_awal'])) ? $_POST['tanggal_awal'] : date('Y-m-01');
$tanggal_akhir = (isset($_POST['tanggal_akhir'])) ? $_POST['tanggal_akhir'] : date('Y-m-t');
$query = 'SELECT
			k.id,
			k.nama,
			k.nip,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk = "1"
			)jml_tel_mas_1
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "1"
			)jml_tel_kel_1
			,(
				SELECT
					count(*) * a.potongan_masuk
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk= "1"
			)jml_pot_mas_1
			,(
				SELECT
					count(*) * a.potongan_keluar
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "1"
			)jml_pot_kel_1
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk = "2"
			)jml_tel_mas_2
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "2"
			)jml_tel_kel_2
			,(
				SELECT
					count(*) * a.potongan_masuk
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk= "2"
			)jml_pot_mas_2
			,(
				SELECT
					count(*) * a.potongan_keluar
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "2"
			)jml_pot_kel_2
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk = "3"
			)jml_tel_mas_3
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "3"
			)jml_tel_kel_3
			,(
				SELECT
					count(*) * a.potongan_masuk
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk= "3"
			)jml_pot_mas_3
			,(
				SELECT
					count(*) * a.potongan_keluar
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "3"
			)jml_pot_kel_3
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk = "4"
			)jml_tel_mas_4
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "4"
			)jml_tel_kel_4
			,(
				SELECT
					count(*) * a.potongan_masuk
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_masuk= "4"
			)jml_pot_mas_4
			,(
				SELECT
					count(*) * a.potongan_keluar
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="H" and 
					a.kat_terlambat_keluar= "4"
			)jml_pot_kel_4
			,(
					SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="A" 
			)jml_tel_mas_5
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan = k.id AND
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" AND
					a. STATUS != "H" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="diklat"
					)
			)jml_tel_diklat
			,(
				SELECT
					count(*) * a.potongan
				FROM
					tb_absen a
				WHERE
					a.id_karyawan = k.id AND
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" AND
					a. STATUS != "H" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="diklat"
					)
			)jml_pot_diklat
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan = k.id AND
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" AND
					a. STATUS != "H" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="skj"
					)
			)jml_tel_skj
			,(
				SELECT
					count(*)*a.potongan
				FROM
					tb_absen a
				WHERE
					a.id_karyawan = k.id AND
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" AND
					a. STATUS != "H" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="skj"
					)
			)jml_pot_skj
			,(
				SELECT
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan = k.id AND
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" AND
					a. STATUS != "H" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="dispensasi"
					)
			)jml_tel_dispensasi
			,(
				SELECT
					count(*) * a.potongan
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status!="H" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="dispensasi"
					)
			)jml_pot_dispensasi
			,(
				SELECT
					count(*) 
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="A" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="harian"
					)
			)jml_tel_alpha
			,(
				SELECT
					count(*) * a.potongan
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="A" AND
					a.id_tipe_presensi = (
						SELECT id_tipepresensi from vw_tipepresensi where kode_tipepresensi ="harian"
					)
			)jml_pot_alpha
		FROM
			tb1_karyawan k';
$query = $id_divisi == '' ? $query : $query . ' WHERE k.id_divisi = "' . $id_divisi . '"';
// pr($query);
$sql = mysqli_query($dbconnect, $query);
$divisi = GetDivisiRule();

?>
<!-- <span class="label label-default">Default</span> -->
<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">LAPORAN PRESENSI</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Data Presensi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>


<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">
			<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Capture</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body text-center">
							<p id="modalTxt"></p>
							<img class="rounded img-fluid" id="modalImg">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>


			<div class="card">
				<div class="card-header " style="height: 82px;">

					<form action="" method="POST">
						<div class="row">
							<div class="col-sm-3">
								<label>Divisi</label>
								<select onchange="this.form.submit()" id="id_divisi" name="id_divisi" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
									<option value="">-Semua Divisi-</option>
									<?php
									foreach ($divisi as $data) { ?>
										<option <?php echo $id_divisi == $data['id'] ? 'selected' : ''; ?> value="<?php echo $data['id'] . '-' . $data['mas_per_1'] . '-' . $data['mas_per_2'] . '-' . $data['mas_per_3'] . '-' . $data['mas_per_4'] . '-' . $data['kel_per_1'] . '-' . $data['kel_per_2'] . '-' . $data['kel_per_3'] . '-' . $data['kel_per_4']; ?>">
											<?php echo '(' . $data['kode_divisi'] . ') ' . $data['nama_divisi']; ?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-3">
								<label>Tanggal Awal</label>
								<input required onchange="this.form.submit()" class="form-control" type="date" value="<?php echo $tanggal_awal ? $tanggal_awal : date('Y-m-d'); ?>" name="tanggal_awal" id="tanggal_awal">
							</div>
							<div class="col-sm-3">
								<label>Tanggal Akhir</label>
								<input required onchange="this.form.submit()" class="form-control" type="date" value="<?php echo $tanggal_akhir ? $tanggal_akhir : date('Y-m-d'); ?>" name="tanggal_akhir" id="tanggal_akhir">
							</div>
							<div class="col-sm-3">
								<label>.</label>
								<button type="submit" class=" form-control btn btn-secondary"><i class="fas fa-search"></i> Tampilkan</button>
							</div>
						</div>
					</form>

					<!-- <div class="row">
						<div class="col-md-6 ">
							<select id="id_tipe_presensi" name="id_tipe_presensi" required onchange="tipePresensiFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
								<option value="">-Semua Divisi-</option>
								<?php
								foreach ($divisi as $data) { ?>
									<option value="<?php echo $data['id']; ?>"><?php echo '(' . $data['kode_divisi'] . ') ' . $data['nama_divisi']; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col-md-6 ">
							<form method="POST">
								<input class="form-control" type="date" value="<?php echo $tanggal_awal ? $tanggal_awal : date('Y-m-d'); ?>" name="tanggal_awal">
								s/d
								<input class="form-control" type="date" value="<?php echo $tanggal_akhir ? $tanggal_akhir : date('Y-m-d'); ?>" name="tanggal_akhir">
								<button type="submit" class="btn btn-light btn-sm mb-1 ml-1"><i class="fas fa-search"></i> Tampilkan</button>
							</form>
						</div>
					</div> -->

				</div>

				<div class="card-body">
					<div class="row mt-2">
						<div class="col-md-12 col-md-offset-2">
							<div class="table table-hover">

								<table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-example" style="width: 100%;">
									<thead>

										<tr>
											<th style="vertical-align:middle" class="text-center bg-secondary" rowspan="3">No.</th>
											<th style="vertical-align:middle" class="text-center bg-secondary" rowspan="3">Nama</th>
											<th style="vertical-align:middle" class="text-center bg-secondary" rowspan="3">NIP</th>
											<th class="text-center bg-warning" colspan="19">Tingkat Ketidakhadiran Berdasarkan Rumus Skor</th>
											<th class="text-center bg-secondary" style="vertical-align:middle" rowspan="3">
												Kehadiran %
											</th>
										</tr>

										<tr class="bg-warning">
											<th class="text-center" colspan="2">05-30 menit</th>
											<th class="text-center" colspan="2">31-60 menit</th>
											<th class="text-center" colspan="2">61-120 menit</th>
											<th class="text-center" colspan="2">>120 menit</th>
											<th class="text-center" colspan="2">TMK 1 hari</th>
											<th class="text-center" colspan="2">Diklat</th>
											<th class="text-center" colspan="2">Tidak SKJ</th>
											<th class="text-center" colspan="2">Tidak Finger</th>
											<th class="text-center" colspan="2">Dispensasi</th>
											<th class="text-center">JML</th>
										</tr>

										<tr class="bg-warning">
											<!-- >5 m  -->
											<th>jml</th>
											<th><?php echo $mas_per_1; ?>%</th>

											<!-- >30 m  -->
											<th>jml</th>
											<th><?php echo $mas_per_2; ?>%</th>

											<!-- >60 m  -->
											<th>jml</th>
											<th><?php echo $mas_per_3; ?>%</th>

											<!-- >120 m  -->
											<th>jml</th>
											<th><?php echo $mas_per_4; ?>%</th>

											<!-- TMK   -->
											<th>jml</th>
											<th>4%</th>

											<!-- diklat -->
											<th>jml</th>
											<th>2%</th>

											<!-- skj -->
											<th>jml</th>
											<th>2%</th>

											<!-- finger -->
											<th>jml</th>
											<th>2%</th>

											<!-- dispen -->
											<th>jml</th>
											<th>3%</th>

											<!-- jml persen : tdk hadir -->
											<th>%</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$no = 0;
										while ($r = mysqli_fetch_assoc($sql)) {
											// harian 
											$jml_tel_1 = $r['jml_tel_mas_1'] + $r['jml_tel_kel_1'];
											$jml_pot_1 = floatval($r['jml_pot_mas_1'] + $r['jml_pot_kel_1']);

											$jml_tel_2 = $r['jml_tel_mas_2'] + $r['jml_tel_kel_2'];
											$jml_pot_2 = floatval($r['jml_pot_mas_2'] + $r['jml_pot_kel_2']);

											$jml_tel_3 = $r['jml_tel_mas_3'] + $r['jml_tel_kel_3'];
											$jml_pot_3 = floatval($r['jml_pot_mas_3'] + $r['jml_pot_kel_3']);

											$jml_tel_4 = $r['jml_tel_mas_4'] + $r['jml_tel_kel_4'];
											$jml_pot_4 = floatval($r['jml_pot_mas_4'] + $r['jml_pot_kel_4']);

											$jml_tel_5 = $r['jml_tel_mas_5'];
											$jml_pot_5 = $jml_tel_5 * 4;

											// diklat
											$jml_tel_diklat = $r['jml_tel_diklat'];
											$jml_pot_diklat = floatval($r['jml_pot_diklat']);

											//skj
											$jml_tel_skj = $r['jml_tel_skj'];
											$jml_pot_skj = floatval($r['jml_pot_skj']);

											//skj
											$jml_tel_alpha = $r['jml_tel_alpha'];
											$jml_pot_alpha =  floatval($r['jml_pot_alpha']);

											//dispensasi
											$jml_tel_dispensasi = $r['jml_tel_dispensasi'];
											$jml_pot_dispensasi = floatval($r['jml_pot_dispensasi']);

											// total 
											$jml_tot_absent = $jml_pot_1 + $jml_pot_2 + $jml_pot_3 + $jml_pot_4 + $jml_pot_5 + $jml_pot_diklat + $jml_pot_skj + $jml_pot_alpha + $jml_pot_dispensasi;
											$jml_tot_present = 100 - $jml_tot_absent;

											$no++;
											$tr = '<tr class="text-right">
													<td class="text-right">' . $no . '</td>
													<td class="text-left">' . $r['nama'] . '</td>
													<td class="text-left">' . $r['nip'] . '</td>
													
													<td class="text-right">' . ($jml_tel_1 == 0 ? '-' : $jml_tel_1) . '</td>
													<td class="text-right">' . ($jml_pot_1 == 0 ? '-' : $jml_pot_1 . '%') . '</td>
													<td class="text-right">' . ($jml_tel_2 == 0 ? '-' : $jml_tel_2) . '</td>
													<td class="text-right">' . ($jml_pot_2 == 0 ? '-' : $jml_pot_2 . '%') . '</td>
													<td class="text-right">' . ($jml_tel_3 == 0 ? '-' : $jml_tel_3) . '</td>
													<td class="text-right">' . ($jml_pot_3 == 0 ? '-' : $jml_pot_3 . '%') . '</td>
													<td class="text-right">' . ($jml_tel_4 == 0 ? '-' : $jml_tel_4) . '</td>
													<td class="text-right">' . ($jml_pot_4 == 0 ? '-' : $jml_pot_4 . '%') . '</td>
													<td class="text-right">' . ($jml_tel_5 == 0 ? '-' : $jml_tel_5) . '</td>
													<td class="text-right">' . ($jml_pot_5 == 0 ? '-' : $jml_pot_5 . '%') . '</td>

													<td class="text-right">' . ($jml_tel_diklat == 0 ? '-' : $jml_tel_diklat) . '</td>
													<td class="text-right">' . ($jml_pot_diklat == 0 ? '-' : $jml_pot_diklat . '%') . '</td>

													<td class="text-right">' . ($jml_tel_skj == 0 ? '-' : $jml_tel_skj) . '</td>
													<td class="text-right">' . ($jml_pot_skj == 0 ? '-' : $jml_pot_skj . '%') . '</td>

													<td class="text-right">' . ($jml_tel_alpha == 0 ? '-' : $jml_tel_alpha) . '</td>
													<td class="text-right">' . ($jml_pot_alpha == 0 ? '-' : $jml_pot_alpha . '%') . '</td>
													
													<td class="text-right">' . ($jml_tel_dispensasi == 0 ? '-' : $jml_tel_dispensasi) . '</td>
													<td class="text-right">' . ($jml_pot_dispensasi == 0 ? '-' : $jml_pot_dispensasi . '%') . '</td>
													
													<td class="text-right">' . $jml_tot_absent . '%</td>
													<td class="text-right">' . $jml_tot_present . '%</td>
												</tr>
												';
											// <td>' . $r['jml_tel_kel_5'] . '%</td>
											echo $tr;
										}
										?>
									</tbody>
								</table>

							</div>
						</div>
					</div><!-- end row-->

				</div>
			</div>

		</div>
	</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script src="./vendor/js/tableHTMLExport/tableHTMLExport.js"></script>
<script src="./vendor/js/tableHTMLExport/fileSaver.js"></script> -->


<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script> -->
<!--

<script type="text/javascript" src="./vendor/js/table-export/tableExport.js"></script>
<script type="text/javascript" src="./vendor/js/table-export/html2canvas.js"></script>
<script type="text/javascript" src="./vendor/js/table-export/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="./vendor/js/table-export/jspdf/jspdf.js"></script>
<script type="text/javascript" src="./vendor/js/table-export/jspdf/libs/base64.js"></script> -->

<!-- <script src="./vendor/js/tableHTMLExport/tableHTMLExport.js"></script> -->
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script> -->

<script>
	function onDelete(id) {
		var choice = confirm('yakin mau menghapus data ' + id + ' ?');
		if (choice) {
			window.location.href = 'konfig/delete_absensi.php?id=' + id;
		}
	}

	$('.pop').on('click', function() {
		$('.imagepreview').attr('src', $(this).find('img').attr('src'));
		$('#imagemodal').modal('show');
	});

	function openModal(urlx) {
		$('#modalImg').attr('src', urlx);
		$('#myModal').modal('show');
	}

	function getMonthName(date) {
		const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		const ret = monthNames[parseInt(date) - 1]
		return ret;
	}

	$(document).ready(function() {
		// console.log('doc ready')
		// $('#json').on('click', function() {
		// 	$("#example").tableHTMLExport({
		// 		type: 'json',
		// 		filename: 'sample.json'
		// 	});
		// })
		// $('#csv').on('click', function() {
		// 	$("#example").tableHTMLExport({
		// 		type: 'csv',
		// 		filename: 'sample.csv'
		// 	});
		// })
		let _1headerRow = [{
				text: '\n\nno',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 3,
			},
			{
				text: '\n\nNama',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 3,
			},
			{
				text: '\n\nNIP',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 3,
			},
			{
				text: 'Tingkat Ketidakhadiran Berdasarkan Rumus Skor',
				style: "tableHeader",
				colSpan: 19,
				rowSpan: 1,
			},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{},
			{
				text: '\nKehadiran %',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 3
			},
		];

		let _3headerRow = [{},
			{},
			{},
			{
				text: '',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'right',
				margin: 0,
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'right',
				margin: 0,
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: 'jml',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
			},
			{
				text: '%',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
				alignment: 'center',
				margin: [0, 0, 0, 0],
				padding: [0, 0, 0, 0],
				border: [true, true, true, true],
				// fillColor: '#fff',
				color: '#ffffff'
			},
			// {},
		];

		let _2headerRow = [{},
			{},
			{},
			{
				text: '05-30 menit',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: '31-60 menit',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: '61-120 menit',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: '>120 menit',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: 'TMK 1 hari',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: 'Diklat',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: 'Tidak SKJ',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: 'Tidak Finger',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: 'Dispensasi',
				style: "tableHeader",
				colSpan: 2,
				rowSpan: 1,
			},
			{},
			{
				text: 'JML Telat %',
				style: "tableHeader",
				colSpan: 1,
				rowSpan: 1,
			},
			{},
		];

		var _fnGetHeaders = function(dt) {
			alert('masuk excel')
			var thRows = $(dt.header()[0]).children();
			var numRows = thRows.length;
			var matrix = [];

			// Iterate over each row of the header and add information to matrix.
			for (var rowIdx = 0; rowIdx < numRows; rowIdx++) {
				var $row = $(thRows[rowIdx]);

				// Iterate over actual columns specified in this row.
				var $ths = $row.children("th");
				for (var colIdx = 0; colIdx < $ths.length; colIdx++) {
					var $th = $($ths.get(colIdx));
					var colspan = $th.attr("colspan") || 1;
					var rowspan = $th.attr("rowspan") || 1;
					var colCount = 0;

					// ----- add this cell's title to the matrix
					if (matrix[rowIdx] === undefined) {
						matrix[rowIdx] = []; // create array for this row
					}
					// find 1st empty cell
					for (var j = 0; j < (matrix[rowIdx]).length; j++, colCount++) {
						if (matrix[rowIdx][j] === "PLACEHOLDER") {
							break;
						}
					}
					var myColCount = colCount;
					matrix[rowIdx][colCount++] = $th.text();

					// ----- If title cell has colspan, add empty titles for extra cell width.
					for (var j = 1; j < colspan; j++) {
						matrix[rowIdx][colCount++] = "";
					}

					// ----- If title cell has rowspan, add empty titles for extra cell height.
					for (var i = 1; i < rowspan; i++) {
						var thisRow = rowIdx + i;
						if (matrix[thisRow] === undefined) {
							matrix[thisRow] = [];
						}
						// First add placeholder text for any previous columns.                 
						for (var j = (matrix[thisRow]).length; j < myColCount; j++) {
							matrix[thisRow][j] = "PLACEHOLDER";
						}
						for (var j = 0; j < colspan; j++) { // and empty for my columns
							matrix[thisRow][myColCount + j] = "";
						}
					}
				}
			}

			return matrix;
		};

		var table = $('#absensiTbl').DataTable({
			dom: 'Bfrtip',
			paging: true,
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			blengthChange: false,
			bPaginate: false,
			bInfo: false,
			buttons: [{
					// header only 1st page 
					// customize: function(doc) {
					// 	doc.content[1].table.headerRows = 0;
					// },
					columns: [{
						"tooltip": "Tooltip text",
					}, ],
					// extend: 'pdf',
					titleAttr: 'Export to PDF',
					extend: 'pdfHtml5',
					className: 'btn-danger',
					orientation: 'landscape',
					download: 'open',
					title: titleFormat,
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?>',
					exportOptions: {
						// columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
						filename: "nyamm",
						orthogonal: 'export'
					},
					customize: function(pdfDocument) {
						// pdfDocument.content[2].table.headerRows = 2;
						/* console.log('pdfDocument', pdfDocument.content[2].table)
						var firstHeaderRow = [];
						$('#absensiTbl').find("thead>tr:first-child>th").each(
							function(index, element) {
								var colSpan = element.getAttribute("colSpan");
								var rowSpan = element.getAttribute("rowSpan");
								// console.log('rows', index, rowSpan)
								firstHeaderRow.push({
									text: element.innerHTML,
									style: "tableHeader",
									colSpan: colSpan,
									rowSpan: rowSpan,
									vAlign: 'middle',
									// style: {
									// 	verticalAlign: 'middle'
									// }
									// alignment: 'right'
								});
								// console.log('rows', index, rowSpan)
								for (var i = 0; i < colSpan - 1; i++) {
									firstHeaderRow.push({});
								}
							}
						); */
						// let secondHeaderRow = []
						// let thirdHeaderRow = []
						// let row1 = $('#absensiTbl').find("thead>tr:nth-child(1)>th")
						// let row2 = $('#absensiTbl').find("thead>tr:nth-child(2)>th")
						// let row3 = $('#absensiTbl').find("thead>tr:nth-child(3)>th")
						// console.log('row 1', row1)
						// console.log('row 2', row2)
						// console.log('row 3', row3)
						// console.log('n row1', firstHeaderRow.length)
						// console.log('n row2', secondHeaderRow.length)

						/* let xx = 0
						const nCol = firstHeaderRow.length
						for (let j = 0; j < nCol; j++) {
							if (firstHeaderRow[j].rowSpan > 1) {
								secondHeaderRow.push({});
							} else {
								var colSpan = row2[xx] ? row2[xx].colSpan : 1;
								var rowSpan = row2[xx] ? row2[xx].rowSpan : 1;

								if (row2[xx]) {
									secondHeaderRow.push({
										text: row2[xx] ? row2[xx].innerHTML : '',
										style: "tableHeader",
										rowSpan: rowSpan,
										colSpan: colSpan
									});
									if (colSpan > 1) {
										for (var i = 0; i < colSpan - 1; i++) {
											secondHeaderRow.push({});
										}
									}
									xx++
								}
							}
						} */

						/* let yy = 0
						for (let y = 0; y < nCol; y++) {
							if (firstHeaderRow[y].rowSpan > 1) {
								thirdHeaderRow.push({});
							} else {
								var colSpan = row3[yy] ? row3[yy].colSpan : 1;
								var rowSpan = row3[yy] ? row3[yy].rowSpan : 1;

								if (row3[yy]) {
									thirdHeaderRow.push({
										text: row3[yy] ? row3[yy].innerHTML : '',
										style: "tableHeader",
										rowSpan: rowSpan,
										colSpan: colSpan
									});
									if (colSpan > 1) {
										for (var i = 0; i < colSpan - 1; i++) {
											thirdHeaderRow.push({});
										}
									}
									yy++
								}
							}
						} */

						// console.log(' first', firstHeaderRow)
						// console.log(' second', secondHeaderRow)
						// console.log(' third', thirdHeaderRow)

						// pdfDocument.content[2].table.body.splice(0, 1, firstHeaderRow, secondHeaderRow, thirdHeaderRow);
						pdfDocument.content[2].table.body.splice(0, 1, _1headerRow, _2headerRow, _3headerRow);
					}
				},
				{
					extend: 'excel',
					className: 'btn-success',

					title: titleFormat,
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?>',
					customize: function(xlsx) {
						// 	//Apply styles, Center alignment of text and making it bold.
						// 	var sSh = xlsx.xl['styles.xml'];
						// 	var lastXfIndex = $('cellXfs xf', sSh).length - 1;
						// 	var n1 = '<numFmt formatCode="##0.0000%" numFmtId="300"/>';
						// 	var s2 = '<xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="0" applyBorder="0" xfId="0" applyAlignment="1">' +
						// 		'<alignment horizontal="center"/></xf>';
						// 	'<alignment horizontal="center"/></xf>';
						// 	sSh.childNodes[0].childNodes[0].innerHTML += n1;
						// 	sSh.childNodes[0].childNodes[5].innerHTML += s2;
						// 	var greyBoldCentered = lastXfIndex + 1;

						// 	//Merge cells as per the table's colspan
						// 	var sheet = xlsx.xl.worksheets['sheet1.xml'];
						// 	var dt = $('#absensiTbl').DataTable();
						// 	var frColSpan = $(dt.table().header()).find('th:nth-child(1)').prop('colspan');
						// 	var srColSpan = $(dt.table().header()).find('th:nth-child(2)').prop('colspan');
						// 	var columnToStart = 2;
						// 	var mergeCells = $('mergeCells', sheet);

						// 	mergeCells[0].appendChild(_createNode(sheet, 'mergeCell', {
						// 		attr: {
						// 			ref: 'A1:' + toColumnName(frColSpan) + '1'
						// 		}
						// 	}));

						// 	mergeCells.attr('count', mergeCells.attr('count') + 1);

						// 	var columnToStart = 2;
						// 	while (columnToStart <= frColSpan) {
						// 		mergeCells[0].appendChild(_createNode(sheet, 'mergeCell', {
						// 			attr: {
						// 				ref: toColumnName(columnToStart) + '2:' + toColumnName((columnToStart - 1) + srColSpan) + '2'
						// 			}
						// 		}));
						// 		columnToStart = columnToStart + srColSpan;
						// 		mergeCells.attr('count', mergeCells.attr('count') + 1);
						// 	}

						// 	//Text alignment to center and apply bold
						// 	$('row:nth-child(1) c:nth-child(1)', sheet).attr('s', greyBoldCentered);
						// 	for (i = 0; i < frColSpan; i++) {
						// 		$('row:nth-child(2) c:nth-child(' + i + ')', sheet).attr('s', greyBoldCentered);
						// 	}

						// 	function _createNode(doc, nodeName, opts) {
						// 		var tempNode = doc.createElement(nodeName);
						// 		if (opts) {
						// 			if (opts.attr) {
						// 				$(tempNode).attr(opts.attr);
						// 			}
						// 			if (opts.children) {
						// 				$.each(opts.children, function(key, value) {
						// 					tempNode.appendChild(value);
						// 				});
						// 			}
						// 			if (opts.text !== null && opts.text !== undefined) {
						// 				tempNode.appendChild(doc.createTextNode(opts.text));
						// 			}
						// 		}
						// 		return tempNode;
						// 	}

						// 	//Function to fetch the cell name
						// 	function toColumnName(num) {
						// 		for (var ret = '', a = 1, b = 26;
						// 			(num -= a) >= 0; a = b, b *= 26) {
						// 			ret = String.fromCharCode(parseInt((num % b) / a) + 65) + ret;
						// 		}
						// 		return ret;
						// 	}
						// },

						// _fnGetHeaders: function() {
						// 	var dt = this.s.dt;
						// 	akert(dt)
						// 	return false
						// 	var thRows = dt.nTHead.rows;
						// 	var numRows = thRows.length;
						// 	var matrix = [];
						// }


						// if (config.header) {
						// 	/* ----- BEGIN changed Code ----- */
						// 	var headerMatrix = _fnGetHeaders(dt);
						// 	for (var rowIdx = 0; rowIdx < headerMatrix.length; rowIdx++) {
						// 		addRow(headerMatrix[rowIdx], rowPos);
						// 	}
						// 	/* ----- OLD Code that is replaced: ----- */
						// 	//addRow( data.header, rowPos );
						// 	/* ----- END changed Code ----- */
						// 	$('row c', rels).attr('s', '2'); // bold
						// }
					}
				},
				{
					extend: 'print',
					className: 'btn-info',
					title: titleFormat,
					messageTop: 'Total Data : <?php echo $no; ?>',
					messageBottom: '\nTotal Data : <?php echo $no; ?>',
					customize: function(pdfDocument) {
						pdfDocument.content[2].table.body.splice(0, 1, _1headerRow, _2headerRow, _3headerRow);
					}
				},
				'colvis',
			]
		});

		// $('#btn-pdf').on('click', function() {
		// 	// alert(999)
		// 	$('#absensiTbl').tableExport({
		// 		type: 'pdf',
		// 		escape: 'false'
		// 	})
		// });

		// $('#absensiTbl').tableExport({
		// 	type: 'pdf',
		// 	jspdf: {
		// 		orientation: 'p',
		// 		margins: {
		// 			left: 20,
		// 			top: 10
		// 		},
		// 		autotable: false
		// 	}
		// });

		// onClick ="$('#tableID').tableExport({type:'pdf',escape:'false'});"

		function titleFormat() {
			let title = 'Daftar Perhitungan Skor Kehadiran Pegawai'
			let subTitle = $('#id_divisi :selected').text()
			st = subTitle.trim().split(' ')
			let div = '\n' + ($('#id_divisi :selected').val() == '' ? '' : 'Divisi ' + st[1]);

			let tanggal_awal = $('#tanggal_awal').val()
			let tgl_awal = tanggal_awal.split('-')
			let ta = tgl_awal[2] + ' ' + getMonthName(tgl_awal[1]) + ' ' + tgl_awal[0]

			let tanggal_akhir = $('#tanggal_akhir').val()
			let tgl_akhir = tanggal_akhir.split('-')
			let tr = tgl_akhir[2] + ' ' + getMonthName(tgl_akhir[1]) + ' ' + tgl_akhir[0]
			let tgl = '\nPeriode ' + ta + ' s/d ' + tr

			return title + tgl + div
		}


		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');

	})
</script>

<?php

// $idArr = isset($_POST['id_divisi']) ?  explode('-', $_POST['id_divisi']) : null;

// $id_divisi = isset($_POST['id_divisi']) ? $idArr[0] : '';
// $mas_per_1 = isset($_POST['id_divisi']) ?  $idArr[1] : '';
// $mas_per_2 = isset($_POST['id_divisi']) ?  $idArr[2] : '';
// $mas_per_3 = isset($_POST['id_divisi']) ?  $idArr[3] : '';
// $mas_per_4 = isset($_POST['id_divisi']) ?  $idArr[4] : '';

// $kel_per_1 = isset($_POST['id_divisi']) ?  $idArr[5] : '';
// $kel_per_2 = isset($_POST['id_divisi']) ?  $idArr[6] : '';
// $kel_per_3 = isset($_POST['id_divisi']) ?  $idArr[7] : '';
// $kel_per_4 = isset($_POST['id_divisi']) ?  $idArr[8] : '';
// pr($query);

?>