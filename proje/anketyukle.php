<?php

require_once "baglan.php";
if (isset($_POST['yukle'])) {
  $response = array( 
    'status' => 0, 
    'message' => 'Form gönderilemedi, lütfen tekrar deneyin.' 
); 
try
{
    $anket_adi = $_REQUEST['anket_adi'];
    $s_sayi = $_REQUEST['s_sayi'];
    $anket_cesidi = $_REQUEST['anket_cesidi'];
    $anket_kategori = $_REQUEST['anket_kategori'];
    $kaynak_turu = $_REQUEST['kaynak_turu'];
    $yazar = $_REQUEST['yazar'];
    $yil = $_REQUEST['yil'];
    $kaynak_adi = $_REQUEST['kaynak_adi'];
    $adres = $_REQUEST['adres'];
    $adres = $_REQUEST['adres'];
    $uygulama = $_REQUEST['uygulama'];
    $derece = $_REQUEST['derece'];
    $puan = $_REQUEST['puan'];
    $anketi_ekleyen = $_REQUEST['anketi_ekleyen'];
    $anketor_mail = $_REQUEST['anketor_mail'];

    $path="upload/"; 
    $anket_yol = basename($_FILES["anket_yol"]["name"]); 
    $targetFilePath = $path . $anket_yol; 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    $allowTypes = array('pdf', 'doc'); 

    if (empty ($anket_adi)  || empty($anket_cesidi)  || empty($anket_kategori)  || empty($kaynak_turu)  || empty($yazar)  || empty( $yil)  || 
    empty($kaynak_adi)  || empty( $adres)  || empty($uygulama)  || empty($derece)  || empty($puan)  || empty($anketi_ekleyen)  || empty($anketor_mail))
     {
      
        $errorMsg = '  Lütfen formu eksiksiz doldurun ! '; 
    }

    

        if(in_array($fileType, $allowTypes)){ 
        if(!file_exists($targetFilePath)) //check file not exist in your upload folder path
          {
            if(move_uploaded_file($_FILES["anket_yol"]["tmp_name"], $targetFilePath)){ 
                $uploadedFile = $anket_yol; 
            }else{ 
                $uploadStatus = 0; 
                $errorMsg = '    Maalesef, dosyanız yüklenirken bir hata oluştu.'; 
            } 
         }
         else
        {	
            $errorMsg="Dosya Zaten Var . Yükleme Klasörünü Kontrol Et (Dosya ismini Değiştirip Yükleyebilirsiniz)"; //error message file not exists your upload folder path
        }
        }else{ 
            $uploadStatus = 0; 
            $errorMsg = 'Maalesef; yalnızca pdf, doc dosyalarının yüklenmesine izin verilir.'; 
        } 


  

       
        if(!isset($errorMsg))
        {
        $sorgu = $baglanti->prepare('INSERT INTO yuklenen_anketler (anket_adi,s_sayi,anket_cesidi,anket_kategori,kaynak_turu,yazar,yil,kaynak_adi,adres,uygulama,derece,puan,anketi_ekleyen,anketor_mail,anket_yol) 
                                                             VALUES (:anket_adi, :s_sayi ,:anket_cesidi, :anket_kategori, :kaynak_turu, :yazar, :yil, :kaynak_adi, :adres, :uygulama, :derece, :puan, :anketi_ekleyen, :anketor_mail, :anket_yol)');
        
        $sorgu->bindParam(':anket_adi', $anket_adi );
      
        $sorgu->bindParam(':s_sayi', $s_sayi );  
        $sorgu->bindParam(':anket_cesidi', $anket_cesidi );
        $sorgu->bindParam(':anket_kategori', $anket_kategori );
        $sorgu->bindParam(':kaynak_turu', $kaynak_turu );
        $sorgu->bindParam(':yazar', $yazar );
        $sorgu->bindParam(':yil', $yil );  
        $sorgu->bindParam(':kaynak_adi', $kaynak_adi );
        $sorgu->bindParam(':adres', $adres );
        $sorgu->bindParam(':adres', $adres );  
        $sorgu->bindParam(':uygulama', $uygulama );
        $sorgu->bindParam(':derece', $derece );
        $sorgu->bindParam(':puan', $puan );  
        $sorgu->bindParam(':anketi_ekleyen', $anketi_ekleyen );
        $sorgu->bindParam(':anketor_mail', $anketor_mail );
        $sorgu->bindParam(':anket_yol', $anket_yol );
        
        if($sorgu->execute())
        {
          $insertMsg="Kayıt Başarıyla Eklendi ..."; 

        }
       
      }
    } catch (PDOException $e) {
        die($e->getMessage());

        $errorMsg = 'Bilgiler başarılı bir şekilde kaydedilmedi.'; 

    }

    $baglanti = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Post a job position or create your online resume by TheJobs!">
  <meta name="keywords" content="">

  <title> Anket Yükle</title>

  <!-- Styles -->
  <link href="assets/css/app.min.css" rel="stylesheet">
  <link href="assets/vendors/summernote/summernote.css" rel="stylesheet">
  <link href="assets/css/thejobs.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">

  <!-- Fonts -->
  <link
    href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
    rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="icon" href="assets/img/favicon.ico">
  <style>
   
    @media (min-width: 768px) {
.col-sm-10 {
    width: 83.33333333%;
    margin-left: 90px;
}}
  </style>
</head>

<body class="nav-on-header smart-nav">

  <!-- Navigation bar -->
  <?php
      include("header.php");
    ?>

  <!-- END Navigation bar -->



  
    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image:url(.//assets/img/bg-facts.jpg)">
      <div class="container page-name">
        <h1 class="text-center">Anketinizi ekleyin</h1>
      </div>

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
      <form method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="row">


            <div class="col-xs-12 col-sm-10 center">
     
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Anketin Adı   <span style="color:red">*</span>
              </span>
              <input type="text" name="anket_adi" class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Soru Sayısı<span style="color:red">*</span>
              </span>
              <input type="text" name="s_sayi" class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon " style="background-color:white; border:none; font-size:18px;"> Anketin
                Çeşidi </span>

              <select name="anket_cesidi" class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
                
                <option value="Geliştirme">Geliştirme</option>
                <option value="Saab">Saab</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon " style="background-color:white; border:none; font-size:18px;"> Anketin
                Kategorisi    </span>

              <select name="anket_kategori" class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
             
                <option value="Psikoloji">Psikoloji</option>
                <option value="Eğitim">Eğitim</option>
                <option value="Sosyal ve Beşeri Bilimler">Sosyal ve Beşeri Bilimler</option>
                <option value="Fen,Matematik ve Mühendislik Bilimleri">Fen,Matematik ve Mühendislik Bilimleri</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Kaynak
                Türü</span>
              <select name="kaynak_turu"  class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
             
                <option value="Makale">Makale</option>
                <option value="Kitap">Kitap</option>
                <option value="Tez">Tez</option>
                <option value="Bildiri">Bildiri</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Yazarlar
              </span>
              <input type="text"  name="yazar"  class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div>  
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Yıl</span>
              <input type="text" name="yil" class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div> 
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Kaynağın Tam
                Adınız Yazınız </span>
              <input type="text" name="kaynak_adi"   class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div><p style="background-color:white; color:red; border:none; font-size:14px;"> Lütfen önce Kaynak Türü
                  Seçiniz </p>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> adres </span>
              <input type="text" name="adres"  class="form-control input-lg"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Kimlere Uygulanabileceği </span>
              <input type="text" class="form-control input-lg" name="uygulama"
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon"  style="background-color:white; border:none; font-size:18px;"> Derecelendirme </span>
              <input type="text" class="form-control input-lg" name="derece" 
                style="background-color:white;  border:none; width:95%; font-size:18px;">
            </div>

            <p style="background-color:white; color:red; border:none; font-size:14px;"> 
              Anket aracının derecelendirmesini yazınız. Örnek:  (1= hiçbir zaman – 5= her zaman) veya 6’lı derecelendirme (1= hiç katılmıyorum – 6= tamamen katılıyorum) gibi. </p>
          </div>
          <div class="form-group">
            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
              <span class="input-group-addon" style="background-color:white; border:none; font-size:18px;"> Anketin Puanlaması</span>
              <input type="text" class="form-control input-lg" name="puan"
                style="background-color:white;  border:none; width:95%; font-size:18px;"/>
               
            </div> <p  style="background-color:white; color:red; border:none; font-size:14px;"> 
              Anket aracının  puanlamasını yazınız. (Örnek: Anketten alınabilecek puan 5 ile 35 arasında değişmektedir. Ankette ters madde bulunmamaktadır.) </p>
          </div>
          <hr class="hr-lg">

        <center>
            <h3 >Anketi Ekleyen</h3>
        </center>  
          <div class="row">

          <div class="form-group col-xs-12 col-sm-12">
              
           
            
                <div class="form-group"  style="border-bottom:1px solid; border-color: #cacaca">
                  <input type="text" class="form-control input-lg" name="anketi_ekleyen"  placeholder="Ad-Soyad" style="background-color:white;  border:none; width:95%; font-size:17px;">
                </div>
             
                <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
                  <input type="email" class="form-control input-lg" name="anketor_mail" placeholder="Email" style="background-color:white;  border:none; width:95%; font-size:17px;">
                </div>

                
                
           
   
            </div>


          </div>

          

        </div>
      </div>

      <div class="button-group">
        <div class="action-buttons">

          <div class="upload-button">
            <button class="btn btn-block btn-primary">Anket Dosyasını Seçiniz</button>
            <input type="file" name="anket_yol"  > 
          </div>

        </div>
      </div>
 

      </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>


      <!-- Social media -->
      



      <!-- Submit -->
      <section class=" bg-img" style="background-image: url(.//assets/img/bg-facts.jpg);">
        <div class="container">
          <header class="section-header">
            <span>TAMAM MISIN?</span>
            <h2>Anket Yükleme</h2>
            <p>Lütfen bilgilerinizi bir kez daha gözden geçirin ve anketinizi çevrimiçi duruma getirmek için aşağıdaki
              düğmeye basın.</p>
          </header>

          <p class="text-center"><input type="submit" class="btn btn-success btn-xl btn-round " name="yukle" id="yukle"/></p>

        </div>
      </section>
      <!-- END Submit -->


    </main>
    <!-- END Main container -->
    </form>

  <!-- Site footer -->
  <?php 
      include("footer.php");
    ?>


  <!-- END Site footer -->


  <!-- Back to top button -->
  <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
  <!-- END Back to top button -->

  <!-- Scripts -->
  <script src="assets/js/app.min.js"></script>
  <script src="assets/vendors/summernote/summernote.min.js"></script>
  <script src="assets/js/thejobs.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>