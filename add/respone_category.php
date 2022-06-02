<?php
include_once("../dbconfig/config.php");
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['submit'])) {
        $category = $_POST['categori'];
        $result = mysqli_query($mysqli, "INSERT INTO tbl_categori_list(nama_categori) VALUES('$category')");
        if( $query ) {
            header('Location: ../category.php');
        } else {
            header('Location: ../category.php');
        }
    } else {
        die("Akses dilarang... ");
    }
?>
   