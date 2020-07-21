<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Anket Merkezi">
    <meta name="keywords" content="">

    <title>Anasayfa</title>

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

  <body class="nav-on-header smart-nav" >

    <!-- Navigation bar  -->
    <?php
      include("header.php");
      include("baglan.php");
    ?>
    

    <!-- END Navigation bar -->


    <!-- Site header -->
    <header class="site-header size-lg text-center" style="background-image: url(.//assets/img/bg-facts.jpg)" >
      <div class="container">
        <div class="col-xs-12" style="width:100%;">
          <br><br>
          <?php  
 
      $query  = $baglanti->query("SELECT * FROM anketler ");
      $count = $query->rowCount();    ?>
          <h2>Web Anket Havuzunda  <mark><?php  echo $count; ?></mark>anket bulunmaktadır !</h2>
          <div class="header-job-search" >
            <div class="input-keyword">
              <input type="text" class="form-control" placeholder="Aramak İstediğiniz Anketi Giriniz">
            </div>

            

            <div class="btn-search">
              <button class="btn btn-primary" type="submit">Ara</button>
              <a href="kategoriler.php">Gelişmiş Anket Arama</a>
            </div>
          </div>
      

        </div>

      </div>
    </header>

    <main>
      <!-- Facts -->   
        <section class=" no-overlay section-sm" style="background-image: url(.//assets/img/bg-facts.png)">
        <div class="container">
         <center> <h2>Popüler Kategoriler</h2></center>
          <div class="row">
            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="1"></span>+</p>
              <h6>deneme 1</h6>
            </div>

            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="1"></span>+</p>
              <h6>Kategori 2</h6>
            </div>

            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="0"></span>+</p>
              <h6>Kategori 3</h6>
            </div>

            <div class="counter col-md-3 col-sm-6">
              <p><span data-from="0" data-to="0"></span>+</p>
              <h6>Kategori 4</h6>
            </div>
          </div>

        </div>
      </section>
 
      <section>
        <div class="container">

          <div class="col-sm-12 col-md-6">
            <header class="section-header text-left">
              <span>İŞ AKIŞI</span>
              <h2>Nasıl Çalışır ?</h2>
            </header>

            <p class="lead">Kullanıcılar Sisteme girdiklerinde Anasayfa'dan anket taraması yapabilir,popüler anket kategorilerini görebilir.
Gelişmiş Anket Arama Yoluyla Filtreleme yaparak aranılan anketlere ulaşım sağlanılabilir. Anket Yükle Sekmesinden kullanıcı girşi yaparak sistemde yayınlanmak üzere .pdf veya .docx uzantılı anket dosyalarını sisteme yükleyip paylaşabilirsiniz.</p>
            <p class="lead">Anket Oluştur Sekmesinden ise Kullanıcı istediği miktarda soru oluşturabilir ve yayınlayabilir. Bu sekmeden ayrıca soruların yanıtlarını da inceleyebilir.</p>
            
            
            <br><br>
           <!-- <a class="btn btn-primary" href="page-typography.html">Daha Fazla </a> -->
          </div>

          <div class="col-sm-12 col-md-6 hidden-xs hidden-sm">
            <br>
            <img class="center-block" src=".//assets/img/anketolustur.jpg" alt="how it works">
          </div>

        </div>
      </section>
     
        <?php 
        $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
        $baglanti->exec("SET NAMES utf8");
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          try{
          $query = $baglanti->prepare("SELECT * FROM yardim");
              while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
            
            ?>    
                            
            <?php echo $sorgu["baslik"]; ?>
            <?php echo $sorgu["icerik"]; ?>
              <?php 
              } 
          }
          catch(PDOException $h)
          {
          echo "<i >Veri Tabanına Erişim Sağlanamadı ... </i>";
          } 
         
          ?> 
         

      <section class="bg-img text-center" style="background-image: url(.//assets/img/bg-facts.jpg)">
        <div class="container">
          <h2><strong>Abone ol</strong></h2>
          <h6 class="font-alt"> Gelen kutunuzda haftalık en  yeni anketleri inceleyin</h6>
          <br><br>
          <form class="form-subscribe" action="#">
            <div class="input-group">
              <input type="text" class="form-control input-lg" placeholder="E-mail adresiniz">
              <span class="input-group-btn">
                <button class="btn btn-success btn-lg" type="submit">Abone ol</button>
              </span>
            </div>
          </form>
        </div>
      </section>
    

    </main>
 
  <?php
  include("footer.php");
  ?>

   


    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
  

    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>
</html>
