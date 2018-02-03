<?php 
include_once("../fungsi/variable.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Produk | EraTekno-Shop</title>
	<?php include_once("../link-css.php"); ?>
	<style>
		.kolom {
			background: white;
			transition: background .5s linear;
		}
		.kolom:hover {
			-webkit-box-shadow: 0 -1px 12px rgba(0,0,0,0.4);
			-moz-box-shadow: 0 -1px 12px rgba(0,0,0,0.4);
			box-shadow: 0 -1px 12px rgba(0,0,0,0.4);
		}

		.title-produk {
			font-weight: bold;
			font-size: 18px;
			font-family: "Arial Black", Gadget, sans-serif;
			color: #eb4800;
			text-transform: uppercase;
			padding: 0;
			transition: transform .2s ease-in-out, font .2s linear;
			-webkit-transition: -webkit-transform .2s ease-in-out, font .2s linear;
		}
		.kolom:hover .title-produk {
			transform: rotate(7deg);
			text-shadow: 2px 2px 4px #000000;
			font-size: 22px;
		}
		.title-produk > strong {color: black;}
		
		.brand-list > .col-sm-2 {
			padding-right: 10px;
			padding-left: 8px;
			margin-left: 11px;
			width: 170px;
		}

		.img-effect {
			padding-left: 0px;
			transition: padding .2s linear;
			-webkit-transition: padding .2s linear;
		}
		.kolom:hover .img-effect {
			padding-left: 23px;
		}
	</style>
</head>
<body>
	<div id="gototop"></div>

	<!-- Loading -->
	<div id="preloader" class="hidden-xs hidden-sm">
		<div id="status"></div>
	</div>
	
	<?php include_once("../navigasi-fixed.php"); ?>
	<div id="kategory"><button id="btn-kat" class="btn btn-default btn-lg">Kategori Belanja <i class="glyphicon glyphicon-circle-arrow-down"></i></button><div id="slide-kat"><?php include_once("../kategori.php"); ?></div>
		<?php
		include_once("../fungsi/fungsi.php");
		breadcrumbs("Produk",$host);
		?>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="well well-small" style="background:white;">
					<table class="table table-hover" border="0">
						<tr>
							<td width="100%" class="kolom"><a href="<?php echo "$host/produk/pc/?ets=pc";?>" target="_blank">
								<table width="100%">
									<tr>
										<td width="500" class="img-effect">
											<img src="<?php echo "$host/image/komputer.png";?>" alt="komputer" class="img-responsive">
										</td>
										<td class="title-produk"><strong>Produk</strong> Komputer</td>
									</tr>
								</table>
							</a></td>
						</tr>
						<tr>
							<td width="100%" class="kolom"><a href="<?php echo "$host/produk/laptop/?ets=laptop";?>" target="_blank">
								<table width="100%">
									<tr>
										<td width="500" class="img-effect">
											<img src="<?php echo "$host/image/laptop.png";?>" alt="laptop" class="img-responsive">
										</td>
										<td class="title-produk"><strong>Produk</strong> Laptop</td>
									</tr>
								</table>
							</a></td>
						</tr>
						<tr>
							<td width="100%" class="kolom"><a href="<?php echo "$host/produk/smartphone/?ets=smartphone";?>" target="_blank">
								<table width="100%">
									<tr>
										<td width="500" class="img-effect">
											<img src="<?php echo "$host/image/smartphone.png";?>" alt="smartphone" class="img-responsive">
										</td>
										<td class="title-produk"><strong>Produk</strong> Smartphone</td>
									</tr>
								</table>
							</a></td>
						</tr>
						<tr>
							<td width="100%" class="kolom"><a href="<?php echo "$host/produk/tab/?ets=tab";?>" target="_blank">
								<table width="100%">
									<tr>
										<td width="500" class="img-effect">
											<img src="<?php echo "$host/image/tab.jpg";?>" alt="tab" class="img-responsive">
										</td>
										<td class="title-produk"><strong>Produk</strong> Tab</td>
									</tr>
								</table>
							</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<?php include_once("$doc/brand-produk.php"); ?>
			</div>
		</div>

	</div>

	<?php include_once("../footer.php"); ?>

<?php include_once("../link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
</body>
</html>