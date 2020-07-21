<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Post a job position or create your online resume by TheJobs!">
  <meta name="keywords" content="">

  <title>Gelişmiş Anket Arama</title>

  <!-- Styles -->
  <link href="assets/css/app.min.css" rel="stylesheet">
  <link href="assets/css/thejobs.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">

  <!-- Fonts -->
  <link
    href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
    rel='stylesheet' type='text/css'>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="icon" href="assets/img/favicon.ico">
</head>

<body class="nav-on-header smart-nav bg-alt">

  <!-- Navigation bar -->
  <?php
      include("header.php");
    ?>
  <!-- END Navigation bar -->


  <!-- Page header -->
  
  <header class="page-header bg-img" style="background-image: url(.//assets/img/bg-facts.jpg)">
    <div class="container page-name">
      <h1 class="text-center">Gelişmiş Anket Arama</h1>
      <p class="lead text-center">Size daha uygun Anket için aşağıdaki arama kutusunu kullanın</p>
    </div>
   

    <div class="container">
      <form >

        <div class="row">
          <div class="form-group col-xs-12 col-sm-4">
         <select class="form-control selectpicker" multiple>
         
          <?php 
          
              $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
              $baglanti->exec("SET NAMES utf8");
              $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              try{
              $query = $baglanti->prepare("SELECT cname,id FROM kategoriler where confirm='evet'  order by id asc ");
             $calis=$query->execute();
             $count = $query->rowCount();
            
             
              while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
             ?>      
     
              <option value="<?php  echo $sorgu['id'];?>"><?php echo $sorgu["cname"]; ?></option>
            
              <?php } }catch(PDOException $h)
                {
                echo "<option >Veri Tabanına Erişim Sağlanamadı ... </option>".$h->getMessage();
                } 
             
              ?> 
            </select>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <input type="text" class="form-control" placeholder="Anket adında ara">
          </div>

          <div class="form-group col-xs-12 col-sm-4">
            <input type="text" class="form-control" placeholder="Yazar adında ara">
          </div>



          <div class="form-group col-xs-12 col-sm-4">
            <h6>Yıl</h6>


            <div id="kutucuklar">
              <div class="checkbox">
                <input type="checkbox" id="selectall">
                <label for="selectall">Tüm Yıllar</label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="contract2">
                <label for="contract2">2019-2017 <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="contract3">
                <label for="contract3">2016-2014 <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="contract4">
                <label for="contract4">2013-2011 <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="contract5">
                <label for="contract5">2011 ve Öncesi <small>(kaç adet olduğu)</small></label>
              </div>
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <h6>Soru Sayısı</h6>
            <div  id="kutucuklar2">
              <div class="checkbox">
                <input type="checkbox" id="selectall1" >
                <label for="selectall1">Hepsi</label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="rate2"><label for="rate2">0 - 50 <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="rate3"><label for="rate3">50 - 100 <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="rate4"><label for="rate4">100 - 200 <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="rate5"><label for="rate5">200+ <small>(kaç adet olduğu)</small></label>
              </div>
            </div>
          </div>


          <div class="form-group col-xs-12 col-sm-4">
            <h6>Kaynak Türü</h6>
            <div id="kutucuklar3">
              <div class="checkbox">
                <input type="checkbox" id="selectall2">
                <label for="selectall2">Tüm Kaynaklar</label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="degree2" >
                <label for="degree2">Makale <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="degree3" >
                <label for="degree3">Kitap<small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="degree4" >
                <label for="degree4">Bildiri <small>(kaç adet olduğu)</small></label>
              </div>

              <div class="checkbox">
                <input type="checkbox" id="degree5" >
                <label for="degree5">Tez <small>(kaç adet olduğu)</small></label>
              </div>
            </div>
          </div>

        </div>

        <div class="button-group">
          <div class="action-buttons">
            <button class="btn btn-primary">Filtreleri Uygula</button>
          </div>
        </div>

      </form>

    </div>

  </header>
  <!-- END Page header -->


  <!-- Main container -->
  <main>
    <section class="no-padding-top bg-alt">
      <div class="container">
        <div class="row item-blocks-condensed">

          <div class="col-xs-12">
            <br>
            <h5> <strong>....</strong> sonuç bulduk <i>...</i> - <i>...</i> arası</h5>
          </div>

          <!-- Job item -->
          <div class="col-xs-12">
            <a class="item-block" href="anket-detay.php">
              <header>
                <img src="assets/img/logo-google.jpg" alt="">
                <div class="hgroup">
                  <h4>Anket İsmi</h4>
                  <h5>Anket Sahibi</h5>
                </div>
                <div class="header-meta">
                  <span>Sayfa Sayısı</span>
                  <span class="label label-success">Kategori </span>
                </div>
              </header>
            </a>
          </div>
          <!-- END Job item -->



          <!-- Page navigation -->
          <nav class="text-center">
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <i class="ti-angle-left"></i>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <i class="ti-angle-right"></i>
                </a>
              </li>
            </ul>
          </nav>
          <!-- END Page navigation -->


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

  
  <script type="text/javascript">

    $("#selectall").change(function () {

      $("#kutucuklar").find("input:checkbox").prop('checked', $(this).prop("checked"));
    });


  </script>
  <script type="text/javascript">
    $("#selectall1").change(function () {

      $("#kutucuklar2").find("input:checkbox").prop('checked', $(this).prop("checked"));
    });
  </script>
  <script type="text/javascript">
    $("#selectall2").change(function () {

      $("#kutucuklar3").find("input:checkbox").prop('checked', $(this).prop("checked"));
    });
  </script>

</body>

</html>