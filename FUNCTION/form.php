<?php include('checkdates.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">

<table width="200" border="1">
  <tr>
    <td colspan="2"><center>Formulaire</center></td>
  </tr>
  <tr>
    <td width="89">date res</td>
    <td width="95">
      
      <input type="text" name="date_res" id="textfield" />
    </td>
  </tr>
  <tr>
    <td>date occ</td>
    <td><input type="text" name="date_occ" id="textfield" /></td>
  </tr>
  <tr>
    <td>date lib</td>
    <td><input type="text" name="date_lib" id="textfield" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="send"   type="submit" /></td>
  </tr>
</table>
</form>
<?php
if(isset($_POST['send'])){
	$date_res=$_POST['date_res'];
	$date_occ=$_POST['date_occ'];
	$date_lib=$_POST['date_lib'];
	$booleen=checkdates($date_res,$date_occ,$date_lib);
	if($booleen=='true'){
		
		echo '<script>alert("okokokokokok");</script>';
		}
	else{
		
	echo '<script>alert("noknoknoknoknoknok");</script>';
		}
		
	
	}
?>



</body>
</html>