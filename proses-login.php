<?php
function anti_injection($data){
require dirname(__FILE__)."/koneksi.php";
  $filter = mysqli_real_escape_string($conn,stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$host1 = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";

$email = anti_injection($_POST['email']);
$pass  = anti_injection(md5("r84h".md5("qf4j9".$_POST['pass']."jqe92")."mk27"));

if (isset($_POST['login'])) {
	if (isset($email) && isset($pass)) {
		if (!ctype_alnum($pass)) {
			echo "<script>alert('Password hanya boleh menggunakan Huruf & Angka!')</script>";
			echo "<script>window.location='$host1'</script>";
		}else{
			//include_once("koneksi.php");
			require dirname(__FILE__)."/koneksi.php";
			$query_cek = mysqli_query($conn,"SELECT * FROM customer WHERE email = '$email' AND aktif = '1'");
			$cek_aktif = mysqli_num_rows($query_cek);

			if ($cek_aktif == 0) {
				header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/?warning=aktivasi");
			}else{
				$query_login = mysqli_query($conn,"SELECT * FROM customer WHERE email = '$email' AND password = '$pass' AND aktif = '1'");
				$login = mysqli_fetch_array($query_login);
				$cek = mysqli_num_rows($query_login);

				if ($cek > 0) {
					session_start();
					$_SESSION['nomor'] 			= $login['nmr_customer'];
					$_SESSION['nama'] 		 	= $login['nama'];
					$_SESSION['email'] 			= $login['email'];
					$_SESSION['pass'] 			= $login['password'];
					echo "<script>window.location='$host1'</script>";
					//header("location: $host1");
				}else{
					header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop/?wrong=salah");
				}
			}
		}
	}
}else{
	header("location: http://$_SERVER[HTTP_HOST]/Eratekno-Shop");
}
?>