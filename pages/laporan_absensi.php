<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
require_once './func/func_pegawai.php';

$absent = '';
$flag = '0';
// if (isset($_POST['tanggal_awal'])) {
// 	$flag = '0';
// 	$date = $_POST['tanggal_awal'];
// 	$absent = $date;
// 	$query = "SELECT tb_absen.id, tb_id.nama, tb_absen.masuk, tb_absen.keluar, tb_absen.date, tb_absen.status, tb_absen.keterangan FROM tb_absen INNER JOIN tb_id ON tb_absen.id=tb_id.id WHERE date='$date'";
// 	$sql = mysqli_query($dbconnect, $query);
// } else {
$flag = '0';
$date = date('Y-m-d');
$absent = $date;

$tanggal_awal = (isset($_POST['tanggal_awal'])) ? $_POST['tanggal_awal'] : date('Y-m-d');
$tanggal_akhir = (isset($_POST['tanggal_akhir'])) ? $_POST['tanggal_akhir'] : date('Y-m-d');
$query = ' 	SELECT 
					DATE_FORMAT(a.date, "%d %M %Y") as tanggal,
					a.id,
					a.masuk,
					a.keluar,
					a.capture,
					a.keterangan,
					a.status,
					a.mode,
					a.id_karyawan,
					a.potongan,
					a.terlambat,
					k.nip,
					k.nama,
					tp.nama_tipepresensi
				FROM tb_absen a
				JOIN tb1_karyawan k ON k.id = a.id_karyawan
				JOIN vw_tipepresensi tp ON tp.id_tipepresensi = a.id_tipe_presensi
				WHERE
					a.date >= "' . $tanggal_awal . '"
				AND a.date <=  "' . $tanggal_akhir . '"';
$sql = mysqli_query($dbconnect, $query);
// pr($query);
// }
$divisi = GetDivisi2();

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

					<div class="row">
						<div class="col-sm-3">
							<label>Divisi</label>
							<select id="id_tipe_presensi" name="id_tipe_presensi" required onchange="tipePresensiFunc(this.value)" class="select2_category form-control input-large" data-placeholder="Choose a Category" tabindex="1">
								<option value="">-Semua Divisi-</option>
								<?php
								foreach ($divisi as $data) { ?>
									<option value="<?php echo $data['id']; ?>"><?php echo '(' . $data['kode_divisi'] . ') ' . $data['nama_divisi']; ?></option>
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
											<th class="text-center" colspan="2" width="80">05-30</th>
											<th class="text-center" colspan="2" width="80">31-60</th>
											<th class="text-center" colspan="2" width="80">61-120</th>
											<th class="text-center" colspan="2" width="80">>120</th>
											<th class="text-center" colspan="2" width="80">TMK</th>
											<th class="text-center" colspan="2" width="80">Diklat</th>
											<th class="text-center" colspan="2" width="80">Tidak SKJ</th>
											<th class="text-center" colspan="2" width="80">Tidak Finger</th>
											<th class="text-center" colspan="2" width="80">Dispensasi</th>
											<th class="text-center" width="80">JML</th>
										</tr>
										<tr>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
											<th class="text-center" width="80">jml</th>
											<th class="text-center" width="80">%</th>
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
										while ($r = mysqli_fetch_assoc($sql)) {
											$tr='<tr>
													<td>aaa</td>
												</tr>
											';
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