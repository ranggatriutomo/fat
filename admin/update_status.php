<?php
// Load file koneksi.php
include "../conn.php";

// Ambil Data yang Dikirim dari Form


$no_pc = $_GET['no_pc'];
// $status_item = $_POST['status_item'];
// var_dump($no_pc);
$uraian = $_POST['turaian'];
$jumlah = $_POST['tjumlah'];
$satuan = $_POST['tsatuan'];
$harga = $_POST['tharga'];
$total = $_POST['ttotal'];
$status_doc = $_POST['status_doc'];

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

  for($i = 0; $i < count($uraian) ; $i++){
    $queryInsert = "INSERT INTO `pc_fat`(`no_pc`, `no_intern`, `nama_pemohon`, `divisi`, `perihal`, `tgl_pc`, `no_proyek`, `kode_barang`, `keterangan`, `uraian_pc`, `jumlah_pc`, `satuan_pc`, `harga_pc`, `total_pc`, `status_req`, `norek`, `status_doc`, `status_item`, `created_by`) VALUES ('". $data['no_pc'] ."','". $data['no_intern'] ."','". $data['nama_pemohon'] ."','". $data['divisi'] ."','". $data['perihal'] ."','". $data['tgl_pc'] ."','". $data['no_proyek'] ."','". $data['kode_barang'] ."','". $data['keterangan'] ."','". $uraian[$i] ."','". $jumlah[$i] ."','". $satuan[$i] ."','". $harga[$i] ."','". $total[$i] ."','". $data['status_req'] ."','". $data['norek'] ."','". $status_doc ."',0,'". $data['created_by'] ."')" ;
  $sql = mysqli_query($koneksi, $queryInsert);

  }

  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='index.php'>Kembali Ke Form</a>";
  }
  

?>