<?php
// require 'konfig/dev.php';

if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
?>
<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">KONFIGURASI</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Konfigurasi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">

			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead class="bg-secondary">
						<tr>
							<th>No</th>
							<th>Variabel</th>
							<th>Parameter Konfigurasi</th>
							<th>Keterangan</th>
							<th></th>
						</tr>
					</thead>

					<!-- <tbody> -->
					<tbody class="bg-white">
						<?php
						$query = "SELECT * from tb2_setting where id_parent is null";
						$sql = mysqli_query($dbconnect, $query);
						$no = '1';
						// vd($query);						
						while ($data = mysqli_fetch_assoc($sql)) {
						?>
							<tr class="odd gradeX">
								<td><?php echo $no; ?></td>
								<td><?php echo $data['param']; ?></td>
								<td class="text-center"><?php echo $data['value'] ? $data['value'] : '-'; ?></td>
								<td>
									<center><a href="./index.php?page=edit_konfigurasi&id=<?php echo $no; ?>&param=<?php echo $data['masuk_mulai']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-cog" data-toggle="tooltip" title="Edit"></i></a></center>
								</td>
								<?php $no++; ?>
							</tr>

						<?php
						}
						?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</section>