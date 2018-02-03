<?php
include_once("fungsi/variable.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contact | EraTekno-Shop</title>
	<?php include_once("link-css.php"); ?>
</head>
<body>
	<div id="gototop"></div>
	
	<?php include_once("navigasi-fixed.php"); ?>
	<div id="kategory"><button id="btn-kat" class="btn btn-default btn-lg">Kategori Belanja <i class="glyphicon glyphicon-circle-arrow-down"></i></button><div id="slide-kat"><?php include_once("kategori.php"); ?></div>
		<?php
		include_once("fungsi/fungsi.php");
		breadcrumbs("Contact",$host);
		?>
	</div>

	<br>
	<div class="container">

		<div class="row">
			<div class="well well-small" style="background:white;">
			<center><legend><div class="hub">Hubungi kami</div></legend></center><br>
			<div class="col-md-5 col-sm-5">
				<div class="judul-info">Informasi Tambahan</div>
				<p><b>Phone:</b> (0896) 9859 4961</p>
				<p><b>Email:</b> azzam@eratekno-shop.16mb.com</p>
			</div>

			<div class="col-md-7 col-sm-7 pull-right">
			<?php
			include_once("proses-contact.php");
			?>
				<form action="" method="post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-sm-3">Nama : </label>
						<div class="col-sm-5">
							<input type="text" name="nama" class="form-control" maxlength="50" placeholder="Masukkan Nama Anda" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Email : </label>
						<div class="col-sm-5">
							<input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" maxlength="100" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Subjek : </label>
						<div class="col-sm-5">
							<input type="text" name="subjek" class="form-control" maxlength="50" placeholder="Masukkan Subjek" onkeypress="return isNumberKeyHuruf(event)">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Pesan : </label>
						<div class="col-sm-6">
							<textarea name="pesan" class="form-control" rows="8" maxlength="1000" placeholder="Masukkan Pesan" required></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<button type="submit" name="kirim" value="kirim" class="btn btn-default"><span class="glyphicon glyphicon-send"></span> Kirim</button>
							<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Batal</button>
						</div>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
		</div>
	</div>

	<?php include_once("footer.php"); ?>

<?php include_once("link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
</body>
</html>