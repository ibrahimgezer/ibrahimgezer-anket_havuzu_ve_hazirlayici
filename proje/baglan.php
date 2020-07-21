

<?php

try {

    $ayarlar = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );

    $baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "", $ayarlar);

    // set the PDO error mode to exception
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  

} catch (PDOException $ex) {
    die($ex->getMessage());
}


?>
 