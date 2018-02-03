<?php
if (isset($_POST['ok'])) {
	if (isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass2'])){
		include_once("koneksi.php");
		$sql = mysqli_query($conn, "SELECT*FROM customer WHERE email = '".$_POST['email']."'");
		$cek = mysqli_num_rows($sql);
		if ($cek == 1) {
			if (!ctype_alnum($_POST['pass'])) {
				header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/lupa_password.php?pw=false");
			}else if ($_POST['pass'] != $_POST['pass2']) {
				header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/lupa_password.php?pass=false");
			}else{
				$password = md5("r84h".md5("qf4j9".$_POST['pass']."jqe92")."mk27");
				$sql_update = mysqli_query($conn, "UPDATE customer SET password = '$password' WHERE email = '".$_POST['email']."'");
				if ($sql_update === false) {
					echo "<script>alert('Terjadi error! silakan coba lagi.');</script>";
				}else{
					header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/lupa_password.php?sukses=true");
				}
			}
		}else{
			header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/lupa_password.php?error=false");
		}
	}
}else{
	header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/lupa_password.php");
}
?>