<?php include_once('header_dashboard.php');
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Form 
        <small>Petty Cash</small>
      </h1> -->
    </section>
      <!-- end -->
    <div class="content-wrapper">
    <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Detail Petty Cash
            <small class="pull-right"><?= date('l, d-m-Y');?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
    <div class="row invoice-info">
     <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->            
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Uraian</th>
                      <th>Nama Pemohon</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody >
                    <?php
                    include 'conn.php';
                      $a = mysqli_query($koneksi, "select * from pc_fat  where no_pc =");
                        $no=1;
                        foreach ($a as $row){
                            echo "<tr>
                            <td>$no</td>
                            <td>".$row['no_pc']."</td>
                            <td>".$row['nama_pemohon']."</td>
                            <td> 
                            <a href='cetak_pc.php?no_pc=".$row['no_pc']."&tgl_trxout=".$row['tgl_pc']."' target='_newtab'>
                            <i class='fa fa-print'></i></a>
                            </td>
                            </tr>";

                            $no++;
                                    }
                ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
          <!-- /.box -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
  </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
</div><!-- /.content-wrapper -->
<?php include_once('footer_dashboard.php');?>