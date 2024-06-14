<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="logo.png">
  <title>Fat | Log in</title>
<link rel="stylesheet" href="alert/css/sweetalert.css">
</head>
<body>

<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'conn.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if($data['level']=="admin"){

        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        // alihkan ke halaman dashboard admin
        echo "
  <script type='text/javascript'>
    setTimeout(function () { 
    
        swal({
            title: 'Selamat Datang',
            text:  '$username',
            type: 'success',
            timer: 3000,
            
        });     
    },10);  
    window.setTimeout(function(){ 
        window.location.replace('https://fat.dabnsalvage.co.id/admin/dashboard.php');
    } ,3000);   
  </script>";
        // header("location:home.php");

    // cek jika user login sebagai pegawai
    }else if($data['level']=="staff"){
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "staff";
        // alihkan ke halaman dashboard pegawai
        echo "
        <script type='text/javascript'>
          setTimeout(function () { 
          
              swal({
                  title: 'Selamat Datang',
                  text:  '$username',
                  type: 'success',
                  timer: 3000,
                  
              });     
          },10);  
          window.setTimeout(function(){ 
              window.location.replace('home.php');
          } ,3000);   
        </script>";

    // cek jika user login sebagai pengurus
    }else if($data['level']=="pengurus"){
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "pengurus";
        // alihkan ke halaman dashboard pengurus
        header("location:halaman_pengurus.php");

    }else{

        // alihkan ke halaman login kembali
        header("location:index.php?pesan=gagal");
    }

    
}else{
    // header("location:index.php?pesan=gagal");
    echo "
      <script type='text/javascript'>
        setTimeout(function () {    
            swal({
                  
                title: 'Oops..',
                text: 'Something went wrong!',
                type: 'error',
                timer: 3000,
                showConfirmButton: true
            });     
        },10);  
        window.setTimeout(function(){ 
            window.location.replace('index.php?pesan=gagal1');
        } ,3000);   
      </script>";
}



?>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="alert/js/sweetalert.min.js"></script>
<script src="alert/js/qunit-1.18.0.js"></script>

</body>
</html>