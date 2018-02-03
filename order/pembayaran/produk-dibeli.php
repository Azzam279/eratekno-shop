<?php
include_once("../../fungsi/variable.php");
include_once("$doc/koneksi.php");
if (isset($_SESSION['email'])) {
	$sesi = @$_SESSION['email'];
}else{
	$sesi = @$_SESSION['x'];
}

//jika sesi email atau kd kosong maka akan di direct ke homepage
if (empty($sesi) || empty($_SESSION['kd'])) {
	echo "<script>window.location = '$host';</script>";
}else{
	//jika ada sesi x maka buat cookie customer <- customer sementara
	if (isset($_SESSION['x'])) {
		setcookie("customer",$_COOKIE['bantuan'],time()-(86400*7),"/");
		setcookie("bantuan",$_COOKIE['bantuan'],time()-(86400*365),"/");
	}else{
	//jika tidak ada, maka buat cookie nomor <- customer tetap
		setcookie($_SESSION['nomor'],$_SESSION['email'],time()-(86400*7),"/");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pembayaran | EraTekno-Shop</title>
	<?php include_once("../../link-css.php"); ?>
	<style>
		.bg-color {
			background: #F4F4F4;
			padding: 15px;
			border-bottom: solid 2px white;
		}

		.btn-back {
			background: #0077C7;
			color: white;
			margin-left: 20px;
		}
		.btn-back:hover {
			background: #AAAAFF;
		}
	</style>
</head>
<body>
	<script>setTimeout(<?php unset($_SESSION['kd']); ?>,3000);</script>

	<div id="gototop"></div>

	<!-- Loading -->
	<div id="preloader" class="hidden-xs hidden-sm">
		<div id="status"></div>
	</div>
	
	<?php include_once("../../navigasi-fixed.php"); ?>
	<div id="kategory"><button id="btn-kat" class="btn btn-default btn-lg">Kategori Belanja <i class="glyphicon glyphicon-circle-arrow-down"></i></button><div id="slide-kat"><?php include_once("../../kategori.php"); ?></div>
		<?php
		include_once("../../fungsi/fungsi.php");
		breadcrumbs2("PENGISIAN ALAMAT","PEMBAYARAN",$host,"$host/order/");
		?>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="well well-small" style="background:white;padding:7px;">
				<?php
				include_once("$doc/koneksi.php");
				include_once("$doc/fungsi/fungsi_harga.php");
				include_once("$doc/fungsi/fungsi.php");

				//mengambil nmr_order terakhir
				$sql_no = mysqli_query($conn, "SELECT nmr_order FROM order_produk WHERE customer = '$sesi' ORDER BY nmr_order ASC");
				$rows = mysqli_num_rows($sql_no);
				$row = $rows-1;
				$no_order = mysqli_result($sql_no,$row,0);

				//mengambil data order_produk berdasarkan email customer dan nomor order
				$sql = mysqli_query($conn, "SELECT * FROM order_produk WHERE customer = '$sesi' AND nmr_order = '$no_order'");
				$get = mysqli_fetch_assoc($sql);

				//mengambil data nama customer utk pengiriman email
				if (isset($_SESSION['email'])) {
					$qry = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$sesi'");
					$get_nama = mysqli_fetch_assoc($qry);
				}else{
					$qry = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '$sesi'");
					$get_nama = mysqli_fetch_assoc($qry);
				}

				//mengambil angka tahun
				$cut_thn = substr($get['e_t_a'], 0,4);
				//mengambil angka bulan
				$cut_bln = substr($get['e_t_a'], 5,2);
				//mengambil angka tanggal
				$cut_tgl = substr($get['e_t_a'], 8,2);
				//mengambil bulan berdasarkan nama
				switch ($cut_bln) {
					case 01:
						$bln = "Jan";
						break;
					case 02:
						$bln = "Feb";
						break;
					case 03:
						$bln = "Mar";
						break;
					case 04:
						$bln = "Apr";
						break;
					case 05:
						$bln = "Mei";
						break;
					case 06:
						$bln = "Jun";
						break;
					case 07:
						$bln = "Jul";
						break;
					case 08:
						$bln = "Agu";
						break;
					case 09:
						$bln = "Sep";
						break;
					case 10:
						$bln = "Okt";
						break;
					case 11:
						$bln = "Nov";
						break;
					case 12:
						$bln = "Des";
						break;
					
					default:
						$bln = "Jan";
						break;
				}

				//mendapatkan no rekening berdasarkan bank
				if ($get['metode_bayar'] == "Bank BCA") {
					$rek = "676 023 0xxx";
				}else if ($get['metode_bayar'] == "Bank BRI") {
					$rek = "092 401 000018 xxx";
				}else if ($get['metode_bayar'] == "Bank BNI") {
					$rek = "333 400 5xxx";
				}else{
					$rek = "164 0000 965 xxx";
				}

				//memecah data produk yg dibeli berdasarkan delimiter "|"
				$nmr_produk = explode("|", $get['nmr_produk']);
				$count_nmr = count($nmr_produk);
				$nama_produk = explode("|", $get['nama_produk']);
				$img_produk = explode("|", $get['gambar_produk']);
				$kuantitas = explode("|", $get['kuantitas']);
				$harga		= explode("|", $get['harga']);

				//mengirim email konfirmasi order ke customer
				require_once("../../class.phpmailer.php");
				$sendmail = new PHPMailer();
				$sendmail->From = 'azzam@eratekno-shop.16mb.com';
				$sendmail->FromName = 'Eratekno-Shop';
				$sendmail->addAddress($sesi,$get_nama['nama']);
				$sendmail->addReplyTo('azzam@eratekno-shop.16mb.com','Azzam');
				$sendmail->Subject = 'Konfirmasi Order Telah Diterima';
				$sendmail->Body = '<a href="http://eratekno-shop.16mb.com/"><img src="http://eratekno-shop.16mb.com/image/era-tekno-lg.png"></a><br><br>
							Kepada '.ucfirst($get_nama['nama']).' .,<br><br>
							Dengan ini kami informasikan bahwa Eratekno-shop.16mb.com telah menerima pemesanan Anda. Berikut kami sertakan detail pemesanan:<br><br>
							<table>';
							for ($e=0;$e<$count_nmr;$e++) {
				$sendmail->Body	.= '<tr><td width="200">Nomor Pesanan</td><td width="20">:</td><td>'.$nmr_produk[$e].'</td></tr>';
							}
				$sendmail->Body	.= '<tr><td width="200">Tanggal Pemesanan</td><td width="20">:</td><td>'.date("d/m/Y",$get['tgl']).'</td></tr>
							<tr><td width="200">Status</td><td width="20">:</td><td>Menunggu Pembayaran</td></tr>
							</table>
							<br>
							Bila Anda telah teregistrasi menjadi member di Eratekno-shop.16mb.com, Anda dapat melihat status pemesanan melalui kolom Pesanan Saya.
							<br><br>
							Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email azzam@eratekno-shop.16mb.com atau buka link <a href="http://eratekno-shop.16mb.com/contact.php">http://eratekno-shop.16mb.com/contact.php</a><br><br>
							<b>Terima Kasih</b><br>
							<div style="color:#FFAE12;font-weight:bold;">Eratekno-shop</div>';
				$sendmail->isHTML(true);
				if (!$sendmail->Send()) {
					echo "Terjadi error, email gagal dikirim! :( " . $sendmail->ErrorInfo;
				}

				?>
					<h2 style="font-family:san-serif;">&nbsp;<b>TERIMA KASIH</b></h2>
					<p>&nbsp;
						Pesanan Anda telah diproses. Kami telah mengirimkan email konfirmasi atas pesanan Anda.<br>&nbsp;
						Mohon lakukan pembayaran dalam jangka waktu kurang dari 24 jam. Jika tidak pesanan Anda akan dibatalkan.
					</p><br>
					<?php
					for ($a=0;$a<$count_nmr;$a++) {
					?>
					<div class="bg-color">
						<span>
							<b>Nomor Pesanan</b>
						</span>
						<span class="pull-right">
							<b><?php echo $nmr_produk[$a]; ?></b>
						</span>
					</div>
					<?php
					}
					?>
					<div class="bg-color">
						<span>
							<b>Status Pesanan</b>
						</span>
						<span class="pull-right">
							<b>Menunggu Pembayaran</b>
						</span>
					</div>
					<div class="bg-color">
						<span>
							<b>Metode Pembayaran</b>
						</span>
						<span class="pull-right">
							<b>Transfer ke Virtual Account</b>
						</span>
					</div>
					<br>

					<div style="border:solid 1px #D2D2D2;padding:13px;box-sizing:border-box;">
						<div style="background:#DEF0D8;padding:15px;margin-bottom:3px;font-size:17px;">
							<span>
								<b>Subtotal</b>
							</span>
							<span class="pull-right">
								<b>Rp. <?php echo number_format($get['subtotal'],0,",","."); ?></b>
							</span>
						</div>
						<div style="background:#DEF0D8;padding:15px;margin-bottom:3px;font-size:17px;">
							<span>
								<b>Ongkos Kirim</b>
							</span>
							<span class="pull-right">
								<b>Rp. <?php echo number_format($get['ongkir'],0,",","."); ?></b>
							</span>
						</div>
						<div style="background:#DEF0D8;padding:15px;margin-bottom:11px;font-size:17px;">
							<span>
								<b>Total Pembayaran</b>
							</span>
							<span class="pull-right">
								<b>Rp. <?php echo number_format($get['total'],0,",","."); ?></b>
							</span>
						</div>
						Silakan selesaikan pembayaran Anda dengan melakukan transfer ke <?php echo $get['metode_bayar'] ?> Account Number: <b><?php echo $rek; ?> (Eratekno-shop.16mb.com)</b>.
					</div>
					<br>
					<div style="padding:7px 7px 7px 11px;color:white;background:#7F7F7F;">
						PRODUK YANG DIPESAN
					</div>
					<div style="background:#D2D2D2;padding:13px;box-sizing:border-box;">
						<?php
						for ($b=0;$b<$count_nmr;$b++) {
						?>
						<div style="background:white;padding:5px;box-sizing:border-box;" id="<?php echo $b;?>">
							<div style="float:left;">
								<img src="<?php echo "$host/image/produk/$img_produk[$b]"; ?>" style="width:100%;">
							</div>
							<div style="float:left;padding:15px;margin-left:20px;">
								<span style="font-size:18px;"><b><?php echo $nama_produk[$b]; ?></b></span><br>
								Jumlah : <?php echo $kuantitas[$b]; ?>
							</div>
							<div style="float:right;padding:15px;color:orange;font-weight:bold;font-size:16px;margin-top:25px;">
								<?php echo "Rp ".number_format($harga[$b],0,",","."); ?>
							</div>
							<div style="clear:both;border-top:solid 1px #999;padding:5px;border-bottom:solid 1px #999">
								Estimasi tanggal produk akan diterima: <b><?php echo date("d-M-Y",$get['tgl']);?> to <?php echo $cut_tgl."-".$bln."-".$cut_thn;?></b>
							</div>
						</div>
						<?php
						}
						?>
					</div>
					<br>

					<a href="<?php echo $host;?>" class="btn btn-lg btn-default btn-back">Kembali ke Halaman Utama</a>
					<br><br>

				</div>
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

//hapus session x dlm waktu 6 detik
if (isset($_SESSION['x'])) {
	?>
	<script>setTimeout(<?php unset($_SESSION['x']);?>,6000);</script>
<?php
}
?>