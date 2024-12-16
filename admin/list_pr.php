<?php include_once('header.php')?>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="height: 4200px; min-height: 293px;">
<section class="content">      
<div class="col-md-12">
         <div class="box box-primary box-solid">
              <div class="box-header with-border">
                        <h3 class="box-title">List Purchase Request</h3>
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
                      $a = mysqli_query($koneksi, "select *, SUM(total_pr) AS grand_total from pr_fat  group by no_pr order by no_pr desc");
                        $no=1;
                        foreach ($a as $row){
                          $hasil_rupiah = "Rp " . number_format($row['grand_total'],0,',','.');  ?>
                            <tr>
                            <td><?=$no?></td>
                            <td><?= date('d F Y', strtotime($row['tgl_pr'])) ?></td>
                            <td><?=$row['no_pr']?></td>
                            <td><?=$row['divisi']?></td>
                            <td><?=$hasil_rupiah?></td>
                            <td> 
                            <a href="cetak_pr.php?no_pr=<?= $row['no_pr']; ?>&date=<?= $row['tgl_pr']; ?>" target='_newtab'><i class="fa fa-print"></i></a>
                  
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
 