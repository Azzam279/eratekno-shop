<?php
include_once("../fungsi/variable.php");
include_once("../koneksi.php");

if (isset($_SESSION['email'])) {
	$mail = @$_SESSION['email'];
	//mengambil data customer berdasarkan session email
	$sql_alamat = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$mail'");
	$cek_alamat = mysqli_fetch_array($sql_alamat);
}else{
	$mail = @$_SESSION['x'];
	//mengambil data customer_sementara berdasarkan session email
	$sql_alamat = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '$mail'");
	$cek_alamat = mysqli_fetch_array($sql_alamat);
}

//menghitung total kuantitas pada tabel troli
$sql_cek = mysqli_query($conn, "SELECT SUM(kuantitas) AS jml FROM troli WHERE customer = '$mail'");
$cek 	 = mysqli_fetch_array($sql_cek);

//jika session email tidak ada ATAU jumlah kuantitas pada tabel troli kosong maka direct ke homepage
if (empty($mail) || $cek['jml']==0) {
	echo "<script>window.location = '$host';</script>";
	
//jika alamat atau provinsi atau kota atau kecamatan atau no hp kosong maka lakukan peng-inputan data alamat customer
}else if (empty($cek_alamat['alamat']) || empty($cek_alamat['provinsi']) || empty($cek_alamat['kota']) || empty($cek_alamat['kecamatan']) || empty($cek_alamat['no_handphone'])) {
	//mmebuat cookie
	if (isset($_SESSION['email'])) {
		setcookie($_SESSION['nomor'],$_SESSION['email'],time()+(86400*7),"/");
	}else{
		setcookie("customer",$_COOKIE['bantuan'],time()+(86400*7),"/");
	}

	//mengecek troli, jika ada kuantitas yang 0 atau subtotal 0 maka akan di direct ke page troli
	$cek_troli = mysqli_query($conn, "SELECT * FROM troli WHERE customer = '$mail'");
	while ($get_troli = mysqli_fetch_array($cek_troli)) {
		if ($get_troli['kuantitas'] == 0 || $get_troli['subtotal'] == 0) {
			header("location: $host/troli/");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order | EraTekno-Shop</title>
	<?php include_once("../link-css.php"); ?>
	<style>
		#detil_order {
			border-left:solid 4px orange;
			background:#F4F4F4;
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			-webkit-box-sizing:border-box;
		}

		#second_table {
			font-size: 13px;
			color: #878787;
			width: 100%;
			overflow-y: scroll;
		}
		#second_table a {
			color: #007FFF;
		}
		#second_table a:hover {
			color: #FFAA2A;
		}

		.btn-order {
			background: #eb4800;
			border: solid 1px #eb4800;
			color: white;
			border-radius: 5px;
			font-family: fantasy;
		}
		.btn-order:hover {
			background-image: #999;
			border: solid 1px #eb4800;
			color: #eb4800;
			border-radius: 5px;
			-webkit-transition: all 0.2s linear;
		    -moz-transition: all 0.2s linear;
		    -o-transition: all 0.2s linear;
		    -ms-transition: all 0.2s linear;
		    transition: all 0.2s linear;
		}

.stepwizard-step p {
    margin-top: 10px;    
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;     
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
    
}

.stepwizard-step {    
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
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
		breadcrumbs3("Troli","Email ID","PENGISIAN ALAMAT",$host,"$host/troli/","$host/order/checkout.php");
		?>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="well well-small" style="background:white;padding:7px;">
					<div class="stepwizard">
					    <div class="stepwizard-row">
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-default btn-circle">1</button>
					            <p>Cart</p>
					        </div>
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-default btn-circle">2</button>
					            <p>Email ID</p>
					        </div>
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-primary btn-circle">3</button>
					            <p>Shipping</p>
					        </div>
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-default btn-circle">4</button>
					            <p>Payment</p>
					        </div> 
					    </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<div class="well well-small" style="background:white;padding:7px;">
				<?php 
				include_once("alamat-pengiriman.php");
				?>
				</div>
			</div>

			<div class="col-md-4 col-sm-4">
				<div class="well well-small" style="background:white;padding:5px;width:100%;">
				<?php
				include_once("detil-order.php");
				?>
				</div>
			</div>
		</div>

	</div>

	<?php include_once("../footer.php"); ?>

<?php include_once("../link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
<script>
var host = "<?php echo $host; ?>";

//seleksi kota
function city(city){
    $.ajax({
        url      : host+'/order/fungsi-alamat.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'kota='+city,
        success  : function(jawaban){
            $('#kota').html(jawaban);
        },
    });
    $("#del_kota").remove();
    $("#del_kecamatan").remove();
    $("#kota").html("Loading...");
    $("#kecamatan").html("Loading...");
}
//seleksi kecamatan
function kecam(kcm){
    $.ajax({
        url      : host+'/order/fungsi-alamat.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'kecam='+kcm,
        success  : function(jawaban){
            $('#kecamatan').html(jawaban);
        },
    });
    $("#del_kecamatan").remove();
    $("#kecamatan").html("Loading...");
}

</script>
</body>
</html>
<?php
//jika alamat cutomer sudah lengkap maka arahkan ke proses pembayaran
}else{
	echo "<script>window.location = '$host/order/pembayaran/'</script>";
}
?>