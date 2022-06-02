<?php
include_once("dbconfig/config.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:login.php'); 
} else { 
   $username = $_SESSION['username']; 
}
$resultCategory = mysqli_query($mysqli, "SELECT COUNT(*) FROM tbl_categori_list");
$resultMenu = mysqli_query($mysqli, "SELECT COUNT(*) FROM tbl_menu_list");
$resultOrderan = mysqli_query($mysqli, "SELECT COUNT(*) FROM tbl_categori_list");
$resultUser = mysqli_query($mysqli, "SELECT COUNT(*) FROM tbl_user");
$countCategory = mysqli_fetch_array($resultCategory);         
$countMenu = mysqli_fetch_array($resultMenu);         
$countOrderan = mysqli_fetch_array($resultOrderan);         
$countUser = mysqli_fetch_array($resultUser);         
                            
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
                    <a class="nav-link active bg-oren text-white" href="index.php">
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
                    <a class="nav-link text-white" href="setting.php">
                        <i class="fas fa-cog ml-3 mr-2"></i>Setting
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 pr-3 pt-3 pl-3">
            <h5>Dashboard</h2>
                <hr style="margin: 0;">
                <div class="row mt-3">
                    <div class="card bg-oren text-white ml-3" style="width: 21rem;">
                        <a href="category.php" class="text-white">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-utensils mr-2"></i>
                                </div>
                                <h5 class="card-title">Category</h5>
                                <div class="display-4"><?php echo $countCategory['COUNT(*)']; ?></div>
                                Lihat Semua Category
                            </div>
                        </a>
                    </div>
                    <div class="card bg-success text-white ml-3" style="width: 21rem;">
                        <a href="menu.php" class="text-white">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-utensils mr-2"></i>
                                </div>
                                <h5 class="card-title">Menu</h5>
                                <div class="display-4"><?php echo $countMenu['COUNT(*)']; ?></div>
                                Lihat Semua Menu
                            </div>
                        </a>
                    </div>
                    <div class="card bg-danger text-white ml-3" style="width: 21rem;">
                        <a href="order.php" class="text-white">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h5 class="card-title">Orderan</h5>
                                <div class="display-4"><?php echo $countOrderan['COUNT(*)']; ?></div>
                                Lihat Semua Orderan
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="card bg-info text-white ml-3 mt-3" style="width: 21rem;">
                        <a href="user.php" class="text-white">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="card-title">User</h5>
                                <div class="display-4"><?php echo $countUser['COUNT(*)']; ?></div>
                                Lihat Semua User
                            </div>
                        </a>
                    </div>
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