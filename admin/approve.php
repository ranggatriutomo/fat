<?php include_once('header.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 4200px; min-height: 293px;">

  <section class="content-header">
      <h1>
        Form
        <small>Approval Status Petty Cash</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Approval</a></li>
        <li><a href="#">Form Update Status</a></li>
      <!--   <li class="active"></li> -->
      </ol>
  </section>  

  <section class="content">
     <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
              <?php
              // Load file koneksi.php
              include "../conn.php";

              $no_pc = $_GET['no_pc'];            
              // Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
              //$query = "SELECT a.*, b.*, c.* FROM mbarang a, tbkategori b, tbmerk c WHERE a.id_merk=c.id_merk and a.id_kategori=b.id_kategori and a.no_pc='".$no_pc."'";
              $sql = mysqli_query($koneksi, "select * from pc_fat where no_pc = '$no_pc'");

              $row = mysqli_fetch_array($sql);
            ?>
            <!-- form start -->
            <form role="form" method="post" onSubmit="if(!confirm('Apakah anda yakin menyimpan data ini?')){return false;}" action="update_approve.php?no_pc=<?= $no_pc ?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nomor Pengajuan Petty Cash</label>
                  <input type="text" name="no_pc" class="form-control" value="<?php echo $row['no_pc']; ?>"  readonly="readonly">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Progress</label>
                  <input type="text" name="no_pc" class="form-control" value="<?php echo $row['status_doc']; ?>"  readonly="readonly">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Divisi</label>
                  <input type="text" name="no_pc" class="form-control" value="<?php echo $row['divisi']; ?>"  readonly="readonly">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Nomor Rekening</label>
                  <input type="text" name="no_req" class="form-control" value="<?php echo $row['norek']; ?>"  readonly="readonly">
                </div>
                <div class="form-group col-xs-6">
                  <label for="exampleInputEmail1">Tanggal Pengajuan</label>
                  <input type="text" name="tgl_pc" class="form-control" value="<?php echo date('d F Y', strtotime($row['tgl_pc']));  ?>"  readonly="readonly">
                </div>

                <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <!--  <th>Kode Barang</th> -->
                  <th>Uraian</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody id="items-list-new">
                <?php
                            
                       $barang = mysqli_query($koneksi,  "select * from pc_fat where no_pc = '$no_pc'");
                        $no=1;?>
                        
                        <?php foreach($barang as $row) : ?>
                          <tr id = "<?php echo $row["id_pc_fat"]; ?>">
                            <td><?php echo strtoupper($row['uraian_pc']); ?></td>
                            <td><?php echo strtoupper($row['jumlah_pc']); ?></td>
                            <td><?php echo strtoupper($row['satuan_pc']); ?></td>
                            <td><?php echo "Rp " . number_format($row ['harga_pc'],0,',','.'); ?></td>
                            <td><?php echo "Rp " . number_format($row ['total_pc'],0,',','.'); ?></td>
                            <td> 
                            <!-- <button class="primary" type="button" name="button" onclick = "deletedata(<?php echo $row['id_pc_fat']; ?>);">Ok</button> -->
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="check1" name="approve[]" value="<?= $row['id_pc_fat'] ?>" 
                              <?php 
                                if($row['status_item'] == 1){
                                  echo 'checked  disabled';
                                }
                              ?>>
                              <label class="form-check-label">Setuju</label>
                            </div> 
                          </td>
                          </tr>
                          <?php endforeach; ?>
                </tbody>
                <tfoot>
      <?php
      $sql = mysqli_query($koneksi, "select *, SUM(total_pc) AS grand_total from pc_fat where no_pc = '$no_pc'");

      $result = mysqli_fetch_array($sql);
      $grandtotal = "Rp " . number_format($result ['grand_total'],0,',','.');

              ?>
        <tr>
            <td></td>
            <td style='text-align: center;'><b>Total</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: center;'><b><?=$grandtotal;?></b></td>
        </tr>
      </tfoot>

              </table>
            

            </div>


               <!--  <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="checkbox" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto<br>
                  <input type="file" name="gambar" id="exampleInputFile">
              </div>  -->
       
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" value="Submit" class="btn btn-primary">Save</button>
                <a href="index.php"><input type="button" class="btn btn-danger" value="Cancel"></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
    </div>
  <!-- /.content-wrapper -->

<?php include_once('footer.php');?>

<script>
   
    $(document).ready(function () {
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
        console.log();
        var newRow = $('<tr>');
        var cols = "";
        cols += '<td>'+ $("#turaian").val() + ' <input type="hidden" name="turaian[]" class="form-control" value=""/></td>';
        cols += '<td>'+ $("#tjumlah").val() + '<input type="hidden" name="tjumlah[]" id="tjumlah'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')" value=""/></td>';
        cols += '<td>'+ $("#tsatuan").val() + '<input type="hidden" name="tsatuan[]" class="form-control" value=""/></td>';
        cols += '<td>Rp '+ $("#tharga").val() + '<input type="hidden" name="tharga[]" id="tharga'+i+'" class="form-control" onKeyUp="return fjumlah('+i+')"  value=""/ ></td>';
        cols += '<td>Rp '+ $("#hasilJumlah").val() + '<input type="hidden" name="ttotal[]" id="hasilJumlah'+i+'" class="form-control" value=""/readonly="readonly"></td>';
        cols += '<td><a href="#" class="delrow"><i class="fa fa-trash"></i></a></td>';
        cols += '</tr>';

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