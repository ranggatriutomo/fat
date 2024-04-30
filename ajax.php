<?php

//membuat koneksi ke database
include "conn.php";
//variabel nim yang dikirimkan form.php
$bhp_id = $_GET['bhp_id'];

//mengambil data
$query = mysqli_query($koneksi, "select * from bhp where bhp_id='$bhp_id'");
$bhp = mysqli_fetch_array($query);
$data = array(
            'stok'      =>  @$bhp['stok'],
            // 'jeniskelamin'      =>  @$mahasiswa['jeniskelamin'],
            // 'jurusan'   =>  @$mahasiswa['jurusan'],
            // 'notelp'      =>  @$mahasiswa['notelp'],
            // 'email'      =>  @$mahasiswa['email'],
            );

//tampil data
echo json_encode($data);
?>
