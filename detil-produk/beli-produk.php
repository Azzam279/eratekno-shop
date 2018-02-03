<?php
session_start();

include_once("../koneksi.php");
$subtotal = $_POST['jml_barang'] * $_POST['sub_total'];
mysqli_query($conn,"UPDATE troli SET kuantitas = '".$_POST['jml_barang']."', subtotal = '$subtotal', tgl = '".time()."' WHERE nmr_produk = '".$_POST['no_produk']."' AND customer = '".$_SESSION['email']."'");

$host = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";
$sql_beli = mysqli_query($conn,"SELECT*FROM customer WHERE email = '".$_SESSION['email']."'");
$beli = mysqli_fetch_assoc($sql_beli);
if ($beli['alamat']=="" || $beli['provinsi']=="" || $beli['kota']=="" || $beli['kecamatan']=="" || $beli['no_handphone']=="") {
	header("location: $host/order/");
}else{
	header("location: $host/order/pembayaran/");
}
?>