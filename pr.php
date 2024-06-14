<!-- pembuata  nomor auto generate reset per bulan -->
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

// script buat nomor internal 

$query = "select max(no_intern) as no_intern from pc_fat WHERE month(tgl_pc) = MONTH(CURRENT_DATE()) && divisi = '$divisi' order by id_pc_fat  desc limit 1;";
$result = mysqli_query($koneksi,$query);
$a = mysqli_fetch_array($result);
$last_id_1 = $a['no_intern'];
$bulan =   date('m');
if ($last_id_1 == "")
{
    $format_1 = "001-DABN-".$bulan;
}
elseif(strlen($last_id_1) == 11){ //panjang kode 11 001-DABN-03
    $urut =  substr($last_id_1, 0,3);
    $nourut = (int) $urut;  
    $nourut++;
    if($nourut < 10){
      $format_1 = "00".$nourut."-DABN-".$bulan;
    }elseif($nourut < 100){
      $format_1 = "0".$nourut."-DABN-".$bulan;
    }else{
      $format_1 = $nourut."-DABN-".$bulan;
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
      <form role="form" method="post" onSubmit="if(!confirm('Apakah anda yakin menyimpan data ini?')){return false;}"  action="simpan_pengajuan_pr.php" enctype="multipart/form-data">
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
                    <input type="text" name="no_intern" class="form-control" value ="<?=$format_1?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="exampleInputEmail1" placeholder="Nama Pemohon" required="required">
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Divisi</label>
                    <input type="text" name="divisi" class="form-control" value="<?=$divisi ?>" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="exampleInputEmail1" placeholder="Divisi" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Cost Center</label>
                    <input type="text" name="perihal" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" id="exampleInputEmail1" placeholder="Cost Center" required="required">
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Tanggal PR</label>
                <input type="text" name="tgl_pc" class="form-control" value="<?= date('Y-m-d');?>" autocomplete="off" required readonly >
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Proyek</label>
                    <input type="text" name="no_proyek" class="form-control" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="No.Proyek" required="required">
              </div>

              <div class="form-group col-xs-6">
                  <label>Status</label>
                  <select class="form-control" name="status_req">
                    <option>==Pilih Status==</option>
                    <option>Normal</option>
                    <option>Urgent</option>
                  </select>
                </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">No.Rekening</label>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4">
                      <!-- <input type="number" name ="rek" class="form-control" placeholder="No.rek"> -->
                          <select class="form-control select2" id="rek" style="width: 100%;"  name="rek" onChange="ket()" required="required"><?php include "conn.php"; 
                          if (!$koneksi){ die("Koneksi database gagal:".mysqli_connect_error()); } $sql="select * from tbrekening"; $hasil=mysqli_query($koneksi,$sql); $no=0; while ($row = mysqli_fetch_array($hasil)) { $no++; ?> <option value="<?php echo $row['norek'];?>"><?php echo $row['norek'] ; str_repeat('&nbsp;', 2); echo" -- "; echo $row['nama_bank'] ;echo" - "; echo $row['atas_nama'] ; ?></option><?php } ?> </select>
                      </div>
                      <div class="col-xs-4">
                        <input type="text" id="textnamabank"  onkeyup="this.value = this.value.toUpperCase()"  class="form-control" placeholder="Nama Bank" name="nb">
                        <!-- <input type="text" name="nb" id="nb"> -->
                      </div>
                
                      <div class="col-xs-4">
                        <input type="text" id="textatasnama" onkeyup="this.value = this.value.toUpperCase()" class="form-control" placeholder="atas nama" name="na">
                        <!-- <input type="text" name="na" id="na"> -->
                      </div>
                    </div>
                  </div>   
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Keterangan</label>
                 <textarea name="keterangan" class="form-control"  autocomplete="on" required placeholder="Keterangan"></textarea>
              </div>

              

            </div>
            
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width : 10px>Kode Barang/Jasa</th>
                      <th>Deskripsi</th>
                      <th>Qty</th>
                      <th>UoM</th>
                      <th>Per Unit</th>
                      <th>Total Price</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="items-list">

                    </tbody>
                     <tr>
                        <td></td>
                        <td></td>
                        <td style='text-align: center;'><b>Total</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style='text-align: center;'><b id="grandtotal"></b><input type="hidden" id="aaa" value=""></td>                    
                    </tr>

                  </table>
                  <a href="#" id="add-items" class="btn btn-info">Tambah Rincian</a>
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

      ket($('#rek').val());
      
      $('.select2').select2({
          tags: true,
        });

      var i = 1;
      
    $('#add-items').click(function(e) {
      e.preventDefault()
        console.log();
        var newRow = $('<tr>');
        var cols = "";
        cols += '<td><select class="form-control select2" id="tkode'+i+'" name="tkode[]" style="width: 100%;" onChange="getSatuan('+i+')" ><option value="">Pilih Item</option><?php include "conn.php"; 
                       if (!$koneksi){ die("Koneksi database gagal:".mysqli_connect_error()); } $sql="select * from mbarang where stok > 0"; $hasil=mysqli_query($koneksi,$sql); $no=0; while ($row = mysqli_fetch_array($hasil)) { $no++; ?> <option value="<?php echo $row['kode_barang'];?>"><?php echo $row['kode_barang'] ; str_repeat('&nbsp;', 2); echo" -- "; echo $row['nama_barang'] ; ?></option><?php } ?> </select></td>';

        //cols += '<td><input type="text" name="turaian[]" class="form-control" value=""/></td>';
        cols += '<td><input type="text" name="turaian[]" id="turaian'+i+'" class="form-control" value=""/></td>';
        // cols += '<td><p id="texturaian'+i+'"></p><textarea name="turaian[]" id="turaian'+i+'" class="form-control"></textarea></td>';
        
        cols += '<td><input type="text" name="tjumlah[]" id="tjumlah'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')" value=""/></td>';
        cols += '<td><input type="text" name="tsatuan[]" id="tsatuan'+i+'" class="form-control" value=""/></td>';
        cols += '<td><input type="text" name="tharga[]" id="tharga'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')"  value=""/ ></td>';
        // cols += '<td>'+ parseInt($("#tharga").val()).toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
        // maximumFractionDigits: 0}) + '<input type="hidden" name="tharga[]" id="tharga'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')"  value="" /></td>';
        cols += '<td><input type="text" name="ttotal[]" id="hasilJumlah'+i+'" class="form-control price" value="0" readonly="readonly"/></td>';
    //     cols += '<td>'+ parseInt($("#hasilJumlah").val()).toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
    // maximumFractionDigits: 0}) + '<input type="hidden" name="ttotal[]" id="hasilJumlah'+i+'" class="form-control price" value="" ></td>';
        cols += '<td><a href="#" class="delrow"><i class="fa fa-trash"></i></a></td>';
        cols += '</tr>';

        newRow.append(cols);
        $("#items-list").append(newRow);
        $('#myTable').slideDown();

        $('.select2').select2({
          tags: true,
        });

        var sumA = 0;
        $('.price').each(function(){
          sumA += parseInt($(this).val());
        });



        $("#grandtotal").text(sumA.toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
    maximumFractionDigits: 0}));
        $("#aaa").val(sumA);

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

          var sumA = 0;
          $('.price').each(function(){
            sumA += parseInt($(this).val());
          });

          $("#grandtotal").text(sumA.toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
      maximumFractionDigits: 0}));
          $("#aaa").val(sumA);
        });

      });

    function ket(id) {
      var kd = $('#rek'). val();

        $.ajax({ type: "GET",   
             url: "ket_data.php?rek="+kd,   
             async: false,
             success : function(text)
             {
              if(text){
                $('#textnamabank').prop('readonly', true);
                $('#textatasnama').prop('readonly', true);
                $('#textnamabank').val(text.nama_bank);
                $('#textatasnama').val(text.atas_nama);

              }else{
                $('#textnamabank').val("");
                $('#textatasnama').val("");

                $('#textnamabank').prop('readonly', false);
                $('#textatasnama').prop('readonly', false);
              }
               
                // alert('test')
             }
        });
          // var vtjumlah = document.getElementById("tjumlah"+id).value;
          // var vtharga = document.getElementById("tharga"+id).value;
          // var hasil = vtjumlah * vtharga;
          // document.getElementById("hasilJumlah"+id).value=hasil;
        }


      function getSatuan(id) {
      var tkode = $('#tkode'+id). val();

        $.ajax({ type: "GET",   
             url: "get_satuan.php?tkode="+tkode,   
             async: false,
             success : function(text)
             {

              console.log();

              if(text){
                $('#tsatuan'+id).prop('readonly', true);
                $('#tsatuan'+id).val(text.satuan);
                $('#turaian'+id).prop('readonly', true);
                $('#turaian'+id).val(text.nama_barang);


              }else{
                $('#tsatuan'+id).val("");
                $('#tsatuan'+id).prop('readonly', false);
                $('#turaian'+id).val("");
                $('#turaian'+id).prop('readonly', false);
                
                // alert('test'); 
              }
               
                // alert('test')
             }
        });
          // var vtjumlah = document.getElementById("tjumlah"+id).value;
          // var vtharga = document.getElementById("tharga"+id).value;
          // var hasil = vtjumlah * vtharga;
          // document.getElementById("hasilJumlah"+id).value=hasil;
        }

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
          var vtjumlah = document.getElementById("tjumlah"+id).value  || 0;
          var vtharga = document.getElementById("tharga"+id).value || 0;

          var hasil = parseInt(vtjumlah) * parseInt(vtharga);

          document.getElementById("hasilJumlah"+id).value=hasil;

          var sumA = 0;
          $('.price').each(function(){
            sumA += parseInt($(this).val());
          });

          $("#grandtotal").text(sumA.toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
      maximumFractionDigits: 0}));
          $("#aaa").val(sumA);
        }

        function myKeyup() {
          let x = document.getElementById("fketerangan");
          x.value = x.value.toUpperCase();
        }
</script>