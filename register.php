<?php include_once("fungsi/variable.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daftar | EraTekno-Shop</title>
	<?php include_once("link-css.php"); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $host."/asset/css/bootstrap-datetimepicker.min.css";?>">
	<style>
		#tgl_lahir > select {
			height: 35px;
			width: 80px;
		}
	</style>
</head>
<body>
	<div id="gototop"></div>

	<?php include_once("navigasi-fixed.php"); ?>
	<div id="kategory"><button id="btn-kat" class="btn btn-default btn-lg">Kategori Belanja <i class="glyphicon glyphicon-circle-arrow-down"></i></button><div id="slide-kat"><?php include_once("kategori.php"); ?></div>
		<?php
		include_once("fungsi/fungsi.php");
		breadcrumbs("Daftar",$host);
		?>
	</div>
	
	<br>
	<div class="container">

		<div class="row">
			<div class="col-md-12 col-sm-12">
			<div class="well well-small" style="background:white;">
				<?php 
				include_once("proses-register.php");
				?>
				<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
					<center>
						<legend><div class="hub">Sign Up</div></legend>
					</center>
					<fieldset>
						<form action="" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Lengkap : </label>
								<div class="col-sm-5">
									<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" maxlength="50" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Email : </label>
								<div class="col-sm-5">
									<input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" maxlength="100" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Password : </label>
								<div class="col-sm-5">
									<input type="password" name="pass" class="form-control" placeholder="Masukkan Password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Ketik Ulang Password : </label>
								<div class="col-sm-5">
									<input type="password" name="pass2" class="form-control" placeholder="Ketik Ulang Password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">Jenis Kelamin : </label>
								<div class="col-sm-5">
									&nbsp;
									<input type="radio" name="jkl" value="Laki-laki"> Laki-laki &nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" name="jkl" value="Perempuan"> Perempuan
								</div>
							</div>
							<div class="form-group">
						        <label for="dtp_input" class="col-sm-4 control-label">Tanggal Lahir : </label>
						        <div class="col-sm-6" id="tgl_lahir">
						        	<select name="tahun" required>
						        		<?php
						        		for ($t=1945;$t<=2015;$t++) {
						        			echo "<option value='$t'>$t</option>";
						        		}
						        		?>
						        	</select>
						        	<select name="bulan" style="width:120px;" required>
						        		<?php
						        		$arr_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
						        		foreach ($arr_bulan as $key_bln => $val_bln) {
						        			$key = $key_bln+1;
						        			echo "<option value='$key'>$val_bln</option>";
						        		}
						        		?>
						        	</select>
						        	<select name="tanggal" required>
						        		<?php
						        		$tgl = 1;
						        		while ($tgl <= 31) {
						        			echo "<option value='$tgl'>$tgl</option>";
						        			$tgl++;
						        		}
						        		?>
						        	</select>
						        </div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"></label>
								<div class="col-sm-offset-2 col-sm-5">
									<button class="btn btn-default" type="submit" name="daftar" value="daftar"><span class="glyphicon glyphicon-registration-mark"></span> Daftar</button>
									<button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove-sign"></span> Batal</button>
								</div>
							</div>
						</form>
					</fieldset>
				</div>
				<div class="clearfix"></div>
			</div>
			</div>
		</div>

	</div>

	<?php include_once("footer.php"); ?>

<?php include_once("link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
</body>
</html>