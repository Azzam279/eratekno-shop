<h2 style="font-family:san-serif;">&nbsp;<b>Pilih Metode Pembayaran</b></h2><hr/>

<?php
$tgl = (date("d") + 6) / 30;
$tgl_baru2 = (date("d") + 6) - (floor($tgl) * 30);
$bln = (date("m") + floor($tgl)) / 12;
$bln_baru2 = (date("m") + floor($tgl)) - (floor($bln) * 12);
$thn = (date("Y") + floor($bln));
if(strlen($tgl_baru2) < 2){$tgl_baru = "0".$tgl_baru2;}else{$tgl_baru = $tgl_baru2;}
if(strlen($bln_baru2) < 2){$bln_baru = "0".$bln_baru2;}else{$bln_baru = $bln_baru2;}
$date = $thn.$bln_baru.$tgl_baru;

$eta = $thn."-".$bln_baru."-".$tgl_baru;

if (isset($_POST['confirm'])) {
	if (@$_POST['m-trans'] == "") {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Pilih metode pembayaran!</b></div>";
	}else{
		include_once("../../koneksi.php");
		if (isset($_SESSION['email'])) {
			$mail2     = $_SESSION['email'];
			$customer2 = "customer = '".$_SESSION['email']."'";
			$email2    = "email = '".$_SESSION['email']."'";
		}else{
			$mail2     = $_COOKIE["customer"];
			$customer2 = "cst_ip = '$mail2'";
			$email2    = "ip = '$mail2'";
		}

		$sql_troli = mysqli_query($conn, "SELECT produk.*, troli.* FROM troli INNER JOIN produk ON produk.nomor = troli.nmr_produk AND troli.$customer2");
		$sql_total = mysqli_query($conn, "SELECT total FROM total_harga WHERE $email2");
		$get_total = mysqli_fetch_array($sql_total);
		$sql_qty   = mysqli_query($conn, "SELECT SUM(kuantitas) AS jml FROM troli WHERE $customer2");
		$get_qty   = mysqli_fetch_array($sql_qty);

		$nmr = "";
		$nama = "";
		$image = "";
		$qty = "";
		$harga = "";
		while($troli = mysqli_fetch_array($sql_troli)){
			$gb = explode(",", $troli['gambar_produk']);
			$nmr .= $troli['nmr_produk']."|";
			$nama .= $troli['nama_produk']."|";
			$image .= $gb[0]."|";
			$qty .= $troli['kuantitas']."|";
			$harga .= $troli['subtotal']."|";
		}
		$nmr2 = strlen($nmr);
		$nmr3 = substr($nmr, -$nmr2, $nmr2-1);
		$replace_nama = str_replace("'", "\'", str_replace("\"","\"",$nama));
		$nama2 = strlen($replace_nama);
		$nama3 = substr($replace_nama, -$nama2,$nama2-1);
		$image2 = strlen($image);
		$image3 = substr($image, -$image2,$image2-1);
		$qty2 = strlen($qty);
		$qty3 = substr($qty, -$qty2,$qty2-1);
		$harga2 = strlen($harga);
		$harga3 = substr($harga, -$harga2,$harga2-1);
		$ongkir = $get_qty['jml'] * 200000;
		$total = $get_total['total'] + $ongkir;

		if (isset($_SESSION['email'])) {
			$sql_no = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
			$nomor  = mysqli_fetch_array($sql_no);
			$sql = mysqli_query($conn, "INSERT INTO order_produk VALUES(null,'$nmr3','".$_SESSION['email']."','$nama3','$image3','$qty3','$harga3','".$get_total['total']."','$total','$ongkir','".time()."','$eta','0','".$_POST['m-trans']."','".$nomor['nmr_customer']."','0')");
			if ($sql === false) {
				die('Perintah SQL Salah: ' . mysqli_error($conn));//jika terjadi error
			}else{
				$_SESSION['kd'] = md5($_SESSION['email']);
				mysqli_query($conn, "DELETE FROM troli WHERE customer = '".$_SESSION['email']."'");
				mysqli_query($conn, "DELETE FROM total_harga WHERE email = '".$_SESSION['email']."'");
				echo "<script>window.location='$host/order/pembayaran/produk-dibeli.php?kd=$_SESSION[kd]';</script>";
			}
		}else{
			$sql_no = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '".$_SESSION['x']."'");
			$nomor  = mysqli_fetch_array($sql_no);
			$sql = mysqli_query($conn, "INSERT INTO order_produk VALUES(null,'$nmr3','".$_SESSION['x']."','$nama3','$image3','$qty3','$harga3','".$get_total['total']."','$total','$ongkir','".time()."','$eta','0','".$_POST['m-trans']."','0','".$nomor['nomor']."')");
			if ($sql === false) {
				die('Perintah SQL Salah: ' . mysqli_error($conn));//jika terjadi error
			}else{
				$_SESSION['kd'] = md5($_SESSION['x']);
				mysqli_query($conn, "DELETE FROM troli WHERE cst_ip = '".$_COOKIE["customer"]."'");
				mysqli_query($conn, "DELETE FROM total_harga WHERE ip = '".$_COOKIE["customer"]."'");
				echo "<script>window.location='$host/order/pembayaran/produk-dibeli.php?kd=$_SESSION[kd]';</script>";
			}
		}
	}
}

?>

<section style="border:solid 1px #E1E1E1;">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<div style="background:white;padding:10px;" id="bg-ibank">
			<input type="radio" name="metode-bayar" id="i_bank" onclick="ibank();"> <label for="i_bank"><b>Internet Banking</b></label>
			<div style="margin-left:18px;color:#B4B4B4;">BCA KlikPay, KlikBCA, Mandiri Clickpay</div>
			<div id="inet_bank" style="margin-left:18px"></div>
		</div>
		<div style="background:white;padding:10px;" id="bg-kredit">
			<input type="radio" name="metode-bayar" id="kredit" onclick="visa();"> <label for="kredit"><b>Kartu Kredit/Debit</b></label>
			<div style="margin-left:18px;color:#B4B4B4;">Semua Visa dan Mastercard</div>
			<div id="visa-mcard" style="margin-left:18px"></div>
		</div>
		<div style="background:white;padding:10px;" id="bg-trans">
			<input type="radio" name="metode-bayar" id="transfer" onclick="trans();" checked="checked"> <label for="transfer"><b>Transfer</b></label>
			<div style="margin-left:18px;color:#B4B4B4;">Dari semua bank</div>
			<div id="trans_b" style="margin-left:18px"></div>
		</div>
		<hr/>
		<div class="col-md-5" style="padding:10px;" id="tombol">
			<button type="submit" name="confirm" value="confirm" class="btn btn-default btn-order btn-lg" id="pesanan">KONFIRMASI PESANAN</button>
		</div>
	</form>
	<div class="clearfix"></div>
</section>