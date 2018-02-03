<?php
session_start();

if (!preg_match("/^[a-zA-Z .]*$/", $_POST['nama'])) {
	echo "<script>alert('Nama harus berupa Alfabet/Huruf!');</script>";
	echo "<script>window.location='/order/pembayaran/';</script>";
}else if (!preg_match("/^[\w .]*$/", $_POST['alamat'])) {
	echo "<script>alert('Alamat harus berupa Huruf/Angka!');</script>";
	echo "<script>window.location='/order/pembayaran/';</script>";
}else if (strlen($_POST['no_hp']) > 13) {
	echo "<script>alert('No Handphone maksimal 13 digit angka!');</script>";
	echo "<script>window.location='/order/pembayaran/';</script>";
}else if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['provinsi']) || empty($_POST['no_hp']) || @$_POST['kecamatan'] == 0) {
	echo "<script>alert('Semua kolom input harus di-isi!');</script>";
	echo "<script>window.location='/order/pembayaran/';</script>";
}else{
	include_once("../../koneksi.php");
	if (isset($_SESSION['email'])) {
		$sql_update = mysqli_query($conn, "UPDATE customer SET nama = '".trim($_POST['nama'])."', alamat = '".trim($_POST['alamat'])."', provinsi = '".$_POST['provinsi']."', kota = '".$_POST['kota']."', kecamatan = '".$_POST['kecamatan']."', no_handphone = '".$_POST['no_hp']."' WHERE email = '".$_SESSION['email']."'");
		if ($sql_update === false) {
			die("Perintah SQL salah: ".mysqli_error($sql_update));
		}else{
			echo "<script>window.location='/order/pembayaran/';</script>";
		}	
	}else{
		$sql_update = mysqli_query($conn, "UPDATE customer_sementara SET nama = '".trim($_POST['nama'])."', alamat = '".trim($_POST['alamat'])."', provinsi = '".$_POST['provinsi']."', kota = '".$_POST['kota']."', kecamatan = '".$_POST['kecamatan']."', no_handphone = '".$_POST['no_hp']."' WHERE email = '".$_SESSION['x']."'");
		if ($sql_update === false) {
			die("Perintah SQL salah: ".mysqli_error($sql_update));
		}else{
			echo "<script>window.location='/order/pembayaran/';</script>";
		}
	}
}
?>