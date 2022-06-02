<?php 
include_once("../dbconfig/config.php");

$id = $_GET['id'];
mysqli_query($mysqli, "DELETE FROM tbl_categori_list WHERE id_categori='$id'")or die(mysqli_error());
 
header("location:../category.php");

?>