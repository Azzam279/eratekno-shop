<?php
session_start();

if (isset($_SESSION['email'])) {
	$sesi 	  = $_SESSION['email'];
	$sesi2 	  = "0";
	$email	  = "email = '".$_SESSION['email']."'";
	$customer = "customer = '".$_SESSION['email']."'";
}else if (isset($_SESSION['x'])) {
	$sesi 	  = $_SESSION['x'];
	$sesi2 	  = $_COOKIE['bantuan'];
	$email	  = "email = '".$_SESSION['x']."'";
	$customer = "customer = '".$_SESSION['x']."'";
}else{
	$sesi 	  = "0";
	$sesi2 	  = $_COOKIE['bantuan'];
	$email 	  = "ip = '".$_COOKIE['bantuan']."'";
	$customer = "cst_ip = '".$_COOKIE['bantuan']."'";
}

include_once("../koneksi.php");
$time = time()+(86400*7);
$subtotal = $_POST['kuantitas'] * $_POST['subtotal'];
mysqli_query($conn,"UPDATE troli SET kuantitas = '".$_POST['kuantitas']."', subtotal = '$subtotal', tgl = '$time' WHERE nmr_produk = '".$_POST['nmr_product']."' AND $customer");

$sql_subtotal = mysqli_query($conn, "SELECT SUM(subtotal) AS sub FROM troli WHERE $customer");
$get_subtotal = mysqli_fetch_assoc($sql_subtotal);
$sql_total = mysqli_query($conn, "SELECT * FROM total_harga WHERE $email");
$cek_total = mysqli_num_rows($sql_total);
if ($cek_total > 0) {
	mysqli_query($conn, "UPDATE total_harga SET total = '".$get_subtotal['sub']."', tgl = '$time' WHERE $email");
}else{
	mysqli_query($conn, "INSERT INTO total_harga VALUES(null,'$sesi','$sesi2','".$get_subtotal['sub']."','$time')");
}

$host = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";
if (isset($_COOKIE['bantuan'])) {
	header("location: $host/order/checkout.php");
}else{
	$sql_beli = mysqli_query($conn,"SELECT*FROM customer WHERE email = '".$_SESSION['email']."'");
	$beli = mysqli_fetch_assoc($sql_beli);
	if ($beli['alamat']=="" || $beli['provinsi']=="" || $beli['kota']=="" || $beli['kecamatan']=="" || $beli['no_handphone']=="") {
		header("location: $host/order/");
	}else{
		header("location: $host/order/pembayaran/");
	}
}
?>