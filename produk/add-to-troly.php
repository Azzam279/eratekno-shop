<?php
session_start();
ob_start();
include_once("../koneksi.php");
include_once("../fungsi/fungsi.php");
//jika ada sesi email maka aktifkan cookie
if (isset($_SESSION['email'])) {
	setcookie($_SESSION['nomor'],$_SESSION['email'],time()+(86400*7),"/");
	$customer   = "customer = '".$_POST['isi2']."'";
	$pelanggan  = $_POST['isi2'];
	$pelanggan2 = "0";
	$email 		= "email = '".$_POST['isi2']."'";
//jika tidak ada, maka eksekusi script dibawah ini
}else if (isset($_SESSION['x'])) {
	$customer   = "customer = '".$_POST['isi2']."'";
	$pelanggan  = $_POST['isi2'];
	$pelanggan2 = $_POST['isi5'];
	$email 		= "email = '".$_POST['isi2']."'";
}else{
	//jika cookie bantuan ada maka setcookie customer dgn nilai cookie bantuan
	if (isset($_COOKIE['bantuan'])) {
		setcookie("customer",$_COOKIE['bantuan'],time()+(86400*7),"/");
	//jika tidak ada, maka buat 2 cookie dibawah ini
	}else{
		setcookie("customer",$_SESSION['ip'],time()+(86400*7),"/");
		setcookie("bantuan",$_SESSION['ip'],time()+(86400*365),"/");
	}
	$customer   = "cst_ip = '".$_POST['isi5']."'";
	$pelanggan  = "0";
	$pelanggan2 = $_POST['isi5'];
	$email 		= "ip = '".$_POST['isi5']."'";
}

$sql_cek_k = mysqli_query($conn,"SELECT * FROM troli WHERE nmr_produk = '".$_POST['isi1']."' AND $customer");
$isi_k = mysqli_fetch_array($sql_cek_k);
$cek_k = mysqli_num_rows($sql_cek_k);
$time = time()+(86400*7);

//jika nomor produk yang sama ada di table troli maka lakukan update data
if ($cek_k > 0) {
	$qty = $isi_k['kuantitas'] + 1;
	//jika kuantitas melebihi stok
	if ($qty > $_POST['isi4']) {
		$subtotal = $_POST['isi3'] * $isi_k['kuantitas'];
		$sql_add = mysqli_query($conn,"UPDATE troli SET kuantitas = '".$isi_k['kuantitas']."', subtotal = '$subtotal', tgl = '$time' WHERE nmr_produk = '".$_POST['isi1']."' AND $customer ");
	//jika tidak
	}else{
		$subtotal = $_POST['isi3'] * $qty;
		$sql_add = mysqli_query($conn,"UPDATE troli SET kuantitas = '$qty', subtotal = '$subtotal', tgl = '$time' WHERE nmr_produk = '".$_POST['isi1']."' AND $customer ");
	}
//jika nomor produk tidak sama maka lakukan insert data baru
}else{
	$sql_add = mysqli_query($conn,"INSERT INTO troli VALUES(null,'".$_POST['isi1']."','$pelanggan','$pelanggan2','1','".$_POST['isi3']."','$time')");
}

//mendapatkan jumlah subtotal berdasarkan email customer
$sql_subtotal = mysqli_query($conn,"SELECT SUM(subtotal) AS sub FROM troli WHERE $customer");
$get_subtotal = mysqli_fetch_array($sql_subtotal);

//menyeleksi table total_harga berdasarkan email customer
$sql_total = mysqli_query($conn,"SELECT * FROM total_harga WHERE $email");
//mendapatkan record email customer yang bersangkutan
$cek_total = mysqli_num_rows($sql_total);

//jika email customer yg bersangkutan ditemukan maka lakukan update data
if ($cek_total > 0) {
	//meng-update total
	$total = mysqli_query($conn,"UPDATE total_harga SET total = '".$get_subtotal['sub']."', tgl = '$time' WHERE $email");

//jika tidak ketemu maka lakukan insert data baru
}else{
	//insert data baru
	$total = mysqli_query($conn,"INSERT INTO total_harga VALUES(null,'$pelanggan','$pelanggan2','".$get_subtotal['sub']."','$time')");
}

//jika terjadi error
if ($sql_add === false && $total === false) {
	echo "<script>alert('Maaf, terjadi kesalahan!')</script>";
	exit();
}
?>