<!DOCTYPE html>
<html>
<?php 

  session_start();

  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['level']==""){
    header("location:index.php?pesan=gagal");
  }

  $divisi= $_SESSION['username']; 
  // include 'conn.php';
  // $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username=$a ");

  // $result = mysqli_fetch_array($sql);
  // $divisi = $result ['username'];

  ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="logo.png">
  <title>FAT</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="alert/css/sweetalert.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- <body class="hold-transition skin-black-light sidebar-mini"> -->
  <body class="hold-transition skin-black  layout-top-nav">
<div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
         
              <a href="#" class="navbar-brand"><b>Finance & TAX</b></a>
            

            <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li> -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Form Pengajuan<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="home.php">Form Petty Cash</a></li>
                <li><a href="mr.php">Form Material Request</a></li>
                <li><a href="pr.php">Form Purchase Request</a></li>
                <!-- <li><a href="#">Purchase Request</a></li> -->
              </ul>
            </li>
          </ul>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li> -->
            <li class="dropdown">
              <a href="list_pc.php">List Pengajuan</span></a>
            </li>
          </ul>
        </div>
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="logout.php">
                      <!-- The user image in the navbar-->
                      <i class="fa fa-sign-in"></i>
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs">Logout</span>
                    </a>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
    
        </nav>
      </header>
  