<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['telepone']) && isset($_POST['password'])) {
 
    // menerima parameter POST ( telepone dan password )
    $telepone = $_POST['telepone'];
    $password = $_POST['password'];
 
    // get the user by telepone and password
    // get user berdasarkan telepone dan password
    $user = $db->getUserByEmailAndPassword($telepone, $password);
 
    if ($user != false) {
        // user ditemukan
        $response["error"] = FALSE;
        $response["uid"] = $user["key_user_id"];
        $response["user"]["telepone"] = $user["telepone"];
        $response["user"]["nama"] = $user["nama"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["key"] = $user["key_user_id"];
        $response["user"]["alamat"] = $user["user_alamat"];
        $response["user"]["images"] = $user["img_user"];
        echo json_encode($response);
    } else {
        // user tidak ditemukan password/email salah
        $response["error"] = TRUE;
        $response["error_msg"] = "Login gagal. Password/Email salah";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameter (email atau password) ada yang kurang";
    echo json_encode($response);
}
?>