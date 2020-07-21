<?php
  //Database connection by using PHP PDO
   
    $connection = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
    $connection->exec("SET NAMES utf8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
   //This code for Create new Records
   if($_POST["kaydet"])
   {

    $statement = $connection->prepare("
    INSERT INTO sorular (anket_id,soru) VALUES(:anket_id,:soru)
    ");
  
   $anket_id=1;
    $result = $statement->execute(
     array(          
        ':anket_id' => $anket_id,
        ':soru' => $_POST["soru[]"] 
     )
    );
    if(!empty($result))
    {
     echo 'Kayıt Eklendi ...';
    }
   }
  
   //This Code is for fetch single customer data for display on Modal

  
  
  
  ?>