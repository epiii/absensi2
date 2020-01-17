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
$mas_per_1 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[1] : '';
$mas_per_2 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[2] : '';
$mas_per_3 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[3] : '';
$mas_per_4 = isset($_POST['id_divisi']) && $_POST['id_divisi'] != '' ?  $idArr[4] : '';

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
					count(*)
				FROM
					tb_absen a
				WHERE
					a.id_karyawan=k.id and 
                    a.date>="' . $tanggal_awal . '" and 
                    a.date<="' . $tanggal_akhir . '" and
                    a.status="A" 
			)jml_tel_mas_5
		FROM
			tb1_karyawan k';
$query = $id_divisi == '' ? $query : $query . ' WHERE k.id_divisi = "' . $id_divisi . '"';
// pr($query);
$sql = mysqli_query($dbconnect, $query);
$divisi = GetDivisiRule();
// pr($divisi);
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
								<select id="id_divisi" name="id_divisi" onchange="tipePresensiFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
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
								<input class="form-control" type="date" value="<?php echo $tanggal_awal ? $tanggal_awal : date('Y-m-d'); ?>" name="tanggal_awal">
							</div>
							<div class="col-sm-3">
								<label>Tanggal Akhir</label>
								<input class="form-control" type="date" value="<?php echo $tanggal_akhir ? $tanggal_akhir : date('Y-m-d'); ?>" name="tanggal_akhir">
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
								<table class="table table-striped table-bordered table-hover" id="ss">
									<thead>

										<tr>
											<th style='display:none;'></th>
											<th width="30" rowspan="3" style="vertical-align:middle">No</th>
											<th width="30" rowspan="3" style="vertical-align:middle">Nama</th>
											<th width="30" rowspan="3" style="vertical-align:middle">NIP</th>
											<!-- <th align="center" width="100" rowspan="3">NIP</th> -->
											<th width="250" class="info text-center" colspan="19">Tingkat Ketidakhadiran berdasarkan Rumus skor</th>
											<th class="text-center" class="info" style="vertical-align:middle" width="80" rowspan="3">
												Tingkat kehadiran
												<br />100-(jml%)
											</th>
										</tr>
										<tr>
											<th class="text-center" colspan="2" width="80">05-30 menit</th>
											<th class="text-center" colspan="2" width="80">31-60 menit</th>
											<th class="text-center" colspan="2" width="80">61-120 menit</th>
											<th class="text-center" colspan="2" width="80">>120 menit</th>
											<th class="text-center" colspan="2" width="80">TMK 1 hari</th>
											<th class="text-center" colspan="2" width="80">Diklat</th>
											<th class="text-center" colspan="2" width="80">Tidak SKJ</th>
											<th class="text-center" colspan="2" width="80">Tidak Finger</th>
											<th class="text-center" colspan="2" width="80">Dispensasi</th>
											<th class="text-center" width="80">JML</th>
										</tr>
										<tr>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80"><?php echo $mas_per_1; ?>%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80"><?php echo $mas_per_2; ?>%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80"><?php echo $mas_per_3; ?>%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80"><?php echo $mas_per_4; ?>%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">4%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">%</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 0;
										while ($r = mysqli_fetch_assoc($sql)) {
											$no++;
											// pr($r);
											// pr($r['jml_tel_mas_1']+$r['jml_tel_kel_1']);
											$tr = '<tr>
													<td>' . $no . '</td>
													<td>' . $r['nama'] . '</td>
													<td>' . $r['nip'] . '</td>
													<td>' . ($r['jml_tel_mas_1'] + $r['jml_tel_kel_1']) . '</td>
													<td>99%</td>
													<td>' . ($r['jml_tel_mas_2'] + $r['jml_tel_kel_2']) . '</td>
													<td>99%</td>
													<td>' . ($r['jml_tel_mas_3'] + $r['jml_tel_kel_3']) . '</td>
													<td>99%</td>
													<td>' . ($r['jml_tel_mas_4'] + $r['jml_tel_kel_4']) . '</td>
													<td>99%</td>
													<td>' . $r['jml_tel_mas_5']  . '</td>
													<td>' . ($r['jml_tel_mas_5'] * 4) . '</td>
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
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
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