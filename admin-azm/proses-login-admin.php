<?php
function anti_hacking($data) {
require dirname(__FILE__)."/koneksi.php";
	$filter = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
	return $filter;
}

$host1 = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";

$id 	= anti_hacking($_POST['id']);
$pass 	= anti_hacking(md5("dg43z".md5("af63s".$_POST['pass']."m3ke0")."m9g3d"));

if (!ctype_alnum($id) || !ctype_alnum($pass)) {
	echo "<script>alert('Username & Password hanya boleh berupa Huruf & Angka!')</script>";
	echo "<script>window.location='$host1/admin-azm/login-admin.php'</script>";
}else{
	include_once("../koneksi.php");
	$sql_admin = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$id' AND password = '$pass'");
	$admin     = mysqli_fetch_assoc($sql_admin);
	$cek 	   = mysqli_num_rows($sql_admin);

	if ($cek > 0) {
		session_start();
		$_SESSION['nama']		= $admin['nama'];
		$_SESSION['admin'] 		= $admin['username'];
		$_SESSION['password']	= $admin['password'];

		$sid_lama = session_id();
		session_regenerate_id();
		$sid_baru = session_id();

		mysqli_query($conn,"UPDATE admin SET id_session = '$sid_baru' WHERE username = '$id'");
		header("location: $host1/admin-azm/");
	}else{
		echo "<script>alert('Email atau Password Salah!')</script>";
		echo "<script>window.location='$host1/admin-azm/login-admin.php'</script>";
	}
}
?>