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
                 <select class="form-control" name="bulan" onchange="this.form.submit()" style="width: 100%;">
                  <option selected="selected">Pilih Bulan</option>
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

            </form>
              <?php
                 $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : null;
                 $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : null;


                     include "../conn.php";
    // $sql = mysqli_query($koneksi, "SELECT a.* , b.*, c.*, count(a.id_barang) as jumlah FROM tbasset a, tblokasi b, tbkategori c WHERE a.id_kategori=c.id_kategori and a.id_lokasi=b.id_lokasi");
    if ($bulan && $tahun) {
      $queries = [
          "fat" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'fat';",
          "it" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'it';",
          "wsc" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'wsc';",
          "hrg" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'hrg';",
          "mkom" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'mkom';",
          "td" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'td';",
          "ops" => "SELECT SUM(total_pc) AS Total, SUM(CASE WHEN status_item = 1 THEN total_pc ELSE 0 END) AS Total_Realisasi FROM pc_fat WHERE MONTH(tgl_PC) = $bulan AND YEAR(tgl_PC) = $tahun AND divisi = 'ops';"
      ];
  
      $results = [];
      foreach ($queries as $key => $query) {
          $sql = mysqli_query($koneksi, $query);
          if ($sql === false) {
              echo "Error in $key query: " . mysqli_error($koneksi) . "<br>";
              $results[$key] = 0;
          } else {
              $result = mysqli_fetch_array($sql);
              $results[$key] = $result['Total_Realisasi'];
          }
      }
  
      $fat = $results['fat'];
      $it = $results['it'];
      $wsc = $results['wsc'];
      $hrg = $results['hrg'];
      $mkom = $results['mkom'];
      $td = $results['td'];
      $ops = $results['ops'];

      $results2 = [];
      foreach ($queries as $key => $query) {
          $sql = mysqli_query($koneksi, $query);
          if ($sql === false) {
              echo "Error in $key query: " . mysqli_error($koneksi) . "<br>";
              $results2[$key] = 0;
          } else {
              $result = mysqli_fetch_array($sql);
              $results2[$key] = $result['Total'];
          }
      }
  
      $fat2 = $results2['fat'];
      $it2 = $results2['it'];
      $wsc2 = $results2['wsc'];
      $hrg2 = $results2['hrg'];
      $mkom2 = $results2['mkom'];
      $td2 = $results2['td'];
      $ops2 = $results2['ops'];
  } else {
      $fat = $it = $wsc = $hrg = $mkom = $td = $ops = 0;
  }

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
                  <span class="info-box-number"><?php echo "Rp " . number_format($ops2,0,',','.'); ?></span>
                  <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($ops,0,',','.'); ?></span>
                  </div>

                  </div>

              </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-wrench"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Teknik Development</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($td2,0,',','.'); ?></span>
                <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($td,0,',','.'); ?></span>
                </div>

                </div>

            </div>

            <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">WSC</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($wsc2,0,',','.'); ?></span>
                <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($wsc,0,',','.'); ?></span>
                </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Fat & Procurment</span> 
                <span class="info-box-number"><?php echo "Rp " . number_format($fat2,0,',','.'); ?></span>
                <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($fat,0,',','.'); ?></span>
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
                  <span class="info-box-number"><?php echo "Rp " . number_format($it2,0,',','.'); ?></span>
                  <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($it,0,',','.'); ?></span>
                  </div>

                  </div>

              </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">HRGA</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($hrg2,0,',','.'); ?></span>
                <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($hrg,0,',','.'); ?></span>
                </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-white"><i class="fa fa-volume-up"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">MARKOM</span>
                <span class="info-box-number"><?php echo "Rp " . number_format($mkom2,0,',','.'); ?></span>
                <span class="info-box-number" style="color: green;"><?php echo "Rp " . number_format($mkom,0,',','.'); ?></span>
                </div>

                </div>

            </div>

      </div>

         <div class="box box-primary box-solid">
              <div class="box-header with-border">
                        <h3 class="box-title">Rekapitulasi Petty Cash</h3>
                    </div>
                    <div class="box-body">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table  id="example1"class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Tanggal Pengajuan</th>
                <th>Nomor Pengajuan</th>
                <th>Divisi</th>
                <th>Keperluan</th>
                <th>No.rek</th>
                <th>Status</th>
                <th>Total Pengajuan</th>
                <th>Jumlah Realisasi</th>
                <th>Jumlah Kekurangan</th>
                <th>Tgl Realisasi</th>
                </tr>
              </thead>
              <tbody >
                    <?php
                    include '../conn.php';
                      
                    $bulan = isset($_POST['bulan']) ? $_POST['bulan'] : null;
                    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : null;

                      $b = mysqli_query($koneksi, "select *, SUM(total_pc) AS realisasi from pc_fat where status_item = 1");
                      $c = mysqli_query($koneksi, "select *, SUM(total_pc) AS not_realisasi from pc_fat where status_item = 0");

                      $a = mysqli_query($koneksi, "select p.*, 
                                        (select sum(total_pc) from pc_fat where no_pc = p.no_pc and status_item = 1 group by no_pc) as realisasi, 
                                        (select sum(total_pc) from pc_fat where no_pc = p.no_pc and status_item = 0 group by no_pc) as belum_realisasi, 
                                        sum(total_pc) as grand_total
                                        from pc_fat p
                                        where no_pc NOT LIKE '%MR%' and MONTH(tgl_PC)=$bulan
                                        GROUP BY p.no_pc
                                        order by no_pc desc");

                      // $a = mysqli_query($koneksi, "select *, SUM(total_pc) AS grand_total from pc_fat where no_pc NOT LIKE '%MR%' and MONTH(tgl_PC)=$bulan   group by no_pc order by no_pc desc");
                        $no=1;
                        foreach ($a as $row){
                          $hasil_rupiah = "Rp " . number_format($row['total_pc'],0,',','.');  ?>
                            <tr>
                            <td><?=$no?></td>
                            <td><?= date('d F Y', strtotime($row['tgl_pc'])) ?></td>
                            <td><?=$row['no_pc']?></td>
                            <td><?= strtoupper($row['divisi'])?></td>
                            <td><?=$row['keterangan']?></td>
                            <td><?=$row['norek']?></td>
                            <td><?=$row['status_req']?></td>
                            <td><?= "Rp " . number_format($row['grand_total'],0,',','.') ?></td>
                            <td><?= "Rp " . number_format($row['realisasi'],0,',','.') ?></td>
                            <td><?= "Rp " . number_format($row['belum_realisasi'],0,',','.') ?></td>
                            <td></td>
                            </tr>
                            <?php
                            $no++;
                                    }
                ?>
                    </tbody>
            </table>
          </div>
          <div class="box-header">
              <h3 class="box-title">
                <?php
                echo "<a href='export_report_fat.php?bulan=".$bulan."&tahun=".$tahun."' class='btn btn-block btn-primary btn-sm'>Export Excel</a>";
                ?>
              </h3>
          </div>

        </div>
         </div>
        </div>
                  </section>


  </section>
  
    </div>
  <!-- /.content-wrapper -->

<?php include_once('footer.php');?>

