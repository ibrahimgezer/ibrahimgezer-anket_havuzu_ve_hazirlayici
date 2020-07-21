 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>Anket Detay</title>

    <!-- Styles -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
  </head>

  <body class="nav-on-header smart-nav">
    <!-- Navigation bar -->
    <?php
      include("header.php");
      
      include("baglan.php");
    ?>
    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image:url(.//assets/img/bg-facts.jpg)">
        <div class="container">
            <div class="header-detail">
                <img class="logo" src="(.//assets/img/logo-google.jpg" alt="">
                <?php  
      /*   $id=$_SESSION['id'];
         $sor  = $baglanti->query("SELECT * FROM anketler WHERE kullanici_id='$id' ");
         while($idbul=$sor->fetch(PDO::FETCH_ASSOC)) { 
            $anket_id=$idbul["id"];
         }
            echo $anket_id;*/
            $anket_id=$_GET["id"];
            $sorusayi  = $baglanti->query("SELECT * FROM sorular WHERE anket_id ='$anket_id'");
            $sorusayisi = $sorusayi->rowCount();    
            $query  = $baglanti->query("SELECT * FROM anketler WHERE id='$anket_id' ");
            $count = $query->rowCount();      
            while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {  ?>
                <form action="">
                    <div class="hgroup">
                        <h1>Anketin ismi : <?php echo $sorgu["anket_adi"]; ?></h1>
                        <!--  <h3><a href="#">Google</a></h3>-->
                    </div>
                    <time datetime="2016-03-03 20:00">1 Gündür Yayında</time>
                    <hr>
                    <p class="lead">Açıklama</p>
                    <ul class="details cols-3">
                        <li>
                            <i class="fa fa-book"></i>
                            <span>Soru Sayısı : <?php echo $sorusayisi; ?></span>
                        </li>
                        <li>
                            <i class="fa fa-certificate"></i>
                            <span>Kategori : <?php echo $sorgu["kategori"]; ?> </span>
                        </li>
                    </ul>
                </form>
                <?php } ?>
                <div class="button-group">
                    <div class="action-buttons">
                        <a class="btn btn-success" href="#">Anketi İndir</a>
                        <!--  <a class="btn btn-success" href="job-apply.html">Apply now</a>-->
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- END Page header -->
 
                        <?php    
          $anket_id=$_GET["id"];
          $soruno=null;
          $sorusayi  = $baglanti->query("SELECT * FROM sorular WHERE anket_id ='$anket_id'");
          $sorusayisi = $sorusayi->rowCount();        
          while($sorgu=$sorusayi->fetch(PDO::FETCH_ASSOC)) {               
            $soruno=$sorgu["id"];  ?>
               <div class="container">
    <div class="col-md-12">
        <div class="item-block">
            <div class="item-form ">
                <div class="row">
                <div class="col-xs-12 col-sm-12">
                        <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
                            <input type="text" class="form-control"
                                style="background-color:white;  border:none; width:95%; font-size:17px;"
                                value="<?php echo $sorgu["soru"]; ?> "onkeypress="return false;"> </input>
                        </div>
                        <?php   $seceneksayi  = $baglanti->query("SELECT * FROM secenek  WHERE soruid ='$soruno'");
                            while($secenek=$seceneksayi->fetch(PDO::FETCH_ASSOC)) {  ?>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
                                    <span class="input-group-addon" style="background-color:white; border:none">
                                    <input type="checkbox"> </input>
                                    </span>
                              
                                    <input type="text" class="form-control col-sm-10"
                                        style="background-color:white;  border:none; width:95%; font-size:17px;"
                                        value="<?php echo $secenek["secenek"]; ?>"  onkeypress="return false;"> </input>
                                        
                                </div>
                            </div>
                        </div>
                        <?php   }   ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    </div>    <?php  }   ?>
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

  </body>
</html>
