<?php
include_once("../dbconfig/config.php");
    
$id = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE tbl_orderan_user SET status_order='Kirim' WHERE tbl_orderan_user.status_order='$status' AND tbl_orderan_user.key_user_id='$id'";
$sql = mysqli_query($mysqli, $query); // Eksekusi/ Jalankan query dari variabel $query

header("location:../orderan_kirim.php");

?>
   