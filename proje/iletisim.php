<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  iframe{
    width="1200"; margin-left="0"; height="500";
  }
  
  </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>İletişim </title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">

  <?php
      include("header.php");
    ?>
    <!-- END Navigation bar -->


    <!-- Site header -->
    <header class="page-header bg-img size-lg" style="background-image: url(.//assets/img/bg-facts.jpg); padding-bottom:0px;">
      <div class="container no-shadow">
        <h1 class="text-center">Bize Ulaşın</h1>
        <p class="lead text-center">Merhaba deyin, bir mail bırakın ve  bizi takip edin.</p>
      </div>
    </header>
    <!-- END Site header -->


    <!-- Main container -->
    <main>

      <section>
        <div class="container" style="margin-top:0px;">
        <?php 
          
          $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
          $baglanti->exec("SET NAMES utf8");
          $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          try{
          $query = $baglanti->prepare("SELECT konum FROM iletisim_bilgi where onay='Evet'  order by id asc limit 1 ");
         $calis=$query->execute();
         $count = $query->rowCount();
        
         
          while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
         
         ?>     
        
              <iframe src="<?php echo $sorgu["konum"]; ?>" width="1200" margin-left="0" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        
          <?php } }catch(PDOException $h)
{
echo "<i >Veri Tabanına Erişim Sağlanamadı ... </i>";
} 
         
          ?> 
         
        
 

          <br><br>

          <div class="row">
            <div class="col-sm-12 col-md-8">
              <h4 style="position:center;">İletişim Formu</h4>
              <form>
            
                <div class="form-group"  style="border-bottom:1px solid; border-color: #cacaca">
                  <input type="text" class="form-control input-lg" placeholder="İsim" style="background-color:white;  border:none; width:95%; font-size:17px;">
                </div>

                <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
                  <input type="email" class="form-control input-lg" placeholder="Email" style="background-color:white;  border:none; width:95%; font-size:17px;">
                </div>

                <div class="form-group"  style="border-bottom:1px solid; border-color: #cacaca">
                  <textarea class="form-control" rows="5" placeholder="Mesaj" style="background-color:white;  border:none; width:95%; font-size:17px;"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Gönder</button>
              </form>
            </div>

            <div class="col-sm-12 col-md-4">
              <h4>Bilgi</h4> <div class="highlighted-block">
                <dl class="icon-holder">
                  
              <?php 
          
          $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
          $baglanti->exec("SET NAMES utf8");
          $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          try{
          $query = $baglanti->prepare("SELECT telefon,mail,konum_kisaltma FROM iletisim_bilgi where onay='Evet'  order by id asc limit 1 ");
         $calis=$query->execute();
         $count = $query->rowCount();
        
         
          while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
         
         ?>     
            <dt><i class="fa fa-phone"></i></dt>
         <dd><?php echo $sorgu["telefon"]; ?></dd>
  <dt><i class="fa fa-map-marker"></i></dt>
              <dd><?php echo $sorgu["konum_kisaltma"]; ?></dd>
                <dt><i class="fa fa-envelope"></i></dt>             
              <dd><?php echo $sorgu["mail"]; ?></dd>
          
          <?php } }catch(PDOException $h)
{
echo "<i >Veri Tabanına Erişim Sağlanamadı ... </i>";
} 
         
          ?> 
                 
             

                

                
                 
                </dl>
              </div>

              <br>

              <ul class="social-icons size-sm text-center">
                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
              </ul>

            </div>
          </div>

        </div>
      </section>


    </main>
    <!-- END Main container -->


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
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>

  </body>
</html>
