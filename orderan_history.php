<?php
include_once("dbconfig/config.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:login.php'); 
} else { 
   $username = $_SESSION['username']; 
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
                    <a class="nav-link bg-oren text-white" href="orderan_history.php">
                       - <i class="fas fa-history ml-3 mr-2"></i>History
                    </a>
                </li>
                
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
            <h5>Orderan</h5>
                <hr style="margin: 0;">
                <div class="card mt-3">
                    <h5 class="card-header">Orderan User</h5>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Pesanan</th>
                                    <th>Nama User</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $result = mysqli_query($mysqli, "SELECT tbl_user.nama, tbl_orderan_user.key_user_id, tbl_orderan_user.status_order FROM tbl_orderan_user INNER JOIN tbl_user ON tbl_orderan_user.key_user_id = tbl_user.key_user_id WHERE tbl_orderan_user.status_order='Sukses' GROUP BY tbl_orderan_user.key_user_id HAVING count(*) > 0");
                            while($order_data = mysqli_fetch_array($result)) {         
                            
                            ?>
                                <tr>
                                    <td><?php echo $order_data['key_user_id']; ?></td>
                                    <td><?php echo $order_data['nama']; ?></td>
                                    <td>San Francisco</td>
                                    <td align="center">
                                        <a href="" class="btn btn-danger"><?php echo $order_data['status_order']; ?></a>
                                    </td>
                                    <td align="center">
                                        <a href="orderan/detail_orderan_history.php?id=<?php echo $order_data['key_user_id']; ?>&status=Sukses" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id Pesanan</th>
                                    <th>Nama User</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </tfoot>
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
    <script>
      $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
</body>

</html>