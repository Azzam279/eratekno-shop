<?php
include_once("koneksi.php");
if (isset($_POST['kirim'])) {
	if (!preg_match("/^[a-zA-Z .]*$/", $_POST['nama'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Nama harus berupa Alfabet/Huruf!</b>!</div>";
	}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email tidak valid!</b></div>";
	}else if(!preg_match("/^[a-zA-Z .]*$/", $_POST['subjek'])){
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Subjek harus berupa Alfabet/Huruf!</b></div>";
	}else{
		$sql = mysqli_query($conn,"INSERT INTO kontak VALUES(
			null,
			'".$_POST['nama']."',
			'".$_POST['email']."',
			'".$_POST['subjek']."',
			'".$_POST['pesan']."',
			'".time()."')");
		if ($sql !== false) {
			echo "<div class='alert alert-success'><b>Pesan Terkirim!</b></div>";
			?>
			<script>setTimeout('window.location = \'contact.php\'',2500);</script>
			<?php
		}else{
			echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Maaf tejadi kesalahan! Silakan coba lagi..</b></div>";
		}
	}
}
?>