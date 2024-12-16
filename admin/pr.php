<?php include_once('header.php');
include '../conn.php';

$query2 = "select max(no_pr) as no_pr from pr_fat WHERE month(tgl_pr) = MONTH(CURRENT_DATE()) order by id_pr_fat  desc limit 1;";
$result2 = mysqli_query($koneksi,$query2);
$row = mysqli_fetch_array($result2);
$last_id = $row['no_pr'];
$bulan =   date('m');
if ($last_id == "")
{
    $format = "001-DABN-PR-".$bulan;
}
elseif(strlen($last_id) == 14){ //panjang kode 9 001-DABN-PC
    $urut =  substr($last_id, 0,3);
    $nourut = (int) $urut;  
    $nourut++;
    if($nourut < 10){
      $format = "00".$nourut."-DABN-PR-".$bulan;
    }elseif($nourut < 100){
      $format = "0".$nourut."-DABN-PR-".$bulan;
    }else{
      $format = $nourut."-DABN-PR-".$bulan;
    } 
}


?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Form 
        <small>Petty Cash</small>
      </h1> -->
    </section>
    <section class="content">
    <div class="row">
    <div class="col-md-12">
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
                  <h3 class="box-title">Material Request to Purchase Request</h3>
              </div>
              <div class="box-body">
              <div class="form-group col-md-5">
              <form class="form-horizontal" method="post">
              <label for="mr">No.Material Request</label>
                    <!-- <input type="number" name ="rek" class="form-control" placeholder="No.rek"> -->
                        <select class="form-control" style="width: 100%;" onchange="this.form.submit()"  name="no_pc">
                           <option value="">Pilih</option>
                          <?php include "conn.php"; 
                        if (!$koneksi){ die("Koneksi database gagal:".mysqli_connect_error()); } 
                        $sql="select distinct(no_pc), nama_pemohon, status_req from pc_fat where no_pc like '%MR%' and harga_pc = '' and tgl_pc >'2024-08-01'";
                        $hasil=mysqli_query($koneksi,$sql);
                         // Menangkap nilai yang dipilih sebelumnya (jika ada)
                        $selectedValue = isset($_POST['no_pc']) ? $_POST['no_pc'] : '';

                        while ($row = mysqli_fetch_array($hasil)) { 
                          // Jika nilai dropdown sama dengan nilai yang dipilih, tambahkan atribut selected

                          $selected = ($row['no_pc'] == $selectedValue) ? 'selected' : '';
                          echo "<option value='{$row['no_pc']}' $selected>{$row['no_pc']}</option>"; ?></option><?php } ?> 
                        </select>  
                        <br>
                            <!-- Button to show form and table -->
                            <button type="button" class="btn btn-primary" onclick="showFormAndTable()">Tampilkan Form</button>
          </div>         
            </form>
        </div>

                  <?php
                   $no_pc = isset($_POST["no_pc"]) ? $_POST['no_pc'] : "";
                  
                     include "../conn.php";  

                     $sql = mysqli_query($koneksi, "SELECT * FROM pc_fat where no_pc = '".$no_pc."'");
                      $a = mysqli_fetch_array($sql);

                  ?>
    <div id="formAndTable" style="display:none;">
      <form id="myForm" role="form" method="post" onSubmit="if(!confirm('Apakah anda yakin menyimpan data ini?')){return false;}" action="simpan_pengajuan.php" enctype="multipart/form-data">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Purchase Request</label>
                    <input type="text" name="no_pr" class="form-control"  value ="<?=$format?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Material Request</label>
                    <input type="text" name="no_pc" class="form-control"  value ="<?=$a ['no_pc'];?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" value ="<?= $a ['nama_pemohon'];?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Divisi</label>
                    <input type="text" name="divisi" class="form-control" value="<?= $a ['divisi']; ?>"  readonly>
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Tanggal PR</label>
                <input type="text" name="tgl_pr" class="form-control" value="<?= date('Y-m-d');?>" autocomplete="off" required readonly>
              </div>
            </div>
          </div>
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>#</th>
                  <th>Kode Barang</th>
                  <th>Deskripsi</th>
                  <th>Qty</th>
                  <th>UoM</th>
                  <th>Harga Satuan</th>
                  <th>Total Harga</th>
                </tr>
                <?php
                            
                $query = mysqli_query($koneksi,  "select * from pc_fat where no_pc = '".$no_pc."'");
                  $no=1;?>
                  <?php foreach($query as $row) : ?>
                    <tbody id="fieldContainer">
                <tr>
                <td><a href="#" data-kode-barang="<?= $row['kode_barang']; ?>" data-toggle="modal" data-target="#modal-default"><i class="glyphicon glyphicon-book"></i></a></td> 
                <td style="width:10%"><input type="hidden" name="id_pc_fat[]" class="form-control" autocomplete="off" readonly value = "<?php echo $row['id_pc_fat'];?>">
                                      <input type="text" name="kode_barang[]" class="form-control" autocomplete="off" readonly value = "<?php echo $row['kode_barang'];?>">
                                    </td>
                <td><input type="text" name="uraian_pr[]" class="form-control" autocomplete="off" readonly value = "<?php echo $row['uraian_pc'];?>"></td>                
                <td style="width:10%"><input type="text" name="jumlah_pr[]" class="form-control field1" oninput="calculateResults()" class="form-control" autocomplete="off" readonly value = "<?php echo $row['jumlah_pc'];?>"></td>
                <td style="width:10%"><input type="text" name="satuan_pr[]" class="form-control" autocomplete="off" readonly value = "<?php echo $row['satuan_pc'];?>"></td>
                <td><input type="number" name="harga_pr[]" class="form-control field2" oninput="calculateResults()" class="form-control" autocomplete="off" required></td>
                <td><input type="hidden" class="result-hidden" name="total_pr[]"><span class="result formatted"></span></td>
                </tr> 
                    </tbody>
                <?php endforeach; ?>
                <tfoot>
                  <tr>
                      <td></td>
                      <td style='text-align: center;'><b>Total</b></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><b><label for="totalResult"></label><input type="hidden" id="totalResult-hidden" name="totalResult"><span id="totalResult" class="formatted"></span></b></td>
                      
                            
                  </tr>
                </tfoot>
              </table>
              <button type="button" id="submitBtn" class="btn btn-info">Buat PR</button>
              <!-- <input type="submit" name="submit" class="btn btn-info" value="Buat PR"> </input> -->
            </div>
          </form>
    </div>
    </section>

    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Alat</h4>
              </div>
               <div class="modal-body">
               <p id="modalContent">Kode Barang: </p>
                 
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

  <!-- /.content-wrapper -->
</div><!-- /.content-wrapper -->
<?php include_once('footer.php');?>
<script>

function showFormAndTable() {
    var formAndTable = document.getElementById('formAndTable');
    formAndTable.style.display = 'block';
}
         function formatRupiah(number) {
            return 'Rp' + number.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }

        function calculateResults() {
            const rows = document.querySelectorAll('#fieldContainer tr');
            let total = 0;

            rows.forEach(row => {
                const field1 = parseFloat(row.querySelector('.field1').value);
                const field2 = parseFloat(row.querySelector('.field2').value);
                const resultHidden = row.querySelector('.result-hidden');
                const resultSpan = row.querySelector('.result');

                if (!isNaN(field1) && !isNaN(field2)) {
                    const product = field1 * field2;
                    resultHidden.value = product;
                    resultSpan.textContent = formatRupiah(product);
                    total += product;
                } else {
                    resultHidden.value = '';
                    resultSpan.textContent = '';
                }
            });

            document.getElementById('totalResult-hidden').value = total;
            document.getElementById('totalResult').textContent = formatRupiah(total);
        }

        document.querySelectorAll('.field1, .field2').forEach(input => {
            input.addEventListener('input', calculateResults);
        });
    </script>
    
    <script type="text/javascript">
  $(document).ready(function() {
    $('#submitBtn').click(function(e) {
      e.preventDefault();

      // Konfirmasi sebelum submit
      if(!confirm('Apakah anda yakin menyimpan data ini?')) {
        return false;
      }

      // Ambil data dari form
      var formData = new FormData($('#myForm')[0]);

      $.ajax({
        url: 'simpan_pengajuan.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          // Parsing respon dari PHP
          var res = JSON.parse(response);
          if (res.status == 'success') {
            alert('Data berhasil disimpan');
            // Redirect atau reload halaman jika perlu
            window.location.href = 'list_pr.php'; 
          } else {
            alert('Gagal menyimpan data: ' + res.message);
          }
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan: ' + error);
        }
      });
    });
  });
</script>
<script>
 $(document).ready(function() {
    // Ketika link dengan data-toggle="modal" diklik
    $('[data-toggle="modal"]').on('click', function() {
        // Ambil nilai dari atribut data-kode-barang
        var kodeBarang = $(this).data('kode-barang');

        // Kirim nilai ini ke server melalui AJAX
        $.ajax({
            url: 'get_barang_details.php',  // URL ke file PHP yang akan mengeksekusi query
            type: 'POST',
            data: { kode_barang: kodeBarang },
            success: function(response) {
                // Ganti konten modal dengan hasil dari server
                $('#modalContent').html(response);
            },
            error: function(xhr, status, error) {
                // Tampilkan pesan error jika terjadi kesalahan
                $('#modalContent').text('An error occurred: ' + error);
            }
        });
    });
});
</script>