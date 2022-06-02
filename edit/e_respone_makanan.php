<?php
include_once("../dbconfig/config.php");
    
$id_makanan = $_POST['idmakanan'];
$nama_makanan = $_POST['namamakanan'];
$id_category = $_POST['idcategory'];
$detail_makanan = $_POST['detailmakanan'];
$harga_makanan = $_POST['hargamakanan'];

$query = "UPDATE tbl_menu_list SET id_categori='".$id_category."',nama_menu='".$nama_makanan."',detail_menu='".$detail_makanan."',harga='".$harga_makanan."' WHERE id_menu='".$id_makanan."'";
$sql = mysqli_query($mysqli, $query); // Eksekusi/ Jalankan query dari variabel $query

header("location:../menu.php");

?>
   