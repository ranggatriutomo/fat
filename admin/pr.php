<?php include_once('header_dashboard.php');
include 'conn.php';

$query2 = "select max(no_pc) as no_pc from pc_fat WHERE month(tgl_pc) = MONTH(CURRENT_DATE()) order by id_pc_fat  desc limit 1;";
$result2 = mysqli_query($koneksi,$query2);
$row = mysqli_fetch_array($result2);
$last_id = $row['no_pc'];
$bulan =   date('m');
if ($last_id == "")
{
    $format = "001-DABN-PC-".$bulan;
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
      <!-- end -->
    <div class="content-wrapper">
    <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Form Purchase Request
            <small class="pull-right"><?= date('l, d-m-Y');?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
      <form role="form" method="post"  action="simpan_pengajuan.php" enctype="multipart/form-data">
     <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Purchase Request</label>
                    <input type="text" name="no_pc" class="form-control"  value ="<?=$format?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Internal</label>
                    <input type="text" name="no_intern" class="form-control">
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="exampleInputEmail1" placeholder="Nama Pemohon" required="required">
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Divisi</label>
                    <input type="text" name="divisi" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="exampleInputEmail1" placeholder="Divisi" required="required">
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Perihal</label>
                    <input type="text" name="perihal" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="exampleInputEmail1" placeholder="Perihal" required="required">
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Tanggal PC</label>
                <input type="date" name="tgl_pc" class="form-control" autocomplete="off" required >
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nomor Rekening</label>
                    <input type="text" name="norek" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="norek" placeholder="No.Rekening" required="required">
                    
              </div>

              <div class="form-group col-xs-6">
                  <label>Status</label>
                  <select class="form-control" name="status_req">
                    <option>==Pilih Status==</option>
                    <option>Normal</option>
                    <option>Urgent</option>
                  </select>
                </div>


              <a href="#" id="add-items" class="btn btn-info">Tambah Uraian</a>

            </div>
            
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Uraian</th>
                      <th>Jumlah</th>
                      <th>Satuan</th>
                      <th>Harga</th>
                      <th>Total</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="items-list">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="submit" class="btn btn-info" value="Buat Pengajuan"> </input>
          <a href="keluar.php" id="add-items" class="btn btn-danger">Cancel</a> 
          </form>
          </div>
          </div>
          <!-- /.box -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- </div> -->
      <!-- </div> -->
  </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
</div><!-- /.content-wrapper -->
<?php include_once('footer_dashboard.php');?>
<script>
   
    $(document).ready(function () {
      var i = 1;
      
    $('#add-items').click(function(e) {
      e.preventDefault()
        console.log();
        var newRow = $('<tr>');
        var cols = "";
        cols += '<td><input type="text" name="turaian[]" class="form-control" value=""/></td>';
        cols += '<td><input type="text" name="tjumlah[]" id="tjumlah'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')" value=""/></td>';
        cols += '<td><input type="text" name="tsatuan[]" class="form-control" value=""/></td>';
        cols += '<td><input type="text" name="tharga[]" id="tharga'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')"  value=""/ ></td>';
        cols += '<td><input type="text" name="ttotal[]" id="hasilJumlah'+i+'" class="form-control" value=""/readonly="readonly"></td>';
        cols += '<td><a href="#" class="delrow"><i class="fa fa-trash"></i></a></td>';
        cols += '</tr>';

        newRow.append(cols);
        $("#items-list").append(newRow);
        $('#myTable').slideDown();

        

        i++;
    });

   


    $('#myTable').on('click', '.delrow', function(e) {
        var lenRow = $('#myTable tbody tr').length;
          e.preventDefault();
          if (lenRow == 1 || lenRow <= 1) {
              $(this).parents('tr').remove();
              $('#myTable').slideUp();
              $('.btn-submit').hide();
          } else {
              $(this).parents('tr').remove();
          }
        });

      });

$(document).ready(function(){
    // Tangani peristiwa input pada kedua field
    $(".input-field").on("input", function(){
        // Ambil nilai dari field1 dan field2
        var nilai1 = parseFloat($("#field1").val()) || 0;
        var nilai2 = parseFloat($("#field2").val()) || 0;

        // Jumlahkan nilai
        var hasil = nilai1 + nilai2;

        // Tampilkan hasil
        $("#hasilJumlah").text(hasil);
    });
});
</script>

<script type="text/javascript">
  function fjumlah  (id) {
          var vtjumlah = document.getElementById("tjumlah"+id).value;
          var vtharga = document.getElementById("tharga"+id).value;
          var hasil = vtjumlah * vtharga;
          document.getElementById("hasilJumlah"+id).value=hasil;
        }


</script>