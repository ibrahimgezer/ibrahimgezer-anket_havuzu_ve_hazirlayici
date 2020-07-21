<?php
session_start();
 include("baglan.php");
if (isset ($_POST["sil_id"]))
{
    if(isset($_POST['sil_id']))
	{
       $anket_id=$_GET["id"];
		
		$id=$_REQUEST['sil_id'];	//get delete_id and store in $id variable
     
		//delete an orignal record from baglanti
		$delete_stmt = $baglanti->prepare('DELETE FROM sorular WHERE id =:id');
		$delete_stmt->bindParam(':id',$id);
        $delete_stmt->execute();
        $delete_stmt2 = $baglanti->prepare('DELETE FROM secenek WHERE soruid =:id');
		$delete_stmt2->bindParam(':id',$id);
		$delete_stmt2->execute();
        echo  "<script type='text/javascript'>location:anket-guncelle.php?id=$anket_id alert('Silmek İstediğiniz Soru Başarıyla Silindi !!');</script>"; 

		
	}
    $yenisoru="Başlıksız Soru";
    $kategori="Belirlenmedi";
    $yenisecenek="Seçenek 1";
    $anketadi=$_POST["anket"];
    $anketkaydet=$baglanti->prepare('INSERT INTO anketler (anket_adi, kullanici_id,kategori)  values(:anket_adi,:kullanici_id,:kategori)'); 
    $anketkaydet->bindParam(':anket_adi',$anketadi);	
    $anketkaydet->bindParam(':kullanici_id',$kullanici_id);	
    $anketkaydet->bindParam(':kategori',$kategori);	
    if( $anketkaydet->execute())
    {
        $sonid=$baglanti->lastInsertId();
        echo "<script>location='anket-guncelle.php?anket_id=$sonid'</script>";
    }

  
}
?>