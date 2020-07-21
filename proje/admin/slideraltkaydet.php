<?php 
//include "baglan.php";
$gelensayfa=$_SERVER['HTTP_REFERER'];
$baglan=mysqli_connect("localhost","root","","ornek"); 
mysqli_set_charset($baglan, "utf8");

$baslik=$_POST['baslik'];
$yazi=$_POST['yazi'];

$sql =mysql_query("INSERT INTO slideralt (baslik , yazi ) values ('$baslik','$yazi')");
if ($sql)
{ 
	 echo "<br>";
echo "<script>aler('Kayıt Başarı İle Eklendi');</script>
<script>location=$gelensayfa</script>";
	
}
else{
	 echo "<br>";
echo "Sorun Oluştu ";
}
 ?>
