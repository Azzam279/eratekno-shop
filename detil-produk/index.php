<?php
include_once("../fungsi/variable.php");

if (empty($_GET['k']) || empty($_GET['b']) || empty($_GET['p'])) {
	header("location: ../404.php");
}else{
	include_once("../koneksi.php");
	$sql_see = mysqli_query($conn,"SELECT*FROM produk WHERE nomor = '".$_GET['p']."'");
	$get_see = mysqli_fetch_assoc($sql_see);
	$dilihat = $get_see['dilihat'] + 1;
	mysqli_query($conn,"UPDATE produk SET dilihat = '$dilihat' WHERE nomor = '".$_GET['p']."'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detil Produk | EraTekno-Shop</title>
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
		breadcrumbs("Detil-Produk",$host);
		?>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-9 col-sm-9">
				<?php
				include_once("detil_produk.php");
				include_once("deskripsi-info-produk.php");
				include_once("produk-terkait.php");
				?>
			</div>

			<div class="col-md-3 col-sm-3">
				<?php
				include_once("sidebar.php");
				?>
			</div>
		</div>

	</div>

	<?php include_once("../footer.php"); ?>

<?php include_once("../link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
<script>
	// JavaScript Document
	$(document).ready(function() {
		// get current rating
		var get = "<?php echo $_GET['p'];?>";
		getRating(get);
		// get rating function
		function getRating(val){
			$.ajax({
				type: "GET",
				url: "update-star.php",
				data: "do=getrate&nmr="+val,
				cache: false,
				async: false,
				success: function(result) {
					// apply star rating to element
					$("#current-rating").css({ width: "" + result + "%" });
				},
				error: function(result) {
					alert("some error occured, please try again later");
				}
			});
		}
		
		// link handler
		$('#ratelinks li a').click(function(){
			$.ajax({
				type: "GET",
				url: "update-star.php",
				data: "rating="+$(this).text()+"&do=rate",
				cache: false,
				async: false,
				success: function(result) {
					// remove #ratelinks element to prevent another rate
					$("#ratelinks").remove();
					// get rating after click
					getRating();
				},
				error: function(result) {
					alert("some error occured, please try again later");
				}
			});
			
		});
	});

	function add_wishlist(isi) {
		$.ajax({
			url 		: "add-wishlist-ajax.php",
			type 		: "POST",
			datatype	: "html",
			data 		: "wishl="+isi,
			success		: function(hasil){
				$("#wishlist").html(hasil);
			}
		});
	}
</script>
</body>
</html>
<?php
}
?>