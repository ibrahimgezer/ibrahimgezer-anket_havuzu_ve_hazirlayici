
<?php
/*$servername = "localhost";
$database = "ornek";
$username = "root";
$password = "";
// Create connection
$baglanti = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$baglanti) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($baglanti);
*/
$baglanti = new PDO("mysql:host=localhost;dbname=dbanketmerkezi", "root", "");
$baglanti->exec("SET NAMES utf8");
$baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 ?>