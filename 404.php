<?php include_once("fungsi/variable.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 | EraTekno-Shop</title>
	<?php include_once("link-css.php"); ?>
</head>
<body>
	<div id="gototop"></div>
	
	<?php include_once("navigasi-fixed.php"); ?>
	<div id="kategory"><button id="btn-kat" class="btn btn-default btn-lg">Kategori Belanja <i class="glyphicon glyphicon-circle-arrow-down"></i></button><div id="slide-kat"><?php include_once("kategori.php"); ?></div>
		<?php
		include_once("fungsi/fungsi.php");
		breadcrumbs("404 Not Found",$host);
		?>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12" style="height:500px;">
				<center>
					<div style="margin-top:150px;">
					<storng>
						<h1>404 Halaman Tidak Ditemukan!</h1>
						<p>Halaman yang Anda cari tidak ada atau terjadi error!</p>
						<a href="<?php echo "http://".$_SERVER['HTTP_HOST']; ?>" class="btn btn-danger btn-lg">Kembali ke Halaman Awal</a>
					</storng>
					</div>
				</center>
			</div>
		</div>
	</div>

	<?php include_once("footer.php"); ?>

<?php include_once("link-js.php"); ?>
</body>
</html>