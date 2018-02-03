<?php
//membuat fungsi paging
$hlm = 10;
$record_produk = mysqli_query($conn, "SELECT COUNT(nmr_order) FROM order_produk WHERE customer = '".$_SESSION['email']."' AND barang_dikirim <> 2");
$total_hlm = mysqli_result($record_produk, 0,0);
$tampil_hlm = ceil($total_hlm / $hlm);

$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
$start_record = ($halaman - 1) * $hlm;

$sql_order = mysqli_query($conn, "SELECT * FROM order_produk WHERE customer = '".$_SESSION['email']."' AND barang_dikirim <> 2 ORDER BY nmr_order DESC LIMIT $start_record,$hlm");

while ($get_order = mysqli_fetch_array($sql_order)) {

	//memecah data produk yg dibeli berdasarkan delimiter "|"
	$nmr_produk = explode("|", $get_order['nmr_produk']);
	$count_nmr = count($nmr_produk);
	$nama_produk = explode("|", $get_order['nama_produk']);
	$img_produk = explode("|", $get_order['gambar_produk']);
	$kuantitas = explode("|", $get_order['kuantitas']);
	$harga		= explode("|", $get_order['harga']);

	//jika atribut barang_dikirim bernilai "0" maka status Menunggu jika "1" maka status Dikirim
	if ($get_order['barang_dikirim']==0) {$status="Menunggu";$bayar="-";}else{$status="Dikirim";$bayar="Pesanan Dibayar";}

?>
<div style="border-top:solid 2px grey;border-left:solid 1px #D2D2D2;border-right:solid 1px #D2D2D2;border-bottom:solid 1px #D2D2D2;">
	<div style="padding:13px;background:#EEEEEE;border-bottom:solid 1px #D2D2D2;">
		<div class="table-responsive">
		<table width="100%">
			<tr>
				<td align="left">TANGGAL</td>
				<td align="center">STATUS PEMBAYARAN</td>
				<td align="right">STATUS PENGIRIMAN</td>
			</tr>
			<tr>
				<td align="left"><b><?php echo date("d-m-Y",$get_order['tgl']);?></b></td>
				<td align="center"><b><?php echo $bayar; ?></b></td>
				<td align="right"><b><?php echo $status; ?></b></td>
			</tr>
		</table>
		</div>
	</div>
	<div style="padding:13px;font-size:12px;">
		<div class="table-responsive">
		<table width="100%">
			<tr>
				<td align="left" colspan="2">PRODUK</td>
				<td align="center">NO. PESANAN</td>
				<td align="right">HARGA</td>
			</tr>
			<?php
			for ($a=0;$a<$count_nmr;$a++) {
				$sql_link = mysqli_query($conn, "SELECT*FROM produk WHERE nomor = '".$nmr_produk[$a]."'");
				$get_link = mysqli_fetch_array($sql_link);
			?>
			<tr>
				<td align="left" width="10%">
					<?php echo "<a href='$host/detil-produk/?k=$get_link[no_kategori]&b=$get_link[no_brand]&p=$nmr_produk[$a]'>
					<img src='$host/image/produk/$img_produk[$a]' class='img-responsive' style='height:64px;'></a>";?>
				</td>
				<td align="left" width="50%">
					<b><?php echo $nama_produk[$a];?></b><br>
					<small>Jumlah: <?php echo $kuantitas[$a];?></small>
				</td>
				<td align="center" width="20%" style="color:blue;">
					<?php echo $nmr_produk[$a];?>
				</td>
				<td align="right" width="20%" style="color:#DD3317;font-weight:bold;">
					<?php cut_harga($harga[$a]); ?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="3" style="border-top:1px solid #A5A5A5;padding-top:9px;">Subtotal</td>
				<td align="right" style="border-top:1px solid #A5A5A5;padding-top:9px;">
				<b><?php cut_harga($get_order['subtotal']); ?></b></td>
			</tr>
			<tr>
				<td colspan="3" style="padding-top:5px;">Ongkir</td>
				<td align="right" style="padding-top:5px;"><b><?php cut_harga($get_order['ongkir']); ?></b></td>
			</tr>
			<tr>
				<td colspan="3" style="padding-top:5px;">Total Pembayaran</td>
				<td align="right" style="padding-top:5px;"><b><?php cut_harga($get_order['total']); ?></b></td>
			</tr>
		</table>
		</div>
	</div>
</div>
<br>
<?php
}
?>
<div class="clearfix"></div>

<div class="row">
<?php
//PAGING SELECT
echo "<div class='col-md-12'>";
	echo "<div class='pull-right' style='margin-top:20px;margin-right:20px;'>";
		echo "Halaman: &nbsp;";
		echo "<select style='height:30px;width:55px;' onchange='paging_cst1(\"$host$php_self?cst=pesanan-saya&halaman=\"+this.value);'>";

		for ($pa=1;$pa<=$tampil_hlm;$pa++) {
			if (@$_GET['halaman'] == $pa) {
				echo "<option value='$pa' selected>$pa</option>";
			}else{
				echo "<option value='$pa'>$pa</option>";
			}
		}

		echo "</select>";
	echo "</div>";
echo "</div>";
?>
</div>