<?php
session_start();

include_once("../koneksi.php");

$cek_wishlist = mysqli_query($conn, "SELECT * FROM wishlist WHERE nmr_produk = '".$_POST['wish']."' AND customer = '".$_SESSION['email']."'");
$cek_rows 	  = mysqli_num_rows($cek_wishlist);
$get_wishlist = mysqli_fetch_assoc($cek_wishlist);

if ($cek_rows > 0) {
	mysqli_query($conn, "UPDATE wishlist SET nmr_produk = '".$get_wishlist['nmr_produk']."', tgl_wishlist = '".time()."' WHERE customer = '".$_SESSION['email']."' AND nmr_produk = '".$get_wishlist['nmr_produk']."'");
}else{
	mysqli_query($conn, "INSERT INTO wishlist VALUES(null,'".$_SESSION['email']."','".$_POST['wish']."','".time()."')");
}

?>