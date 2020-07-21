  <?php session_start();
  error_reporting(0);?>
  <html>
    <head>
    <style>
    @media (max-width: 1366px) {
      .item-block {
        width: 96%;
        margin-top: 25px;
        /* width: 100%; */
      }
    }

    @media (max-width: 991px) {

      .item-block {
        /* margin-top: 10px; */
        width: 84%;
        margin-top: 15px;
      }
    }
  </style>
    <style>
    .ti-menu:before {
    content: "\e68e";
    color: black;
    
     
  } 
  .ti-menu:after {
    
    color: black;
     
  } 
  @media (max-width: 767px){
  .navbar .logo img, .navbar .logo-alt img {
    height: 80px; margin-left: 45px;   width: 400px;
 
     margin-top: 10px;
   
}}
  .logobyt{
    width:180px;
   
  }
  
  </style>  
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Post a job position or create your online resume by TheJobs!">
  <meta name="keywords" content="">
  <title> Anket Oluştur</title>
  <link href="assets/css/app.min.css" rel="stylesheet">
  <link href="assets/vendors/summernote/summernote.css" rel="stylesheet">
  <link href="assets/css/thejobs.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
  <link href="assets/css/tabmenu.css" rel="stylesheet">
  <link href="assets/harici/style.css" rel="stylesheet">
  <!-- Fonts -->
  <link
    href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
    rel='stylesheet' type='text/css'>
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="icon" href="assets/img/favicon.ico">

</head>
    <body>
      <nav class="navbar" style="background-color: white; margin-top: 0%;" >
      <div class="container" >

        <!-- Logo -->
        <div class="pull-left">
          <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

          <div class="logo-wrapper">
          
          <a class="logo-alt logobyt  logo-alt img" href="index.php"><img src=".//assets/img/logo.png" alt="logo-alt" class="logo-alt img" style="width:200px; height:80px;"></a>
          </div>

        </div>
        <div class="pull-right">


    <?php

      if(empty($_SESSION['id']))
      {
      ?>

      <div class="dropdown user-account">
      <a class="dropdown-toggle" style="color:black; font-size:15px;" href="#" data-toggle="dropdown">Oturum Açılmadı</a>
      <ul class="dropdown-menu dropdown-menu-right">
      <li><a href="kullanıcı-giris.php">Giriş Yap </a></li>
      <li><a href="kullanıcı-kayit.php">Kayıt Ol</a></li>
      <li><a href="sifremi-unuttum.php">Şifremi Unuttum </a></li>
      </ul> </div>
      <?php
      }
      else  if(!empty($_SESSION['id'])){
        $id=$_SESSION['id'];
      ?>

      <div class="dropdown user-account">
      <a class="dropdown-toggle" style=" color:black; font-size:14px;" href="#" data-toggle="dropdown"><?php echo $_SESSION['adsoyad']; ?></a>
      <ul class="dropdown-menu dropdown-menu-right">
      <input type="hidden" name="k_id"  value="<?php echo $_SESSION['id']; ?>" class="form-control "></input>
      <li><a href='anketlerim.php'>Anketlerim</a></li>
      <li><a href="cikis.php">Çıkış Yap</a></li>

      </ul> </div>
      <?php
      }
      ?>


</div>
     
        <!-- END User account -->

        <!-- Menüler -->
        <ul class="nav-menu">
          <li>
          <a class="logo logobyt " href="index.php"><img src=".//assets/img/logo.png" class="" alt="logo"></a>

          </li>
        
          <li   style="margin-top: 10px;">
            <a class="active"  style="color: black;" href="index.php">   Anasayfa</a>
           
          </li >
         
      

                <li style="margin-top: 10px;"><a  style="color: black;" href="hakkimizda.php">Hakkımızda</a></li>
                <li style="margin-top: 10px;"><a style="color: black;" href="iletisim.php">İletişim</a ></li>   
                <li style="margin-top: 10px;"><a style="color: black;" href="anketyukle.php">Anket Yükle</a></li >
                <li style="margin-top: 10px;">  
                <form action="varsayılananket.php" method="post">
                <input type="hidden" name="anket" value="Baslıksız Anket"/>
                <a style="color: black;"><input type="submit" style="color:#black; font-size:14px; background:none; border:none;" value="Anket Oluştur" name="anketyeni"></a>
                </form>
              </li >
    </ul>
      </div>
    </nav>
    </body>
</html> 