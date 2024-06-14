<?php
// Load file koneksi.php
include "conn.php";

// Ambil Data yang Dikirim dari Form


$no_pc = $_POST['no_pc'];
$no_intern = $_POST['no_intern'];
$nama_pemohon = $_POST['nama_pemohon'];
$divisi = $_POST['divisi'];
$perihal = $_POST['perihal'];
$tgl_pc = $_POST['tgl_pc'];
$turaian = $_POST['turaian'];
$tjumlah = $_POST['tjumlah'];
$tsatuan = $_POST['tsatuan'];
$tharga = $_POST['tharga'];
$ttotal = $_POST['ttotal'];
$status_req = $_POST['status_req'];
$norek = $_POST['norek'];


  // Proses simpan ke Database
  // $query = "UPDATE pc_fat SET status_item='".$status_item."' WHERE  no_pc='".$no_pc."'";
  // $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
  $data1 = mysqli_query($koneksi,  "select * from pc_fat where no_pc = '".$no_pc."' limit 1");

  foreach($data1 as $row){
    $data = $row;
  }
// var_dump($data['no_pc']);
  $query = "DELETE from pc_fat where no_pc = '".$no_pc."' AND status_item != 1" ;
  $sql1 = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query

  for($i = 0; $i < count($turaian) ; $i++){
    $queryInsert = "INSERT INTO pc_fat (no_pc,no_intern,nama_pemohon, divisi, perihal, tgl_pc, uraian_pc, jumlah_pc, satuan_pc, harga_pc, total_pc, status_req, norek) 
    VALUES ('". $data['no_pc'] ."','". $data['no_intern'] ."','". $data['nama_pemohon'] ."','". $data['divisi'] ."','". $data['perihal'] ."','". $data['tgl_pc'] ."','". $turaian[$i] ."','". $tjumlah[$i] ."','". $tsatuan[$i] ."','". $tharga[$i] ."','". $ttotal[$i] ."','". $data['status_req'] ."','". $data['norek'] ."')" ;
  $sql = mysqli_query($koneksi, $queryInsert);

  }

  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: list_pc.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='index.php'>Kembali Ke Form</a>";
  }
  

?>