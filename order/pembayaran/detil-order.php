<?php
include_once("../../koneksi.php");
include_once("../../fungsi/fungsi_harga.php");

if (isset($_SESSION['email'])) {
	$mail2     = $_SESSION['email'];
	$customer2 = "customer = '$mail2'";
	$email2    = "email = '$mail2'";
}else{
	$mail2     = $_COOKIE["customer"];
	$customer2 = "cst_ip = '$mail2'";
	$email2    = "ip = '$mail2'";
}

$sql_produk = mysqli_query($conn, "SELECT produk.*, troli.* FROM produk INNER JOIN troli ON troli.nmr_produk = produk.nomor AND troli.$customer2 ORDER BY troli.tgl DESC");
$total_produk = mysqli_num_rows($sql_produk);
?>
<div class="table-responsive">
<table width="100%" class="table table-condensed">
	<tr>
		<td colspan="2" class="heading"><b>Detail Order</b></td>
	</tr>
	<tr>
		<td colspan="2">Ada <?php echo $total_produk;?> item di troli Anda</td>
	</tr>
	<tr>
		<td colspan="2">
			<table id="second_table" class="table">
				<tr>
					<td align="left"><b>Produk</b></td><td align="center"><b>Kuantitas</b></td><td align="right"><b>Harga</b></td>
				</tr>
				<?php
				while ($produk = mysqli_fetch_assoc($sql_produk)) {
				?>
				<tr>
					<td width="40%"><?php echo $produk['nama_produk']; ?></td>
					<td width="30%" align="center"><?php echo $produk['kuantitas']; ?></td>
					<td width="30%" align="right"><?php echo "Rp ".number_format($produk['subtotal'],0,",","."); ?></td>
				</tr>
				<?php
				}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<?php
		$sql_subtotal = mysqli_query($conn, "SELECT total FROM total_harga WHERE $email2");
		$subtotal 	  = mysqli_fetch_assoc($sql_subtotal);
		?>
		<td>Subtotal</td><td><?php echo "Rp ".number_format($subtotal['total'],0,",","."); ?></td>
	</tr>
	<tr>
		<?php
		$sql_ongkir = mysqli_query($conn, "SELECT SUM(kuantitas) AS qty FROM troli WHERE $customer2");
		$get_ongkir = mysqli_fetch_assoc($sql_ongkir);
		$ongkir 	= $get_ongkir['qty'] * 200000;
		?>
		<td>Ongkos Kirim</td><td><?php echo "Rp ".number_format($ongkir,0,",","."); ?></td>
	</tr>
	<tr>
		<?php $total = $ongkir + $subtotal['total']; ?>
		<td><b>Total</b><br>(Termasuk PPN)</td><td><?php echo "Rp ".number_format($total,0,",","."); ?></td>
	</tr>
</table>
</div>