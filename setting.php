<?php
include_once("dbconfig/config.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:login.php'); 
} else { 
   $username = $_SESSION['username']; 
}

    $resultSetting = mysqli_query($mysqli, "SELECT * FROM tbl_setting");
    if ($resultSetting) {
        $user = mysqli_fetch_array($resultSetting);
        $nama_toko = $user['nama_toko'];
        $alamat_toko = $user['alamat_toko'];
        $contact_toko = $user['contact_toko'];
        $email_toko = $user['email_toko'];
        $web_toko = $user['web_toko'];
        $jarak_cod = $user['jarak_cod'];
        $lat_map = $user['lat_map'];
        $long_map = $user['long_map'];
    }

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/assetex/color.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">
    <title>Facefood - Dashboard</title>
</head>
<body>
    <header class="mb-3">
    <nav class="navbar navbar-dark bg-oren">
            <h3 class="text-white ml-3">App Restoran</h3>
            <a href="logout.php"><button class="btn btn-danger my-2 my-sm-0" data-toggle="tooltip" data-placement="bottom"
                title="Anda yakin untuk Keluar?">Log Out</button></a>
        </nav>
    </header>
    <div class="row no-gutters">
        <div class="col-md-2 bg-dark text-white" style="min-height: 100vh;">
            <nav class="navbar navbar-dark">
                <table align="center">
                    <tr>
                        <td>
                            <h2>Facefood</h2>
                        </td>
                    </tr>
                </table>
            </nav>
            <ul class="nav flex-column ">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">
                        <i class="fas fa-tachometer-alt ml-3 mr-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="category.php">
                        <i class="fas fa-utensils ml-3 mr-2"></i>Menu Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="menu.php">
                        <i class="fas fa-utensils ml-3 mr-2"></i>Menu List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-shopping-cart ml-3 mr-2"></i>Order List
                    </a>
                </li>
                <div class="collapse" id="navbarToggleExternalContent">
                <li class="nav-item">
                    <a class="nav-link text-white" href="order.php">
                       - <i class="fas fa-clipboard-list ml-3 mr-2"></i>Pending
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="orderan_kirim.php">
                        - <i class="fas fa-tasks ml-3 mr-2"></i>Kirim Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="orderan_sukses.php">
                       - <i class="fas fa-check-circle ml-3 mr-2"></i>Sukses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="orderan_history.php">
                       - <i class="fas fa-history ml-3 mr-2"></i>History
                    </a>
                </li>
                </div>
                <li class="nav-item">
                    <a class="nav-link text-white" href="user.php">
                        <i class="fas fa-users ml-3 mr-2"></i>User List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active bg-oren text-white" href="setting.php">
                        <i class="fas fa-cog ml-3 mr-2"></i>Setting
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 pr-3 pt-3 pl-3">
            <h5>Setting</h2>
                <hr style="margin: 0;">
            <div class="card mt-5">
            <form class="mt-3 mb-3 ml-3 mr-3" method="post" enctype="multipart/form-data" action="edit/e_respone_setting.php">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" value="<?php echo $nama_toko; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Toko</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamattoko" value="<?php echo $alamat_toko; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Contact</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="contacttoko" value="<?php echo $contact_toko; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="emailtoko" value="<?php echo $email_toko; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Website</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="webtoko" value="<?php echo $web_toko; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Maps Latitude</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="latmap" value="<?php echo $lat_map; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Maps Longitude</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="longmap" value="<?php echo $long_map; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jarak Antar (COD)</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="jarakcod" value="<?php echo $jarak_cod; ?>">
                    </div>
                </div>
                <button type="submit" value="Submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>
    </div>
    <footer class="pt-3 pb-3 mt-3 bg-dark text-white">
        <table align="center">
            <tr>
                <td>&copy; 2020 | Develope by Fajar Kurniawan | KP STMIK Sinar Nusantara</td>
            </tr>
        </table>
    </footer>
    <script src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/assetex/ex.js"></script>
</body>

</html>