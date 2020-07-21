<?php
session_start();
 include("baglan.php");
if (isset ($_POST["anketyeni"]))
{
    $kullanici_id=$_SESSION["id"];

    if(empty($kullanici_id)){
echo  "<script type='text/javascript'>location='index.php'; alert('Kullanıcı Girişi yapmanız Gerekmektedir.');</script>";
    }
    else{
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
        echo "<script>location='anketolustur.php?anket_id=$sonid'</script>";
    }

}
}
?>