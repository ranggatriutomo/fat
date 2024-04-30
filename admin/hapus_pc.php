<?php
// Load file koneksi.php
include "../conn.php";
// Ambil data NIS yang dikirim oleh index.php melalui URL
$no_pc = $_GET['no_pc'];
// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
$query = "SELECT * FROM pc_fat WHERE no_pc='".$no_pc."'";
$sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query2 = "DELETE FROM pc_fat WHERE no_pc='".$no_pc."'";
$sql2 = mysqli_query($koneksi, $query2); // Eksekusi/Jalankan query dari variabel $query
if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  header("location: index.php"); // Redirect ke halaman index.php
}else{
  // Jika Gagal, Lakukan :
  echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
?>