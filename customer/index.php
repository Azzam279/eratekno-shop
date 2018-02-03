<?php 
include_once("../fungsi/variable.php");

if (empty($_SESSION['email']) && empty($_SESSION['pass'])) {
	header("location: $host");
}else{
include_once("$doc/koneksi.php");
include_once("$doc/fungsi/fungsi_harga.php");
$sql_alamat = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
$get_alamat = mysqli_fetch_array($sql_alamat);
$sql_provinsi = mysqli_query($conn, "SELECT * FROM master_provinsi WHERE provinsi_id = '".$get_alamat['provinsi']."'");
$get_provinsi = mysqli_fetch_array($sql_provinsi);
$sql_kota     = mysqli_query($conn, "SELECT * FROM master_kokab WHERE kota_id = '".$get_alamat['kota']."'");
$get_kota	  = mysqli_fetch_array($sql_kota);
$sql_kecam 	  = mysqli_query($conn, "SELECT * FROM master_kecam WHERE kecam_id = '".$get_alamat['kecamatan']."'");
$get_kecam	  = mysqli_fetch_array($sql_kecam);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EraTekno-Shop</title>
	<?php include_once("../link-css.php"); ?>
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
		breadcrumbs("Customer",$host);
		?>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-3 col-sm-3" style="padding:0px;">		
				<?php include_once("sidebar.php") ?>
			</div>

			<div class="col-md-9 col-sm-9">
				<div class="row">
					<div class="col-md-12">
						<div style="padding:10px;background:white;">
						<?php
						if (@$_GET['cst'] == "info-akun") {
							include_once("info-akun.php");
						}else if (@$_GET['cst'] == "pesanan-saya") {
							include_once("pesanan-saya.php");
						}else if (@$_GET['cst'] == "wishlist-saya") {
							include_once("wishlist-saya.php");
						}else if (@$_GET['cst'] == "info-alamat") {
							include_once("info-alamat.php");
						}else if (empty($_GET['cst'])) {
							include_once("panel-akun.php");
						}else{
							echo "<script>window.location = '$host/404.php';</script>";
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once("../footer.php"); ?>

<?php include_once("../link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
<script>
	var host = "<?php echo $host; ?>";
	function pilihKota(c,s) {
		$.ajax({
			url: host+'/customer/select-alamat-ajax.php',
			type: 'POST',
			datatype: 'php',
			data: 'pick_city='+c+'&sesi='+s,
			success: function(hasil){
				$('#city').html(hasil);
			},
		});
		$("#ko").remove();
		$("#kec").remove();
		$("#city").html("Loading...");
		$("#kcmt").html("Loading...");
	}

	function pilihKecamatan(k,s) {
		$.ajax({
			url: host+'/customer/select-alamat-ajax.php',
			type: 'POST',
			datatype: 'php',
			data: 'pick_kcm='+k+'&sesi2='+s,
			success: function(hasil){
				$('#kcmt').html(hasil);
			},
		});
		$("#kec").remove();
		$("#hpus_kec").remove();
		$("#kcmt").html("Loading...");
	}

	function paging_cst1(page) {
		window.location = page;
	}
	function paging_cst2(page2) {
		window.location = page2;
	}
</script>
</body>
</html>

<?php
}
?>