<?php include_once('header.php')?>

<div class="content-wrapper" style="height: 4200px; min-height: 293px;">

    <section class="content-header">
      <h1>
        Data
        <small>Rekening</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="merk.php">Table Rekening</a></li>
      <!--   <li class="active"></li> -->
      </ol>
    </section>  

    <section class="content">

       <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="proses_simpan_rek.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Atas Nama</label>
                 <input type="text" name="atas_nama" class="form-control" autocomplete="off" id="exampleInputEmail1" onkeyup="this.value = this.value.toUpperCase()" placeholder="Atas Nama" required="required">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nomor Rekening</label>
                 <input type="text" name="norek" class="form-control" autocomplete="off" id="exampleInputEmail1" onkeyup="this.value = this.value.toUpperCase()" placeholder="Nomor Rekening" required="required">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Bank</label>
                 <input type="text" name="nama_bank" class="form-control" autocomplete="off" id="exampleInputEmail1" onkeyup="this.value = this.value.toUpperCase()" placeholder="Nama Bank" required="required">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </div>
       
       <div class="col-md-6">
          <div class="">
          </div>
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
        
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nomor Rekening</th>
                  <th>Atas Nama</th>
                  <th>Nama Bank</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php
                      include '../conn.php';
                      $a = mysqli_query($koneksi, "SELECT *FROM tbrekening");
                        $no=1;
                        foreach ($a as $row){?>
            <tr>
            <td><?= $no++; ?></td>
            <td><?=$row['norek']?></td>
            <td><?=$row['nama_bank']?></td>
            <td><?=$row['atas_nama']?></td>
             <td> 
              <a href="hapusRekening.php?id_rekening=<?php echo $row['id_rekening']; ?>" type="button" class="btn btn-block btn-danger btn-sm">Delete</a>
               <!-- <a href="downloadCertificat.php?id_certificat=<?php echo $row['id_certificat']; ?>" target="_blank" type="button" class="btn btn-block btn-success btn-sm">View</a> -->

            </td>
          </tr>
          <?php
            
                    }
                ?>
                </tbody>
                <tfoot>

              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
         <!-- /.col -->
      </div>
    </section>
   
    
  </div>

 <?php require_once('footer.php')?>