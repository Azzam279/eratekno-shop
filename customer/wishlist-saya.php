<?php
$sql_total = mysqli_query($conn, "SELECT * FROM wishlist WHERE customer = '".$_SESSION['email']."'");
$total 	   = mysqli_num_rows($sql_total);

echo "<div class='hub'>Wishlist Saya <span class='pull-right' style='font-size:12px;color:#888;'>Wishlist ini berisi $total item</span></div><hr/>";

$sql_wishlist = mysqli_query($conn, "SELECT wishlist.*, produk.* FROM wishlist INNER JOIN produk ON produk.nomor = wishlist.nmr_produk AND wishlist.customer = '".$_SESSION['email']."' ORDER BY wishlist.nmr_wishlist DESC LIMIT 20");

//hapus produk dari wishlist
if (isset($_GET['hapus'])) {
	mysqli_query($conn, "DELETE FROM wishlist WHERE nmr_wishlist = '".$_GET['hapus']."'");
	echo "<script>window.location = '$host/customer/?cst=wishlist-saya';</script>";
}
?>
<div class="table-responsive">
<table class="table table-condensed table-hover table-striped">
	<thead>
		<tr>
			<th><center>Produk</center></th>
			<th><center>Nama Produk</center></th>
			<th><center>Tanggal</center></th>
			<th><center>Ketersediaan</center></th>
			<th colspan="2">Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($wishlist = mysqli_fetch_array($sql_wishlist)) {
			if ($wishlist['stok'] > 0) {$stok="<font color='green'>Stok tersedia</font>";}else{$stok="<font color='red'>Stok kosong</font>";}
			$img = explode(",", $wishlist['gambar_produk']);

			echo "<tr>";
				echo "<td><img src='$host/image/produk/$img[0]' class='img-responsive' style='width:100%;'></td>";
				echo "<td>$wishlist[nama_produk]<br><a href='$request_uri&hapus=$wishlist[nmr_wishlist]' class='btn btn-link btn-sm'><i class='fa fa-times-circle'></i> Hapus produk</a></td>";
				echo "<td>".date("d/m/Y",$wishlist['tgl_wishlist'])."</td>";
				echo "<td>$stok</td>";
				echo "<td style='color:red;font-weight:bold;'>";
					cut_harga($wishlist['harga_diskon']);	
				echo "</td>";
				echo "<td><a href='$host/detil-produk/?k=$wishlist[no_kategori]&b=$wishlist[no_brand]&p=$wishlist[nomor]' class='btn btn-default'><i class='glyphicon glyphicon-eye-open'></i> Detil Produk</a></td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>
</div>
<div class="clearfix">
	<small>Limit 20 Wishlist</small>
</div>