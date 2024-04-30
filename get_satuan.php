<?php

//membuat koneksi ke database
header('Content-Type: application/json; charset=utf-8');
include "conn.php";
//variabel nim yang dikirimkan form.php
$tkode = $_GET['tkode'];

//mengambil data
$query = mysqli_query($koneksi, "select * from mbarang where kode_barang='".$tkode."'");
$data = mysqli_fetch_array($query);

//tampil data
echo json_encode($data);
?>
