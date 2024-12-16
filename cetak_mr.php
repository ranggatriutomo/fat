<?php
include 'conn.php';
$no_pc = $_GET['no_pc'];

// Mengambil data utama dari tabel pc_fat
$barang = mysqli_query($koneksi, "SELECT * FROM pc_fat WHERE no_pc = '$no_pc'");
$row = mysqli_fetch_array($barang);

$nama_pemohon = $row['nama_pemohon'];
$divisi = $row['divisi'];
$perihal = $row['perihal'];
$no_pc = $row['no_pc'];
$no_intern = $row['no_intern'];
$tgl_pc = date('d F Y', strtotime($row['tgl_pc']));
$status_req = $row['status_req'];
$norek = $row['norek'];
$keterangan = $row['keterangan'];
$no_proyek = $row['no_proyek'];

// Mengambil semua file terkait dari tabel pc_fat_files
$files_query = mysqli_query($koneksi, "
    SELECT f.file 
    FROM pc_fat_files f
    JOIN pc_fat p ON f.id_pc_fat = p.id_pc_fat
    WHERE p.no_pc = '$no_pc'
");

if (!$files_query) {
    die("Query Error: " . mysqli_error($koneksi));
}


$files = [];
while ($file_row = mysqli_fetch_assoc($files_query)) {
    $files[] = $file_row['file'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Material Request</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        body {
            background-color: white;
            font-family: "Calibri";
            font-size: 13px;
        }
        .table-bordered td {
            text-align: left;
        }
        td {
            text-align: left;
            font-size: 14px;
        }
        iframe {
            width: 100%;
            height: 500px;
            border: none;
        }
        @media print {
            iframe {
                height: 100%;
            }
        }
    </style>
</head>

<body class="A4-landscape">
    <!-- Form dan informasi lainnya -->
    <div class="container-header">
        <div class="container-logo">
            <img src="kop_mr.png">
        </div>
    </div>
    <br><br><br>
    <table style="text-align : left; width : 100%">
        <tr>
            <td>Purchase Request No. &nbsp;&nbsp;&nbsp; :  <?= $no_pc;?> </td>
        </tr>
        <tr> 
            <td>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $tgl_pc;?></td>
        </tr>
        <tr> 
            <td>Internal No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $no_intern;?></td>
        </tr>
    </table>
    <br><br><br>
    <table class="table1" style="text-align : left; width : 100%">
        <thead>
            <tr>
                <th width="12">PEMOHON</th>
                <td><?= $nama_pemohon;?></td>
                <th width="12">COST CENTER</th>
                <td><?= $perihal;?></td>
                <th rowspan="2" width="15">TANGGAL DIPERLUKAN</th>
                <td rowspan="2"></td>
            </tr>
            <tr>
                <th width="12">DIVISI</th>
                <td><?= strtoupper($divisi);?></td>
                <th width="12">NO.PROYEK</th>
                <td><?= $no_proyek;?></td>
            </tr>
            <tr>
                <th width="12">Keterangan</th>
                <td colspan="5"><?= strtoupper($keterangan);?></td>
            </tr>
        </thead>
        <tbody>
            <!-- Isi tabel -->
        </tbody>
    </table>
    <br><br>
    <table class="table1" style="text-align : left; width : 100%">
        <thead><b>Rincian Permintaan</b>
            <tr>
                <th width="10">No.</th>
                <th>Kode</th>
                <th>Deskripsi</th>
                <th width="12">Qty</th>
                <th width="12">UoM</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $barang = mysqli_query($koneksi, "SELECT * FROM pc_fat WHERE no_pc = '$no_pc'");
            $no = 1;
            foreach ($barang as $row) {
                echo "<tr>
                        <td>$no</td>
                        <td style='text-align: center;'>".strtoupper($row['kode_barang'])."</td>
                        <td style='text-align: center;'>".strtoupper($row['uraian_pc'])."</td>
                        <td style='text-align: center;'>".strtoupper($row['jumlah_pc'])."</td>
                        <td style='text-align: center;'>".strtoupper($row['satuan_pc'])."</td>
                    </tr>";
                $no++;
            }
        ?>
        </tbody>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br>
    <table style="text-align : left; width : 100%">
        <tr>
            <td><b>Status: <?= $status_req;?> </b></td>
        </tr>
        <tr> 
            <td><b>Note : </b></td>
        </tr>
    </table>
    <br><br><br><br><br><br><br><br><br>
    <table>
        <thead>
            <tr>
                <th width="200">Dibuat Oleh         : </th>
                <th width="200">Diketahui Oleh (*)  : </th>
                <th width="200">Disetujui Oleh (**) : </th>
            </tr>
            <tr>
                <td height="100"></td>
                <td height="100"></td>
                <td height="100"></td>
            </tr>
            <tr>
                <td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................)</td>
                <td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................)</td>
                <td width="200">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................)</td>
            </tr>
        </thead>
    </table>
    <br><br><br><br>

    <!-- Tampilkan semua file yang diunggah -->
    <?php if (!empty($files)): ?>
        <h4>File yang Diunggah:</h4>
        <?php foreach ($files as $file): ?>
            <img src="gambar_pendukung/<?= $file ?>" alt="Gambar yang Diunggah" style="width: 100%; max-height: 500px; object-fit: contain; margin-bottom: 10px;">
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada file yang diunggah.</p>
    <?php endif; ?>

</body>

<script type="text/javascript">
  window.print();
</script>

</html>
