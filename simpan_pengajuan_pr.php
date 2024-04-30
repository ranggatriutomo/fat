<link rel="stylesheet" href="alert/css/sweetalert.css">
<?php
// Load file koneksi.php
include "conn.php";

    $no_pc = $_POST['no_pc'];
    $no_intern = $_POST['no_intern'];
    $nama_pemohon = $_POST['nama_pemohon'];
    $divisi = $_POST['divisi'];
    $perihal = $_POST['perihal'];
    $tgl_pc = $_POST['tgl_pc'];
    $turaian = $_POST['turaian'];
    $tjumlah = $_POST['tjumlah'];
    $tkode = $_POST['tkode'];
    $tsatuan = $_POST['tsatuan'];
    $tharga = $_POST['tharga'];
    $ttotal = $_POST['ttotal'];
    $status_req = $_POST['status_req'];
    $field1 = $_POST['rek'];
    $field2 = $_POST['nb'];
    $field3 = $_POST['na'];

    $norek = $field1 . '-' . $field2 . '-' . $field3;

    $keterangan = $_POST['keterangan'];
    $no_proyek = $_POST['no_proyek'];
    $tkode = $_POST['tkode'];



    $i = 0;
    foreach ($turaian as $item){

     $query = "INSERT INTO pc_fat (no_pc,no_intern,nama_pemohon, divisi, perihal, tgl_pc, no_proyek, kode_barang, keterangan, uraian_pc, jumlah_pc, satuan_pc, harga_pc, total_pc, status_req, norek) 
     VALUES('".$no_pc."','".$no_intern."','".$nama_pemohon."', '".$divisi."', '".$perihal."', '".$tgl_pc."', '".$no_proyek."', '".$tkode[$i]."', '".$keterangan."', '".$turaian[$i]."', '".$tjumlah[$i]."','".$tsatuan[$i]."', '".$tharga[$i]."', '".$ttotal[$i]."', '".$status_req."', '".$norek."')";
     $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
   
     if($sql){ // Cek jika proses simpan ke database sukses atau tidak
       // Jika Sukses, Lakukan :
       echo "
       <script type='text/javascript'>
         setTimeout(function () { 
         
             swal({
                 title: 'Data Berhasil Terinput',
                 text:  'Form Purchase Request Tersubmit',
                 type: 'success',
                 timer: 3000,
                 
             });     
         },10);  
         window.setTimeout(function(){ 
             window.location.replace('list_pc.php');
         } ,3000);   
       </script>";
     }else{
       // Jika Gagal, Lakukan :
       echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
       echo "<br><a href='index.php'>Kembali Ke Form</a>";
     }

   $i++;
   }

?>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="alert/js/sweetalert.min.js"></script>
<script src="alert/js/qunit-1.18.0.js"></script>