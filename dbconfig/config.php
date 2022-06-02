<?php
Include("DataBase.php");

$url_dashboard = $cdomain;
$databaseHost = $cHost;
$databaseName = $cName;
$databaseUsername = $cUsername;
$databasePassword = $cPassword;

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

?>