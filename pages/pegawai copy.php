<?php
if (isset($_SESSION['page'])) {
} else {
	header("location: ../index.php?page=dashboard&error=true");
}
?>
<div class="content-header ml-3 mr-3">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">DAFTAR PEGAWAI</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
					<li class="breadcrumb-item active">Daftar Pegawai</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>


<section class="content ml-3 mr-3">
	<div class="content">
		<div class="row">
			<div class="col-md-12 mb-3 mt-4">
				<a href="./index.php?page=tambah_pengawai">
					<button type="button" class="btn btn-secondary btn-sm float-left"><i class="fas fa-plus-square"></i> pegawai</button>
				</a>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">

				<div class="table">
					<table id="pegawai" class="table table-bordered table-hover dt-responsive nowrap" id="dataTables-example" style="width: 100%;">
						<thead class="bg-secondary">
							<tr>
								<th>UID</th>
								<th>Nama Pegawai</th>
								<th>Email</th>
								<th></th>
							</tr>
						</thead>


						<tbody class="bg-white">
							<?php
							$sql = mysqli_query($dbconnect, "SELECT * FROM tb_id ORDER BY nama!=''");
							// vd($sql);
							while ($data = mysqli_fetch_array($sql)) {
							?>

								<tr class="odd gradeX">
									<td><?php echo $data['id']; ?></td>
									<td><?php echo $data['nama']; ?></td>
									<td><?php echo $data['email']; ?></td>
									<td>
										<center>
											<a href="./konfig/delete_pegawai.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah anda yakin?')" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></a>
											<a href="./index.php?page=edit_pegawai&id=<?php echo $data['id']; ?>&nama=<?php echo $data['nama']; ?>&email=<?php echo $data['email']; ?>" class="btn btn-outline-primary btn-sm ml-3" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
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


		</div>
	</div>
</section>