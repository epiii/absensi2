<?php
if (isset($_SESSION['page'])) {
	if (isset($_GET['id']) || isset($_GET['param'])) {
		//lajut
	} else {
		echo '<h4><center> Permintaan ditolak :( </center></h3>';
		exit;
	}
} else {
	header("location: ../index.php?page=dashboard&error=true");
}

$id = $_GET['id'];
$mode = $id == '1' ? 'Masuk' : 'Keluar';
$query = "	SELECT s.*,v.nama_divisi
			FROM tb1_setting2 s 
			LEFT JOIN vw_divisi v on v.id_divisi = s.id_divisi 
			WHERE s.no =" . $id;
$sql = mysqli_query($dbconnect, $query);
?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT KONFIGURASI </h1>
				<h4 class="m-0 text-muted">Jam <?php echo $mode; ?></h4>
				<!-- <small id="emailHelp" class="form-text text-muted"><?php echo $keterangan; ?></small> -->

			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=konfigurasi">Konfigurasi</a></li>
					<li class="breadcrumb-item active">Edit</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3" id="box">
	<div class="content">
		<div class="container-fluid">

			<!-- <form action="./konfig/update_konfigurasi.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Parameter</label>
					<input type="hidden" name="id" value=<?php echo $id; ?>>
					<input readonly class="form-control" type="text" name="param" id="param" placeholder="Masukan Parameter" value="<?php echo $parameter ?>">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Value</label>
					<input required class="form-control" type="text" name="value" id="value" placeholder="Masukan Value" value="<?php echo $value ?>">
				</div>
				<button type="submit" class="btn btn-primary mt-3" value="simpan">Simpan Konfigurasi</button>
			</form> -->

			<div class="card-body">
				<div class="row mt-2">
					<div class="col-md-12 col-md-offset-2">
						<div class="table table-hover">

							<div class="text-right">
								<button class="btn btn-primary ">
									<i class="fas fa-plus" data-toggle="tooltip" title="Edit"></i>
								</button>
							</div>

							<table id="detKonfigTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-example" style="width: 100%;">
								<!-- <table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;"> -->
								<thead>
									<tr class="bg-secondary text-center">
										<th>No</th>
										<th>Divisi</th>
										<th>Jam <?php echo $mode; ?></th>
										<th>Batas Absen</th>
										<th>Telat 1</th>
										<th>Telat 2</th>
										<th>Telat 3</th>
										<th>Telat 4</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$no = 1;
									while ($data = mysqli_fetch_assoc($sql)) {
										$status = $data['isActive'];
										$txt = $status == '1' ? 'Active' : 'Inactive';
										$clr = $status == '1' ? 'success' : 'secondary';
									?>
										<tr class="text-center table-<?php echo $color; ?>">
											<td><?php echo $no; ?></td>
											<td class="text-left"><?php echo $data['nama_divisi']; ?></td>
											<td><?php echo $data['jam'] . ':' . $data['menit']; ?></td>
											<td><?php echo $data['batas1'] . ':00' . ' - ' . $data['batas2'] . ':00'; ?></td>
											<td class="text-left"><?php echo $data['telat1a'] . ' s/d ' . $data['telat1b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen1'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo $data['telat2a'] . ' s/d ' . $data['telat2b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen2'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo $data['telat3a'] . ' s/d ' . $data['telat3b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen3'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-left"><?php echo '> ' . $data['telat3b'] . ' menit'; ?><br><b>Potongan : <?php echo $data['persen4'] . ' %'; ?></b><?php echo ''; ?></td>
											<td class="text-center"><span class="badge badge-<?php echo $clr; ?>"><?php echo $txt; ?></span></td>
											<td>
												<center>
													<!-- <a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-primary btn-sm text-center">edit</a> -->
													<a href="#" onclick="openModal(<?php echo $data['id']; ?>)" class="btn btn-primary btn-sm text-center"><i class="fas fa-edit"></i></a>
													<!-- <a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">delete</a> -->
												</center>
											</td>

										</tr>
									<?php
										$no++;
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
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {

		var table = $('#detKonfigTbl').DataTable({
			paging: true,
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, "All"]
			],
			blengthChange: false,
			bPaginate: false,
			bInfo: false,

		});

		// table.buttons().container()
		// 	.appendTo('#absensiTbl_wrapper .col-md-6:eq(0)');

	})
</script>