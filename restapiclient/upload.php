<?php
require_once '../dbconfig/config.php';
$url_dashboard = $cdomain;
$databaseHost = $cHost;
$databaseName = $cName;
$databaseUsername = $cUsername;
$databasePassword = $cPassword;
 
$con = mysqli_connect($cHost,$cUsername,$cPassword,$cName);

$userkey = $_POST['userkey'];
$image_name = $_POST['image_name'];
$image = $_POST['image'];

$path = "$cdomain/images/user/$image_name.jpg"; 
$pathphoto = "../images/user/$image_name.jpg";
$sql  = "UPDATE tbl_user SET img_user='$path' WHERE tbl_user.key_user_id='$userkey'";
       
 
    if(mysqli_query($con,$sql)){
        file_put_contents($pathphoto,base64_decode($image));
        echo json_encode(array('response'=>"Successfully"));
    } else {
        echo json_encode(array('response'=>"Failed..."));
    }
    mysqli_close($con); 
?>