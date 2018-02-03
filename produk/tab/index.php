<?php
include_once("../../fungsi/variable.php");

if (@$_GET['ets'] != "tab") {
	header("location: $host/produk/tab/?ets=tab");
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tab | EraTekno-Shop</title>
	<?php include_once("../../link-css.php"); ?>
</head>
<body>
	<div id="gototop"></div>

	<!-- Loading -->
	<div id="preloader" class="hidden-xs hidden-sm">
		<div id="status"></div>
	</div>
	
	<?php include_once("../../navigasi-fixed.php"); ?>
	<div id="kategory"><button id="btn-kat" class="btn btn-default btn-lg">Kategori Belanja <i class="glyphicon glyphicon-circle-arrow-down"></i></button><div id="slide-kat"><?php include_once("../../kategori.php"); ?></div>
		<?php
		include_once("../../fungsi/fungsi.php");
		breadcrumbs2("Produk","Tab",$host,"$host/produk/");
		?>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">
				<?php
				include_once("konten.php");
				?>
			</div>

			<div class="col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9" id="sidebar">
				<?php 
				include_once("sidebar.php");
				?>
			</div>
		</div>
	</div>

	<?php include_once("../../footer.php"); ?>

<?php include_once("../../link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
</body>
</html>
<?php
}
?>