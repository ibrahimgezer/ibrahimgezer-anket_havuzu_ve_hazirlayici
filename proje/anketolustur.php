<?php
session_start();
include('baglan.php');
error_reporting(0);
if(isset($_POST['submit']))
{
try
{
$anketid=$_GET["anket_id"];
$anketadi=$_REQUEST['anket_adi'];  
$kategori=$_POST['kategori'];
//$k_id=$_POST['k_id'];
$k_id=$_SESSION["id"];
//$kullanici_id=2;
if(!empty($anketadi) && !empty($kategori)){
  $anketguncelle=$baglanti->prepare('UPDATE anketler SET anket_adi=:anket_adi, kullanici_id=:k_id, kategori=:kategori WHERE id=:id'); 
  $anketguncelle->bindParam(':anket_adi',$anketadi);	
  $anketguncelle->bindParam(':k_id',$k_id);	
  $anketguncelle->bindParam(':id',$anketid);
  $anketguncelle->bindParam(':kategori',$kategori);	
  $anketguncelle->execute();
  }



$soruDizi=$_POST['soru']; 
$secenekDizi=$_POST['secenek'];
$sorusonid = null;


  

foreach($soruDizi as $soru)
    { 
      if(!empty($soru)) 
      {  
        $query  = $baglanti->query("SELECT * FROM sorular where anket_id='$anketid' ");
        $count = $query->rowCount(); 

      $sorgu=$baglanti->prepare('INSERT INTO sorular (soru,anket_id) values(:soru,:anket_id)'); 
      $sorgu->bindParam(':soru',$soru);	
      $sorgu->bindParam(':anket_id',$anketid);

        if( $sorgu->execute())
        {                        
          if($count==0){  $insertMsg="İlk Soru Kaydı Başarı İle Oluşturuldu."; }
          else {   $insertMsg="Kayıt Başarıyla Eklendi ..."; }
        $sorusonid=$baglanti->lastInsertId();
   
        }
        else
        {
        $errorMsg="Bilinmeyen Bir Hata Oluştu !!!"; 
        }       
      }
      else
      {
      $errorMsg = 'Kayıt İşlemi Başarısız ! Herhangi Bir Soru veya secenek Girişi Yapılmadığı Saptandı . '; 
      }
    
 

} 
foreach($secenekDizi as $Yanit)
    {    
      if(!empty($Yanit)) 
      {
      $sorgu2=$baglanti->prepare('INSERT INTO secenek (secenek,soruid)  values(:secenek,:soruid)'); 
      $sorgu2->bindParam(':secenek',$Yanit);	
      $sorgu2->bindParam(':soruid',$sorusonid);	
      $sorgu2->execute();
       
      }
      else
      {
        $errorMsg = 'Kayıt İşlemi Başarısız ! Herhangi Bir Soru veya secenek Girişi Yapılmadığı Saptandı . '; 
      }
    } 

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
<script src="assets/js/jquery-1.8.3.min.js"></script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>


<body class="nav-on-header smart-nav">

<?php
include("header.php");

?>

<section class=" bg-alt">
<div class="container ">

<?php
if(isset($errorMsg))
{
?>
<div id="hata" class="alert alert-danger col-xs-12 col-sm-12">
<strong> <?php echo $errorMsg; ?></strong>
</div>
<?php
}
if(isset($insertMsg)){
?>
<div  class="alert alert-success col-xs-12 col-sm-12">
<strong ><?php echo $insertMsg; ?></strong>
</div>
<?php
}
?>
<form  method="post" id="soruform" style="text-align:center;"> 
        <?php         
        $anketid=$_GET["anket_id"];
        $query = $baglanti->query("SELECT * FROM sorular where anket_id='$anketid' ");
        $count = $query->rowCount(); 
        if($count == 0){
        ?>
        <hr>
        <p style="color:green; font-size:19px;">Anketiniz Oluşturulmuş Fakat Herhangi Bir Düzenleme Yapılmamıştır !</p>
<hr>  

<div id="myDIV">
<div class="item-block col-md-12">
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
<div class="item-block col-md-12">
<div class="item-form">
<div class="row">
<span class="input-group-addon" style="font-size:24px; background-color:white; border:none"> Anket Kategorisi 
 </span>   <select class="form-control form-control-lg " name="kategori" style="font-size:19px; background-color:white; border:none; border-bottom:1px solid; border-color: #cacaca " >
        <br>
      <hr>   
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
  <option name="kategori"><?php echo $sorgu["cname"]; ?></option>
 
        
          <?php } }catch(PDOException $h)
            {
            echo "<option >Veri Tabanına Erişim Sağlanamadı ... </option>".$h->getMessage();
            } 
         
          ?> 
       
  </select>
</div>
</div>
</div>
</div>
<?php } ?>
<div class="row">
<div id="dinamik_form">
<div id="mydiv">
<div class="col-md-12">
<div class="item-block">
<div class="item-form ">
<div class="row">
<div class="col-xs-12 col-sm-12" id="secenek_kutu">
  <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
      <input type="text" class="form-control"
          style="background-color:white;  border:none; width:95%; font-size:17px;"
          name="soru[]"  id="soru[]" value="Başlıksız Soru " placeholder="Soru Adı" />
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
<footer class="futer" style="float:left;">
<div class="action-btn">
<a href="javacript:void(0)" onclick="secenekEkle1()"
class="secenekstyle">
Seçenek ekle</a> veya<a style="margin-right:100px;" href="javacript:void(0) "
onclick="digerEkle1()"> "Diğer" seçeneği ekle  </a> 




</div>                                    
</footer>
  </div>
</div>  <!-- Seçenek Ekle butonları son  <a  onclick="oku()" class="btn btn-success" >Onayla </a>
 -->
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<center>
<br>
<p style="color:red;">Oluşturduğunuz Soruları Kaydetmeyi Unutmayınız !</p>
<?php         
        $query = $baglanti->query("SELECT * FROM sorular where anket_id='$anketid' ");
        $count = $query->rowCount(); 
        if($count == 0){
        ?>
<input type="submit" class="btn btn-primary " name="submit" value="İlk Soruyu Kaydet " id="submit"></input>
      <?php         
          }
          else{
        ?>
        <input type="submit" class="btn btn-primary " name="submit" value="<?php  echo $count+1 ;?>. Soruyu Kaydet " id="submit"></input>
        <?php         
          }
        ?>
        <br>
        </center>

<input type="hidden"id="basari" value="<?php  echo $insertMsg;?>"></input>
<input type="hidden" id="box_count" value="1"></input>
<input type="hidden" name="anket_id" id="anket_id" class="form-control " value="<?php  echo $_SESSION['k_id'];?>"></input>
<input type="hidden" name="anket_id" id="anket_id" class="form-control " value="<?php  echo $_GET['anket_id'];?>"></input>
</div>
</form>
<br>


</section>
<!--Grafik Yanıt -->

<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']}); google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([['yanit','y_sayi'],
  <?php
    $yanitgetir = $baglanti->prepare("SELECT * FROM yanitlar"); $yanitgetir->execute();
    while($sorgu=$yanitgetir->fetch(PDO::FETCH_ASSOC)) { echo"['".$sorgu['yanit']."',".$sorgu['y_sayi']."],";}
  ?>      
]);
var options = { title: 'Anket Başlığı' };
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(data, options);
}
</script>
<!-- Grafik Yanıt Son-->
<?php  include("footer.php"); ?> 
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
<script src="assets/js/app.min.js"></script>
<script src="assets/vendors/summernote/summernote.min.js"></script>
<script src="assets/js/thejobs.js"></script>
<script src="assets/js/custom.js"></script>
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


function secenekEkle1(box_count) {


l++;
jQuery('#secenek_kutu' ).append('<div class="form-group col-xs-12 col-sm-12"  id="secenek_no' + l + '">' +
'<div class="input-group" style="border-bottom:1px solid; border-color: #cacaca"> <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>' +
'<input type="text" class="form-control col-sm-10 " style="background-color:white;  border:none; width:95%; font-size:17px;" name="secenek[]" id="cevap '+l+' " value="Seçenek ' + k+ ' "  placeholder="Yanıt">' +
'<a href="javacript:void(0)"  class="secenek_sil_btn" id="' + l+ '"><i style="color:#55595c; font-size:40px; margin-top:10px; margin-right:15px" class="fa fa-times btn-float btn-remove"></i></a></input></div></div></div>');

k=k+1;

}
function digerEkle1(box_count) {
l++;  
jQuery('#secenek_kutu').append('<div class="form-group col-xs-12 col-sm-12 "  id="secenek_no' +l+ '">' +
'<div class="input-group" style="border-bottom:1px solid; border-color: #cacaca"> <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>' +
'<input type="text" class="form-control col-sm-10 " style="background-color:white;  border:none; width:95%; font-size:17px;" value="Diğer.." name="secenek[]"   id="secenek' +l + '" value="Diğer" placeholder=" Diğer ..." disabled>' +
'<a href="javacript:void(0)"  class="secenek_sil_btn" id="' +l+ '"><i style="color:#55595c; font-size:40px; margin-top:10px; margin-right:15px" class="fa fa-times btn-float btn-remove " ></i></a></input></div></div></div>');


}

var box_count=jQuery("#box_count").val();
box_count++;
jQuery("#box_count").val(box_count);
l++;

$(document).on('click', '.soru_sil_btn', function () {
div_id = $(this).attr("id");
$('#soru' + div_id + '').remove();
box_count--;
///    k = 2;
});
$(document).on('click', '#soru_ekle', function () {
baslik=[];
});
$(document).on('click', '.secenek_sil_btn', function () {
button_id = $(this).attr("id");
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
// href="kullanicisil.php?sayfa=kullanicilar&id=?= $sonuc["id"] ?>" */
</script>

</body>

</html>

