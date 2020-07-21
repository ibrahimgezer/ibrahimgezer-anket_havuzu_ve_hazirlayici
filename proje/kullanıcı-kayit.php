<?php

include("baglan.php");

if(isset($_REQUEST['ekle']))
{
   
	try
	{
        $ad	= $_REQUEST['ad'];
        $k_adi	= $_REQUEST['k_adi'];
        $mail	= $_REQUEST['mail'];
        $sifre	= $_REQUEST['sifre'];
        if(empty($ad)){
            $HataMesaj="Lütfen İsim Soyisim Giriniz !!";
        }
        else if(empty($mail)){
            $HataMesaj="Lütfen Mail Adresini  Giriniz !!";
        }
        if(empty($sifre)){
            $HataMesaj="Lütfen Bir Şifre Belirleyiniz !! ";
        }
		  $kayit=$baglanti->prepare('INSERT INTO kullanici (adsoyad,kullanici_adi,mail,sifre) VALUES(:ad,:k_adi,:mail,:sifre)'); 
      $kayit->bindParam(':ad',$ad);	
      $kayit->bindParam(':k_adi',$ad);	
			$kayit->bindParam(':mail',$mail);	 
			$kayit->bindParam(':sifre',$sifre);	
			if($kayit->execute())
			{
				$BasariMesaj="Kayıt Başarıyla Eklendi ..."; 
			//	header("refresh:2;index.php");
			}
		}
	
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
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

    <title>Anket Merkezi - Kullanıcı Kayıt </title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href=".//assets/img/favicon.ico">
  </head>

  <body class="login-page"  >


    <main style="margin-top:10px; margin-bottom: 0%;" >

      <div class="login-block" style="margin-top:0px; padding: 5%;  padding-top: 0px;">
<img src=".//assets/img/logo.png" style="height: 150px; width: 250px;" alt="" ><h1> Hesap Oluşturun </h1>
        <?php
              if(isset($HataMesaj))
              {
                ?>
      <div class="alert alert-danger">
          <strong> <?php echo $HataMesaj; ?></strong>
      </div>
      <?php
              }
              if(isset($BasariMesaj)){
              ?>
      <div class="alert alert-success">
          <strong><?php echo $BasariMesaj; ?></strong>
      </div>
      <?php
              }
        ?>
        <form action="#" method="post">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-user"></i></span>
              <input type="text" name="ad" class="form-control" placeholder="İsminiz">
            </div>
          </div>          
          <hr class="hr-xs">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-email"></i></span>
              <input type="text" class="form-control" name="mail" placeholder="E-mail Adresiniz">
            </div>
          </div>          
          <hr class="hr-xs">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-user"></i></span>
              <input type="text" name="k_adi" class="form-control" placeholder="Kullanıcı Adınız">
            </div>
          </div>
          <hr class="hr-xs">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-unlock"></i></span>
              <input type="password" name="sifre" class="form-control" placeholder="Şifreniz">
            </div>
          </div>

          <button class="btn btn-primary btn-block" type="submit" name="ekle">Kaydol</button>

        

        </form>
      </div>

      <div class="login-links">
        <p class="text-center">Zaten hesabınız var mı ? <a class="txt-brand" href="kullanıcı-giris.php">Giriş Yap</a></p>
      </div>

    </mainstyle="margin-bottom:0px;">


    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>
</html>
