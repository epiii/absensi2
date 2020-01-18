<?php
if(isset($_SESSION['page'])){
  
}else{
  header("location: ../index.php?page=dashboard&error=true");
}

    $today = date('Y-m-d');
    $sql1 = mysqli_query($dbconnect,"SELECT COUNT(status) FROM tb_absen WHERE date='$today' AND status='T'");
    $count_terlambat=mysqli_num_rows($sql1);

    $sql2 = mysqli_query($dbconnect,"SELECT COUNT(status) FROM tb_absen WHERE date='$today' AND status='H'");
    $count_hadir=mysqli_num_rows($sql2);

    $sql3 = mysqli_query($dbconnect,"SELECT COUNT(status) FROM tb_absen WHERE date='$today' AND status='I'");
    $count_izin=mysqli_num_rows($sql3);

    $sql4 = mysqli_query($dbconnect,"SELECT COUNT(status) FROM tb_absen WHERE date='$today' AND status='S'");
    $count_sakit=mysqli_num_rows($sql4);

    $sql5 = mysqli_query($dbconnect,"SELECT COUNT(status) FROM tb_absen WHERE date='$today' AND status='B'");
    $count_bolos=mysqli_num_rows($sql5);

    $sql6 = mysqli_query($dbconnect,"select * from tb_id where id not in(select id from tb_absen where date='$today')");
    $count_alpa=mysqli_num_rows($sql6);
?>

 
 <!-- Content Header (Page header) -->
    <div class="content-header ml-3 mr-3">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">DASHBOARD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content ml-3 mr-3">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        

          <!-- card-->
          <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                <?php
                  $sql = mysqli_query($dbconnect,"SELECT*FROM tb_absen");
                  $row = mysqli_num_rows($sql);
                  echo $row;
                ?>
                </h3>

                <p>Data Presensi</p>
              </div>
              <div class="icon">
              <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index.php?page=absensi" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                <?php
                  $sql = mysqli_query($dbconnect,"SELECT*FROM tb_id");
                  $row = mysqli_num_rows($sql);
                  echo $row;
		            ?>
                </h3>

                <p>Jumlah Pegawai</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i>
              </div>
              <a href="index.php?page=pegawai" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                <?php
                  $sql = mysqli_query($dbconnect,"SELECT*FROM tb_pengguna");
                  $row = mysqli_num_rows($sql);
                  echo $row;
                ?>
                </h3>

                <p>Pengguna</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
              <a href="index.php?page=pengguna" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                <?php
                  // $sql = mysqli_query($dbconnect,"SELECT*FROM tb_pengguna");
                  // $row = mysqli_num_rows($sql);
                  // echo $row;
                ?>
                -
                </h3>

                <p>Absensi</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
              <a href="index.php?page=laporan_absensi" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->



      <!-- chart -->
            
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Presentase Kehadiran
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div id="container" height="300px" width="300px"></div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            </section>
            
            <!-- right colum-->
            <section class="col-lg-5 connectedSortable">

            <!-- calendar-->
            <div class="card">
              <div class="card-header border-1 bg-secondary">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt mr-1"></i>
                  Tanggal & Jam
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div style="text-align:center;padding:1em 0;"> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=large&timezone= <?php echo $timezone;?>" width="100%" height="140" frameborder="0" seamless></iframe> </div>
              </div>
              <!-- /.card-body -->
            </div>

            <!--gmail panel-->
            <div class="card bg-gradient-info">
                <div class="card-header  bg-secondary">
                  <h3 class="card-title">
                    <i class="fas fa-envelope mr-1"></i>
                    Email Izin
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active text-white" href="#new_email" data-toggle="tab">New</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="#email_record" data-toggle="tab">Record</a>
                      </li>
                    </ul>
                  </div>
                </div><!--end card header -->
            <div class="card-body pt-3">
              <div class="tab-content p-0">
                <?php
                    if (! function_exists('imap_open')) {
                        echo "IMAP is not configured.";
                        exit();
                    } else {
                        /* Connecting Gmail server with IMAP */
                        $connection = @imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $email, $pwdemail) or die('Cannot connect to Gmail: ' . imap_last_error());   
                        
                         
                ?>
                    <div class="chart tab-pane active" id="new_email">
                          <?php
                              /* Search Emails having the specified keyword in the email subject */
                              $emailData = imap_search($connection, 'SUBJECT Izin UNSEEN');
                              
                              if (! empty($emailData)) {
                                
                                rsort($emailData);
                            ?>
                          
                          <div class="table-responsive">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th>Pengirim</th>
                                    <th>Subject</th>
                                    <th>Isi Pesan</th>
                                    <th>Tanggal Pengiriman</th>
                                </tr>
                            </thead>

                              <?php
                                  foreach ($emailData as $emailIdent) {
                                      
                                      $overview = imap_fetch_overview($connection, $emailIdent, 0);
                                      $message = imap_fetchbody($connection, $emailIdent, '1');
                                      $messageExcerpt = substr($message, 0, 50);
                                      $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
                                      $date = date("d F, Y", strtotime($overview[0]->date));
                                      
                                      ?>
                              <tbody>
                                <tr>
                                    <td><?php echo $overview[0]->from; ?></td>
                                    <td><?php echo $overview[0]->subject; ?></td> 
                                    <td><?php echo $partialMessage; ?></td>
                                    <td><?php echo $date; ?></td>
                                </tr>
                              </tbody>
                              <?php
                                  } // End foreach
                                  ?>
                          </table>
                        </div>
                          <?php
                              } // end if
                          ?>
                    </div><!-- end div for tab new email-->

                    <div class="chart tab-pane" id="email_record">
                      <?php
                        /* Search Emails having the specified keyword in the email subject */
                       
                        $searchmail = "SINCE ". date('d-M-Y')." SUBJECT Izin";
                        $emailData = imap_search($connection, $searchmail);
                                
                        if (! empty($emailData)) {

                          rsort($emailData);
                      ?>
                            
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                              <tr>
                                  <th>Pengirim</th>
                                  <th>Subject</th>
                                  <th>Isi Pesan</th>
                                  <th>Tanggal Pengiriman</th>
                              </tr>
                          </thead>

                          <?php
                              foreach ($emailData as $emailIdent) {
                                  
                                  $overview = imap_fetch_overview($connection, $emailIdent, 0);
                                  $message = imap_fetchbody($connection, $emailIdent, '1');
                                  $messageExcerpt = substr($message, 0, 50);
                                  $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
                                  $date = date("d F, Y", strtotime($overview[0]->date));
                                  
                          ?>
                          <tbody>
                            <tr>
                                <td><?php echo $overview[0]->from; ?></td>
                                <td><?php echo $overview[0]->subject; ?></td> 
                                <td><?php echo $partialMessage; ?></td>
                                <td><?php echo $date; ?></td>
                            </tr>
                          </tbody>
                            <?php
                              } // End foreach
                            ?>
                        </table>
                      </div>
                        <?php
                            
                          } // end if    
                            imap_close($connection);
                            
                          }
                        ?> 
                  </div><!-- end div for tab email record -->


                </div>
              </div>
            </div><!-- end card gmail panel -->
          </section><!--end right colum-->
        </div><!-- end row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
    </section>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: ''
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
	
    series: [{
        type: 'pie',
        name: 'Jumlah',
        data: [
            ['Izin', <?php echo $count_izin;?>],
            ['Terlambat', <?php echo $count_terlambat;?>],
            {
                name: 'Hadir',
                y: <?php echo $count_hadir;?>,
                sliced: true,
                selected: true
            },
            ['Bolos', <?php echo $count_bolos;?>],
            ['Sakit', <?php echo $count_sakit;?>],
            ['Alpa', <?php echo $count_alpa;?>],
        ]
    }]
});
</script>