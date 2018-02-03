<?php
include_once("$doc/koneksi.php");
include_once("$doc/fungsi/fungsi.php");
include_once("$doc/fungsi/fungsi_harga.php");

//Pesanan Customer Tetap(terdaftar) -BEGIN-
if (@$_GET['cst'] != "sementara") {

echo "<div class='hub'>Pesanan Customer</div><hr/>";

$hlm = 10;
$record_produk = mysqli_query($conn, "SELECT COUNT(nmr_order) FROM order_produk WHERE no_customer <> 0");
$total_hlm = mysqli_result($record_produk, 0,0);
$tampil_hlm = ceil($total_hlm / $hlm);

$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
$start_record = ($halaman - 1) * $hlm;

$sql_order = mysqli_query($conn, "SELECT * FROM order_produk WHERE no_customer <> 0 ORDER BY nmr_order DESC LIMIT $start_record,$hlm");
?>
<div id="accordion" style="margin-left:10px;margin-right:10px;">
	<?php
	while ($get = mysqli_fetch_array($sql_order)) {
		//mengambil data informasi customer
		$sqL_cst = mysqli_query($conn, "SELECT * FROM customer WHERE nmr_customer = '".$get['no_customer']."'");
		$get_cst = mysqli_fetch_array($sqL_cst);

		//mengambil data provinsi-kota-kecamatan
		$sql_provinsi  = mysqli_query($conn, "SELECT*FROM master_provinsi WHERE provinsi_id = '".$get_cst['provinsi']."'");
		$sql_kota 	   = mysqli_query($conn, "SELECT*FROM master_kokab WHERE kota_id = '".$get_cst['kota']."'");
		$sql_kecamatan = mysqli_query($conn, "SELECT*FROM master_kecam WHERE kecam_id = '".$get_cst['kecamatan']."'");
		$provinsi 	   = mysqli_fetch_array($sql_provinsi);
		$kota 		   = mysqli_fetch_array($sql_kota);
		$kecamatan 	   = mysqli_fetch_array($sql_kecamatan);

		//memecah data produk yg dibeli berdasarkan delimiter "|"
		$nmr_produk = explode("|", $get['nmr_produk']);
		$count_nmr = count($nmr_produk);
		$nama_produk = explode("|", $get['nama_produk']);
		$img_produk = explode("|", $get['gambar_produk']);
		$kuantitas = explode("|", $get['kuantitas']);
		$harga		= explode("|", $get['harga']);

		//jika tombol update diklik maka eksekusi script dibawah ini
		if (isset($_POST['update'.$get['nmr_order']])) {
			if ($_POST['status'] == 1) {
				//memecah nomor produk
				$ex_no  = explode("|", $_POST['no_p']);
				//menghitung jumlah array $ex_no
				$hitung = count($ex_no);
				//memecah kuantitas produk
				$ex_qty = explode("|", $_POST['qty']);
				for ($x=0;$x<$hitung;$x++) {
					//mengecek kuantitas, jika ada kuantitas yg melebihi jumlah stok maka akan menampilkan warning dan halaman di refresh
					$qry2 = mysqli_query($conn, "SELECT stok FROM produk WHERE nomor = '".$ex_no[$x]."'");
					while ($get2 = mysqli_fetch_array($qry2)) {
						if ($get2['stok'] < $ex_qty[$x]) {
							echo "<script>alert('Kuantitas melebihi jumlah Stok!');</script>";
							echo "<script>window.location = '$host/admin-azm/?azm=order-produk';</script>";
							exit();
						}
					}
					//mengambil data table produk berdasarkan atribut nomor
					$qry3 = mysqli_query($conn, "SELECT * FROM produk WHERE nomor = '".$ex_no[$x]."'");
					$get3 = mysqli_fetch_array($qry3);
					$terjual = $get3['terjual'] + 1;
					$stock 	 = $get3['stok'] - $ex_qty[$x];
					//update table produk
					mysqli_query($conn, "UPDATE produk SET terjual = '$terjual', stok = '$stock' WHERE nomor = '".$ex_no[$x]."'");
				}
			}

			//update status pesanan customer
			$sql_update = mysqli_query($conn, "UPDATE order_produk SET barang_dikirim = '".$_POST['status']."' WHERE nmr_order = '".$_POST['nmr']."'");
			if ($sql_update === false) {
				echo "<script>alert('Terjadi Error!');</script>";
			}else{
				echo "<script>window.location = '$host/admin-azm/?azm=order-produk';</script>";
			}
		}

		//jika barang dikirim maka background accordion berwarna hijau jika dibatalkan berwarna merah
		$sql_color = mysqli_query($conn, "SELECT barang_dikirim AS sent FROM order_produk WHERE nmr_order = '".$get['nmr_order']."'");
		$get_color = mysqli_fetch_array($sql_color);
		if($get_color['sent']==1) {$colors="background:#7FFF55;color:#FFFFD4;";}else if($get_color['sent']==2){$colors="background:red;color:white;";}else{$colors="";}
	?>
	<h3 style="padding-top:15px;padding-bottom:15px;<?php echo $colors;?>"><?php echo $get_cst['nama']." - ".$get['customer'];?>
	<span class="pull-right"><?php echo date("d-m-Y",$get['tgl']);?></span></h3>
	<div style="background:white;">
		<p>
		<div class="table-responsive">
		<table class="table table-condensed table-hover">
			<tr>
				<th>Produk</th>
				<th>No.Produk</th>
				<th>Kuantitas</th>
				<th>Stok</th>
				<th>Harga</th>
			</tr>
			<?php
			for ($a=0;$a<$count_nmr;$a++) {
			?>
			<tr>
				<td width="43%" style="padding-right:25px;"><?php echo $nama_produk[$a]; ?></td>
				<td width="15%"><?php echo $nmr_produk[$a]; ?></td>
				<td width="15%"><?php echo $kuantitas[$a]; ?></td>
				<?php
				$qry_stok = mysqli_query($conn, "SELECT stok FROM produk WHERE nomor = '".$nmr_produk[$a]."'");
				while ($stoks = mysqli_fetch_array($qry_stok)) {
					if ($stoks['stok'] < $kuantitas[$a]) {$stok_color='style="color:red"';}else{$stok_color="";}
					echo '<td width="12" '.$stok_color.'>'.$stoks['stok'].'</td>';
				}
				?>
				<td width="15%"><?php cut_harga($harga[$a]); ?></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="4" style="border-top:solid 2px white;padding-top:15px;"><b>Subtotal</b></td>
				<td style="border-top:solid 2px grey;padding-top:15px;"><b><?php cut_harga($get['subtotal']); ?></b></td>
			</tr>
			<tr>
				<td colspan="4"><b>Ongkir</b></td>
				<td><b><?php cut_harga($get['ongkir']); ?></b></td>
			</tr>
			<tr>
				<td colspan="4"><b>Total</b></td>
				<td><b><?php cut_harga($get['total']); ?></b></td>
			</tr>
		</table>
		</div>
		<div style="float:left;">
			<h4 style="font-family:cursive;">Alamat Customer</h4>
			<?php
			echo "$get_cst[alamat]<br>$provinsi[provinsi_nama] - $kota[kokab_nama] - $kecamatan[nama_kecam]<br>$get_cst[no_handphone]";
			?>
		</div>
		<div style="float:right;">
			<?php
			echo "<form action='' method='post'>
					Status Pesanan: 
					<select name='status' style='height:35px;'>";
					if ($get['barang_dikirim'] == 0) {
						echo "<option value='0' selected>Menunggu</option>";
						echo "<option value='1'>Dikirim</option>";
						echo "<option value='2'>Dibatalkan</option>";
					}else if ($get['barang_dikirim'] == 1){
						echo "<option value='0'>Menunggu</option>";
						echo "<option value='1' selected>Dikirim</option>";
						echo "<option value='2'>Dibatalkan</option>";
					}else{
						echo "<option value='0'>Menunggu</option>";
						echo "<option value='1'>Dikirim</option>";
						echo "<option value='2' selected>Dibatalkan</option>";
					}
			echo "	</select><br><br>";
			echo "<input type='hidden' name='nmr' value='$get[nmr_order]'>";
			echo "<input type='hidden' name='no_p' value='$get[nmr_produk]'>";
			echo "<input type='hidden' name='qty' value='$get[kuantitas]'>";
			//jika stok produk kurang dari kuantitas produk yang dipesan, maka tombol update akan disabled
			$no = 0;
			for ($i=0; $i<$count_nmr; $i++) {
				$sql_stok = mysqli_query($conn, "SELECT stok AS stock FROM produk WHERE nomor = '".$nmr_produk[$i]."'");
				while ($get_stok = mysqli_fetch_array($sql_stok)) {
					$no++;
					if ($kuantitas[$i] > $get_stok['stock']) {
						$disabled = "disabled='disabled'";
						break;
					}else{
						$disabled = "";
						break;
					}
				}
			}
			echo "<input type='submit' class='btn btn-success' value='Update' name='update$get[nmr_order]' style='float:right;' $disabled>";
			echo "</form>";
			?>
		</div>
		</p>
	</div>
	<?php
	}
	?>
</div>

<div class="row">
<div class="col-md-offset-2 col-md-8">
<?php
//PAGING
echo "<ul class='pager'>";
if ($halaman > 1) echo  "<li class='previous'><a href='".$_SERVER['PHP_SELF']."?azm=order-produk&halaman=".($halaman-1)."'>&lt;&lt; Prev</a></li>";

echo "<li><ul class='pagination' style='margin:0px;'>";
for($page = 1; $page <= $tampil_hlm; $page++)
{
     if ((($page >= $halaman - 3) && ($page <= $halaman + 3)) || ($page == 1) || ($page == $haltam)) 
     {
        if ($page == $halaman) echo "<li class='active'><a href='#'>".$page."</a></li> ";
        else echo "<li><a href='".$_SERVER['PHP_SELF']."?azm=order-produk&halaman=".$page."'>".$page."</a></li>";         
     }
}
echo "</ul></li>";

if ($halaman < $tampil_hlm) echo "<li class='next'><a href='".$_SERVER['PHP_SELF']."?azm=order-produk&halaman=".($halaman+1)."'>Next &gt;&gt;</a></li>";
echo "</ul>";

echo '</div>'; 
?>
</div>
</div>
<?php
//Pesanan Customer Tetap(terdaftar) -END-
// *************************************************************************************************************************
// *************************************************************************************************************************
// *************************************************************************************************************************
}else{
//Pesanan Customer Sementara -BEGIN-

echo "<div class='hub'>Pesanan Customer Sementara</div><hr/>";

$hlm = 10;
$record_produk = mysqli_query($conn, "SELECT COUNT(nmr_order) FROM order_produk WHERE no_cst_sementara <> 0");
$total_hlm = mysqli_result($record_produk, 0,0);
$tampil_hlm = ceil($total_hlm / $hlm);

$halaman = (isset($_GET['hlm']) ? (int)$_GET['hlm'] : 1);
$start_record = ($halaman - 1) * $hlm;

$sql_order = mysqli_query($conn, "SELECT * FROM order_produk WHERE no_cst_sementara <> 0 ORDER BY nmr_order DESC LIMIT $start_record,$hlm");
?>
<div id="accordion" style="margin-left:10px;margin-right:10px;">
	<?php
	while ($get = mysqli_fetch_array($sql_order)) {
		//mengambil data informasi customer
		$sqL_cst = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE nomor = '".$get['no_cst_sementara']."'");
		$get_cst = mysqli_fetch_array($sqL_cst);

		//mengambil data provinsi-kota-kecamatan
		$sql_provinsi  = mysqli_query($conn, "SELECT*FROM master_provinsi WHERE provinsi_id = '".$get_cst['provinsi']."'");
		$sql_kota 	   = mysqli_query($conn, "SELECT*FROM master_kokab WHERE kota_id = '".$get_cst['kota']."'");
		$sql_kecamatan = mysqli_query($conn, "SELECT*FROM master_kecam WHERE kecam_id = '".$get_cst['kecamatan']."'");
		$provinsi 	   = mysqli_fetch_array($sql_provinsi);
		$kota 		   = mysqli_fetch_array($sql_kota);
		$kecamatan 	   = mysqli_fetch_array($sql_kecamatan);

		//memecah data produk yg dibeli berdasarkan delimiter "|"
		$nmr_produk = explode("|", $get['nmr_produk']);
		$count_nmr = count($nmr_produk);
		$nama_produk = explode("|", $get['nama_produk']);
		$img_produk = explode("|", $get['gambar_produk']);
		$kuantitas = explode("|", $get['kuantitas']);
		$harga		= explode("|", $get['harga']);

		//jika tombol update diklik maka eksekusi script dibawah ini
		if (isset($_POST['update'.$get['nmr_order']])) {
			if ($_POST['status'] == 1) {
				//memecah nomor produk
				$ex_no  = explode("|", $_POST['no_p']);
				//menghitung jumlah array $ex_no
				$hitung = count($ex_no);
				//memecah kuantitas produk
				$ex_qty = explode("|", $_POST['qty']);
				for ($x=0;$x<$hitung;$x++) {
					//mengecek kuantitas, jika ada kuantitas yg melebihi jumlah stok maka akan menampilkan warning dan halaman di refresh
					$qry2 = mysqli_query($conn, "SELECT stok FROM produk WHERE nomor = '".$ex_no[$x]."'");
					while ($get2 = mysqli_fetch_array($qry2)) {
						if ($get2['stok'] < $ex_qty[$x]) {
							echo "<script>alert('Kuantitas melebihi jumlah Stok!');</script>";
							echo "<script>window.location = '$host/admin-azm/?azm=order-produk&cst=sementara';</script>";
							exit();
						}
					}
					//mengambil data table produk berdasarkan atribut nomor
					$qry3 = mysqli_query($conn, "SELECT * FROM produk WHERE nomor = '".$ex_no[$x]."'");
					$get3 = mysqli_fetch_array($qry3);
					$terjual = $get3['terjual'] + 1;
					$stock 	 = $get3['stok'] - $ex_qty[$x];
					//update table produk
					mysqli_query($conn, "UPDATE produk SET terjual = '$terjual', stok = '$stock' WHERE nomor = '".$ex_no[$x]."'");
				}
			}

			//update status pesanan customer
			$sql_update = mysqli_query($conn, "UPDATE order_produk SET barang_dikirim = '".$_POST['status']."' WHERE nmr_order = '".$_POST['nmr']."'");
			if ($sql_update === false) {
				echo "<script>alert('Terjadi Error!');</script>";
			}else{
				echo "<script>window.location = '$host/admin-azm/?azm=order-produk&cst=sementara';</script>";
			}
		}

		//hapus pesanan customer sementara
		if (isset($_GET['del_cst'])) {
			$sqlDelete = mysqli_query($conn, "DELETE FROM order_produk WHERE nmr_order = '".$_GET['del_cst']."'");
			if ($sqlDelete === false) {
				die("Terjadi Error: ".mysqli_error($sqlDelete));
			}else{
				header("location: $host/admin-azm/?azm=order-produk&cst=sementara");
			}
		}

		//jika barang dikirim maka background accordion berwarna hijau jika dibatalkan berwarna merah
		$sql_color = mysqli_query($conn, "SELECT barang_dikirim AS sent FROM order_produk WHERE nmr_order = '".$get['nmr_order']."'");
		$get_color = mysqli_fetch_array($sql_color);
		if($get_color['sent']==1) {$colors="background:#7FFF55;color:#FFFFD4;";}else if($get_color['sent']==2){$colors="background:red;color:white;";}else{$colors="";}
	?>
	<h3 style="padding-top:15px;padding-bottom:15px;<?php echo $colors;?>">
		<?php echo $get_cst['nama']." - ".$get['customer'];?>
		<span class="pull-right">
			<?php echo date("d-m-Y",$get['tgl']);?>
		</span>
	</h3>
	<div style="background:white;">
		<p>
		<div class="table-responsive">
		<table class="table table-condensed table-hover">
			<tr>
				<th>Produk</th>
				<th>No.Produk</th>
				<th>Kuantitas</th>
				<th>Stok</th>
				<th>Harga</th>
			</tr>
			<?php
			for ($a=0;$a<$count_nmr;$a++) {
			?>
			<tr>
				<td width="43%" style="padding-right:25px;"><?php echo $nama_produk[$a]; ?></td>
				<td width="15%"><?php echo $nmr_produk[$a]; ?></td>
				<td width="15%"><?php echo $kuantitas[$a]; ?></td>
				<?php
				$qry_stok = mysqli_query($conn, "SELECT stok FROM produk WHERE nomor = '".$nmr_produk[$a]."'");
				while ($stoks = mysqli_fetch_array($qry_stok)) {
					if ($stoks['stok'] < $kuantitas[$a]) {$stok_color='style="color:red"';}else{$stok_color="";}
					echo '<td width="12" '.$stok_color.'>'.$stoks['stok'].'</td>';
				}
				?>
				<td width="15%"><?php cut_harga($harga[$a]); ?></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="4" style="border-top:solid 2px white;padding-top:15px;"><b>Subtotal</b></td>
				<td style="border-top:solid 2px grey;padding-top:15px;"><b><?php cut_harga($get['subtotal']); ?></b></td>
			</tr>
			<tr>
				<td colspan="4"><b>Ongkir</b></td>
				<td><b><?php cut_harga($get['ongkir']); ?></b></td>
			</tr>
			<tr>
				<td colspan="4"><b>Total</b></td>
				<td><b><?php cut_harga($get['total']); ?></b></td>
			</tr>
		</table>
		</div>
		<div style="float:left;">
			<h4 style="font-family:cursive;">Alamat Customer</h4>
			<?php
			echo "$get_cst[alamat]<br>$provinsi[provinsi_nama] - $kota[kokab_nama] - $kecamatan[nama_kecam]<br>$get_cst[no_handphone]";
			?>
			<br>
			<a href="?azm=order-produk&cst=sementara&del_cst=<?php echo $get['nmr_order'];?>" class="btn btn-danger btn-xs" style="color:white;margin-top:10px;" onclick="return confirm('Yakin Ingin Hapus?')" data-toggle="tooltip" data-placement="bottom" title="Hapus Pesanan Customer Sementara">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</div>
		<div style="float:right;">
			<?php
			echo "<form action='' method='post'>
					Status Pesanan: 
					<select name='status' style='height:35px;'>";
					if ($get['barang_dikirim'] == 0) {
						echo "<option value='0' selected>Menunggu</option>";
						echo "<option value='1'>Dikirim</option>";
						echo "<option value='2'>Dibatalkan</option>";
					}else if ($get['barang_dikirim'] == 1){
						echo "<option value='0'>Menunggu</option>";
						echo "<option value='1' selected>Dikirim</option>";
						echo "<option value='2'>Dibatalkan</option>";
					}else{
						echo "<option value='0'>Menunggu</option>";
						echo "<option value='1'>Dikirim</option>";
						echo "<option value='2' selected>Dibatalkan</option>";
					}
			echo "	</select><br><br>";
			echo "<input type='hidden' name='nmr' value='$get[nmr_order]'>";
			echo "<input type='hidden' name='no_p' value='$get[nmr_produk]'>";
			echo "<input type='hidden' name='qty' value='$get[kuantitas]'>";
			//jika stok produk kurang dari kuantitas produk yang dipesan, maka tombol update akan disabled
			$no = 0;
			for ($i=0; $i<$count_nmr; $i++) {
				$sql_stok = mysqli_query($conn, "SELECT stok AS stock FROM produk WHERE nomor = '".$nmr_produk[$i]."'");
				while ($get_stok = mysqli_fetch_array($sql_stok)) {
					$no++;
					if ($kuantitas[$i] > $get_stok['stock']) {
						$disabled = "disabled='disabled'";
						break;
					}
				}
			}
			echo "<input type='submit' class='btn btn-success' value='Update' name='update$get[nmr_order]' style='float:right;' ".@$disabled.">";
			echo "</form>";
			?>
		</div>
		</p>
	</div>
	<?php
	}
	?>
</div>

<div class="row">
<div class="col-md-offset-2 col-md-8">
<?php
//PAGING
echo "<ul class='pager'>";
if ($halaman > 1) echo  "<li class='previous'><a href='".$_SERVER['PHP_SELF']."?azm=order-produk&cst=sementara&hlm=".($halaman-1)."'>&lt;&lt; Prev</a></li>";

echo "<li><ul class='pagination' style='margin:0px;'>";
for($page = 1; $page <= $tampil_hlm; $page++)
{
     if ((($page >= $halaman - 3) && ($page <= $halaman + 3)) || ($page == 1) || ($page == $haltam)) 
     {
        if ($page == $halaman) echo "<li class='active'><a href='#'>".$page."</a></li> ";
        else echo "<li><a href='".$_SERVER['PHP_SELF']."?azm=order-produk&cst=sementara&hlm=".$page."'>".$page."</a></li>";         
     }
}
echo "</ul></li>";

if ($halaman < $tampil_hlm) echo "<li class='next'><a href='".$_SERVER['PHP_SELF']."?azm=order-produk&cst=sementara&hlm=".($halaman+1)."'>Next &gt;&gt;</a></li>";
echo "</ul>";

echo '</div>'; 
?>
</div>
</div>
<?php
}
//Pesanan Customer Sementara -END-
?>