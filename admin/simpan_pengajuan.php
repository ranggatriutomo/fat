<?php
// Load file koneksi.php
include "../conn.php";

$no_pc = $_POST['no_pc'];
$no_pr = $_POST['no_pr'];
$nama_pemohon = $_POST['nama_pemohon'];
$divisi = $_POST['divisi'];
$tgl_pr = $_POST['tgl_pr'];
$id_pc_fat = $_POST['id_pc_fat'];
$kode_barang = $_POST['kode_barang'];
$uraian_pr = $_POST['uraian_pr'];
$jumlah_pr = $_POST['jumlah_pr'];
$satuan_pr = $_POST['satuan_pr'];
$harga_pr = $_POST['harga_pr'];
$total_pr = $_POST['total_pr'];

$success = true; // Flag untuk mengecek jika semua query berhasil

foreach ($satuan_pr as $i => $satuan) {
    // Insert ke tabel pr_fat
    $query_insert = "INSERT INTO pr_fat (id_pc_fat, no_pc, no_pr, nama_pemohon, divisi, tgl_pr, kode_barang, uraian_pr, jumlah_pr, satuan_pr, harga_pr, total_pr) VALUES
                     ('{$id_pc_fat[$i]}','$no_pc', '$no_pr', '$nama_pemohon', '$divisi', '$tgl_pr', '{$kode_barang[$i]}', '{$uraian_pr[$i]}', '{$jumlah_pr[$i]}', '$satuan', '{$harga_pr[$i]}', '{$total_pr[$i]}')";
    $sql_insert = mysqli_query($koneksi, $query_insert);

    // Cek apakah insert berhasil
    if ($sql_insert) {
        // Update stok barang di tabel 'barang'
        $query_update = "UPDATE pc_fat SET harga_pc = '{$harga_pr[$i]}', total_pc = '{$total_pr[$i]}' WHERE id_pc_fat = '{$id_pc_fat[$i]}'";
        $sql_update = mysqli_query($koneksi, $query_update);

        // Cek apakah update berhasil
        if (!$sql_update) {
            $success = false;
            break; // Keluar dari loop jika ada kesalahan
        }
    } else {
        $success = false;
        break; // Keluar dari loop jika ada kesalahan
    }
}

// Kirim respon JSON berdasarkan status
if ($success) {
    echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
}
?>

