<?php
    include 'conn.php';
    $no_pc = $_GET['no_pc'];
    // $tgl_pc = $_GET['tgl_pc'];
     $barang = mysqli_query($koneksi, "select *
     from pc_fat
     where no_pc = '$no_pc'");
     $row=mysqli_fetch_array($barang);

     $nama_pemohon=$row['nama_pemohon'];
     $divisi=$row['divisi'];
     $perihal=$row['perihal'];
     $no_pc=$row['no_pc'];
     $no_intern=$row['no_intern'];
     $tgl_pc= date('d F Y', strtotime($row['tgl_pc']));
     $status_req = $row['status_req'];
     $norek = $row['norek'];
    
     $query = mysqli_query($koneksi, "select * from pc_fat");
     $pc=mysqli_fetch_array($query);

    //  $data = $pc ['no_invoice'];
    // print_r($inv2);
    
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Petty Cash</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
      <img src="kop_pc.png">
    </div>
  </div>

  <table style="text-align : left; width : 100%">
    <tr>
      <td >Nama Pemohon &nbsp;&nbsp;&nbsp;: <?= $nama_pemohon;?> </td> 
      <td></td> 
      <td>No Petty Cash &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $no_pc;?> </td>
    </tr>
    <tr> 
      <td>Divisi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= strtoupper($divisi);?></td> 
      <td></td> 
      <td>No.Internal  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $no_intern;?></td>
    </tr>
    <tr> 
      <td>Perihal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $perihal;?></td> 
      <td></td> 
      <td>Tgl Pengajuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $tgl_pc;?></td>
    </tr>
    <tr>
      <!-- <td>Tujuan : <?= $hlokasi;?></td> 
      <td></td> 
      <td>Pengiriman Via : </td>  -->
    </tr>
  </table>



    <table class="table1" style="text-align : left; width : 100%">
      <thead>
        <tr>
          <th width="10">No.</th>
          <th>Uraian</th>
          <th>Jumlah</th>
          <th width="12">Satuan</th>
          <th>Harga</th>
          <th>Total Harga</th>
          <!-- <th>Keterangan</th>
          <th width="10">Cheklist</th> -->
        </tr>
      </thead>
      <tbody>
    <?php
      include 'conn.php';
      // $project = $_GET['project'];
      // $tgl_trxout = $_GET['tgl_trxout'];

      $barang = mysqli_query($koneksi,  "select * from pc_fat where no_pc = '$no_pc'");
        $no=1;
        foreach ($barang as $row){
                        
                      
          echo "<tr>
          <td>$no</td>
          <td style='text-align: center;'>".strtoupper($row['uraian_pc'])."</td>
          <td style='text-align: center;'>".strtoupper($row['jumlah_pc'])."</td>
          <td style='text-align: center;'>".strtoupper($row['satuan_pc'])."</td>
          <td style='text-align: center;'>"."Rp " . number_format($row ['harga_pc'],0,',','.')."</td>
          <td style='text-align: center;'>"."Rp " . number_format($row ['total_pc'],0,',','.')."</td>
          </tr>";

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
        <tr>
            <td></td>
            <td style='text-align: center;'><b>Total</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: center;'><b><?=$grandtotal;?></b></td>
        </tr>
      </tfoot>
    </table>

    <br><br><br>
    <table style="text-align : left; width : 100%">
    <tr>
      <td><b>Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $status_req;?> </b></td> 
    </tr>
    <tr> 
      <td><b>No Rekening &nbsp; : <?= $norek;?></b></td> 
    </tr>
    </table>

    <table class="table1" BORDER : style="text-align : left; width : 100%">
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
          <td style='text-align: center;'>$grandtotal</td>
          <td style='text-align: center;'>$b1</td>
          <td style='text-align: center;'>$c1</td>
          </tr>";

              ?>

          
      </tbody>
    </table>

    <br><br><br><br><br><br>
    <table>
          <thead>
            <tr>
              <th width="200">Dibuat Oleh</th>
              <th width="200">Diterima Oleh</th>
              <th width="200">Disahkan Oleh</th>
            </tr>
            <tr>
              <td height="100"></td>
              <td height="100"></td>
              <td height="100"></td>
            </tr>
            <tr>
              <td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................)</td>
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