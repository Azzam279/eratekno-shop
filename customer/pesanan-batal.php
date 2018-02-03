<?php
//membuat fungsi paging
$hlm2 = 10;
$record_produk2 = mysqli_query($conn, "SELECT COUNT(nmr_order) FROM order_produk WHERE customer = '".$_SESSION['email']."' AND barang_dikirim = 2");
$total_hlm2 = mysqli_result($record_produk2, 0,0);
$tampil_hlm2 = ceil($total_hlm2 / $hlm2);

$halaman2 = (isset($_GET['hlm']) ? (int)$_GET['hlm'] : 1);
$start_record2 = ($halaman2 - 1) * $hlm2;

$sql_batal = mysqli_query($conn, "SELECT * FROM order_produk WHERE customer = '".$_SESSION['email']."' AND barang_dikirim = 2 ORDER BY nmr_order DESC LIMIT $start_record2,$hlm2");

while ($get_batal = mysqli_fetch_array($sql_batal)) {

	//memecah data produk yg dibeli berdasarkan delimiter "|"
	$nmr_produk2  = explode("|", $get_batal['nmr_produk']);
	$count_nmr2   = count($nmr_produk2);
	$nama_produk2 = explode("|", $get_batal['nama_produk']);
	$img_produk2  = explode("|", $get_batal['gambar_produk']);
	$kuantitas2   = explode("|", $get_batal['kuantitas']);
	$harga2		  = explode("|", $get_batal['harga']);

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
				<td align="left"><b><?php echo date("d-m-Y",$get_batal['tgl']);?></b></td>
				<td align="center"><b>Pesanan Dibatalkan</b></td>
				<td align="right"><b>-</b></td>
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
			for ($b=0;$b<$count_nmr2;$b++) {
				$sql_link = mysqli_query($conn, "SELECT*FROM produk WHERE nomor = '".$nmr_produk2[$b]."'");
				$get_link = mysqli_fetch_array($sql_link);
			?>
			<tr>
				<td align="left" width="10%">
					<?php echo "<a href='$host/detil-produk/?k=$get_link[no_kategori]&b=$get_link[no_brand]&p=$nmr_produk2[$b]'>
					<img src='$host/image/produk/$img_produk2[$b]' class='img-responsive' style='height:64px;'></a>";?>
				</td>
				<td align="left" width="50%">
					<b><?php echo $nama_produk2[$b];?></b><br>
					<small>Jumlah: <?php echo $kuantitas2[$b];?></small>
				</td>
				<td align="center" width="20%" style="color:blue;">
					<?php echo $nmr_produk2[$b];?>
				</td>
				<td align="right" width="20%" style="color:#DD3317;font-weight:bold;">
					<?php cut_harga($harga2[$b]); ?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="3" style="border-top:1px solid #A5A5A5;padding-top:9px;">Subtotal</td>
				<td align="right" style="border-top:1px solid #A5A5A5;padding-top:9px;">
				<b><?php cut_harga($get_batal['subtotal']); ?></b></td>
			</tr>
			<tr>
				<td colspan="3" style="padding-top:5px;">Ongkir</td>
				<td align="right" style="padding-top:5px;"><b><?php cut_harga($get_batal['ongkir']); ?></b></td>
			</tr>
			<tr>
				<td colspan="3" style="padding-top:5px;">Total Pembayaran</td>
				<td align="right" style="padding-top:5px;"><b><?php cut_harga($get_batal['total']); ?></b></td>
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
		echo "<select style='height:30px;width:55px;' onchange='paging_cst2(\"$host$php_self?cst=pesanan-saya&hlm=\"+this.value);'>";

		for ($pb=1;$pb<=$tampil_hlm2;$pb++) {
			if (@$_GET['hlm'] == $pb) {
				echo "<option value='$pb' selected>$pb</option>";
			}else{
				echo "<option value='$pb'>$pb</option>";
			}
		}

		echo "</select>";
	echo "</div>";
echo "</div>";
?>
</div>
