<?php
echo '<div class="panel-heading">';
echo '<h4><b>';
echo "Tambah Admin Baru";
echo '</b></h4>';
echo '</div>';
echo '<div class="panel-body">';

include_once("../koneksi.php");

if (isset($_POST['daftar'])) {
	if ($_POST['pass'] != $_POST['pass2']) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Ketik ulang password!</b></div>";
	}else if (!preg_match("/^[a-zA-Z .]*$/",$_POST['nama'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Nama harus berupa Alfabet/Huruf!</b></div>";
	}else if(!ctype_alnum($_POST['id'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Username hanya boleh berupa Huruf & Angka!</b></div>";
	}else if(!ctype_alnum($_POST['pass'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Password hanya boleh berupa Huruf & Angka!</b></div>";
	}else if(!preg_match("/^[a-zA-Z ]*$/",$_POST['jawaban'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Jawaban Hint harus berupa Alfabet/Huruf!</b></div>";
	}else if($_POST['captcha'] != $_POST['captcha2']) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Captcha Salah!</b></div>";
	}else{
		$sql_cek = mysqli_query($conn,"SELECT*FROM admin WHERE username = '".$_POST['id']."'");
		$cek = mysqli_fetch_array($sql_cek);
		if ($cek['username'] == $_POST['id']) {
			echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Username sudah terdaftar!</b></div>";
		}else{
			//enkripsi password ke md5
			$pass = md5("dg43z".md5("af63s".$_POST['pass']."m3ke0")."m9g3d");
			//query tambah data ke tabel admin
			$sql_daftar = mysqli_query($conn,"INSERT INTO admin VALUES(
				null,
				'".$_POST['nama']."',
				'".$_POST['id']."',
				'$pass',
				'".$_POST['hint']."',
				'".$_POST['jawaban']."',
				'0')");
			//pengecekan
			if ($sql_daftar === false) {
				die('Perintah SQL Salah: ' . mysqli_error($sql_daftar));//jika error
			}else{
				echo "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> <b>Daftar Sukses!</b></div>";//jika berhasil
			}
		}
	}
}

include_once("../fungsi/captcha.php");
?>

	<div class="row">
		<div class="col-md-7 col-md-offset-2">
			<legend><center><h4><strong>Form Tambah Admin</strong></h4></center></legend>
			<fieldset>
				<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>" method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-4">Nama : </label>
						<div class="col-md-6">
							<input type="text" name="nama" class="form-control" maxlength="50" autofocus required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Username : </label>
						<div class="col-md-6">
							<input type="text" name="id" class="form-control" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Password : </label>
						<div class="col-md-6">
							<input type="password" name="pass" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Ketik Ulang Password : </label>
						<div class="col-md-6">
							<input type="password" name="pass2" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Hint : </label>
						<div class="col-md-6">
							<select name="hint" class="form-control" required>
								<option value="Siapa nama ibu Anda?">Siapa nama ibu Anda?</option>
								<option value="Siapa nama ayah Anda?">Siapa nama ayah Anda?</option>
								<option value="Apa binatang peliharaan Anda?">Apa binatang peliharaan Anda?</option>
								<option value="Apa makanan favorit Anda?">Apa makanan favorit Anda?</option>
								<option value="Dimana kota Anda lahir?">Dimana kota Anda lahir?</option>
								<option value="Apa hobby Anda?">Apa hobby Anda?</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-5">
							<input type="text" name="jawaban" class="form-control" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-4">
							<div id="captcha"><?php echo $acak ?></div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3 col-md-offset-4">
							<input type="text" name="captcha" class="form-control" placeholder="Captcha?" style="width:90px;" required>
							<input type="hidden" name="captcha2" value="<?php echo $hasil1 ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-5">
							<button type="submit" name="daftar" value="daftar" class="btn btn-success"><span class="glyphicon glyphicon-registration-mark"></span> Register</button>
							<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
						</div>
					</div>
				</form>
			</fieldset>
		</div>
	</div>

<?php
echo '</div>'; 
?>