<?php
// Load file koneksi.php
include "../conn.php";

// Ambil Data yang Dikirim dari Form


$no_pc = $_GET['no_pc'];
$approve = $_POST['approve'];

// var_dump($data['no_pc']);

foreach($approve as $app){
  $query = "UPDATE pc_fat set status_item = 1 where no_pc='".$no_pc."' and id_pc_fat='".$app."'" ;
  $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query
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