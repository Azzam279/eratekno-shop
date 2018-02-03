<?php
include_once("../fungsi/variable.php");
include_once("$doc/koneksi.php");

$sql = mysqli_query($conn, "SELECT * FROM troli WHERE cst_ip = '".$_COOKIE["customer"]."'");
$cek = mysqli_num_rows($sql);
$sql2 = mysqli_query($conn, "SELECT SUM(kuantitas) AS qty FROM troli WHERE cst_ip = '".$_COOKIE["customer"]."'");
$qty = mysqli_fetch_assoc($sql2);

if ($cek==0 || $qty['qty']==0 || $qty['qty']=="" || $_COOKIE['customer']=="") {
	header("location: $host");
}else if (isset($_SESSION['x']) || isset($_SESSION['email'])) {
	header("location: $host/order/");
}else{
	//mengecek troli, jika ada kuantitas yang 0 atau subtotal 0 maka akan di direct ke page troli
	$cek_troli = mysqli_query($conn, "SELECT * FROM troli WHERE cst_ip = '".$_COOKIE["customer"]."'");
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
	<title>Login | EraTekno-Shop</title>
	<?php include_once("../link-css.php"); ?>
	<script src="angular.min.js"></script>
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
			font-family: sans-serif;
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
		breadcrumbs2("Troli","Email ID",$host,"$host/troli/");
		?>
	</div>

	<div class="container">
		<div id='dialog-overlay'></div>

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
					            <button type="button" class="btn btn-primary btn-circle">2</button>
					            <p>Email ID</p>
					        </div>
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-default btn-circle">3</button>
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
					//jika tombol lanjut diklik
					if (isset($_POST['next'])) {
						//jika kolom input kosong maka akan muncul warning
						if (empty($_POST['email'])) {
							echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email harus di isi!</b></div>";
						//jika email tidak valid
						}else if (!filter_var(@$_POST['email'], FILTER_VALIDATE_EMAIL)) {
							echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email tidak valid!</b></div>";
						}else{
							//kondisi dimana control radio "baru" diklik
							if ($_POST['client']=="baru") {
								//mengambil data dari table customer utk mengecek email apakah sdh terdaftar dlm DB atau belum
								$qry_cek  = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '".$_POST['email']."'");
								$cek_mail = mysqli_num_rows($qry_cek); 
								$qry2_cek = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_POST['email']."'");
								$cek_mail2= mysqli_num_rows($qry2_cek);
								//jika kolom nama kosong maka akan tampil warning
								if (empty($_POST['nama'])) {
									echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Nama harus di isi!</b></div>";
								//jika nama bukan huruf/spasi/(.) maka akan menampilkan warning
								}else if (!preg_match("/^[a-zA-Z .]*$/", $_POST['nama'])) {
									echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Nama hanya boleh berupa huruf!</b></div>";
								}else if ($cek_mail > 0 || $cek_mail2 > 0) {
									echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email sudah terdaftar!</b></div>";
								}else{
									//proses memasukkan data customer ke database sbg customer sementara/temporary customer
									$insert = mysqli_query($conn, "INSERT INTO customer_sementara VALUES(null,'".$_POST['nama']."','".$_POST['email']."','','','','','')");
									//jika proses insert data customer gagal
									if ($insert===false) {
										echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Maaf, terjadi error! Silakan coba lagi.</b></div>";
									//jika berhasil
									}else{
										//proses update table troli dimana kolom customer diupdate dengan nilai $_POST[email] dimana cst_ip = $_COOKIE[customer] 
										mysqli_query($conn, "UPDATE troli SET customer = '".$_POST['email']."' WHERE cst_ip = '".$_COOKIE['customer']."'");
										//proses update table total_harga dimana kolom email diupdate dengan nilai $_POST[email] dimana ip = $_COOKIE[customer]
										mysqli_query($conn, "UPDATE total_harga SET email = '".$_POST['email']."' WHERE ip = '".$_COOKIE['customer']."'");
										//membuat session x dengan nilai $_POST[email]
										$_SESSION['x'] = $_POST['email'];
										//pindah halaman ke pengisian alamat
										header("location: $host/order/");
									}
								}
							//kondisi dimana control radio "tetap" diklik
							}else{
								//jika password bukan berupa huruf/angka maka akan tampil warning
								if (!ctype_alnum($_POST['pass'])) {
									echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Password hanya boleh Alfanumerik!</b></div>";
								}else{
									//membuat function anti hacking
									function anti_injection($data){
									  require dirname(__FILE__)."/koneksi.php";
									  $filter = mysqli_real_escape_string($conn,stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
									  return $filter;
									}
									//cek email n password dengan function anti_injection
									$em = anti_injection($_POST['email']);
									$pw = anti_injection($_POST['pass']);

									//meng-enkripsi password ke md5;
									$pass  = md5("r84h".md5("qf4j9".$pw."jqe92")."mk27");
									//mengambil data dari table customer berdasarkan email = $_POST[email]
									$qry   = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_POST['email']."' AND password = '$pass'");
									$get   = mysqli_fetch_assoc($qry);
									$check = mysqli_num_rows($qry);
									//jika email dengan nilai $_POST[email] ketemu maka eksekusi script dibawah ini
									if ($check == 1) {
										//update table troli
										mysqli_query($conn, "UPDATE troli SET customer = '".$_POST['email']."' WHERE cst_ip = '".$_COOKIE["customer"]."'");
										//mengambil data dari table total_harga berdasarkan email
										$cek_ttl = mysqli_query($conn, "SELECT * FROM total_harga WHERE email = '".$_POST['email']."'");
										$get_ttl = mysqli_num_rows($cek_ttl);
										$val_ttl = mysqli_fetch_assoc($cek_ttl);
										//jika email dengan nilai $_POST[email] ada pada table total_harga maka eksekusi script dibawah ini
										if ($get_ttl == 1) {
											//mengambil data dari total_harga berdasarkan ip
											$sql_ip = mysqli_query($conn, "SELECT * FROM total_harga WHERE ip = '".$_COOKIE["customer"]."'");
											$get_ip = mysqli_fetch_assoc($sql_ip);
											//proses menjumlah isi kolom total
											$total  = $get_ip['total'] + $val_ttl['total'];
											//proses update kolom total berdasarkan email
											mysqli_query($conn, "UPDATE total_harga SET total = '$total' WHERE email = '".$_POST['email']."'");
											//proses hapus data dari table total_harga berdasarkan ip
											mysqli_query($conn, "DELETE FROM total_harga WHERE ip = '".$_COOKIE["customer"]."'");
										//jika tidak ada, maka eksekusi script dibawah ini
										}else{
											//proses update table total_harga dimana email = $_POST[email] berdasarkan ip
											mysqli_query($conn, "UPDATE total_harga SET email = '".$_POST['email']."' WHERE ip = '".$_COOKIE["customer"]."'");
										}
										//membuat session
										$_SESSION['nomor'] 			= $get['nmr_customer'];
										$_SESSION['nama'] 		 	= $get['nama'];
										$_SESSION['email'] 			= $get['email'];
										$_SESSION['pass'] 			= $get['password'];
										//pindah halaman ke pengisian alamat
										header("location: $host/order/");
									//jika tidak ketemu, maka eksekusi script dibawah ini
									}else{
										echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Email atau Password Salah!</b></div>";
									} 
								}
							}	
						}
					}
					?>
					<form action="" method="post" class="form-horizontal" style="padding:20px;border:1px solid #D2D2D2;border-radius:10px;" ng-app="login" ng-controller="loginCtrl" name="myForm" novalidate>
						<div class="form-group">
							<label class="control-label col-sm-4">Masukkan Nama Anda : </label>
							<div class="col-sm-5">
								<input type="text" name="nama" class="form-control" ng-disabled="!nm" placeholder="Masukkan Nama" ng-model="nama">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Masukkan Email Anda : </label>
							<div class="col-sm-5">
								<input type="email" name="email" ng-model="email" class="form-control" placeholder="email@mail.com" ng-disabled="!em" required>
								<span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
									<span ng-show="myForm.email.$error.required">Email harus diisi.</span>
									<span ng-show="myForm.email.$error.email">Invalid email address.</span>
								</span>
								<br>
								<input type="radio" name="client" id="a" style="margin-bottom:15px;" value="baru" checked="checked" ng-click="klik('baru')"> <label for="a">Pelanggan Baru</label><br>
								<input type="radio" name="client" id="b" value="tetap" ng-click="klik('tetap')"> <label for="b">Saya Adalah Pelanggan Tetap</label><br><br>
								<input type="password" ng-disabled="!pw" name="pass" class="form-control" placeholder="Masukkan kata sandi" ng-model="pass"><br>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-5">
								<button class="btn btn-default btn-order btn-lg" name="next" value="next" ng-disabled="myForm.email.$dirty && myForm.email.$invalid">LANJUTKAN</button>
							</div>
						</div>
					</form>	 
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
	var app = angular.module('login', []);
	app.controller('loginCtrl', function($scope) {
		$scope.nm = true;
		$scope.pw = false;
		$scope.em = true;

		$scope.klik = function(id) {
			if (id == 'baru') {
				$scope.nm = true;
				$scope.pw = false;
				$scope.pass = '';
			}else{
				$scope.nm = false;
				$scope.pw = true;
				$scope.nama = '';
			}
		}
	});
</script>
</body>
</html>
<?php
}
?>