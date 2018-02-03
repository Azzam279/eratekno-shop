<?php
session_start();

if (@$_POST['pass'] != $_POST['pass2']) {
	echo "<script>alert('Ketik Ulang Password!'); window.location = '/customer/'</script>";
}else if(!ctype_alnum(@$_POST['pass'])) {
	echo "<script>alert('Password hanya boleh berupa Huruf & Angka!'); window.location = '/customer/'</script>";
}else if(empty($_POST['pass']) || empty($_POST['pass2'])) {
	echo "<script>alert('Semua kolom input harus diisi!'); window.location = '/customer/'</script>";
}else{
	include_once("../koneksi.php");
	$pass = md5("r84h".md5("qf4j9".@$_POST['pass']."jqe92")."mk27");
	$update_pw = mysqli_query($conn, "UPDATE customer SET password = '$pass' WHERE email = '".$_SESSION['email']."'");
	if ($update_pw === false) {
		echo "<script>alert('Maaf, terjadi error!'); window.location = '/customer/'</script>";
	}else{
		echo "<script>alert('Password berhasil di Ubah!'); window.location = '/customer/'</script>";
	}
}
?>