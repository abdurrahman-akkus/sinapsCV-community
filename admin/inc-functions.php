<?php
//vt bağlan
header("Content-Type: text/html; charset=utf-8");
//error_reporting(0);
setlocale(LC_ALL, 'tr_TR,UTF-8','tr_TR', 'tr','turkish' );
/*define("_HOST", "localhost");
define("_DBNAME", "lisans");
define("_DBUSER", "root");
define("_DBPASS", "");*/

$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "Sinaps++42";
$dbname = "sinapsIK"; 

try{

	$db = new PDO ("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

} catch(PDOException $e){
	echo $e-> getMessage();
}

/*$db->exec("SET NAMES 'utf8'; SET CHAERSET 'utf8' ");
/*define("_URL","http://localhost/lisans");*/

?>