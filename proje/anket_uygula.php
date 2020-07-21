<?php

include('baglan.php');

if(isset($_POST['submit']))
{
try
{
$anketid=$_GET["anket_id"];
$anketadi=$_REQUEST["anket_adi"];

$kullanici_id=2;
$anketguncelle=$baglanti->prepare('UPDATE anketler SET anket_adi=:anket_adi, kullanici_id=:kullanici_id WHERE id=:id'); 
$anketguncelle->bindParam(':anket_adi',$anketadi);	
$anketguncelle->bindParam(':kullanici_id',$kullanici_id);	
$anketguncelle->bindParam(':id',$anketid);
$anketguncelle->execute();


$soruDizi=$_POST['soru']; 
$secenekDizi=$_POST['secenek'];
$sorusonid = null;

     
$soruDizi=array($_POST['secenek']); 
echo json_encode($soruDizi);
$secenekDizi=array($_POST['secenek']);
  


}
catch (PDOException $e) 
{
die($e->getMessage());
$errorMsg = ' Bir Sorun Oluştu !! * Bağlantı hatası ile karşı karşıya olabilsiniz * '; 

}
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
<script src="jquery-1.4.1.min.js"></script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>


<body class="nav-on-header smart-nav">

<?php
include("header.php");

?>

<section class=" bg-alt">
<div class="container">





<?php
if(isset($errorMsg))
{
?>
<div class="alert alert-danger">
<strong> <?php echo $errorMsg; ?></strong>
</div>
<?php
}
if(isset($insertMsg)){
?>
<div class="alert alert-success">
<strong><?php echo $insertMsg; ?></strong>
</div>
<?php
}
?>
<form  method="post" id="soruform"  action="action.php">
<div class="item-block col-md-11">
<div class="item-form">
<div class="row">
<div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
  <span class="input-group-addon" style="font-size:24px; background-color:white; border:none"> Anket
      Başlığı
      <input type="text" name="anket_adi" class="form-control " value="Başlıksız Anket Formu"
          style="background-color:white;  border:none; font-size:17px;"></input></span>
</div>
</div>
</div>
</div>      
<div class="row">
<div id="dinamik_form">
<div id="mydiv">
<div class="col-md-11">
<div class="item-block">
<div class="item-form ">
<div class="row">
<div class="col-xs-12 col-sm-12" id="secenek_kutu">
  <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
      <input type="text" class="form-control"
          style="background-color:white;  border:none; width:95%; font-size:17px;"
          name="soru[]"  id="soru[]" value="Başlıksız Soru" placeholder="Soru Adı" />
  </div>
  <div class="col-xs-12 col-sm-12">
      <div class="form-group">
          <div class="input-group"
              style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon"
                  style="background-color:white; border:none">
                  <i class="fa fa-circle" style="color: #b4b4b4"></i>
              </span>
              <input type="text" class="form-control col-sm-10" id="secenek"
                  style="background-color:white;  border:none; width:95%; font-size:17px;"
                  name="secenek[]" value="Seçenek 1" placeholder="Yanıt" />
          </div>
      </div>
  </div>
</div>
<!-- Seçenekler Kutusu Son-->
<!-- Seçenek Ekle butonları -->
<div class="col-xs-12 col-sm-12">
<div class="form-group">
<div class="col-xs-12 col-sm-12" id="dinamik_secenek_kutu">
</div>
<footer style="float:left;">
<div class="action-btn">
<a href="javacript:void(0)" onclick="secenekEkle1()"
class="secenekstyle">
Seçenek ekle</a> veya<a style="margin-right:100px;" href="javacript:void(0) "
onclick="digerEkle1()"> "Diğer" seçeneği ekle  </a> 
<a  onclick="oku()" class="btn btn-success" >Onayla </a>



</div>                                    
</footer>
  </div>
</div>  <!-- Seçenek Ekle butonları son 
 -->
</div>
</div>
</div>
</div>
</div>
</div>
<div class=" col-md-1" >
<br>
<!-- <input type="button"   onclick="soruEkle()">-->
<input type="button" class="btn btn-primary  text-center" value="+" name="add_btn"  
name="soru_ekle"
onclick="soruEkle()" style="width:20px; padding-left:20px; height:150px; font-size: 20px;">

</div>
</div>

<br>
<p style="color:red;">Anketinizi Oluşturmayı Tamamladıktan Sonra Kaydetmeyi Unutmayınız !</p>
<input type="submit" class="btn btn-primary " value="Anketi Oluştur"></input>
<br>

<input type="hidden" id="box_count" name="sayi[]" value="1"></input>

<input type="hidden" name="anket_id" id="anket_id" class="form-control " value="<?php  echo $_GET['anket_id'];?>"></input>
</div>
</form>
<br>

</div>


<!-- Grafik Yanıt Son-->
<?php  include("footer.php"); ?> 





</body>

<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<script src="assets/js/app.min.js"></script>
<script src="assets/vendors/summernote/summernote.min.js"></script>
<script src="assets/js/thejobs.js"></script>
<script src="assets/js/custom.js"></script>

</html>

