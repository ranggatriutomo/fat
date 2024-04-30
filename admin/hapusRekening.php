<?php
// Load file koneksi.php
include "../conn.php";
// Ambil data NIS yang dikirim oleh index.php melalui URL
$id = $_GET['id_rekening'];
echo$id;
// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query2 = "DELETE FROM tbrekening WHERE id_rekening='".$id."'";
$sql2 = mysqli_query($koneksi, $query2); // Eksekusi/Jalankan query dari variabel $query
if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
  // Jika Sukses, Lakukan :
  header("location: rek.php"); // Redirect ke halaman index.php
}else{
  // Jika Gagal, Lakukan :
  echo "Data gagal dihapus. <a href='rek.php'>Kembali</a>";
}
?>