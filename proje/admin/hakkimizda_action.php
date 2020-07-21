<?php
  //Database connection by using PHP PDO
   
    $connection = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
    $connection->exec("SET NAMES utf8");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST["action"] == "Load") 
    {
     $statement = $connection->prepare("SELECT * FROM hakkimizda ORDER BY id ASC");
     $statement->execute();
     $result = $statement->fetchAll();
     
     $output = '';
     $output .= '
     <table class="table table-bordered">
      <tr>
        <th>Başlık</th>
        <th>İçerik </th>
        <th>Geliştirici</th>
        <th>Geliştirici Görev</th>
        <th>Geliştirici Resim Yolu</th>
        <th>Sayfada Gösterilsin mi?</th>   
        <th>Geliştirici Olarak Gösterilsin mi?</th>       
        <th>Güncelle</th>
        <th>Sil</th>
       </tr>
       '; 
       if($statement->rowCount() > 0)
      {
       foreach($result as $row)
       {
        $output .= '
        <tr>
   
       <td>'.$row["baslik"].'</td>
       <td>'.mb_strimwidth($row["icerik"] ,0, 10, "...").'</td>
       <td>'.$row["g_isim"].'</td>
       <td>'.$row["g_gorev"].'</td>
       <td>'.mb_strimwidth($row["g_resim"] ,0, 10, "...").'</td>
       <td>'.$row["onay"].'</td>
       <td>'.$row["g_onay"].'</td>
      
       <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Güncelle</button></td>
       <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Sil</button></td>
      </tr>
      ';
     }
    }
    else
    {
      $output .= '
    
      <tr style="border:1px solid #f1f2f7;">, 
        <td  style="border:none;">..................</td>
        <td  style="border:none;">..................</td>
        <td  style="border:none;">..................</td>
        <td  style="border:none;">..................</td>
        <td  style="border:none;">Kayıt Bulunamadı</td>
        <td  style="border:none;">..................</td>
        <td  style="border:none;">..............................................</td>
        <td  style="border:none;">..................</td>
        <td  style="border:none;">..................</td>
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
     INSERT INTO hakkimizda (baslik,icerik,g_isim,g_gorev,g_resim,onay,g_onay) 
     VALUES (:baslik , :icerik , :g_isim , :g_gorev, :g_resim , :onay , :g_onay )
    ");
    $result = $statement->execute(     
     array(
        ':baslik' => $_POST["baslik"],
        ':icerik' => $_POST["icerik"] ,
        ':g_isim' => $_POST["g_isim"] ,
        ':g_gorev' => $_POST["g_gorev"],
        ':g_resim' =>   $_POST["g_resim"],
        ':onay' =>  $_POST["onay"]  ,
        ':g_onay' => $_POST["g_onay"]    
     )
    );

    if(!empty($result))
    {
      echo 'Kayıt Eklendi';
    }
/* Getting file name */


 } 

   if($_POST["action"] == "Select")
   {
    $output = array();
    $statement = $connection->prepare(
     "SELECT * FROM hakkimizda 
     WHERE id = '".$_POST["id"]."' 
     LIMIT 1 "
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
     $output["baslik"] = $row["baslik"];          
     $output["icerik"] = $row["icerik"];
     $output["g_isim"] = $row["g_isim"];
     $output["g_gorev"] = $row["g_gorev"];
     $output["g_resim"] = $row["g_resim"];
     $output["onay"] = $row["onay"];
     $output["g_onay"] = $row["g_onay"];
    }
    echo json_encode($output);
   }
  
   if($_POST["action"] == "Güncelle")
   {
    $statement = $connection->prepare(
     "UPDATE hakkimizda 
     SET baslik=:baslik ,icerik=:icerik ,g_isim=:g_isim ,g_gorev=:g_gorev, g_resim=:g_resim ,onay=:onay ,g_onay=:g_onay
     WHERE id = :id
     "
    );
    //get delete_id and store in $id variable


    $statemsent = $connection->prepare("SELECT * FROM hakkimizda  WHERE id = :id ");
        $statemsent->bindParam(':id',$_POST["id"] );
        $result =  $statemsent->execute();
        $row=$statemsent->fetch(PDO::FETCH_ASSOC);
        if(!empty($result))
        {
          unlink("upload/".$row['g_resim']);
        }
    $result = $statement->execute(
     array(
        ':baslik' => $_POST["baslik"],
        ':icerik' => $_POST["icerik"],
        ':g_isim' => $_POST["g_isim"],
        ':g_gorev' => $_POST["g_gorev"],
        ':g_resim' => $_POST["g_resim"],
        ':onay' =>  $_POST["onay"],
        ':g_onay' => $_POST["g_onay"], 
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
      // select image from db to delete
        //get delete_id and store in $id variable
     /*   $select_stmt= $db->prepare('SELECT * FROM tbl_file WHERE id =:id');	//sql select query
$statemsent->execute(array(    ':id' => $_POST["id"] ));
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
          if(!empty($rsesult))
          {
        unlink("upload/".$row['image']);
      }
    }*/
        $statemsent = $connection->prepare("SELECT * FROM hakkimizda  WHERE id = :id ");
        $statemsent->bindParam(':id',$_POST["id"] );
        $result =  $statemsent->execute();
        $row=$statemsent->fetch(PDO::FETCH_ASSOC);
        if(!empty($result))
        {
          unlink("upload/".$row['g_resim']);
        }
        else
        {
          echo "resim yok";
        }
            
         
    $statement = $connection->prepare(
     "DELETE FROM hakkimizda WHERE id = :id"
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
  
   //This code for Create new Records
   
  
  ?>