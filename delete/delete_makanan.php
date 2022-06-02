<?php 
include_once("../dbconfig/config.php");

$id = $_GET['id'];
mysqli_query($mysqli, "DELETE FROM tbl_menu_list WHERE id_menu='$id'")or die(mysqli_error());
 
header("location:../menu.php");

?>