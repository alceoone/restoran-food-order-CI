<?php
include_once("../dbconfig/config.php");
session_start();
if(!isset($_SESSION['username'])) {
   header('location:../login.php'); 
} else { 
   $username = $_SESSION['username']; 
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
                    <a class="nav-link active bg-oren text-white" href="../menu.php">
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
                    <a class="nav-link text-white" href="../orderan_sukses.php">
                       - <i class="fas fa-check-circle ml-3 mr-2"></i>Sukses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../orderan_history.php">
                       - <i class="fas fa-history ml-3 mr-2"></i>History
                    </a>
                </li>
                </div>
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
            <h5>Tambah Menu Makanan</h2>
                <hr style="margin: 0;">
                <form class="mt-3 mr-5 ml-5" method="post" enctype="multipart/form-data" action="e_respone_makanan.php">
                    <?php 
                    
                       include_once("../dbconfig/config.php");
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $update = true;
                            $resultMenuEdit = mysqli_query($mysqli, "SELECT tbl_menu_list.id_menu, tbl_menu_list.id_categori, tbl_menu_list.nama_menu, tbl_categori_list.nama_categori, tbl_menu_list.detail_menu, tbl_menu_list.harga, tbl_menu_list.gambar_menu FROM tbl_menu_list LEFT JOIN tbl_categori_list ON tbl_menu_list.id_categori = tbl_categori_list.id_categori WHERE tbl_menu_list.id_menu = $id");

                            if ($resultMenuEdit ) {
                                $n = mysqli_fetch_array($resultMenuEdit);
                                $nama_menu = $n['nama_menu'];
                                $nama_categori = $n['nama_categori'];
                                $detail_menu = $n['detail_menu'];
                                $harga = $n['harga'];
                                $gambar_menu = $n['gambar_menu'];
                            }
                        }
                    ?>
                  <div class="form-group">
                        <label>Nama Makanan</label>
                        <input type="text" value="<?php echo $id; ?>" name="idmakanan" class="form-control" placeholder="Nama Makanan" required>
                    </div>
                  
                  <div class="form-group">
                        <label>Nama Makanan</label>
                        <input type="text" value="<?php echo $nama_menu; ?>" name="namamakanan" class="form-control" placeholder="Nama Makanan" required>
                    </div>
                    <div class="form-group">
                        <label>Category Makanan</label>
                        <select class="custom-select" name="idcategory">
                        <option value="<?php echo $id_categori; ?>"><?php echo $nama_categori; ?></option>
                        <?php
                            $resultCategory = mysqli_query($mysqli, "SELECT * FROM tbl_categori_list");
                            while($user_data = mysqli_fetch_array($resultCategory)) {         
                        ?>
                            <option value="<?php echo $user_data['id_categori']; ?>"><?php echo $user_data['nama_categori']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Detail Makanan</label>
                        <input class="form-control" value="<?php echo $detail_menu; ?>" name="detailmakanan" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Makanan</label>
                        <input type="number" value="<?php echo $harga; ?>" name="hargamakanan" class="form-control" placeholder="Harga Makanan" required>
                    </div>
                    <div class="form-group">
                    <label>Gambar Makanan</label><p>
                    <img src="<?php echo $gambar_menu; ?>"  height="200" width="350">
                     </div>
                     <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                </form>
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
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/assetex/ex.js"></script>
</body>

</html>