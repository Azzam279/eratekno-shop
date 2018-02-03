<?php 
include_once("fungsi/variable.php");
if (isset($_GET['home'])) {
	header("location: $host");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EraTekno-Shop</title>
	<?php include_once("link-css.php"); ?>
	<style>
/*
--------------------------
Standar tampilan
--------------------------
*/

.note {
  position:relative;
  width:100%;
  height: 160px;
  color:white;
  background:#97C02F;
  overflow:hidden;
}

.note:hover:before {
  content:"";
  position:absolute;
  top:0;
  right:0;
  border-width:0 16px 16px 0;
  border-style:solid;
  border-color:white white #658E15 #658E15;
  background-color:#658E15;
  -webkit-box-shadow:0 1px 1px rgba(0,0,0,.3),-1px 1px 1px rgba(0,0,0,.2);
  -moz-box-shadow:0 1px 1px rgba(0,0,0,.3),-1px 1px 1px rgba(0,0,0,.2);
  box-shadow:0 1px 1px rgba(0,0,0,.3),-1px 1px 1px rgba(0,0,0,.2);
  display:block;
  width:0; /* Firefox 3.0 damage limitation */
}

/*
--------------------------
Opsi untuk memberikan efek rounded corner
dengan menambahkan kelas "rounded"
--------------------------
*/

.note.rounded {
  -webkit-border-radius:5px 0 5px 5px;
  -moz-border-radius:5px 0 5px 5px;
  border-radius:5px 0 5px 5px;
}

.note.rounded:before {
  border-width:8px;
  border-color:white white transparent transparent;
  -webkit-border-radius:0 0 0 5px;
  -moz-border-radius:0 0 0 5px;
  border-radius:0 0 0 5px;
}

.iklan-banner {
    width:100%;
    height: 160px;
	display: block;
	box-shadow: 0 0 1px transparent;
	position: relative;
	overflow: hidden;
}
.iklan-banner:hover:before {
	display: block;
	position: absolute;
	content: "";
	width: 0;
	top: 0;
	right: 0;
  border-width:0 16px 16px 0;
  border-style:solid;
  border-color:white white #f8f8f8 #f8f8f8;
	background: #f8f8f8;
	background: linear-gradient(225deg, #fff 45%, #bbb 50%, #ccc 50%, white 70%);
	box-shadow: -1px 1px 1px rgba(0,0,0,.4);
	-webkit-transition-duration: .3s;
	transition-duration: .3s;
	-webkit-transition-property: border-width;
	transition-property: border-width;
}

.brand-list > .col-sm-2 {
	padding-right: 10px;
	padding-left: 8px;
	margin-left: 11px;
	width: 170px;
}
	</style>
</head>
<body>
	<div id="gototop"></div>

	<!-- Loading -->
	<div id="preloader" class="hidden-xs hidden-sm">
		<div id="status"></div>
	</div>

	<?php include_once("navigasi-fixed.php"); ?>

	<br>
	<div class="container">
		<?php
		if (isset($_GET['ak']) && isset($_GET['kd'])) {
			include_once("koneksi.php");
			$sql_aktif = mysqli_query($conn,"SELECT * FROM customer WHERE nmr_customer = '".$_GET['ak']."' AND kode = '".$_GET['kd']."'");
			$gek_aktif = mysqli_fetch_array($sql_aktif);
			$cek_aktif = mysqli_num_rows($sql_aktif);
			if ($cek_aktif == 1) {
				mysqli_query($conn, "UPDATE customer SET aktif = '1' WHERE nmr_customer = '".$_GET['ak']."' AND kode = '".$_GET['kd']."' AND email = '".$gek_aktif['email']."'");
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="well" style="background:white;margin-bottom:55px;">
					<h3>Aktivasi Email Berhasil! Sekarang Anda dapat berbelanja di Erakteno-Shop.16mb.com</h3>
				</div>
			</div>
		</div>
		<?php
			}else{
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="well" style="background:white;margin-bottom:55px;">
					<h3>Aktivasi Email Gagal!</h3>
				</div>
			</div>
		</div>
		<?php
			}

		}else if (@$_GET['no']=="rekening") {
			include_once("detil-info-rekening.php");
		}else{	
		?>
		<div class="row">
			<div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3 hidden-xs">
				<?php
				include_once("slider.php");
				?>
			</div>
			<div class="col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9" id="sidebar">
				<?php 
				include_once("kategori-home.php");
				?>
				
				<div class="well well-small">
				<center>
				<a href="<?php echo "$host/?no=rekening";?>">
					<img src="image/paypal.jpg" class="img-responsive" alt="payment method paypal">
					<img src="image/daftar_bank3.png" alt="daftar-bank" class="img-responsive">
				</a>
				</center>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<?php
				include_once("new-products.php");
				include_once("popular-products.php");
				include_once("best-selling-products.php");
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<?php include_once("brand-produk.php"); ?>
			</div>
		</div>
		<?php
		}
		?>
		
	</div>

	<?php include_once("footer.php"); ?>

<?php include_once("link-js.php"); ?>
</body>
</html>