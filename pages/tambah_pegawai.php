<?php
// pr($_SESSION);
if (!isset($_SESSION['page'])) {
	header("location: ../index.php?page=dashboard&error=true");
} else {
	require_once './func/func_pegawai.php';
	// $data = GetOne($_GET['id']);
	// pr($data);
	// pr($data['tanggal_lahir']);
	// $agama = GetAgama();
	// $divisi = GetDivisi();
	// $jabatan = GetJabatan();
	// $provinsi = GetProvinsi();
	// $kategori = GetKatKaryawan();

	$status = GetStatus2();
	$agama = GetAgama2();
	$divisi = GetDivisi2();
	$jabatan = GetJabatan2();
	$kategori = GetKatKaryawan2();
	// pr($kategori);

	// $status = GetStatus2();
	// $provinsi = GetProvinsi2();

?>

	<!-- tab nav  -->
	<!--
	-->
	<!-- C:\xampp\htdocs\absensi2\vendor\js\jquery\jquery.min.js -->


	<!-- <script src="./vendor/js/jquery/2_2_1/jquery.min.js"></script> -->
	<script src="./vendor/js/bootstrap/js/3_3_7/bootstrap.min.js"></script>
	<link href="./vendor/css/bootstrap/3_3_7/bootstrap.min.css" rel="stylesheet" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->

	<div class="content-header ml-3 mr-3">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">EDIT PEGAWAI</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php?page=pegawai">Daftar pegawai</a></li>
						<li class="breadcrumb-item active">Edit pegawai</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>

	<section class="content ml-3 mr-3">
		<div class="content">
			<div class="container-fluid">
				<!-- nyamm form 	 -->

				<!-- old form  -->
				<form action="./konfig/add_pegawai.php" method="POST">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_1" data-toggle="tab">
								IDENTITAS
							</a>
						</li>
						<li>
							<a href="#tab_2" data-toggle="tab">
								KONTAK PERSONAL
							</a>
						</li>
						<!-- <li>
						<a href="#tab_3" data-toggle="tab">
							PENDIDIKAN
						</a>
					</li> -->
						<li>
							<a href="#tab_4" data-toggle="tab">
								KEPEGAWAIAN
							</a>
						</li>
						<li>
							<a href="#tab_5" data-toggle="tab">
								LAIN-LAIN
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">

							<div class="form-group">
								<label for="exampleInputEmail1">nama</label>
								<input type="hidden" name="id">
								<input required class="form-control" type="text" " name=" nama" placeholder="Masukan nama">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">tanggal_lahir</label>
								<input type="date" class="form-control" " name=" tanggal_lahir">
								<!-- <input required class="form-control" type="text" " name="tanggal_lahir" placeholder="Masukan tanggal_lahir"> -->
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">jenis_kelamin</label>
								<select name="jenis_kelamin" required class="form-control input-medium">
									<option value="1"> Laki-Laki</option>
									<option value="2"> Perempuan</option>
								</select>
							</div>
							<!-- <div class="form-group">
							<label for="exampleInputEmail1">goldar</label>
							<input required class="form-control" type="text" " name="goldar" placeholder="Masukan goldar">
						</div> -->
							<div class="form-group">
								<label for="exampleInputEmail1">agama</label>
								<select name="agama" class="form-control input-medium">
									<option value=""></option>
									<?php
									foreach ($agama as $data_agama) { ?>
										<option value="<?php echo $data_agama['id']; ?>"> <?php echo $data_agama['nama_agama']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">status_kawin</label>
								<select name="status_kawin" class="form-control input-medium">
									<option value=""></option>
									<?php
									foreach ($status as $data_status) { ?>
										<option value="<?php echo $data_status['id']; ?>"> <?php echo $data_status['keterangan']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">divisi</label>
								<select name="divisi" class="form-control input-medium">
									<option value=""></option>
									<?php
									foreach ($divisi as $data_divisi) { ?>
										<option value="<?php echo $data_divisi['id']; ?>"> <?php echo $data_divisi['nama_divisi']; ?></option>
									<?php } ?>
								</select> </div>
						</div>

						<div class="tab-pane" id="tab_2">
							<div class="form-group">
								<label for="exampleInputEmail1">no_hp</label>
								<input class="form-control" type="text" " name=" no_hp" placeholder="Masukan no_hp">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">alamat</label>
								<input class="form-control" type="text" " name=" alamat" placeholder="Masukan alamat">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">kota</label>
								<input class="form-control" type="text" " name=" kota" placeholder="Masukan kota">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">provinsi</label>
								<input class="form-control" type="text" " name=" provinsi" placeholder="Masukan provinsi">
								<!-- <select name="provinsi" class="form-control input-medium">
								<option value=""></option>
								<?php
								foreach ($provinsi as $data_provinsi) { ?>
									<option > <?php echo $data_provinsi['nama_provinsi']; ?></option>
								<?php } ?>
							</select> -->
							</div>
							<!-- <div class="form-group">
							<label for="exampleInputEmail1">kode_pos</label>
							<input required class="form-control" type="text" " name="kode_pos" placeholder="Masukan kode_pos">
						</div> -->
							<div class="form-group">
								<label for="exampleInputEmail1">email</label>
								<input required class="form-control" type="text" " name=" email" placeholder="Masukan email">
							</div>
							<!-- <div class="form-group">
							<label for="exampleInputEmail1">pendidikan</label>
							<input required class="form-control" type="text" " name="pendidikan" placeholder="Masukan pendidikan">
						</div> -->
						</div>
						<!-- <div class="tab-pane" id="tab_3">
						<div class="form-group">
							<label for="exampleInputEmail1">pendidikan</label>
							<input required class="form-control" type="text" " name="pendidikan" placeholder="Masukan pendidikan">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">gelar</label>
							<input required class="form-control" type="text" " name="gelar" placeholder="Masukan gelar">
						</div>
					</div> -->

						<div class="tab-pane" id="tab_4">
							<!-- <div class="form-group">
							<label for="exampleInputEmail1">no_sk</label>
							<input required class="form-control" type="text" " name="no_sk" placeholder="Masukan no_sk">
						</div> -->
							<div class="form-group">
								<label for="exampleInputEmail1">nip</label>
								<input required class="form-control" type="text" " name=" nip" placeholder="Masukan nip">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">jabatan</label>
								<select name="jabatan" class="form-control input-medium">
									<option value=""></option>
									<?php
									foreach ($jabatan as $data_jabatan) { ?>
										<option value="<?php echo $data_jabatan['id']; ?>"> <?php echo $data_jabatan['nama_jabatan']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="tab-pane" id="tab_5">
							<div class="form-group">
								<label for="exampleInputEmail1">kategori_karyawan</label>
								<select name="kategori_karyawan" class="form-control input-medium">
									<option value=""></option>
									<?php
									foreach ($kategori as $data_kategori) { ?>
										<option value="<?php echo $data_kategori['id']; ?>"> <?php echo $data_kategori['nama_katkaryawan']; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">npwp</label>
								<input required class="form-control" type="text" name="npwp" placeholder="Masukan npwp">
							</div>
							<!-- <div class="form-group">
							<label for="exampleInputEmail1">norek</label>
							<input required class="form-control" type="text" value="<?php echo $data['nama']; ?>" name="norek" placeholder="Masukan norek">
						</div> -->
						</div>

					</div>
					<button type="submit" name="add_pegawai" class="btn btn-primary" value="simpan">Simpan</button>
					<!-- <input type='submit' name='add_absensi' value='Simpan Data' class='btn btn-primary'> -->

				</form>

			</div>
		</div>
	</section>

<?php } ?>