<?php
include_once("../dbconfig/config.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:../login.php'); 
} else { 
   $username = $_SESSION['username']; 
}
    $id = $_GET['id'];
    $status = $_GET['status'];
    $resultOrderanPrice = mysqli_query($mysqli, "SELECT SUM(price), alamat_antar, address_antar FROM tbl_orderan_user WHERE (tbl_orderan_user.status_order='$status' AND key_user_id='$id')");
    $resultUserDetail = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE tbl_user.key_user_id='$id'");
    if ($resultOrderanPrice ) {
        $n = mysqli_fetch_array($resultOrderanPrice);
        $sum_price = $n['SUM(price)'];
        $alamat_antar = $n['alamat_antar'];
        $address_antar = $n['address_antar'];
        
    }
    if ($resultUserDetail ) {
        $user = mysqli_fetch_array($resultUserDetail);
        $user_nama = $user['nama'];
        $user_alamat = $user['user_alamat'];
        $user_telepone = $user['telepone'];
    }
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/assetex/color.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome/css/all.min.css">
    <title>Facefood - Dashboard</title>
</head>

<body>
    <header class="mb-3">
        <nav class="navbar navbar-dark bg-oren">
                <h3 class="text-white ml-3">App Restoran</h3>
                <a href="../logout.php"><button class="btn btn-danger my-2 my-sm-0" data-toggle="tooltip" data-placement="bottom"
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
                    <a class="nav-link text-white" href="../index.php">
                        <i class="fas fa-tachometer-alt ml-3 mr-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../category.php">
                        <i class="fas fa-utensils ml-3 mr-2"></i>Menu Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../menu.php">
                        <i class="fas fa-utensils ml-3 mr-2"></i>Menu List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-shopping-cart ml-3 mr-2"></i>Order List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../order.php">
                       - <i class="fas fa-clipboard-list ml-3 mr-2"></i>Pending
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../orderan_kirim.php">
                        - <i class="fas fa-tasks ml-3 mr-2"></i>Kirim Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-oren text-white" href="../orderan_sukses.php">
                       - <i class="fas fa-check-circle ml-3 mr-2"></i>Sukses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../orderan_history.php">
                       - <i class="fas fa-history ml-3 mr-2"></i>History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../user.php">
                        <i class="fas fa-users ml-3 mr-2"></i>User List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../setting.php">
                        <i class="fas fa-cog ml-3 mr-2"></i>Setting
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 pr-3 pt-3 pl-3">
            <h5>Orderan Detail</h2>
                <hr style="margin: 0;">
                <div class="card mt-3 pt-2 pb-2 pl-2 pr-2">
                <table class="mb-3">
                    <tr><td>Nama</td><td>:</td><td><?php echo $user_nama; ?></td></tr>
                    <tr><td>Alamat</td><td>:</td><td><?php echo $user_alamat; ?></td></tr>
                    <tr><td>Alamat Kirim</td><td>:</td><td><a href="https://maps.google.com/?q=<?php echo $alamat_antar; ?>" target="_blank">Lokasi Kirim</a></td></tr>
                    <tr><td></td><td></td><td><?php echo $address_antar; ?></td></tr>
                    <tr><td>Telepone</td><td>:</td><td><?php echo $user_telepone; ?></td></tr>
               </table>
                <table class="table table-bordered" align="center">
                    <thead align="center">
                        <tr>
                            <th>Nama Makanan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                    <?php 
                        $result = mysqli_query($mysqli, "SELECT tbl_menu_list.nama_menu, tbl_orderan_user.jumlah, tbl_orderan_user.price FROM tbl_orderan_user INNER JOIN tbl_menu_list ON tbl_menu_list.id_menu = tbl_orderan_user.id_menu WHERE (tbl_orderan_user.status_order='$status' AND key_user_id='$id')");
                        while($orderan_detail = mysqli_fetch_array($result)) {         
                            
                    ?>    
                    <tr>
                        <td><?php echo $orderan_detail['nama_menu']; ?></td>
                        <td><?php echo $orderan_detail['jumlah']; ?></td>
                        <td><?php echo $orderan_detail['price']; ?></td>
                    </tr>       
                    <?php }?>
                    <tr>
                        <td></td>
                        <td>Jumlah Bayar</td>
                        <td><?php echo $sum_price; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Status</td>
                        <td><button href="" 
                        onclick="document.getElementById('modal-wrapper').style.display='block'"
                        class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                            title="Konfirmasi">Orderan Telah Terkirim</button></td>
                    </tr>              
                    </tbody>
                </table>
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
    <div id="modal-wrapper" class="modal">
        <form class="modal-content animate" action="respone_sukses.php?id=<?php echo $id ?>&status=<?php echo $status ?>" method="post">
                <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
                <h5 align="center" class="mt-3">Konfirmasi Pesanan</h5>
            <div class="container">
                1. Apa Pesanan Sudah di Terima Pembeli?<p></p>
                2. Pesanan Akan di Pindah Ke History Pesanan<p></p>
                <button class="btn btn-primary text-white mt-2">Pesanan Telah Di Terima Pembeli</button>
             </div>
        </form>
    </div>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/assetex/ex.js"></script>
    <script>
  
        var modal = document.getElementById('modal-wrapper');
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>