<?php include_once('header.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 4200px; min-height: 293px;">

  <section class="content-header">
      <h1>
        Dashboard
        <small>FAT</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="#">FAT</a></li>
      <!--   <li class="active"></li> -->
      </ol>
  </section>  

  <section class="content">

    <div class="row">
    <div class="col-md-12">
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
                  <h3 class="box-title">Search Report</h3>
              </div>
              <div class="box-body">
              <div class="form-group col-md-5">
              <form class="form-horizontal" method="post">
              <label>Bulan</label>
              <div class="input-group date">
                  <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                  </div>
                 <select class="form-control select2" name="bulan" style="width: 100%;">
                  <option selected="selected" value="">Pilih Bulan</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==1) echo "selected" ?> value=01 >Januari</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==2) echo "selected" ?> value=02 >Februari</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==3) echo "selected" ?> value=03 >Maret</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==4) echo "selected" ?> value=04 >April</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==5) echo "selected" ?> value=05 >Mei</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==6) echo "selected" ?> value=06 >Juni</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==7) echo "selected" ?> value=07 >Juli</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==8) echo "selected" ?> value=08 >Agustus</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==9) echo "selected" ?> value=09 >September</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==10) echo "selected"?> value=10 >Oktober</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==11) echo "selected" ?> value=11 >November</option>
                  <option <?php if (isset($_POST['bulan']) && $_POST['bulan']==12) echo "selected" ?> value=12 >Desember</option>
                  </select>
              </div>
          </div>

          <div class="form-group col-md-5">
              <label>Tahun</label>
              <div class="input-group date">
                  <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tahun" class="form-control pull-right" value="<?= date('Y');?>" readonly >
              </div>
          </div>
            

          <div class="col-md-2">
            <label for=""><br></label>
            <br><button type="submit" class="btn btn-block btn-primary btn-sm">Cari</button>
          </div>
            </form>
              <?php
                  $bulan = $_POST['bulan'];
                  
                     include "../conn.php";  

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'fat';");

    $result = mysqli_fetch_array($sql);
    $fat = $result ['Total'];

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'it';");

    $result = mysqli_fetch_array($sql);
    $it = $result ['Total'];

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'wsc';");

    $result = mysqli_fetch_array($sql);
    $wsc = $result ['Total'];

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'hrg';");

    $result = mysqli_fetch_array($sql);
    $hrg = $result ['Total'];

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'mkom';");

    $result = mysqli_fetch_array($sql);
    $mkom = $result ['Total'];

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'td';");

    $result = mysqli_fetch_array($sql);
    $td = $result ['Total'];

    $sql = mysqli_query($koneksi, "SELECT SUM(total_pc) AS Total FROM pc_fat where MONTH(tgl_PC)=$bulan and divisi = 'ops';");

    $result = mysqli_fetch_array($sql);
    $ops = $result ['Total'];
                  ?>
        </div>
      </div>
    </div>
  </div>


    <!-- tampilan dashboard -->
      <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                  <div class="info-box-content">
                  <span class="info-box-text">Operational</span>
                  <span class="info-box-number"><?php echo "Rp " . number_format($ops,0,',','.'); ?></span>
                  </div>

                  </div>

              </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-wrench"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Teknik Development</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($td,0,',','.'); ?></span>
                </div>

                </div>

            </div>

            <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">WSC</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($wsc,0,',','.'); ?></span>
                </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Fat & Procurment</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($fat,0,',','.'); ?></span>
                </div>

                </div>

            </div>

      </div>
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                  <span class="info-box-icon bg-white"><i class="fa fa-laptop"></i></span>
                  <div class="info-box-content">
                  <span class="info-box-text">IT</span>
                  <span class="info-box-number"><?php echo "Rp " . number_format($it,0,',','.'); ?></span>
                  </div>

                  </div>

              </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">HRGA</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($hrg,0,',','.'); ?></span>
                </div>

                </div>

            </div>

      </div>
  </section>
  
    </div>
  <!-- /.content-wrapper -->

<?php include_once('footer.php');?>

