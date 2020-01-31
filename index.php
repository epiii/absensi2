<?php
require 'konfig/dev.php';
require 'konfig/function.php';

session_start();
// pr($_SESSION);
// if (isset($_SESSION['status'])) {
if ($_SESSION['status'] != '0' && $_SESSION['username'] == '') {
  header("location: konfig/logout.php");
}
// }
// vd(isset($_SESSION['status']));
// exit();
$_SESSION['page'] = 'index';
?>

<!DOCTYPE html>
<!--
  This is a starter template page. Use this page to start your new project from
  scratch. This page gets rid of all links and provides the needed markup only.
  -->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Presensi | ESP32</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="vendor/css/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vendor/css/admin-lte/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- custom databales -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/assets/global/plugins/select2/select2.css" />

  <!-- loading -->
  <link rel="stylesheet" href="vendor/css/css-manual/loading.css">


  <!-- combo grid  : old-->
  <!-- <link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery-ui-1.10.1.custom.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery.ui.combogrid.css" /> -->

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php?page=dashboard" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link" href="konfig/logout.php" onclick="return confirm('Ingin keluar ??')">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="vendor/img/logo_index.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">ESP32 Presensi</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="vendor/img/admin.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo "Hello, " . $_SESSION['username']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index.php?page=dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php if ($_SESSION['level'] == '0') { ?>
              <li class="nav-item">
                <a href="index.php?page=absensi" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Data Presensi
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=laporan_absensi" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Laporan Presensi
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=pegawai" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Daftar Pegawai
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=pengguna" class="nav-link">
                  <i class="nav-icon fas fa-user-lock"></i>
                  <p>
                    Daftar Pengguna
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=master" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Master
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=konfigurasi" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Konfigurasi
                  </p>
                </a>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a href="index.php?page=absensi" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                    Data Presensi
                  </p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-4 pb-4">
      <?php
      // var_dump($_GET);
      // exit();

      if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {

          case 'dashboard':
            require "pages/dashboard.php";
            break;

          case 'absensi':
            include "pages/absensi.php";
            break;

          case 'laporan_absensi':
            include "pages/laporan_absensi.php";
            break;

          case 'laporan_absensi_pdf':
            include "pages/laporan_absensi_pdf.php";
            break;

          case 'pegawai':
            include "pages/pegawai.php";
            break;

          case 'pengguna':
            include "pages/pengguna.php";
            break;

          case 'master':
            include "pages/master.php";
            break;

          case 'konfigurasi':
            include "pages/konfigurasi.php";
            break;

          case 'edit_pegawai':
            include "pages/edit_pegawai.php";
            break;

          case 'edit_master':
            include "pages/edit_master.php";
            break;

          case 'edit_konfigurasi':
            include "pages/edit_konfigurasi.php";
            break;

          case 'edit_konfigurasi_hari_libur_2':
            include "pages/edit_konfigurasi_hari_libur_2.php";
            break;

          case 'edit_master_jam':
            include "pages/edit_master_jam.php";
            break;

          case 'edit_absensi':
            include "pages/edit_absensi.php";
            break;

          case 'edit_pengguna':
            include "pages/edit_pengguna.php";
            break;

          case 'tambah_pengguna':
            include "pages/tambah_pengguna.php";
            break;

          case 'tambah_pegawai':
            include "pages/tambah_pegawai.php";
            break;

          case 'tambah_absensi':
            include "pages/tambah_absensi.php";
            break;

          case 'tambah_absensi_user':
            include "pages/tambah_absensi_user.php";
            break;

          case 'login':
            include "pages/login.php";
            break;

          default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
      } else {
        include 'pages/dashboard.php';
        // echo '<h3><center> Permintaan ditolak :( </center></h3>';
      }
      ?>

    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      <strong>Copyright &copy; 2019 <a href="https://dt-production.com">DT Production</a>.</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <!-- <script src="vendor/js/jquery/jquery.min.js"></script> -->
  <!-- <script src="vendor/js/jquery/jquery-3.4.1.min.js"></script> -->
  <script src="vendor/js/combogrid/jquery-1.9.1.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="vendor/js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="vendor/js/admin-lte/adminlte.min.js"></script>


  <!-- Js datatables -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

  <script type="text/javascript" src="vendor/assets/global/plugins/select2/select2.min.js"></script>

  <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css" />


  <!-- combo grid  : old-->
  <!-- <script src="vendor/js/combogrid/jquery-ui-1.10.1.custom.min.js"></script>
  <script src="vendor/js/combogrid/jquery.ui.combogrid-1.6.3.js"></script> -->

  <!-- nyamm  -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->

  <!--data tables function-->
  <script>
    $(document).ready(function() {
      // $('#example').DataTable({
      //   dom: 'Bfrtip',
      //   buttons: [{
      //     extend: 'pdfHtml5',
      //     orientation: 'landscape',
      //     pageSize: 'LEGAL'
      //   }]
      // });

      // Append a caption to the table before the DataTables initialisation

      // $('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');

      // var table = $('#example').DataTable({
      //   dom: 'Bfrtip',
      //   paging: true,
      //   pageLength: 5,
      //   blengthChange: false,
      //   bPaginate: false,
      //   bInfo: false,
      //   buttons: [{
      //       // extend: 'pdf',
      //       extend: 'pdfHtml5',
      //       className: 'btn-danger',
      //       orientation: 'landscape',
      //       download: 'open',
      //       messageTop: 'Januari 2020 || Divisi Keuangan ',
      //       messageBottom: 'keterangan bawah',
      //       exportOptions: {
      //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
      //       },
      //     },
      //     {
      //       extend: 'excel',
      //       className: 'btn-success'
      //     },
      //     {
      //       extend: 'print',
      //       className: 'btn-info'
      //     }
      //   ]
      // });

      // table.buttons().container()
      //   .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
  </script>

  <script>
    $(document).ready(function() {

      // editor = new $.fn.dataTable.Editor({
      //   "ajax": "../php/staff.php",
      //   "table": "#example",
      //   "fields": [{
      //     "label": "First name:",
      //     "name": "first_name"
      //   }, {
      //     "label": "Last name:",
      //     "name": "last_name"
      //   }, {
      //     "label": "Position:",
      //     "name": "position"
      //   }, {
      //     "label": "Office:",
      //     "name": "office"
      //   }, {
      //     "label": "Extension:",
      //     "name": "extn"
      //   }, {
      //     "label": "Start date:",
      //     "name": "start_date",
      //     "type": "datetime"
      //   }, {
      //     "label": "Salary:",
      //     "name": "salary"
      //   }]
      // });

      var table = $('#pegawai').DataTable({
        blengthChange: false,
        bPaginate: true,
        bInfo: false,
      });

      table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
  </script>

  <script>
    $(document).ready(function() {
      if (Notification.permission !== "granted")
        Notification.requestPermission();
    });

    function cek() {
      $.ajax({
        type: "GET",
        url: './konfig/notifikasi.php',
        success: function(data) {
          if (data == '0') {

          } else {
            var notifikasi = new Notification(data, {
              icon: 'vendor/img/user.png',
              body: "Klik notifikasi ini untuk memasukan data pegawai",
            });
            notifikasi.onclick = function() {
              window.open("index.php?page=pegawai");
            };
          }
        }
      });
      i = 1;
      loop();
    }

    var i = 1;

    function loop() {
      setTimeout(function() {
        i++;
        if (i < 15) {
          loop();
        } else {
          cek();
        }
      }, 1000)
    }
    loop();
  </script>

  <!-- combo grid  : new-->
  <!-- <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
  <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> -->


  <!-- combo grid  : new online-->
  <!-- <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> -->

  <!-- combo grid  : old-->
  <script src="vendor/js/combogrid/jquery-ui-1.10.1.custom.min.js"></script>
  <script src="vendor/js/combogrid/jquery.ui.combogrid-1.6.3.js"></script>
  <script src="vendor/js/combogrid/jquery.widget.min.js"></script>
  <link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery-ui-1.10.1.custom.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="vendor/css/combogrid/jquery.ui.combogrid.css" />
  <!-- input mask -->
  <!-- <script src="vendor/js/jquery/jquery.min.js"></script>
  <script src="vendor/js/inputmask/jquery.inputmask.js"></script> -->


  <!-- <script src="vendor/js/tableHTMLExport/tableHTMLExport.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script> -->

  <!-- <script src="vendor/js/jquery/jquery.min.js"></script>
  <script src="vendor/js/inputmask/jquery.inputmask.js"></script> -->
</body>

</html>