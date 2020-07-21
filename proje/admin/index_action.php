<?php
  //Database connection by using PHP PDO
   
    $connection = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
    $connection->exec("SET NAMES utf8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST["action"] == "Load") 
    {
     $statement = $connection->prepare("SELECT * FROM kategoriler ORDER BY id ASC");
     $statement->execute();
     $result = $statement->fetchAll();
     $output = '';
     $output .= '
      <table class="table table-bordered">
       <tr>
        <th>Kategori Adı</th>
        <th>Anasayfada Popüler Kategori Olarak Gösterilsin mi ?</th>
        <th>Güncelle</th>
        <th >Sil</th>
       </tr>
     '; 
     if($statement->rowCount() > 0)
{
     foreach($result as $row)
     {
      $output .= '
      <tr>
       <td>'.$row["cname"].'</td>
       <td>'.$row["i_confirm"].'</td>
       <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Güncelle</button></td>
       <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Sil</button></td>
      </tr>
      ';
     }
    }
    else
    {
     $output .= '
    
    <tr>
  <td align="center">..................................</td>
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
     INSERT INTO kategoriler (cname, i_confirm) 
     VALUES (:cname, :i_confirm)
    ");
    $result = $statement->execute(
     array(
      ':cname' => $_POST["txtName"],
      ':i_confirm' => $_POST["i_txtConfirm"]
      
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
     "SELECT * FROM kategoriler 
     WHERE id = '".$_POST["id"]."' 
     LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
     $output["cname"] = $row["cname"];
     $output["i_confirm"] = $row["i_confirm"];
    }
    echo json_encode($output);
   }
  
   if($_POST["action"] == "Güncelle")
   {
    $statement = $connection->prepare(
     "UPDATE kategoriler 
     SET cname = :cname, i_confirm = :i_confirm 
     WHERE id = :id
     "
    );
    $result = $statement->execute(
     array(
      ':cname' => $_POST["txtName"],
      ':i_confirm' => $_POST["i_txtConfirm"],
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
     "DELETE FROM kategoriler WHERE id = :id"
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