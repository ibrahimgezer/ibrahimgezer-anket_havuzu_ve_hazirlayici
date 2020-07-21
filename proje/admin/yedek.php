<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Özelleştirnmiş Admin Sayfası </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:100px;
   }
  </style>
 </head>
  <body class="boxed-page">
     <div class="container box">
     <?php
      include("header.php")
      ?>
        
        
   <h1 align="center">Kategoriler</h1>
   <br />
   <div align="right">
    <button type="button" id="modal_button" class="btn btn-info">Kayıt Ekle</button>
    <!-- It will show Modal for Create new Records !-->
   </div>
   <br />
   <div id="result" class="table-responsive"> <!-- Data will load under this tag!-->

   </div>
  </div>
 </body>
</html>
         <!--
         sidebar end
          <!--main content start
          <section id="main-content">
              <section class=" wrapper">
                        <section class="panel">
                          <header class="panel-heading">
                           Slider Yazı Özelleştirme
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" role="form">
                                 
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Kategori Adı Giriniz</label>
                                      <div class="col-lg-10">
                                          <input type="text-area" name="kname" class="form-control" placeholder="İçerik">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                  	 <label for="inputPassword1" class="col-lg-3 col-sm-3 control-label">Gelişmiş Arama'da Gösterilsin mi ?</label>
                                        <div class="col-lg-9">
                                          <input type="text-area" name="kconfirmation" class="form-control" placeholder=" Evet / Hayır ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-5 col-lg-10">
                                          <button type="submit" class="btn btn-danger" name="save">Kaydet </button>
                                      </div>
                                  </div>
                              </form>
				<div class="row ">
                  <div class="col-lg-12 " >
                      <section class="panel">
                          <header class="panel-heading  ">
                             Slider Altındaki Metinler
                          </header>

        <!-- /.adminpanelde slider altı verileri  çekme işlemi  


            <?php   
             	
            $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
            $baglanti->exec("SET NAMES utf8");
            $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $baglanti->prepare("SELECT * FROM categories where kconfirmation='evet'  order by id asc ");
            $query->execute();
                  
            ?>
             <table class="table  table-advance  table-hover " style="font-size:12px;" id="links-list">
                  <thead> 
                
                    <tr >                     
                      <th class="text-center" >Kategori ID </th>
                      
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Onay </th>
                      <th class="text-center">Düzenle</th>
                      <th class="text-center">Sil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php                     
                      while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>                        
                        <td class="text-center"><?php echo $sorgu['id']; ?></td>
                     
                        <td class="text-center"   ><?php 
                        $detay = $sorgu['kname'];
                        //Var olan metin içindeki karakter sayısı
                        $uzunluk = strlen($detay);
                        //Kaç Karakter Göstermek İstiyorsunuz
                        $limit = 10;
                        //Uzun olan yer "devamı..." ile değişecek.
                        if ($uzunluk > $limit) {
                        $detay = substr($detay,0,$limit) . "...";
                        }
                        echo $detay; ?></td>
                        <td class="text-center"><?php echo $sorgu['kconfirmation']; ?></td>                   
                        <td class="text-center"><a href="slideralt.php?id=<?php echo $sorgu['id']; ?>"><button  class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</button></a>
                        </td>            
                        <td class="text-center"><a  href="slideralt.php?confirmation=ok&id=<?php echo $sorgu['id']; ?>" id="delete"><button type="submit"  class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Sil</button></a>
                        </td>
                      </tr>
                      <?php } ?>
                </tbody>
            </table>

   <!-- /.adminpanelde slider altı verileri  çekme işlemi bitti -->

                          </div>
                     
                     </section></div></div></div></section></section></section></li></ul></div></div></header>
          </section>
          <!--main content end-->
          <!--footer start-->
          <footer class="site-footer">
              <div class="text-center">
                 2019 Created By İbrahim Gezer
                  <a href="#" class="go-top">
                      <i class="icon-angle-up"></i>
                  </a>
              </div>
          </footer></
          <!--footer end-->

    

      </div>
 
    <!-- js placed at the end of the document so the pages load faster -
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>

    <!--common script for all pages
    <script src="js/common-scripts.js"></script>
	  <?php/* 
		
		if(isset($_POST['save']))

		{
            header("Refresh:0");
        $kname=$_POST['kname'];
      $kconfirmation=$_POST['kconfirmation'];
     
      
			if(empty($kname) || empty($kconfirmation))
				{
			
				echo "<script>alert('Lüften Boş Alanlari Doldurunuz ! ');</script>";
                exit;

              
				}
			
			else 
        {
         
		$baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
        $baglanti->exec("SET NAMES utf8");
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sorgu = $baglanti->prepare("INSERT INTO categories (kname , kconfirmation) values ('$kname','$kconfirmation')");
     	$sorgu->bindParam(1, $kname, PDO::PARAM_STR);
        $sorgu->bindParam(2, $kconfirmationyazi, PDO::PARAM_STR);     
        $sorgu->execute();
      
         exit;
       
        }
      }
       
  if ($_GET['confirmation']=="ok") {
        $id=$_GET["id"];
	    $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
        $baglanti->exec("SET NAMES utf8");
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (! empty($id )) {

   $sil=$baglanti->prepare("DELETE from categories where id=$id");
     $sil->execute();

      echo "<script>alert('Kayıt Başarı İle silindi');</script>";
    
        exit;
        $id=null;
  } 
  else { 

 echo "<script>alert('Kayıt Başarı İle silinmedi');</script>";
   exit;
       
    

  } } 

?>

  </body>
</html>-->
