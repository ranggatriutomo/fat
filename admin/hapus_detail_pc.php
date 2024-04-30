<?php
include "../conn.php";

if(isset($_POST["action"])){
  // Choose a function depends on value of $_POST["action"]
  if($_POST["action"] == "delete"){
    delete();
  }
}

function delete(){
  global $koneksi;

  $id_pc_fat = $_POST["id_pc_fat"];

  $rows = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pc_fat WHERE id_pc_fat = $id_pc_fat"));

  // Data with female gender
  // if($rows["gender"] == "Female"){
  //   echo 0;
  //   exit;
  // }

  mysqli_query($koneksi, "DELETE FROM pc_fat WHERE id_pc_fat = $id_pc_fat");
  echo 1;
}
