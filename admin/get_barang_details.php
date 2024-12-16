<?php
if (isset($_POST['kode_barang'])) {
    $kode_barang = $_POST['kode_barang'];

    // Koneksi ke database
    include '../conn.php';

    // Query untuk mendapatkan detail barang
    $sql = mysqli_query($koneksi, "select * from mbarang where kode_barang = '$kode_barang'");
    $result = mysqli_fetch_array($sql);
    $spek = $result ['spek'];

    echo $spek;

}
?>