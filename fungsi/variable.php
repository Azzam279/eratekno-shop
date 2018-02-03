<?php
session_start();
ob_start();
$host = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";
$doc  = $_SERVER['DOCUMENT_ROOT']."/Eratekno-Shop";
$request_uri = $_SERVER['REQUEST_URI'];
$php_self = $_SERVER['PHP_SELF'];
$qry_string = $_SERVER['QUERY_STRING'];

if (isset($_SESSION['email'])) {
	$sesi_email = $_SESSION['email'];
	$sesi_ip 	= "0";
	$del_ip 	= isset($_COOKIE['bantuan']) ? $_COOKIE['bantuan'] : @$_SESSION['ip'];
	//jika ada cookie customer maka hapus cookie tersebut
	if (isset($_COOKIE['customer'])) {setcookie("customer",$del_ip,time()-(86400*7),"/");}
	//jika ada session ip maka hapus session ip
	if (isset($_SESSION['ip'])) {unset($_SESSION['ip']);}
	//jika ada session x maka hapus session x
	if (isset($_SESSION['x'])) {unset($_SESSION['x']);}
	//jika ada cookie bantuan maka hapus cookie bantuan
	if (isset($_COOKIE['bantuan'])) {setcookie("bantuan",$_COOKIE['bantuan'],time()-(86400*365),"/");}
}else if (isset($_SESSION['x'])) {
	$sesi_email = $_SESSION['x'];
	$sesi_ip 	= $_COOKIE['bantuan'];
}else{
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; 
	$sesi_email = "0";
	$sesi_ip 	= isset($_COOKIE['bantuan']) ? $_COOKIE['bantuan'] : $_SESSION['ip'];
}

//mengHapus record pd total_harga yang memiliki atribut total kosong
include_once("$doc/koneksi.php");
$totalHarga = mysqli_query($conn, "SELECT*FROM total_harga WHERE total = ''");
while ($getTotalHarga = mysqli_fetch_array($totalHarga)) {
	if ($getTotalHarga['total'] == "") {
		mysqli_query($conn, "DELETE FROM total_harga WHERE total = ''");
	}
}
?>