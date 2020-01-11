<?php
if(isset($_SESSION['page'])) {
	if(isset($_GET['id']) && isset($_GET['nama']) && isset($_GET['email'])){
		//lajut
	}else{
		echo '<h3><center> Permintaan ditolak :( </center></h3>';
		exit;
	}
}else{
  header("location: ../index.php?page=dashboard&error=true");
}
$uid = $_GET['id'];
$nama = $_GET['nama'];
$email = $_GET['email'];
$tampung_uid = $uid;
?>

<div class="content-header ml-3 mr-3">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">EDIT PEGAWAI</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=pegawai">Pegawai</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
	</div>

<section class="content ml-3 mr-3">
	<div class="content">
		<div class="container-fluid">
			
												
						<form action="./konfig/update_pegawai.php" method="POST">
						<div class="form-group">
						<input type="hidden" name="parameter" value="<?php echo $tampung_uid; ?>">
							<label for="exampleInputEmail1">UID</label>
							<input required class="form-control" type="text" name="uid" placeholder="Masukan UID" value="<?php echo $uid ?>">
							<small id="emailHelp" class="form-text text-muted">UID yang terdaftar</small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Nama</label>
							<input required class="form-control" type="text" name="nama" placeholder="Masukan nama" value="<?php echo $nama ?>">
							<small id="emailHelp" class="form-text text-muted">Nama pegawai harus sesuai dengan pemilik UID</small>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input required type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Masukan email" value="<?php echo $email ?>">
							<small id="emailHelp" class="form-text text-muted">Email terdaftar pegawai</small>
						</div>
							<button type="submit" class="btn btn-outline-primary mt-3 float-right" value="simpan">Submit</button>
						</form>
					
				
		</div>
	</div>
</section>