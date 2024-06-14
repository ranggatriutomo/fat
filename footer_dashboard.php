<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2024 <a href="#">IT Division</a>.</strong> 
      <marquee width="60%" direction="left"> MAKSIMAL UNTUK PENGAJUAN DANA PETTY CASH Rp. 10.000.000</marquee>
  </footer>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="alert/js/sweetalert.min.js"></script>
<script src="alert/js/qunit-1.18.0.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min3.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Ajax -->
<script src="bower_components/PACE/pace.min.js"></script>
<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->



<!-- page script -->
<script>
 $(function () {
$('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
$('#tabel1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    //Initialize Select2 Elements
    $('.select2').select2()

    
  



  })

function goBack() {
        window.history.back();
    }

function ubah() {
    var charCode = document.getElementById("kode");
    charCode.value = charCode.value.toUpperCase();
}


function harusHuruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
}

   function isi_otomatis(){
    var bhp_id = $("#bhp_id").val();
    $.ajax({
        url: 'ajax.php',
        data:"bhp_id="+bhp_id ,
    }).success(function (data) {
        var json = data,
        obj = JSON.parse(json);
        $('#stok').val(obj.stok);
    });
}

$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-update").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm(" Back To Surabaya ?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-update").submit(); // Submit form
    });
  });

</script>
</body>
</html>