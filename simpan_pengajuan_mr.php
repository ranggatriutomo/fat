<link rel="stylesheet" href="alert/css/sweetalert.css">
<?php
// Load file koneksi.php
include "conn.php";

$no_pc = $_POST['no_pc'];
$no_intern = $_POST['no_intern'];
$nama_pemohon = $_POST['nama_pemohon'];
$divisi = $_POST['divisi'];
$perihal = $_POST['perihal'];
$tgl_pc = $_POST['tgl_pc'];
$turaian = $_POST['turaian'];
$tjumlah = $_POST['tjumlah'];
$tkode = $_POST['tkode'];
$tsatuan = $_POST['tsatuan'];
$status_req = $_POST['status_req'];
$field1 = $_POST['rek'];
$field2 = $_POST['nb'];
$field3 = $_POST['na'];

$norek = $field1 . '-' . $field2 . '-' . $field3;

$keterangan = $_POST['keterangan'];
$no_proyek = $_POST['no_proyek'];

// Insert data utama ke tabel pc_fat
$i = 0;
foreach ($turaian as $item) {
    $query = "INSERT INTO pc_fat (no_pc, no_intern, nama_pemohon, divisi, perihal, tgl_pc, no_proyek, kode_barang, keterangan, uraian_pc, jumlah_pc, satuan_pc, status_req, norek) 
        VALUES('" . $no_pc . "','" . $no_intern . "','" . $nama_pemohon . "', '" . $divisi . "', '" . $perihal . "', '" . $tgl_pc . "', '" . $no_proyek . "', '" . $tkode[$i] . "', '" . $keterangan . "', '" . $turaian[$i] . "', '" . $tjumlah[$i] . "','" . $tsatuan[$i] . "', '" . $status_req . "', '" . $norek . "')";
    $sql = mysqli_query($koneksi, $query); // Eksekusi/ Jalankan query dari variabel $query

    // Mendapatkan ID dari data yang baru saja dimasukkan
    $last_id = mysqli_insert_id($koneksi);

    // Cek jika proses simpan ke database sukses atau tidak
    if (!$sql) {
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='index.php'>Kembali Ke Form</a>";
        exit();
    }

    $i++;
}

// Proses unggahan file
$rand = rand();
$ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'pdf');

foreach ($_FILES['berkas']['name'] as $key => $filename) {
    $ukuran = $_FILES['berkas']['size'][$key];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!empty($filename)) {
        // Memeriksa apakah ekstensi file valid
        if (!in_array($ext, $ekstensi)) {
            header("location:mr.php?alert=gagal_ekstensi");
            exit();
        } else if ($ukuran < 25044070) {
            $xx = $rand . '_' . $filename;
            move_uploaded_file($_FILES['berkas']['tmp_name'][$key], 'gambar_pendukung/' . $xx);

            // Menyimpan informasi file ke tabel pc_fat_files
            $file_query = "INSERT INTO pc_fat_files (id_pc_fat, file) VALUES ('$last_id', '$xx')";
            $file_sql = mysqli_query($koneksi, $file_query);

            if (!$file_sql) {
                echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan file ke database.";
                exit();
            }
        } else {
            echo "Ukuran file terlalu besar.";
            exit();
        }
    }
}

// Jika semua proses berhasil, tampilkan pesan sukses
echo "
<script type='text/javascript'>
    setTimeout(function () { 
        swal({
            title: 'Data Berhasil Terinput',
            text: 'Form Purchase Request Tersubmit',
            type: 'success',
            timer: 3000,
        });     
    }, 10);  
    window.setTimeout(function(){ 
        window.location.replace('list_pc.php');
    } ,3000);   
</script>";
?>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="alert/js/sweetalert.min.js"></script>
<script src="alert/js/qunit-1.18.0.js"></script>
