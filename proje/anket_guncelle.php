
<?php
//error_reporting(0);
//güncelleme
include('baglan.php');
if(isset($_REQUEST['soru_sil_id']))
{
 
  $id=$_REQUEST['soru_sil_id'];	
  $soruidbul  = $baglanti->query("SELECT * FROM sorular WHERE id=$id");  
  while($sorgu=$soruidbul->fetch(PDO::FETCH_ASSOC)) { 
    $soruid=$sorgu["id"];
    $delete_secenek = $baglanti->prepare('DELETE FROM secenek WHERE soruid=:id');
    $delete_secenek->bindParam(':id',$soruid);
    $delete_secenek->execute();
  }

  $delete_sorular = $baglanti->prepare('DELETE FROM sorular WHERE id=:id');
  $delete_sorular->bindParam(':id',$id);
  $delete_sorular->execute();
  echo  "<script type='text/javascript'>location:anket_guncelle.php?id=$anket_id alert('Silmek İstediğiniz Soru Başarıyla Silindi !!');</script>"; 
  
}

if(isset($_POST['submit']))
{
    $id=$_REQUEST['guncelle'];
    $anketid=$_REQUEST['id'];	
    $soru=$_POST['baslik'];
    $secenekDizi=$_POST['secenek'];

    echo  "<script type='text/javascript'> alert('$soru');</script>"; 
    $soru_guncelle= $baglanti->prepare('UPDATE sorular SET soru=:soru WHERE id=:id ');
    $soru_guncelle->bindParam(':soru',$soru);	
    $soru_guncelle->bindParam(':id',$id);
 
    if($soru_guncelle->execute())
    {
      $insertMsg="Güncelleme Başarılı";
    }
  
 
  
}

	//güncelleme son

?>

<!DOCTYPE html>
<html lang="en">

<head>
<script src="jquery-1.4.1.min.js"></script>
<title>Anket Soruları Güncelle</title>

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
<div id="hata" class="alert alert-danger">
<strong> <?php echo $errorMsg; ?></strong>
</div>
<?php
}
if(isset($insertMsg)){
?>
<div  class="alert alert-success">
<strong ><?php echo $insertMsg; ?></strong>
</div>
<?php
}
?>
<form  method="post" id="soruform" > 
  
  <div id="myDIV">
<div class="item-block col-md-12">
<div class="item-form">
<div class="row">

<?php 
     $anket_id=$_GET['id'];
     $query  = $baglanti->query("SELECT * FROM anketler WHERE id='$anket_id' "); 
        while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {  ?>
            <form action="">
                <div class="hgroup">
                 
<div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
<span class="input-group-addon" style="font-size:24px; background-color:white; border:none"> Anket
  Başlığı
  <input type="text" name="anket_adi" class="form-control " value="<?php echo $sorgu["anket_adi"]; ?>"
      style="background-color:white;  border:none; font-size:17px;"></input></span>
</div>
        <?php }?>
</div>
</div>
</div>
</div>
<div class="item-block col-xs-12 col-sm-12">
<div class="item-form">
<div class="row">
<span class="input-group-addon" style="font-size:24px; background-color:white; border:none"> Anket    Kategorisi 
</span>    <select class="form-control form-control-lg " name="kategori" style="font-size:19px; background-color:white; border:none; border-bottom:1px solid; border-color: #cacaca " >
     
<?php 
      
      $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
      $baglanti->exec("SET NAMES utf8");
      $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      try{
      $query = $baglanti->prepare("SELECT cname FROM kategoriler where confirm='evet' ");
     $calis=$query->execute();
     $count = $query->rowCount();
    
     
      while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
     ?>      
<option name="kategori" style="border:none"><?php echo $sorgu["cname"]; ?></option>

    
      <?php } }catch(PDOException $h)
        {
        echo "<option >Veri Tabanına Erişim Sağlanamadı ... </option>".$h->getMessage();
        } 
     
      ?> 
</select>
</div>
</div>
</div>
<div class="row">
 
 <?php    
      $anket_id=$_GET['id'];
      $soruno=null;
      $sorular  = $baglanti->query("SELECT * FROM sorular WHERE anket_id ='$anket_id'");
      while($sorgu=$sorular->fetch(PDO::FETCH_ASSOC)) {               
      $soruno=$sorgu['id'];  ?>
     
<div id="dinamik_form">
<div id="mydiv">
<div class="col-md-12">
<div class="item-block col-md-12">
<div class="item-form ">
<div class="row">
<div class="col-xs-12 col-sm-12" id="secenek_kutu<?php echo $sorgu['id']; ?>">

<div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
  <input type="text" class="form-control"
      style="background-color:white;  border:none; width:95%; font-size:17px;"
      name="baslik"  placeholder="<?php echo $sorgu["soru"]; ?>" />
    
</div>
<?php   $secenekler  = $baglanti->query("SELECT * FROM secenek  WHERE soruid ='$soruno'");
                        while($secenek=$secenekler->fetch(PDO::FETCH_ASSOC)) {  ?>
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
              name="secenek[]" placeholder="<?php echo $secenek["secenek"]; ?>" />
      </div>
  </div>
</div><?php     }  ?>
</div>

<!-- Seçenekler Kutusu Son-->
<!-- Seçenek Ekle butonları -->
<div class="col-xs-12 col-sm-12">


<footer class="futer" style="float:left;">
<div class="action-btn">
<a href="javacript:void(0)" id="secenekEkle<?php echo $sorgu['id']; ?>" 
class="secenekstyle">
Seçenek ekle</a> veya<a style="margin-right:100px;"
id="dsecenekEkle<?php echo $sorgu['id']; ?>" href="javacript:void(0) "> "Diğer" seçeneği ekle  </a>
<a title="Soruyu silmek için burayı tıklayın." href="anket_guncelle.php?soru_sil_id=<?php echo $sorgu['id'];?>&&id=<?php echo $sorgu["anket_id"];?>" style="color:#29aafe;
 font-size:35px; margin-right:15px; position:absolute; top:4px; right:17px;" class="soru_sil_btn fa fa-trash btn-remove" onclick="return myConfirm();"></a>



<!-- Seçenek Ekle butonları son  <a  onclick="oku()" class="btn btn-success" >Onayla </a>
<a title="Soruyu güncellemek için burayı tıklayın." href="" style="color:#53bd53; font-size:30px; margin-right:15px; position:absolute; top:9px; right:65px;" class=" fa fa-check-square "></a>
-->

<a style="position:absolute; top:8px; right:120px; color:#29aafe;" href="anket_guncelle.php?guncelle=<?php echo $sorgu['id'];?>&&id=<?php echo $sorgu["anket_id"];?>">Güncellemek İstiyorum</a>
<input type="submit" style="position:absolute; top:5px; right:80px; color:#29aafe;" name="submit" value="    " id="submit"><i style="position:absolute; color:#29aafe; top:9px; right:86px; font-size:22px;" class="fa fa-check-square" aria-hidden="false"></i></input>
 <!--Direk Güncelleyen Fakat idyi bulamayan
       <input type="submit" style="position:absolute; top:5px; right:100px;"  name="submit" value="&#xf00c;" id="submit"></input>
-->

</div>                                    
</footer>
</div>
 <!-- Seçenek Ekle butonları son  <a  onclick="oku()" class="btn btn-success" >Onayla </a>
-->
</div>
</div>
</div>
</div>
</div>
</div>

<input type="hidden" id="box_count" name="box_count" value="<?php echo $sorgu['id']; ?>"></input>
<?php     }  ?>
<br>
</div>


<br>



<?php         
        $anketid=$_GET["id"];
        $query = $baglanti->query("SELECT * FROM sorular where anket_id='$anketid' ");
        $query2 = $baglanti->query("SELECT * FROM anketler where id='$anketid' ");
        $count = $query->rowCount(); 
        if($count == 0){ 
          while($sorgula=$query2->fetch(PDO::FETCH_ASSOC)) {   ?><br>
            <hr>
        <center>
        <div class="col-xs-12 col-sm-12">

        <p style="color:green;">Anketinizde Hiç Soru Bulunmamaktadır, Dilerseniz Soru Ekleyebilirsiniz.</p>
  <a class="btn btn-xs btn-success" href="anketolustur.php?anket_id=<?php echo $sorgula["id"]; ?>">Soru Ekle</a> 
  </div></center> 

  <br>
  <hr>
  <?php } } ?>
 
  <br>
  <center>
<p style="color:red; ">Düzenlediğiniz  Soruları Kaydetmeyi Unutmayınız !</p>


</center>
    <br>

<input type="hidden"id="basari" value="<?php  echo $insertMsg;?>"></input>

<input type="hidden" name="anket_id" id="k_id" class="form-control " value="<?php  echo $_SESSION['k_id'];?>"></input>
<input type="hidden" name="anket_id" id="anket_id" class="form-control " value="<?php  echo $_GET['anket_id'];?>"></input>
</div>
</form>
<br>

</div>


</section>

<?php  include("footer.php"); ?> 
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<script src="assets/js/app.min.js"></script>
<script src="assets/vendors/summernote/summernote.min.js"></script>
<script src="assets/js/thejobs.js"></script>
<script src="assets/js/custom.js"></script>
<script type="text/javascript">

function deneme() {

      $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
      $baglanti->exec("SET NAMES utf8");
      $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $query = $baglanti->prepare("SELECT cname FROM kategoriler where confirm='evet' ");
      $calis=$query->execute();       
      while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
        window.location = "anket_guncelle.php?guncelle=<?php echo $sorgu['id'];?>&&id=<?php echo $sorgu["anket_id"];?>";
}
      }
        </script> 
<script>
var baslik =[];
var i = 1;
var j = 1;
// var k = 1;
var button_id = 1;
var div_id = 1;
var l = 0;
var s = 1;
var k = 2;
/** Seçenek Ekle */
<?php         
$sorusayi  = $baglanti->query("SELECT * FROM sorular WHERE anket_id ='$anket_id'");
          $sorusayisi = $sorusayi->rowCount();        
          while($sorgu=$sorusayi->fetch(PDO::FETCH_ASSOC)) {  ?>

$( "#secenekEkle<?php echo $sorgu['id']; ?>" ).click(function()  {


l++;
jQuery('#secenek_kutu<?php echo $sorgu['id']; ?>' ).append('<div class="form-group col-xs-12 col-sm-12"  id="secenek_no' + l + '">' +
'<div class="input-group" style="border-bottom:1px solid; border-color: #cacaca"> <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>' +
'<input type="text" class="form-control col-sm-10 " style="background-color:white;  border:none; width:95%; font-size:17px;" name="secenek[]" id="cevap '+l+' " value="Seçenek ' + k+ ' "  placeholder="Yanıt">' +
'<a href="javacript:void(0)"  class="secenek_sil_btn" id="' + l+ '"><i style="color:#55595c; font-size:40px; margin-top:10px; margin-right:15px" class="fa fa-times btn-float btn-remove"></i></a></input></div></div></div>');

k=k+1;
         
}); <?php }?>

/** Seçenek Ekle Son */

/** D.Seçenek Ekle */
<?php         
$sorusayi  = $baglanti->query("SELECT * FROM sorular WHERE anket_id ='$anket_id'");
          $sorusayisi = $sorusayi->rowCount();        
          while($sorgu=$sorusayi->fetch(PDO::FETCH_ASSOC)) {  ?>

$( "#dsecenekEkle<?php echo $sorgu['id']; ?>" ).click(function()  {


l++;
jQuery('#secenek_kutu<?php echo $sorgu['id']; ?>' ).append('<div class="form-group col-xs-12 col-sm-12 "  id="secenek_no' +l+ '">' +
'<div class="input-group" style="border-bottom:1px solid; border-color: #cacaca"> <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>' +
'<input type="text" class="form-control col-sm-10 " style="background-color:white;  border:none; width:95%; font-size:17px;" value="Diğer" name="secenek[]"   id="secenek' +l + '" value="Diğer" placeholder=" Diğer ..." disabled>' +
'<a href="javacript:void(0)"  class="secenek_sil_btn" id="' +l+ '"><i style="color:#55595c; font-size:40px; margin-top:10px; margin-right:15px" class="fa fa-times btn-float btn-remove " ></i></a></input></div></div></div>');

         
}); <?php }?>
/** D.Seçenek Ekle Son */

l++;

$(document).on('click', '.secenek_sil_btn', function () {
button_id = $(this).attr('id');
$('#secenek_no' + button_id + '').remove();
l--;
k--;
//k = (button_id) - 1;
});


</script>

<script>
// Tab menü başlangıç
function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace("active", "");

}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
// Tab menü son 
// href="kullanicisil.php?sayfa=kullanicilar&id=?= $sonuc['id'] ?>" */
</script>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Soruyu Silmek istediğinizden Emin misiniz ?');
}
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Soruyu Silmek istediğinizden Emin misiniz ?')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
<script>
function myConfirm() {
  var result = confirm("Soruyu Silmek istediğinizden Emin misiniz ?");
  if (result==true) {
   return true;
   
  } else {
   return false;
  }
}
</script>  
</body>

</html>



