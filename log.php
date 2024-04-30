<?php include_once('header.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        Table
        <small>Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="barang.php">Log Transaksi Peralatan</a></li>
      <!--   <li class="active"></li> -->
      </ol>
  </section>  

  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="">
            
          </div>
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">
                 <a href="input_barang.php" class="btn btn-block btn-primary btn-sm">Tambah Stock</a> 
              </h3>
               <h3 class="box-title">
                 <a href="proses.php" class="btn btn-block btn-primary btn-sm">Export Excel</a> 
              </h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
         <!--      <form name="form1" method="post" action=""> -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                 <!--  <th>Kode Barang</th> -->
                  <th>Nama Barang</th>
                  <th>Lokasi</th>
                  <th>Project</th>
                  <th>Tanggal Keluar</th>
                  <th>Tanggal Masuk</th>
         <!--          <th>Kondisi</th>
                  <th>Keterangan</th>
                  <th>Gambar</th> -->
                  <!-- <th>Gambar</th> -->
                <!--   <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                <?php
                      include 'conn.php';
                      $barang = mysqli_query($koneksi, "SELECT * FROM log_trx");
                        $no=1;
                        foreach ($barang as $row){
                          
                        //   SELECT a.*, b.*, COUNT(a.id_kategori)as jumlah 
                        // FROM tbasset a, tbkategori b
                        // WHERE a.id_kategori=b.id_kategori
                        // GROUP BY a.id_kategori

            echo "<tr>
            <td>$no</td>
            <td>".$row['id_barang']."</td>
            <td>".$row['id_lokasi']."</td>
            <td>".$row['project']."</td>
            <td>".$row['date_out']."</td>
            <td>".$row['date_in']."</td>
             </tr>";

            $no++;
                    }
                ?>
                </tbody>
                <tfoot>

              </table>
            </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
            <a href="#top">Ke Atas!<a>

      <!-- /.row -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php include_once('footer.php');?>
