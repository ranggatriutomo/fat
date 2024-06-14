<?php include_once('header_dashboard.php');
include 'conn.php';

$no_pc = $_GET['no_pc'];            
$sql = mysqli_query($koneksi, "select * from pc_fat where no_pc = '$no_pc'");
$row = mysqli_fetch_array($sql);

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
            <i class="fa fa-globe"></i> View Petty Cash
            <small class="pull-right"><?= date('l, d-m-Y');?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
    <form role="form" method="post" onSubmit="if(!confirm('Apakah anda yakin menyimpan data ini?')){return false;}"  action="update_pc.php?no_pc=<?php echo $row['no_pc'] ?>" enctype="multipart/form-data">
     <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Pc</label>
                    <input type="text" name="no_pc" class="form-control"  value ="<?php echo $row['no_pc']; ?>" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">No.Internal</label>
                    <input type="text" name="no_intern" value ="<?php echo $row['no_intern']; ?>" class="form-control" readonly>
              </div>
              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nama Pemohon</label>
                    <input type="text" name="nama_pemohon"  class="form-control" value ="<?php echo $row['nama_pemohon']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Divisi</label>
                    <input type="text" name="divisi" class="form-control" value ="<?php echo $row['divisi']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Perihal</label>
                    <input type="text" name="perihal" class="form-control" value ="<?php echo $row['perihal']; ?>" readonly>
              </div>

              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Tanggal PC</label>
                <input type="text" name="tgl_pc" class="form-control" value ="<?php echo date('Y-m-d', strtotime($row['tgl_pc']));  ?>" readonly>
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">No Rekening</label>
                <input type="text" name="norek" class="form-control" value="<?php echo $row['norek']; ?>"  readonly="readonly">
              </div>
              <div class="form-group col-xs-6">
                <label for="exampleInputEmail1">Status</label>
                <input type="text" name="status_req" class="form-control" value="<?php echo $row['status_req']; ?>"  readonly="readonly">
              </div>
            </div>
            
            <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Deskripsi</th>
                      <th>Qty</th>
                      <th>UoM</th>
                      <th>Per Unit</th>
                      <th>Total Price</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="items-list">
                      <tr>
                      <td><input type="text" id="turaian" class="form-control" value=""/></td>
                      <td><input type="number" id="tjumlah" class="form-control" onKeyUp="return fjumlah()" value=""/></td>
                      <td><input type="text" id="tsatuan" class="form-control" value=""/></td>
                      <td><input type="number" id="tharga" class="form-control" onKeyUp="return fjumlah()"  value="" /></td>
                      <td><input type="text" id="hasilJumlah" class="form-control" value=""readonly="readonly"/></td>
                      <td>
                        <!-- <a href="#" class="delrow"><i class="fa fa-trash"></i>tambah</a> -->
                        <a href="#" id="add-items-new" class="btn btn-info">Tambah</a>
                      </td>
                      <tr>
                    </tbody>
                  </table>
                  <a href="#" id="add-items" class="btn btn-info">Tambah Uraian</a>
                  
                </div>
              </div>
            </div>

            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <!--  <th>Kode Barang</th> -->
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>UoM</th>
                    <th>Per Unit</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="items-list-new">
                <?php
                            
                       $barang = mysqli_query($koneksi,  "select * from pc_fat where no_pc = '$no_pc'");
                        $no=1;?>
                        
                        <?php foreach($barang as $row) : ?>
                          <?php if($row['status_item'] == 1){ ?>
                            <tr id = "<?php echo $row["id_pc_fat"]; ?>">
                              <td><?php echo strtoupper($row['uraian_pc']); ?><input type="hidden" class="form-control" value="<?php echo ($row['uraian_pc']); ?>"/></td>
                              <td><?php echo strtoupper($row['jumlah_pc']); ?><input type="hidden" class="form-control" value="<?php echo ($row['jumlah_pc']); ?>"/></td>
                              <td><?php echo strtoupper($row['satuan_pc']); ?><input type="hidden" class="form-control" value="<?php echo ($row['satuan_pc']); ?>"/></td>
                              <td><?php echo "Rp " . number_format($row ['harga_pc'],0,',','.'); ?><input type="hidden" class="form-control" value="<?php echo ($row['harga_pc']); ?>"/></td>
                              <td><?php echo "Rp " . number_format($row ['total_pc'],0,',','.'); ?><input type="hidden"  class="form-control price" value="<?php echo ($row['total_pc']); ?>"/></td>
                              <td> 
                            </td>
                            </tr>
                            <?php }else{ ?>
                              <tr id = "<?php echo $row["id_pc_fat"]; ?>">
                              <td><?php echo strtoupper($row['uraian_pc']); ?><input type="hidden" name="turaian[]" class="form-control" value="<?php echo ($row['uraian_pc']); ?>"/></td>
                              <td><?php echo strtoupper($row['jumlah_pc']); ?><input type="hidden" name="tjumlah[]" class="form-control" value="<?php echo ($row['jumlah_pc']); ?>"/></td>
                              <td><?php echo strtoupper($row['satuan_pc']); ?><input type="hidden" name="tsatuan[]" class="form-control" value="<?php echo ($row['satuan_pc']); ?>"/></td>
                              <td><?php echo "Rp " . number_format($row ['harga_pc'],0,',','.'); ?><input type="hidden" name="tharga[]" class="form-control" value="<?php echo ($row['harga_pc']); ?>"/></td>
                              <td><?php echo "Rp " . number_format($row ['total_pc'],0,',','.'); ?><input type="hidden" name="ttotal[]" class="form-control price" value="<?php echo ($row['total_pc']); ?>"/></td>
                              <td> 
                              <a href="#" class="delrow"><i class="fa fa-trash"></i></a>
                              <!-- <button type="button" name="button" onclick = "deletedata(<?php echo $row['id_pc_fat']; ?>);">Delete</button>
                              <button class="primary" type="button" name="button" onclick = "deletedata(<?php echo $row['id_pc_fat']; ?>);">Ok</button> -->
                            </td>
                            </tr>
                            <?php } ?>
                          <?php endforeach; ?>
                </tbody>
                <tfoot>
                <?php
                $sql = mysqli_query($koneksi, "select *, SUM(total_pc) AS grand_total from pc_fat where no_pc = '$no_pc'");

                $result = mysqli_fetch_array($sql);
                $grandtotal = "Rp " . number_format($result ['grand_total'],0,',','.');
                                    // var_dump($result ['grand_total']);
                        ?>
                  <tr>
                      <td></td>
                      <td style='text-align: center;'><b>Total</b></td>
                      <td></td>
                      <td></td>
                      <td style='text-align: center;'><b id="grandtotal"><?=$grandtotal;?></b><input type="hidden" id="aaa" value="<?= $result ['grand_total'] ?>"></td>
                      <td></td>
                  </tr>
                </tfoot>

              </table>
              
              

            </div>
            <button type="submit" value="Submit" class="btn btn-primary">Submit</button>  
            <a href="list_pc.php" id="add-items" class="btn btn-primary">Back</a> 
            </form>
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
      // console.log($("#aaa").val());

      // var sumA = 0;
      //   $('.price').each(function(){
      //     sumA += parseInt($(this).val());
      //     console.log(parseInt($(this).val()));
      //   });

      //   $("#grandtotal").text("Rp " + sumA.toLocaleString());
      //   $("#aaa").val(sumA);

      var i = 1;
      $("#items-list").hide();
      
    $('#add-items').click(function(e) {
      e.preventDefault()

      if($("#items-list").is(":hidden")){
        $("#items-list").show();
      }else{
        $("#items-list").hide();
      }
        
    });

    $('#add-items-new').click(function(e) {
      e.preventDefault()
        // console.log($("#totalgrand").val());
        var newRow = $('<tr>');
        var cols = "";
        cols += '<td>'+ $("#turaian").val() + ' <input type="hidden" name="turaian[]" class="form-control" value="'+ $("#turaian").val() + '"/></td>';
        cols += '<td>'+ $("#tjumlah").val() + '<input type="hidden" name="tjumlah[]" id="tjumlah'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')" value="'+ $("#tjumlah").val() + '"/></td>';
        cols += '<td>'+ $("#tsatuan").val() + '<input type="hidden" name="tsatuan[]" class="form-control" value="'+ $("#tsatuan").val() + '"/></td>';
        cols += '<td>'+ parseInt($("#tharga").val()).toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
    maximumFractionDigits: 0}) + '<input type="hidden" name="tharga[]" id="tharga'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')"  value="'+ $("#tharga").val() + '" /></td>';
        cols += '<td>'+ parseInt($("#hasilJumlah").val()).toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
    maximumFractionDigits: 0}) + '<input type="hidden" name="ttotal[]" id="hasilJumlah'+i+'" class="form-control price" value="'+ $("#hasilJumlah").val() + '" ></td>';
        cols += '<td><a href="#" class="delrow"><i class="fa fa-trash"></i></a></td>';
        cols += '</tr>';

        // var sum = parseInt($("#aaa").val()) + parseInt($("#hasilJumlah").val());
        
        newRow.append(cols);
        // $("#items-list").append(newRow);
        $("#items-list-new").append(newRow);
        // $('#myTable').slideDown();
        $('#example1').slideDown();
        
        $("#turaian").val(""); 
        $("#tjumlah").val("");
        $("#tsatuan").val("");
        $("#tharga").val("");
        $("#hasilJumlah").val("");

        $("#items-list").hide();

        

        var sumA = 0;
        $('.price').each(function(){
          sumA += parseInt($(this).val());
        });

        $("#grandtotal").text(sumA.toLocaleString("id-ID", {style:"currency", currency:"IDR", minimumFractionDigits: 0,
    maximumFractionDigits: 0}));
        $("#aaa").val(sumA);

        i++;
    });

   


    $('#example1').on('click', '.delrow', function(e) {
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
          var vtjumlah = document.getElementById("tjumlah").value;
          var vtharga = document.getElementById("tharga").value;
          var hasil = vtjumlah * vtharga;
          document.getElementById("hasilJumlah").value=hasil;
        }
        


</script>

<script type="text/javascript">
      // Function
      function deletedata(id_pc_fat){
        $(document).ready(function(){
          $.ajax({
            // Action
            url: 'hapus_detail_pc.php',
            // Method
            type: 'POST',
            data: {
              // Get value
              id_pc_fat: id_pc_fat,
              action: "delete"
            },
            success:function(response){
              // Response is the output of action file
              if(response == 1){
                alert("Data Deleted Successfully");
                document.getElementById(id).style.display = "none";
              }
              else if(response == 0){
                alert("Data Cannot Be Deleted");
              }
            }
          });
        });
      }
    </script>
