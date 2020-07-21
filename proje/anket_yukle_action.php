<?php
  //Database connection by using PHP PDO
   
    $connection = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
    $connection->exec("SET NAMES utf8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
   //This code for Create new Records
   if($_POST["yukle"] == "Ekle")
   {

    $statement = $connection->prepare("
     INSERT INTO yuklenen_anketler (anket_adi,anket_cesidi,anket_kategori,kaynak_turu,yazar,yil,kaynak_adi,link, uygulama, derece,puan, anketi_ekleyen, anketor_mail,anket_yol) 
     VALUES (:anket_adi, :anket_cesidi, :anket_kategori, :kaynak_turu, :yazar,:yil, :kaynak_adi, :link, :uygulama, :derece, :puan, :anketi_ekleyen, :anketor_mail, :anket_yol )
    ");
    
   
    $result = $statement->execute(
     array(
       

        ':anket_adi' => 
        $_POST["anket_adi"],$_POST["anket_cesidi"] ,$_POST["anket_kategori"], $_POST["kaynak_turu"] , $_POST["yazar"], $_POST["yil"] ,
         $_POST["kaynak_adi"], $_POST["link"] ,$_POST["uygulama"],$_POST["derece"] ,$_POST["puan"], $_POST["anketi_ekleyen"], $_POST["anketor_mail"] ,$_POST["anket_yol"] 
        ':anket_cesidi' => $_POST["anket_cesidi"] ,
        ':anket_kategori' => $_POST["anket_kategori"],
        ':kaynak_turu' => $_POST["kaynak_turu"] ,
        ':yazar' => $_POST["yazar"],
        ':yil' => $_POST["yil"] ,
        ':kaynak_adi' => $_POST["kaynak_adi"],
        ':link' => $_POST["link"] ,
        ':uygulama' => $_POST["uygulama"],
        ':derece' => $_POST["derece"] ,
        ':puan' => $_POST["puan"],
        ':anketi_ekleyen' => $_POST["anketi_ekleyen"],
        ':anketor_mail' => $_POST["anketor_mail"] ,
        ':anket_yol' => $_POST["anket_yol"] 
       
   
     )
    );
    if(!empty($result))
    {
     echo 'Kayıt Eklendi ...';
    }
   }

  
  ?>