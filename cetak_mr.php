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
    <title>Material Request to Purchase</title>
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
      <img src="kop_mr.png">
    </div>
  </div>

  <table style="text-align : left; width : 100%">
    <tr>
      <td >Produk dihasilkan: <?= $nama_pemohon;?> </td> 
      <td></td> 
      <td>No.MR to Purchase :  <?= $no_pc;?> </td>
    </tr>
    <tr> 
      <td>Divisi : <?= strtoupper($divisi);?></td> 
      <td></td> 
      <td>No.Internal : <?= $no_intern;?></td>
    </tr>
    <tr> 
      <td>Tipe Produk : <?= $perihal;?></td> 
      <td></td> 
      <td>Tanggal Pengajuan:<?= $tgl_pc;?></td>
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
          <th>Nama Material</th>
          <th>Spesifikasi</th>
          <th>Jumlah Diminta</th>
          <th>Jumlah Stok</th>
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
          <td style='text-align: center;'>".strtoupper($row['kode_barang'])."</td>
          <td style='text-align: center;'>".strtoupper($row['uraian_pc'])."</td>
          <td style='text-align: center;'>".strtoupper($row['jumlah_pc'])."</td>
          <td style='text-align: center;'>".strtoupper($row['satuan_pc'])."</td>
          </tr>";

          $no++;
                  }
              ?>

          
      </tbody>
    </table>

    <br><br><br>


    <br><br><br><br><br><br>
    <table>
          <thead>
            <tr>
              <th width="200">Diminta Oleh</th>
              <th width="200">Diketahui Oleh</th>
              <th width="200">Diterima Oleh</th>
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