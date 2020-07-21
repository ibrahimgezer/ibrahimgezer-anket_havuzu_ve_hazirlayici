<?php
require_once "baglan.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Anket Havuzu Admin Sayfası </title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" />
       

</head>

<body>
    

            <!--header start-->
            <header class="header white-bg">
                <div class="container ">
                    <div class="sidebar-toggle-box">
                        <div data-original-title="Menü" data-placement="right" class="icon-reorder tooltips"></div>
                    </div>
                    <!--logo start-->
                    <a href="index.php" class="logo">Anket <span>Merkezi</span></a>
                    <!--logo end-->
                    <div class="nav notify-row" id="top_menu">
                        <!--  notification start -->
                        <ul class="nav top-menu">
                            <!-- settings start -->
                            <li class="dropdown">
                               <!--   <a data-toggle="dropdown" class="dropdown-toggle" href="#">Arama Kutusunu Gizle</a>-->

                    </div>
                    <div class="top-nav ">
                        <ul class="nav pull-right top-menu">
                            <li>
                                <input type="text" class="form-control search" placeholder="Search">
                            </li>
                            <!-- user login dropdown start-->
                            <li class="dropdown">
                              
                                    <?php 
    
   
  
          try{
              $id=5;
          $query = $baglanti->prepare("SELECT * FROM kullanici where  id=:id  limit 1 ");
          $query->bindParam(':id', $id);

          $calis=$query->execute();
         $count = $query->rowCount();
        
         
          while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
         ?>        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <img alt="" src="img/avatar1_small.jpg">
  <span class="username" value="<?php  echo $sorgu['id'];?>"><?php echo $sorgu["adsoyad"]; ?></span>
  <b class="caret"></b>
                                </a>
        
          <?php } }catch(PDOException $h)
{
echo "<option >Veri Tabanına Erişim Sağlanamadı ... </option>".$h->getMessage();
} 
         
          ?> 
                                   
                                 
                                <ul class="dropdown-menu extended logout">
                                    <div class="log-arrow-up"></div>
                                    <li><a href="#"><i class=" icon-suitcase"></i>Profil</a></li>
                                    <li><a href="#"><i class="icon-cog"></i> Ayarlar</a></li>
                                    <li><a href="#"><i class="icon-bell-alt"></i> Bildirimler</a></li>
                                    <li><a href="login.html"><i class="icon-key"></i> Çıkış Yap</a></li>
                                </ul>
                            </li>
                            <!-- user login dropdown end -->
                        </ul>
                    </div>
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->
            <aside class="kaydır">
                <div id="sidebar" class="nav-collapse">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="index.php">
                                <i class="icon-dashboard"></i>
                                <span> Gösterge Paneli</span>
                            </a>
                        </li>



                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="icon-th"></i>
                                <span>Anasayfa Özelleştir</span>
                            </a>
                            <ul class="sub">
                       
                      
                                <li><a href="anasayfagoster.php">Anasayfa'da Gösterilecek Kategorileri Seç</a></li>
                                <li><a href="bilgi.php">Nasıl Çalışır ?  Özelleştir</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                        <a href="iletisim.php">
                                <i class=" icon-bar-chart"></i>
                                <span>İletişim Özelleştir</span>
                            </a>

                        </li>
                        <li>
                            <a href="hakkimizda.php">
                                <i class="icon-user"></i>
                                <span>Hakkımızda Özelleştir</span>
                            </a>
                        <li>
                       
                        <li>
                            <a href="kategoriler.php">
                                <i class="icon-user"></i>
                                <span>Kategoriler Özelleştir</span>
                            </a>
                        <li>
                            <a href="kullanicilar.php">
                                <i class="icon-user"></i>
                                <span>Kullanıcı İşlemleri </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>
            </body> 
          
</html>  
    