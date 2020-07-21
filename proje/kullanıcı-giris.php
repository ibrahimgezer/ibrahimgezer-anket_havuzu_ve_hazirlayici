<?php
	session_start();
	include("baglan.php");

  if(isset($_REQUEST['giris']))
	{
		$mail =$_POST["mail"];
		$pass =$_POST["sifre"];

 
    $query  = $baglanti->query("SELECT * FROM kullanici WHERE mail='$mail' && sifre='$pass'",PDO::FETCH_ASSOC);
    while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
    $isim=$sorgu["adsoyad"];
    $_SESSION["id"]=$sorgu["id"];
    $_SESSION["adsoyad"]=$sorgu["adsoyad"];
    }    

		if ( $say = $query -> rowCount() ){

			if( $say > 0 ){
		
				$_SESSION['oturum']=true;
				$_SESSION['mail']=$mail;
				$_SESSION['sifre']=$pass;
       
        $BasariMesaj="Hoş Geldiniz ".$isim;
        header("refresh:3;index.php");
			
			}else{
				$HataMesaj="Oturum Açılmadı ";
			}
    }
    else{
			$HataMesaj= "Kullanıcı adı veya şifre hatalı";
		
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

    <title>Anket Merkezi - Kullanıcı Giriş</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href=".//apple-touch-icon.png">
    <link rel="icon" href=".//assets/img/favicon.ico">
  </head>

  <body class="login-page">


    <main style="margin-top:40px; margin-bottom: 0%;" >

      <div class="login-block" style="margin-top:0px; padding: 5%;  padding-top: 0px;">
        <img src=".//assets/img/logo.png" style="height: 150px; width: 250px;" alt="" >
        <h1>Hesabınıza Giriş Yapın</h1>
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

        <form action="" method="post">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-email"></i></span>
              <input type="text" name="mail" class="form-control" placeholder="Email Adresiniz">
            </div>
          </div>
          
          <hr class="hr-xs">

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="ti-unlock"></i></span>
              <input type="password" name="sifre" class="form-control" placeholder="Şifreniz">
            </div>
          </div>
                    
          <hr class="hr-xs">
          <div class="form-group">
            <div class="input-group" >
              <button class="btn btn-primary btn-block" type="submit" name="giris">Giriş Yap</button>
            </div>
          </div>

        </form>
      </div>

      <div class="login-links">
        <a class="pull-left" href="sifremi-unuttum.php">Şifremi Unuttum</a>
        <a class="pull-right" href="kullanıcı-kayit.php">Bir Hesap Oluştur</a>
      </div>

    </main>


    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>
</html>
