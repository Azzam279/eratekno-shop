<?php
echo '<div class="panel-heading">';
echo '<h4><b>';
echo "PROFILE";
echo '</b></h4>';
echo '</div>';
echo '<div class="panel-body">';
include_once("../koneksi.php");
$sql_profile 	= mysqli_query($conn,"SELECT * FROM admin WHERE username = '".$_SESSION['admin']."'");
$profile 		= mysqli_fetch_assoc($sql_profile);
$post 			= $_SERVER['REQUEST_URI'];

if (isset($_POST['edit_nama'])) {
	$sql_nama = mysqli_query($conn,"UPDATE admin SET nama = '".$_POST['nama']."' WHERE nomor = '".$profile['nomor']."'");
	if ($sql_nama === false) {
		echo "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-alert'></span> <b>Nama gagal di-Ubah!</b></div>";
	}else{
		echo "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <b>Nama berhasil di-Ubah!</b></div>";
		?>
		<script>setTimeout('window.location=\'index.php?azm=profile\'',3000);</script>
		<?php
	}
}

if (isset($_POST['edit_pw'])) {
	if ($_POST['pass'] != $_POST['pass2']) {
		echo "<div class='alert alert-warning' role='alert'><span class='glyphicon glyphicon-warning-sign'></span> <b>Ketik ulang password!</b></div>";
	}else{
		$pass = md5("dg43z".md5("af63s".$_POST['pass']."m3ke0")."m9g3d");
		$sql_id = mysqli_query($conn,"UPDATE admin SET password = '$pass' WHERE nomor = '".$profile['nomor']."'");
		if ($sql_id === false) {
			echo "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-alert'></span> <b>Password gagal di-Ubah!</b></div>";
		}else{
			echo "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <b>Password berhasil di-Ubah!</b></div>";
			?>
			<script>setTimeout('window.location=\'index.php?azm=profile\'',3000);</script>
			<?php
		}
	}
}

if (isset($_POST['upload'])) {
	move_uploaded_file($_FILES['img_admin']['tmp_name'], "image/".$_FILES['img_admin']['name']);
	$sql_gb = mysqli_query($conn,"UPDATE admin SET foto_admin = '".$_FILES['img_admin']['name']."' WHERE nomor = '".$profile['nomor']."'");
	if ($sql_gb === false) {
		echo "<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-alert'></span> <b>Gambar gagal di-Upload!</b></div>";
	}else{
		echo "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <b>Gambar sukses di-Upload!</b></div>";
		?>
		<script>setTimeout('window.location=\'index.php?azm=profile\'',3000);</script>
		<?php
	}
}

if ($profile['foto_admin'] == "") {
	$gambar = $host."/admin-azm/image/avatar_2x.png";
}else{
	$gambar = $host."/admin-azm/image/".$profile['foto_admin'];
}
?>
<div class="row">
	<div class="col-md-3">
		<div id="gb-profile">
			<center>
				<img src="<?php echo $gambar ?>" class="img-circle"><br>
				<b><?php echo ucfirst($profile['username']); ?></b><br>
				<button class="btn btn-link btn-sm" id="ganti_foto">Ganti Foto</button><br>
				<form action="" class="form-inline" method="post" id="tampil_ganti_foto" enctype="multipart/form-data">
					<input type="file" name="img_admin" id="input-gb" required><br>
					<button type="submit" name="upload" value="upload" class="btn btn-sm btn-default"><span class='glyphicon glyphicon-upload'></span> Upload</button>
				</form>
			</center>
		</div>
	</div>
	<div class="col-md-8" style="border:solid 1px #E1E1E1;border-radius:5px;">
		<h5><strong>Informasi Admin</strong></h5><hr style="margin:10px;" />
		<p><?php echo $profile['nama']; ?> - <button class="ubah_admin1 btn btn-link">Ubah</button>
			<form action="" method="post" class="form-inline form-azm1">
				<div class="form-group">
					<label class="control-label col-md-3">Nama : </label>
					<div class="col-md-10">
						<input type="text" name="nama" value="<?php echo $profile['nama']; ?>" class="form-control">
						<input type="submit" name="edit_nama" class="btn btn-primary" value="Ubah">
					</div>
				</div>
			</form>
		</p>
		<p><?php echo $profile['password']; ?> - <button class="ubah_admin2 btn btn-link">Ubah</button>
			<form action="" method="post" class="form-inline form-azm2">
				<div class="form-group">
					<label class="control-label col-md-4">Password Baru : </label>
					<div class="col-md-10">
						<input type="password" name="pass" class="form-control" placeholder="Password Baru">
						<input type="password" name="pass2" class="form-control" placeholder="Ketik Ulang Password">
						<input type="submit" name="edit_pw" class="btn btn-primary" value="Ubah">
					</div>
				</div>
			</form>
		</p>
	</div>
</div>
<?php
echo '</div>'; 
?>