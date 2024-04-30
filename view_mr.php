<?php include_once('header_dashboard.php');
include 'conn.php';

$no_pc = $_GET['no_pc'];            
$sql = mysqli_query($koneksi, "select * from pc_fat where no_pc = '$no_pc'");
$row = mysqli_fetch_array($sql);

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
            <i class="fa fa-globe"></i> View Material Request to Purchase
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

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Produk dihasilkan</label>
                    <input type="text" name="nama_pemohon" class="form-control" value ="<?php echo $row['nama_pemohon']; ?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.MR to Purchase</label>
              <input type="text" name="no_pc" class="form-control"  value ="<?php echo $row['no_pc']; ?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Tipe Produk</label>
                    <input type="text" name="perihal" class="form-control"value ="<?php echo $row['perihal']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Divisi</label>
                    <input type="text" name="divisi" class="form-control" value ="<?php echo $row['divisi']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Internal No.</label>
                    <input type="text" name="no_intern" class="form-control" value ="<?php echo $row['no_intern']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Tanggal MR</label>
                <input type="text" name="tgl_pc" class="form-control" value ="<?php echo date('d F Y', strtotime($row['tgl_pc']));  ?>" readonly >
              </div>             
            </div>
            
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Material</th>
                      <th>Spesifikasi</th>
                      <th>Jumlah diminta</th>
                      <th>Jumlah Stok</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'conn.php';
                      $a = mysqli_query($koneksi, "select * from pc_fat where no_pc = '$no_pc'");
                        $no=1;
                        foreach ($a as $row){
                        ?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?=$row['kode_barang'] ?></td>
                            <td><?=$row['uraian_pc']?></td>
                            <td><?=$row['jumlah_pc']?></td>
                            <td><?=$row['satuan_pc']?></td>
                         </tr>
                        <?php
                            $no++;
                      }
                     
                ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <a href="list_pc.php" id="add-items" class="btn btn-primary">Back</a> 
          </form>
          </div>
          </div>
          <!-- /.box -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- </div> -->
      <!-- </div> -->
  </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
</div><!-- /.content-wrapper -->
<?php include_once('footer_dashboard.php');?>