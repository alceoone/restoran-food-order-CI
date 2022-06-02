<?php
include_once("dbconfig/config.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:login.php'); 
} else { 
   $username = $_SESSION['username']; 
}

    $id = $_GET['id'];
    $UserDetail = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE tbl_user.key_user_id='$id'");
    if ($UserDetail ) {
        $user = mysqli_fetch_array($UserDetail);
        $user_nama = $user['nama'];
        $user_alamat = $user['user_alamat'];
        $user_telepone = $user['telepone'];
        $user_email = $user['email'];
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/assetex/color.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
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
                    <a class="nav-link active bg-oren text-white" href="user.php">
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
            <h5>User</h5>
                <hr style="margin: 0;">
                <div class="card mt-3">
                    <h5 class="card-header">User Detail</h5>
                    <div class="card-body">
                    <table class="mb-3" align="center">
                        <tr><td>Nama</td><td>:</td><td><?php echo $user_nama; ?></td></tr>
                        <tr><td>Telepone</td><td>:</td><td><?php echo $user_telepone; ?></td></tr>
                        <tr><td>Email</td><td>:</td><td><?php echo $user_email; ?></td></tr>
                        <tr><td>Alamat</td><td>:</td><td><?php echo $user_alamat; ?></td></tr>
                    </table>
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
    <script src="bootstrap/js/jquery-3.5.1.js"></script>
    <script src="bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="bootstrap/js/dataTables.bootstrap4.min.js"></script>
   
    </script>
</body>

</html>