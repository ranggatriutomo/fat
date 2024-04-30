<?php include_once('header.php');?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Table
        <small>Log Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="log_keluar.php">Log Barang</a></li>
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
            <!-- /.box-header -->
            <div class="box-body">
              <form name="form1" method="post" action="">
                            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Lokasi</th>
                  <th>Project</th>
                  <th>Tgl Keluar</th>
                  <th>Tgl Kembali</th>
                </tr>
                </thead>
                <tbody>
                <?php
                      include 'conn.php';
                      $query = mysqli_query($koneksi, "SELECT  b.kode_barang , d.nama_kategori, c.nama_lokasi, a.project, a.date_out, a.date_in
                                                      FROM log_trx a, tbasset b, tblokasi c, tbkategori d 
                                                      WHERE a.id_barang=b.id_barang and a.id_lokasi=c.id_lokasi and b.id_kategori=d.id_kategori;");
                        $no=1;
                        foreach ($query as $row){
            echo "<tr>
    
            <td>".$row['kode_barang']."</td>
            <td>".$row['nama_kategori']."</td>
            <td>".$row['nama_lokasi']."</td>
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

      <!-- /.row -->
    </section>
    
  </div>
  <!-- /.content-wrapper -->

<?php include_once('footer.php');?>

