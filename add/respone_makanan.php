<?php
include_once("../dbconfig/config.php");
    
$nama_makanan = $_POST['namamakanan'];
$id_category = $_POST['idcategory'];
$detail_makanan = $_POST['detailmakanan'];
$harga_makanan = $_POST['hargamakanan'];
$nama_file = $_FILES['gambarmakanan']['name'];
$ukuran_file = $_FILES['gambarmakanan']['size'];
$tipe_file = $_FILES['gambarmakanan']['type'];
$tmp_file = $_FILES['gambarmakanan']['tmp_name'];
$url_images = "images/".$nama_file;

$path = "../images/".$nama_file;

if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 

	if($ukuran_file <= 1000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		// Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		// Proses upload
		if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
			// Jika gambar berhasil diupload, Lakukan :	
			// Proses simpan ke Database
			$query = "INSERT INTO tbl_menu_list(id_categori,nama_menu,detail_menu,harga,gambar_menu) VALUES('".$id_category."','".$nama_makanan."','".$detail_makanan."','".$harga_makanan."','".$url_dashboard.$url_images."')";
			$sql = mysqli_query($mysqli, $query); // Eksekusi/ Jalankan query dari variabel $query
			
			if($sql){ // Cek jika proses simpan ke database sukses atau tidak
				// Jika Sukses, Lakukan :
				header("location: ../menu.php"); // Redirectke halaman index.php
			}else{
				// Jika Gagal, Lakukan :
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
				echo "<br><a href='form.php'>Kembali Ke Form</a>";
			}
		}else{
			// Jika gambar gagal diupload, Lakukan :
			echo "Maaf, Gambar gagal untuk diupload.";
			echo "<br><a href='form.php'>Kembali Ke Form</a>";
		}
	}else{
		// Jika ukuran file lebih dari 1MB, lakukan :
		echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
		echo "<br><a href='form.php'>Kembali Ke Form</a>";
	}
}else{
	// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
	echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
	echo "<br><a href='form.php'>Kembali Ke Form</a>";
}

?>
   