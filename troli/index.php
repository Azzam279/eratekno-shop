<?php 
include_once("../fungsi/variable.php");
include_once("$doc/koneksi.php");

if (isset($_SESSION['email'])) {
	$cus 	   = "customer = '".@$_SESSION['email']."'";
	$cek_troly = mysqli_query($conn, "SELECT * FROM troli WHERE $cus");
	$cek_rows  = mysqli_num_rows($cek_troly);
	$sesi 	   = $_SESSION['email'];
}else if (isset($_COOKIE["bantuan"])) {
	//jika cookie customer kosong/habis maka data di troli dan total_harga akan dihapus berdasarkan ip dari customer tersebut
	if (empty($_COOKIE["customer"])) {
		mysqli_query($conn, "DELETE FROM troli WHERE cst_ip = '".$_COOKIE["bantuan"]."'");
		mysqli_query($conn, "DELETE FROM total_harga WHERE ip = '".$_COOKIE["bantuan"]."'");
		echo "<script>window.location = '$host';</script>";
	}
	$cus 	   = "cst_ip = '".$_COOKIE["customer"]."'";
	$cek_troly = mysqli_query($conn, "SELECT * FROM troli WHERE $cus");
	$cek_rows  = mysqli_num_rows($cek_troly);
	$sesi 	   = $_COOKIE["customer"];
}else{
	$cek_rows  = 0;
	$sesi 	   = "";
}

if (empty($sesi) || $cek_rows==0) {
	echo "<script>window.location = '$host/?home=refresh';</script>";
}else{
	//jika cookie nomor kosong/habis maka akan menghapus data di troli & total_harga berdasarkan session email customer
	if (isset($_SESSION['email'])) {
		if (empty($_COOKIE[$_SESSION['nomor']])) {
			mysqli_query($conn, "DELETE FROM troli WHERE customer = '".$_SESSION['email']."'");
			mysqli_query($conn, "DELETE FROM total_harga WHERE email = '".$_SESSION['email']."'");
			echo "<script>window.location = '$host';</script>";
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Troli | EraTekno-Shop</title>
	<?php include_once("../link-css.php"); ?>
	<style>
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
		breadcrumbs("Keranjang",$host);
		?>
	</div>

	<div class="container">
			<div id='dialog-overlay'></div>

		<?php
		include_once("../koneksi.php");
		//jika ada GET hapus maka akan melakukan hapus item berdasarkan nomor produk/item tersebut
		if (isset($_GET['hapus'])) {
			mysqli_query($conn,"DELETE FROM troli WHERE nmr_troli = '".$_GET['hapus']."'");
			echo "<script>window.location = '$host/troli/?ref=refresh';</script>";
		}

		//jika ada GET ref maka akan dilakukan refresh halaman
		if (@$_GET['ref']=="refresh") {
			echo "<script>window.location = '$host/troli/';</script>";
		}

		if (isset($_SESSION['email'])) {
			$customer = "customer = '".$_SESSION['email']."'";
		}else{
			$customer = "cst_ip = '".$_COOKIE["customer"]."'";
		}
		$sql_troli = mysqli_query($conn,"SELECT * FROM troli WHERE $customer");
		$isi_troli = mysqli_num_rows($sql_troli);

		//mengecek produk yang stoknya kosong, jika kosong maka akan dihapus produk tersebut dari troli
		if (@$_GET['cek']=="produk") {
			$sql_cek = mysqli_query($conn, "SELECT * FROM troli WHERE $customer AND kuantitas = 0 AND subtotal = 0");
			while ($get_cek = mysqli_fetch_array($sql_cek)) {
				mysqli_query($conn, "DELETE FROM troli WHERE nmr_troli = '".$get_cek['nmr_troli']."'");
			}
			if (isset($_SESSION['email'])) {
				header("location: $host/order/");
			}else{
				header("location: $host/order/checkout.php");
			}
		}

		if (isset($_SESSION['email'])) {
			$email = "email = '".$_SESSION['email']."'";
		}else{
			$email = "ip = '".$_COOKIE["customer"]."'";
		}
		$sql_total   = mysqli_query($conn,"SELECT total FROM total_harga WHERE $email");
		$total_harga = mysqli_fetch_array($sql_total);

		//mengambil data dari table troli dan table produk untuk mengecek apakah stok < kuantitas atau stok == 0
		$sql_checks = mysqli_query($conn,"SELECT troli.*,produk.* FROM produk INNER JOIN troli ON troli.nmr_produk=produk.nomor AND $customer ORDER BY troli.tgl DESC");
		while ($check_produk = mysqli_fetch_array($sql_checks)) {
			if ($check_produk['stok']==0) {
				mysqli_query($conn, "UPDATE troli SET kuantitas = 0, subtotal = 0 WHERE $customer AND nmr_troli = '".$check_produk['nmr_troli']."'");
			}else if ($check_produk['stok'] < $check_produk['kuantitas']) {
				$jml  = $check_produk['stok'];
				$subs = $check_produk['stok'] * $check_produk['harga_diskon'];
				mysqli_query($conn, "UPDATE troli SET kuantitas = '$jml', subtotal = '$subs' WHERE $customer AND nmr_troli = '".$check_produk['nmr_troli']."'");
			}
		}

		//mengambil data dari table troli dan table produk
		$sql_produk = mysqli_query($conn,"SELECT troli.*,produk.* FROM produk INNER JOIN troli ON troli.nmr_produk=produk.nomor AND $customer ORDER BY troli.tgl DESC");
?>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="well well-small" style="background:white;padding:7px;">
					<div class="stepwizard">
					    <div class="stepwizard-row">
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-primary btn-circle">1</button>
					            <p>Cart</p>
					        </div>
					        <div class="stepwizard-step">
					            <button type="button" class="btn btn-default btn-circle">2</button>
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
			<div class="col-md-12 col-sm-12">
				<div class="well well-small" style="background:white;padding:8px;">
					<div><span class="hub"><font color="orange">Keranjang</font> Belanja</span><span class="pull-right" style="font-size:22px;color:#A5A5A5;"><?php echo $isi_troli;?> Item di Keranjang</span></div><hr/>
					<div class="table-responsive">
					<table class="table table-bordered table-condensed table-hover">
						<thead>
							<tr>
								<th>Produk</th>
								<th>Nama Produk</th>
								<th>Ketersediaan</th>
								<th>Harga</th>
								<th>Kuantitas</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						while ($produk = mysqli_fetch_assoc($sql_produk)) {

							//jika ada stok maka fa-check-squeare, jika tidak ada maka fa-times-circle-o
							if ($produk['stok'] > 0) {
								$stok = '<i class="fa fa-check-square fa-3x" style="color:green;"></i>';
							}else{
								$stok = '<i class="fa fa-times-circle-o fa-3x" style="color:red;"></i>';
							}

							$cek_stok = mysqli_query($conn,"SELECT stok FROM produk WHERE nomor = '".$produk['nmr_produk']."'");
							$check 	  = mysqli_fetch_array($cek_stok);

							//jika stok kosong maka tampilkan harga Rp 0, jika tidak maka tampilkan harga sesuai harga produk
							if ($check['stok'] == 0) {
								$harga     = "Rp 0";
								$sub_harga = "Rp 0";
							}else{
								$harga 	   = "Rp ".number_format($produk['harga_diskon'],0,",",".");
								$sub_harga = "Rp ".number_format($produk['subtotal'],0,",",".");
							}

							//memecah gambar produk
							$cut_img = explode(",",$produk['gambar_produk']);

							//update kuantitas produk di troli
							if (isset($_POST['update'.$produk['nomor']])) {
								$subtotal = $_POST['qty'] * $produk['harga_diskon'];
								$update = mysqli_query($conn, "UPDATE troli SET kuantitas = '".$_POST['qty']."', subtotal = '$subtotal', tgl = '".time()."' WHERE nmr_produk = '".$_POST['nmr']."' AND $customer");
								if ($update === false) {
									echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Maaf tejadi kesalahan! Silakan coba lagi..</b></div>";
								}else{
									echo "<div class='alert alert-success'><span class='glyphicon glyphicon-ok'></span> $produk[nama_produk] <b>Updated!</b></div>";
									$qry_troli = mysqli_query($conn, "SELECT SUM(subtotal) AS sub FROM troli WHERE $customer");
									$get_troli = mysqli_fetch_array($qry_troli);
									//update total harga produk di keranjang
									mysqli_query($conn, "UPDATE total_harga SET total = '".$get_troli['sub']."' WHERE $email");
									echo "<meta http-equiv='refresh' content=2;url=$host/troli/>";						
								}
							}

							echo '
							<tr>
								<td width="270">
									<a href="'.$host.'/detil-produk/?k='.$produk['no_kategori'].'&b='.$produk['no_brand'].'&p='.$produk['nomor'].'">
									<img src="'.$host.'/image/produk/'.$cut_img[0].'" class="img-responsive" style="width:100%;"></a><br>';
								?>
									<!--<button class="btn btn-link btn-sm muncul">Hapus Item</button>
									<div id='dialog-box'>
									    Yakin ingin hapus Item ini?<br><br>
									    <a href="?hapus=<?php //echo $produk['nmr_troli'];?>" class="btn btn-default btn-sm">Hapus Item</a>&nbsp;<button class='tutup btn btn-danger btn-sm'>Close</button>
									</div>-->
									<a href="?hapus=<?php echo $produk['nmr_troli'];?>" class="btn btn-link btn-sm">Hapus Item</a>
								<?php
						echo'	</td>
								<td width="250">
									'.$produk['nama_produk'].'
								</td>
								<td width="120" align="center">
									'.$stok.'
								</td>
								<td>
									'.$harga.'
								</td>
								<td>';
						echo	'	<form action="" method="post">
									<select name="qty" style="width:60px;height:35px;margin-right:10px;float:left;">';
								for ($x=1;$x<=$produk['stok'];$x++) {	
									if ($x == $produk['kuantitas']) {
										echo '<option value="'.$x.'" selected="selected">'.$x.'</option>';
									}else{
										echo '<option value="'.$x.'">'.$x.'</option>';
									}
								}
						echo	'	</select>
									<input type="hidden" name="nmr" value="'.$produk['nmr_produk'].'">
									<div style="float:left;display:inline;margin-left:5px;">';
								if ($produk['stok']==0) {
						echo	'	<button type="button" disabled="disabled" style="background:white;" class="btn">
										<i class="fa fa-plus fa-2x" style="color:lime;"></i>
									</button>';		
								}else{
						echo	'	<button type="submit" value="update'.$produk['nomor'].'" name="update'.$produk['nomor'].'" style="background:white;" class="btn" data-toggle="tooltip" data-placement="bottom" title="Update kuantitas">
										<i class="fa fa-plus fa-2x" style="color:lime;"></i>
									</button>';
								}
						echo	'	</div>
									</form>
								</td>
								<td>
									'.$sub_harga.'
								</td>
							</tr>
							';
						}
						?>
							<tr>
								<td colspan="5"><b>Total Harga:</b></td>
								<td><?php echo "Rp ".number_format($total_harga['total'],0,",","."); ?></td>
							</tr>
						</tbody>
					</table>
					</div>
					<br>
					<a href="<?php echo $host;?>" class="btn btn-lanjut btn-lg pull-left"><i class="glyphicon glyphicon-chevron-left"></i> <b>Lanjut Belanja</b></a>
					<a href="<?php echo "$host/troli/?cek=produk";?>" class="btn btn-lanjut btn-lg pull-right"><b>Lanjut ke Pembayaran</b> <i class="glyphicon glyphicon-chevron-right"></i></a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once("../footer.php"); ?>

<?php include_once("../link-js.php"); ?>
<script src="<?php echo "$host/asset/js/kategori-fixed.js"; ?>"></script>
<script>
$(function() {
     //Tampilkan kotak dialog saat .muncul diklik
     $('.muncul').click(function() {
          $('#dialog-box').fadeIn();
          $('#dialog-overlay').fadeTo("normal", 0.4);
     });
     //Tutup kotak dialog saat .tutup diklik
     $('.tutup').click(function() {
          $('#dialog-box').fadeOut();
          $('#dialog-overlay').hide();
     });
     //Tutup kotak dialog saat #dialog-overlay diklik
     $('#dialog-overlay').click(function() {
          $('#dialog-box').fadeOut();
          $('#dialog-overlay').hide();
     });
});
</script>
</body>
</html>
<?php
}
?>