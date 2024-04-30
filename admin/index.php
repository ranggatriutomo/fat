<?php include_once('header.php')?>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="height: 4200px; min-height: 293px;">
<section class="content">      
<div class="col-md-12">
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
                <th>Total Pengajuan</th>
                <th>Action</th>
                </tr>
              </thead>
              <tbody >
                    <?php
                    include '../conn.php';
                      $a = mysqli_query($koneksi, "select *, SUM(total_pc) AS grand_total from pc_fat where no_pc NOT LIKE '%MR%'  group by no_pc order by no_pc desc");
                        $no=1;
                        foreach ($a as $row){
                          $hasil_rupiah = "Rp " . number_format($row['grand_total'],0,',','.');  ?>
                            <tr>
                            <td><?=$no?></td>
                            <td><?= date('d F Y', strtotime($row['tgl_pc'])) ?></td>
                            <td><?=$row['no_pc']?></td>
                            <td><?=$row['divisi']?></td>
                            <td><?=$hasil_rupiah?></td>
                            <td> 
                            <?php
                              $kode = $row['no_pc'];
                              $mid = substr($kode, 9, 2);
                              ?>
                           <?php   
                                  if ($mid == "PC"){
                                      echo " <a href='status.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                            <i class='fa fa-pencil'></i></a>
                                            <a href='approve.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                            <i class='fa fa-check'></i></a>
                                            <a href='hapus_pc.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                            <i class='fa fa-eraser'></i></a>
                                            <a href='view_pc.php?no_pc=".$row['no_pc']."&tgl_trxout=".$row['tgl_pc']."' class='btn btn-default'>
                                            <i class='fa fa-eye'></i></a>";
                                  } elseif ($mid == "MR") {
                                      echo "<a href='status_mr.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                            <i class='fa fa-pencil'></i></a>
                                            <a href='approve.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                            <i class='fa fa-check'></i></a>
                                            <a href='hapus_pc.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                            <i class='fa fa-eraser'></i></a>
                                            <a href='view_mr.php?no_pc=".$row['no_pc']."&tgl_trxout=".$row['tgl_pc']."' class='btn btn-default'>
                                            <i class='fa fa-eye'></i></a>";
                                  }else{
                                    echo " <a href='status_pr.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                          <i class='fa fa-pencil'></i></a>
                                          <a href='approve_pr.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                          <i class='fa fa-check'></i></a>
                                          <a href='hapus_pc.php?no_pc=".$row['no_pc']."' class='btn btn-default'>
                                          <i class='fa fa-eraser'></i></a>
                                          <a href='view_pr.php?no_pc=".$row['no_pc']."&tgl_trxout=".$row['tgl_pc']."' class='btn btn-default'>
                                          <i class='fa fa-eye'></i></a>";
                                }
                                  ?>
                            </td>
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
                  </section>


</div>


  <!-- /.content-wrapper -->

 <?php require_once('footer.php')?>
 