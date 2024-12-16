<?php
    include '../conn.php';
    $no_pr = $_GET['no_pr'];
    // $tgl_pc = $_GET['tgl_pc'];
     $barang = mysqli_query($koneksi, "select *
     from pr_fat
     where no_pr = '$no_pr'");
     $row=mysqli_fetch_array($barang);

     $nama_pemohon=$row['nama_pemohon'];
     $divisi=$row['divisi'];
     $no_pr=$row['no_pr'];
     $tgl_pr= date('d F Y', strtotime($row['tgl_pr']));

    
     $query = mysqli_query($koneksi, "select * from pr_fat");
     $pc=mysqli_fetch_array($query);

    //  $data = $pc ['no_invoice'];
    // print_r($inv2);
    
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Purchase Request</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
<style type="text/css">
body {
      background-color: white;
    }

    body,
    div,
    table,
    thead,
    tbody,
    tfoot,
    tr,
    td,
    td,
    p {
      font-family: "Calibri";
      font-size: 13px;
    }

    .table-bordered td {
      text-align: left;
      align: right;
    }

    td {
      text-align: left;
      font-size: 14px;
    }
  </style>


</head>

  <body  class="A4-landscape">
  <div class="container-header">
    <div class="container-logo">
      <img src="../kop_pr.png">
    </div>
  </div>
  <br><br><br>
  <table style="text-align : left; width : 100%">
    <tr>
      <td>Purchase Request No. &nbsp;&nbsp;&nbsp; :  <?= $no_pr;?> </td>
    </tr>
    <tr> 
      <td>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $tgl_pr;?></td>
    </tr>
    <tr> 
      <td>Internal No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </td>
    </tr>
    <!-- <tr>
      <td>Tanggal</td> 
    </tr> -->
  </table>
  <br><br><br>
  <table class="table1" BORDER :  style="text-align : left; width : 100%">
      <thead>
        <tr>
          <th width="12" >PEMOHON</th>
          <td> <?= $nama_pemohon;?></td>
          <th width="12" >COST CENTER</th>
          <td></td>
          <th rowspan="2" width="15" >TANGGAL DIPERLUKAN</th>
          <td rowspan="2"></td>
        </tr>
        <tr>
          <th width="12" >DIVISI</th>
          <td> <?= strtoupper($divisi);?></td>
          <th width="12" >NO.PROYEK</th>
          <td></td>
        </tr>
        <tr>
          <th width="12" >KETERANGAN</th>
          <td colspan="5"></td>
        </tr>
      </thead>
      <tbody>
         
      </tbody>
    </table>
    <br><br>
    <table class="table1" style="text-align : left; width : 100%">
      <thead><b>Rincian Permintaan</b>
        <tr>
          <th width="10">No.</th>
          <th>Kode</th>
          <th>Deskripsi</th>
          <th width="12">Qty</th>
          <th width="12">UoM</th>
          <th>Per Unit</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
    <?php
      include '../conn.php';

      $barang = mysqli_query($koneksi,  "select * from pr_fat where no_pr = '$no_pr'");
        $no=1;
        foreach ($barang as $row){
                        
                      
          echo "<tr>
          <td>$no</td>
          <td style='text-align: center;'>".strtoupper($row['kode_barang'])."</td>
          <td style='text-align: center;'>".strtoupper($row['uraian_pr'])."</td>
          <td style='text-align: center;'>".strtoupper($row['jumlah_pr'])."</td>
          <td style='text-align: center;'>".strtoupper($row['satuan_pr'])."</td>
          <td style='text-align: center;'>"."Rp " . number_format($row ['harga_pr'],0,',','.')."</td>
          <td style='text-align: center;'>"."Rp " . number_format($row ['total_pr'],0,',','.')."</td>
          </tr>";

          $no++;
                  }
              ?>

          
      </tbody>
      <tfoot>
      <?php
      include '../conn.php';
      $sql = mysqli_query($koneksi, "select *, SUM(total_pr) AS grand_total from pr_fat where no_pr = '$no_pr'");

      $result = mysqli_fetch_array($sql);
      $grandtotal = "Rp " . number_format($result ['grand_total'],0,',','.');

              ?>
        <tr>
            <td></td>
            <td style='text-align: center;'><b>Total</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: center;'><b><?=$grandtotal;?></b></td>
        </tr>
      </tfoot>
    </table>

    <br><br><br> <br><br><br><br><br><br> <br><br><br>
    <table style="text-align : left; width : 100%">
    <tr>
      <td><b>Status:  </b></td> 
    </tr>
    <tr> 
      <td><b>No Rekening : </b></td> 
    </tr>
    </table>


        <table class="../table1" BORDER : style="text-align : left; width : 100%">
      <thead>
        <tr>
          <th>TOTAL PENGAJUAN</th>
          <th>TEREALISASI</th>
          <th>BELUM TEREALISASI</th>
        </tr>
      </thead>
      <tbody>
    <?php
      include '../conn.php';
      $sql = mysqli_query($koneksi, "select *, SUM(total_pr) AS grand_total from pr_fat where no_pr = '$no_pr'");
      $b = mysqli_query($koneksi, "select *, SUM(total_pr) AS realisasi from pr_fat where no_pr = '$no_pr' and status_item = 1");
      $c = mysqli_query($koneksi, "select *, SUM(total_pr) AS not_realisasi from pr_fat where no_pr = '$no_pr' and status_item = 0");

      $result = mysqli_fetch_array($sql);
      $grandtotal = "Rp " . number_format($result ['grand_total'],0,',','.');

      //$result = mysqli_fetch_array($b);
      //$b1 = "Rp " . number_format($result ['realisasi'],0,',','.');

      //$result = mysqli_fetch_array($c);
      //$c1 = "Rp " . number_format($result ['not_realisasi'],0,',','.');
  

      
                        
                      
          echo "<tr>
          <td style='text-align: center;'>$grandtotal</td>
          <td style='text-align: center;'></td>
          <td style='text-align: center;'></td>
          </tr>";

              ?>

          
      </tbody>
    </table>

    <br><br><br><br><br><br> <br><br><br>
    <table>
          <thead>
            <tr>
              <th width="200">Dibuat Oleh (*)  : </th>
              <th width="200">Disetujui Oleh (**) : </th>
            </tr>
            <tr>
              <td height="100"></td>
              <td height="100"></td>
              <td height="100"></td>
            </tr>
            <tr>
              <td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................)</td>
              <td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................)</td>
            </tr>
          </thead>
    </table>  
    
  </body>

  <footer>
    
  </footer>
</html>
 
<script type="text/javascript">
  window.print();
</script>