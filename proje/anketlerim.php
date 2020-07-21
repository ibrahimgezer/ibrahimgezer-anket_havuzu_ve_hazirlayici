
<?php 
include("baglan.php");

	if(isset($_REQUEST['sil_id']))
	{
		// select image sil_id baglanti to delete
		$id=$_REQUEST['sil_id'];	//get delete_id and store in $id variable
    $soruidbul  = $baglanti->query("SELECT * FROM sorular WHERE anket_id=$id");  
    while($sorgu=$soruidbul->fetch(PDO::FETCH_ASSOC)) { 
      $soruid=$sorgu["id"];
      $delete_secenek = $baglanti->prepare('DELETE FROM secenek WHERE soruid=:id');
      $delete_secenek->bindParam(':id',$soruid);
      $delete_secenek->execute();
    }
		//delete an orignal record from baglanti
		$delete_stmt = $baglanti->prepare('DELETE FROM anketler WHERE id=:id');
		$delete_stmt->bindParam(':id',$id);
    $delete_stmt->execute();

    $delete_sorular = $baglanti->prepare('DELETE FROM sorular WHERE anket_id=:id');
		$delete_sorular->bindParam(':id',$id);
    $delete_sorular->execute();
 
 
   
    
    
    echo  "<script type='text/javascript'> alert('Silmek İstediğiniz Anket Formu Başarıyla Silindi !!');</script>"; 

		
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

  <title>Anket</title>

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
      include("baglan.php");
      session_start();
    ?>

<form action="">
    
  <header class="page-header bg-img" style="background-image: url(.//assets/img/bg-facts.jpg)">
    <div class="container page-name">
      <h1 class="text-center">Merhaba <?php echo $_SESSION["adsoyad"]; ?></h1>
      <p class="lead text-center">Hazırlamış olduğunuz anketler aşağı doğru listelenecektir.</p>
    </div>
    </form>
  </header>
  <main style="margin-top:0px;">
    <section class="no-padding-top bg-alt">
      <div class="container">
      <?php  
      $id=$_SESSION['id'];
      $query  = $baglanti->query("SELECT * FROM anketler WHERE kullanici_id='$id' ");

      $count = $query->rowCount();      
      while($sorgu=$query->fetch(PDO::FETCH_ASSOC)) {  ?>      
  <form>
  <div class="row item-blocks-condensed">
          <div class="item-block col-md-12">
  <div class="col-xs-12">
            
                <header>
         
                  <div class="hgroup">
                  <h4><?php echo $sorgu["anket_adi"]; ?></h4>
                <h5><?php echo $_SESSION["adsoyad"]; ?></h5>
                  </div>
                  <div class="header-meta">
                  <span class="label label-success"><?php echo $sorgu["kategori"]; ?> </span>
                  </div>
                </header>

                <footer>
                <!--  <p class="status"><strong>Updated on:</strong> March 10, 2016</p> -->

                  <div class="action-btn">
                  <a class="btn btn-xs btn-black" href="yanitlar.php?id=<?php echo $sorgu["id"]; ?>">Yanıtlar</a>
                  <a class="btn btn-xs btn-success" href="anketolustur.php?anket_id=<?php echo $sorgu["id"]; ?>">Soru Ekle</a>
                    <a class="btn btn-xs btn-log" href="anket-detay.php?id=<?php echo $sorgu["id"]; ?>">İncele</a>
                    <a class="btn btn-xs btn-gray" href="anket_guncelle.php?id=<?php echo $sorgu["id"]; ?>">Düzenle</a>
                    <a class="btn btn-xs btn-danger" href="?sil_id=<?php echo $sorgu["id"];?>" onclick="return myConfirm();">Sil</a>
                  </div>
                </footer>
              </div>
            <!-- Job item -->
            </div>
       </div>
</form>

<?php } ?> 
        <div class="col-xs-12 text-center">
          <br>
          <h5>Toplam  <strong><?php echo $count ?></strong> adet anketiniz bulundu  </h5>
        </div>
        </div>
    </section>
  </main>

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

 
<script>
function myConfirm() {
  var result = confirm("Anketi Silmek istediğinizden Emin misiniz ?");
  if (result==true) {
   return true;
   
  } else {
   return false;
  }
}
</script>  
</body>

</html>