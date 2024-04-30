<!--
Created By : Aguzrybudy
Blog	   : Aguzrybudy.blogspot.co.id
time	   : Sunday, 17 April 2016
-->

<!DOCTYPE HTML>
<html lang="en"> 
<head>
<meta charset="utf-8">
<title>Aguzrybudy.com | Sweet Alert</title>
<link rel="stylesheet" href="alert/css/sweetalert.css">
</head>
<body >



<!--Scripts-->
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="alert/js/sweetalert.min.js"></script>
<script src="alert/js/qunit-1.18.0.js"></script>


<script type="text/javascript">
$(document).ready(function(){
  $('#email').on('submit',function(e) {  
  $.ajax({
      url:'subscribe_act.php', 
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
        console.log(data);
	    swal("Success!", "Message sent!", "success");
      },
      error:function(data){
	    swal("Oops...", "Something went wrong :(", "error");
      }
    });
    e.preventDefault(); 
  });
});
</script>


</body>
</html>
