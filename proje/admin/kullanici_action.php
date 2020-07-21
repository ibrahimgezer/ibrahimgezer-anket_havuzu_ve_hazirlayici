<?php
  //Database connection by using PHP PDO
   
    $connection = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
    $connection->exec("SET NAMES utf8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST["action"] == "Load") 
    {
     $statement = $connection->prepare("SELECT * FROM kullanici ORDER BY id ASC");
     $statement->execute();
     $result = $statement->fetchAll();
     $output = '';
     $output .= '
     <table class="table table-bordered">
      <tr>
        <th >Ad-Soyad</th>
        <th >Mail </th>
        <th >Kullanıcı Adı </th>
        <th >Şifre</th>
        <th >Güncelle</th>
        <th >Sil</th>
       </tr>
       '; 
       if($statement->rowCount() > 0)
      {
       foreach($result as $row)
       {
        $output .= '
        <tr>
       <td>'.$row["adsoyad"].'</td>
       <td>'.$row["mail"].'</td>
       <td>'.$row["kullanici_adi"].'</td>
       <td>'.mb_strimwidth($row["sifre"] ,0, 5, "...").'</td>
      
       <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Güncelle</button></td>
       <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Sil</button></td>
      </tr>
      ';
     }
    }
    else
    {
      $output .= '
    
      <tr>,
      <td align="center">.....................................................</td>
    <td align="center">.........................................................</td>
         <td align="center">Kayıt Bulunamadı</td>
         <td align="center">..................................</td>
         <td align="center">..................................</td>
        </tr>
       
       ';
    }
    $output .= '</table>';
    echo $output;
   }
  
   //This code for Create new Records
   if($_POST["action"] == "Ekle")
   {

    $statement = $connection->prepare("
     INSERT INTO kullanici (adsoyad,mail,kullanici_adi,sifre) 
     VALUES (:adsoyad , :mail , :kullanici_adi, :sifre )
    ");
  
   
    $result = $statement->execute(
     array(
       
      
            
        ':adsoyad' => $_POST["adsoyad"],
        ':mail' => $_POST["mail"] ,
        ':kullanici_adi' => $_POST["kullanici_adi"],
        ':sifre' => $_POST["sifre"] 
       
   
     )
    );
    if(!empty($result))
    {
     echo 'Kayıt Eklendi ...';
    }
   }
  
   //This Code is for fetch single customer data for display on Modal
   if($_POST["action"] == "Select")
   {
    $output = array();
    $statement = $connection->prepare(
     "SELECT * FROM kullanici 
     WHERE id = '".$_POST["id"]."' 
     LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output["adsoyad"] = $row["adsoyad"]; 
     $output["mail"] = $row["mail"];  
     $output["kullanici_adi"] = $row["kullanici_adi"];
     $output["sifre"] = $row["sifre"];
    
    }
    echo json_encode($output);
   }
  
   if($_POST["action"] == "Güncelle")
   {
    $statement = $connection->prepare(
     "UPDATE kullanici 
     SET adsoyad = :adsoyad, mail = :mail , kullanici_adi = :kullanici_adi , sifre = :sifre 
     WHERE id = :id
     "
    );
    $result = $statement->execute(
     array(
      ':adsoyad' => $_POST["adsoyad"],
      ':mail' => $_POST["mail"],
      ':kullanici_adi' => $_POST["kullanici_adi"], 
      ':sifre' => $_POST["sifre"],     
 
      ':id'   => $_POST["id"]
     )
    );
    if(!empty($result))
    {
     echo 'Kayıt  Güncellendi ... ';
    }
   }
  
   if($_POST["action"] == "Sil")
   {
    $statement = $connection->prepare(
     "DELETE FROM kullanici WHERE id = :id"
    );
    $result = $statement->execute(
     array(
      ':id' => $_POST["id"]
     )
    );
    if(!empty($result))
    {
     echo 'Kayıt Silindi ...';
    }
   }
  
  
  
  ?>