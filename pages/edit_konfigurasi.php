<?php
if (isset($_SESSION['page'])) {
	if (isset($_GET['id']) || isset($_GET['param'])) {
		//lajut
	} else {
		echo '<h3><center> Permintaan ditolak :( </center></h3>';
		exit;
	}
} else {
	header("location: ../index.php?page=dashboard&error=true");
}

$id = $_GET['id'];
$parameter = $_GET['param'];
$value = $_GET['value'];

$query = "SELECT * from tb2_setting where id_parent =" . $id;
$sql = mysqli_query($dbconnect, $query);
?>

<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">EDIT PARAMETER</h1>
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

			<form action="./konfig/update_konfigurasi.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Parameter</label>
					<input type="hidden" name="id" value=<?php echo $id; ?>>
					<input readonly class="form-control" type="text" name="param" id="param" placeholder="Masukan Parameter" value="<?php echo $parameter ?>">
					<!-- <small id="emailHelp" class="form-text text-muted"><?php echo $keterangan; ?></small> -->
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Value</label>
					<input required class="form-control" type="text" name="value" id="value" placeholder="Masukan Parameter" value="<?php echo $value ?>">
				</div>
				<button type="submit" class="btn btn-outline-primary mt-3" value="simpan">Simpan Konfigurasi</button>
			</form>

			<div class="card-body">
				<div class="row mt-2">
					<div class="col-md-12 col-md-offset-2">
						<div class="table table-hover">

							<table id="absensiTbl" class="table table-striped table-bordered dt-responsive nowrap" id="dataTables-absensiTbl" style="width: 100%;">
								<thead>
									<tr>
										<th>Parameter</th>
										<th>Value</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									while ($data = mysqli_fetch_assoc($sql)) {
									?>
										<tr class="table-<?php echo $color; ?>">
											<td><?php echo $data['param']; ?></td>
											<td><?php echo $data['value']; ?></td>
											<td><?php echo $data['isActive']; ?></td>
											<td>
												<center>
													<a href="#" onclick="onDelete(<?php echo $data['id']; ?>)" class="btn btn-danger btn-sm text-center">delete</a>
												</center>
											</td>

										</tr>
									<?php
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