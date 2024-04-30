<?php
// Load file koneksi.php
include "../conn.php";

// Ambil Data yang Dikirim dari Form
$norek = $_POST['norek'];
$atas_nama = $_POST['atas_nama'];
$nama_bank = $_POST['nama_bank'];

  // Proses simpan ke Database
  $query = "INSERT INTO tbrekening VALUES('".$id_rekening."', '".$norek."', '".$nama_bank."', '".$atas_nama."')";
  $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query

  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: rek.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='merk.php'>Kembali Ke Form</a>";
  }

?>