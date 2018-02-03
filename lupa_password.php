<?php include_once("fungsi/variable.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lupa Password | EraTekno Shop</title>
	<?php include_once("link-css.php"); ?>
</head>
<body>
	
	<?php include_once("navigasi-fixed.php"); ?>

	<div class="container">
		<div id="gototop"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<br><br><div class="well well-small" style="background:white;margin:0 auto;width:70%">
				<center><legend><div class="hub">Lupa Password</div></legend></center>
				<fieldset>
				<?php
				if (isset($_GET['pw']) || @$_GET['pw']=="false") {
					echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Password hanya boleh berupa Huruf & Angka!</b></div>";
					?>
					<script>setTimeout('window.location=\'lupa_password.php\'',2500);</script>
					<?php
				}else if (isset($_GET['pass']) || @$_GET['pass']=="false") {
					echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Password tidak sama! Ketik Ulang Password.</b></div>";
					?>
					<script>setTimeout('window.location=\'lupa_password.php\'',2500);</script>
					<?php
				}else if (isset($_GET['error']) || @$_GET['error']=="false") {
					echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email tidak terdaftar didalam database Kami!</b></div>";
					?>
					<script>setTimeout('window.location=\'lupa_password.php\'',2500);</script>
					<?php
				}else if (isset($_GET['sukses']) || @$_GET['sukses']=="true") {
					echo "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> <b>Password berhasil di Ubah.</b></div>";
					?>
					<script>setTimeout('window.location=\'lupa_password.php\'',4000);</script>
					<?php
				}
				?>
					<form action="proses-lupa-pass.php" method="post" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Email : </label>
							<div class="col-sm-6">
								<input type="email" name="email" class="form-control" placeholder="Masukkan Email" autofocus required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Password Baru : </label>
							<div class="col-sm-6">
								<input type="password" name="pass" class="form-control" placeholder="Masukkan Password Baru" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Ketik Ulang Password : </label>
							<div class="col-sm-6">
								<input type="password" name="pass2" class="form-control" placeholder="Ketik Ulang Password" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-5">
								<button class="btn btn-default" type="submit" name="ok" value="ok">Reset Password</button>
								<button class="btn btn-danger" type="reset">Batal</button>
							</div>
						</div>
					</form>
				</fieldset>
				</div>
			</div>
		</div>

	</div>

	<?php include_once("footer.php"); ?>

<?php include_once("link-js.php"); ?>
</body>
</html>