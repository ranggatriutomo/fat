<?php include_once('header_dashboard.php');
include 'conn.php';

$no_pc = $_GET['no_pc'];            
$sql = mysqli_query($koneksi, "select * from pc_fat where no_pc = '$no_pc'");
$row = mysqli_fetch_array($sql);


?>


    <div class="content-wrapper">
    <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Form Material Request
            <small class="pull-right"><?= date('l, d-m-Y');?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
      <form role="form" method="post" onSubmit="if(!confirm('Apakah anda yakin menyimpan data ini?')){return false;}"  action="simpan_pengajuan_pr.php" enctype="multipart/form-data">
     <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Material Request</label>
                    <input type="text" name="no_pc" class="form-control"  value ="<?php echo $row['no_pc']; ?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Internal</label>
                    <input type="text" name="no_intern" class="form-control" value ="<?php echo $row['no_intern']; ?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" value ="<?php echo $row['nama_pemohon']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Divisi</label>
                    <input type="text" name="divisi" class="form-control"  value ="<?php echo $row['divisi']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Cost Center</label>
                    <input type="text" name="perihal" class="form-control"  value ="<?php echo $row['perihal']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Tanggal MR</label>
                <input type="text" name="tgl_pc" class="form-control" value ="<?php echo date('d F Y', strtotime($row['tgl_pc']));  ?>" readonly >
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Proyek</label>
                    <input type="text" name="no_proyek" class="form-control" value ="<?php echo $row['no_proyek']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Status</label>
                    <input type="text" class="form-control" value ="<?php echo $row['status_req']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">No Rekening</label>
                <input type="text" name="no_req" class="form-control" value="<?php echo $row['norek']; ?>"  readonly="readonly">
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Keterangan</label>
                 <textarea name="keterangan" class="form-control"  readonly="readonly"><?php echo $row['keterangan']; ?></textarea>
              </div>

              

            </div>
            
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th width : 10px>Kode Barang/Jasa</th>
                      <th>Deskripsi</th>
                      <th>Qty</th>
                      <th>UoM</th>
                      <th>Status</th>
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
                          <?php

                                if ( $row['status_item'] == 1 ){
                                    $status = 'realisasi';
                                } else {
                                    $status = 'belum realisasi';
                                }

                                ?>
                            <td><?=$no?></td>
                            <td><a href="#" data-kode-barang="<?= $row['kode_barang']; ?>" data-toggle="modal" data-target="#modal-default"><?=$row['kode_barang']?></a></td>
                            <td><?=$row['uraian_pc']?></td>
                            <td><?=$row['jumlah_pc']?></td>
                            <td><?=$row['satuan_pc']?></td>
                            <td><?=$status?></td>
                         </tr>
                        <?php
                            $no++;
                      }
                     
                ?>
                    </tbody>
                    <tfoot>
                        <?php
                        include 'conn.php';
                        $sql = mysqli_query($koneksi, "select *, SUM(total_pc) AS grand_total from pc_fat where no_pc = '$no_pc'");

                        $result = mysqli_fetch_array($sql);
                        $grandtotal = "Rp " . number_format($result ['grand_total'],0,',','.');

                                ?>
                          <!-- <tr>
                              <td></td>
                              <td style='text-align: center;'><b>Total</b></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td style='text-align: center;'><b><?=$grandtotal;?></b></td>
                          </tr> -->
                        </tfoot>
                  </table>

                  <!-- <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>TOTAL PENGAJUAN</th>
                            <th>TEREALISASI</th>
                            <th>BELUM TEREALISASI</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php
                        include 'conn.php';
                        $sql = mysqli_query($koneksi, "select *, SUM(total_pc) AS grand_total from pc_fat where no_pc = '$no_pc'");
                        $b = mysqli_query($koneksi, "select *, SUM(total_pc) AS realisasi from pc_fat where no_pc = '$no_pc' and status_item = 1");
                        $c = mysqli_query($koneksi, "select *, SUM(total_pc) AS not_realisasi from pc_fat where no_pc = '$no_pc' and status_item = 0");

                        $result = mysqli_fetch_array($sql);
                        $grandtotal = "Rp " . number_format($result ['grand_total'],0,',','.');

                        $result = mysqli_fetch_array($b);
                        $b1 = "Rp " . number_format($result ['realisasi'],0,',','.');

                        $result = mysqli_fetch_array($c);
                        $c1 = "Rp " . number_format($result ['not_realisasi'],0,',','.');
                    

                        
                                          
                                        
                            echo "<tr>
                            <td>$grandtotal</td>
                            <td>$b1</td>
                            <td>$c1</td>
                            </tr>";

                                ?>

                            
                        </tbody>
                      </table> -->
                </div>
              </div>
            </div>
          </div>
          <a href="list_pc.php" class="btn btn-primary">Back</a> 
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

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Alat</h4>
              </div>
               <div class="modal-body">
               <p id="modalContent">Kode Barang: </p>
                 
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


<?php include_once('footer_dashboard.php');?>
<script>
 $(document).ready(function() {
    // Ketika link dengan data-toggle="modal" diklik
    $('[data-toggle="modal"]').on('click', function() {
        // Ambil nilai dari atribut data-kode-barang
        var kodeBarang = $(this).data('kode-barang');

        // Kirim nilai ini ke server melalui AJAX
        $.ajax({
            url: 'get_barang_details.php',  // URL ke file PHP yang akan mengeksekusi query
            type: 'POST',
            data: { kode_barang: kodeBarang },
            success: function(response) {
                // Ganti konten modal dengan hasil dari server
                $('#modalContent').html(response);
            },
            error: function(xhr, status, error) {
                // Tampilkan pesan error jika terjadi kesalahan
                $('#modalContent').text('An error occurred: ' + error);
            }
        });
    });
});
</script>
