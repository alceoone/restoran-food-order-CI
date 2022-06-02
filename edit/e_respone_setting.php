<?php
include_once("../dbconfig/config.php");
    

$alamat_toko = $_POST['alamattoko'];
$contact_toko = $_POST['contacttoko'];
$email_toko = $_POST['emailtoko'];
$web_toko = $_POST['webtoko'];
$lat_map = $_POST['latmap'];
$long_map = $_POST['longmap'];
$jarak_cod = $_POST['jarakcod'];

$query = "UPDATE tbl_setting SET alamat_toko='".$alamat_toko."',contact_toko='".$contact_toko."',email_toko='".$email_toko."',web_toko='".$web_toko."',lat_map='".$lat_map."',long_map='".$long_map."',jarak_cod='".$jarak_cod."' WHERE id_setting='1'";
$sql = mysqli_query($mysqli, $query); // Eksekusi/ Jalankan query dari variabel $query

header("location:../setting.php");

?>
   