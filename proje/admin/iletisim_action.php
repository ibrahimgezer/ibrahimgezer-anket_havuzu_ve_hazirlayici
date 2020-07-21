<?php
  //Database connection by using PHP PDO
   
    $connection = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
    $connection->exec("SET NAMES utf8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST["action"] == "Load") 
    {
     $statement = $connection->prepare("SELECT * FROM iletisim ORDER BY id ASC");
     $statement->execute();
     $result = $statement->fetchAll();
     $output = '';
     $output .= '
     <table class="table table-bordered">
      <tr>
        <th >Telefon</th>
        <th >Mail </th>
        <th >Konum </th>
        <th >Konum Linki</th>
        <th >İletişim Bilgisi Olarak Gösterilsin mi?</th>        
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
       <td>'.$row["telefon"].'</td>
       <td>'.$row["mail"].'</td>
       <td>'.$row["konum_kisaltma"].'</td>
       <td>'.mb_strimwidth($row["konum"] ,0, 10, "...").'</td>
       <td>'.$row["onay"].'</td>
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
     INSERT INTO iletisim (telefon,mail,konum_kisaltma,konum,onay) 
     VALUES (:telefon , :mail , :konum_kisaltma, :konum , :onay)
    ");
  
   
    $result = $statement->execute(
     array(
       
      
            
        ':telefon' => $_POST["telefon"],
        ':mail' => $_POST["mail"] ,
        ':konum_kisaltma' => $_POST["konum_kisaltma"],
        ':konum' => $_POST["konum"] ,
        ':onay' =>  $_POST["onay"]     
   
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
     "SELECT * FROM iletisim 
     WHERE id = '".$_POST["id"]."' 
     LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output["telefon"] = $row["telefon"]; 
     $output["mail"] = $row["mail"];  
     $output["konum_kisaltma"] = $row["konum_kisaltma"];
     $output["konum"] = $row["konum"];
     $output["onay"] = $row["onay"];
    }
    echo json_encode($output);
   }
  
   if($_POST["action"] == "Güncelle")
   {
    $statement = $connection->prepare(
     "UPDATE iletisim 
     SET telefon = :telefon, mail = :mail , konum_kisaltma = :konum_kisaltma , konum = :konum , onay=:onay
     WHERE id = :id
     "
    );
    $result = $statement->execute(
     array(
      ':telefon' => $_POST["telefon"],
      ':mail' => $_POST["mail"],
      ':konum_kisaltma' => $_POST["konum_kisaltma"], 
      ':konum' => $_POST["konum"],     
      ':onay' => $_POST["onay"],
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
     "DELETE FROM iletisim WHERE id = :id"
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