<?php
include_once("$doc/koneksi.php");
include_once("$doc/fungsi/fungsi.php");
$sql_all = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2'");
$all 	 = mysqli_num_rows($sql_all);
?>
<div class="head-isi" >
	<span class="pull-left">Ditampilkan <b>1-16</b> dari <b><?php echo $all;?></b> Produk</span>
	<span class="pull-right" style="width:450px;">
		<span style="float:left;margin:13px 0 0 0;">Urut Berdasarkan :</span> 
		<span style="float:left;margin:8px 5px 8px 5px;">
			<!--<select onchange="sorting(this.options[this.selectedIndex].value);" class="form-control">-->
			
			<?php
			if (isset($_GET['hm']) && isset($_GET['hs']) && isset($_GET['brand'])) {
			?>
			<select onchange="sorting('<?php echo "$host$php_self?ets=pc&hm=$_GET[hm]&hs=$_GET[hs]&brand=$_GET[brand]&sort=";?>'+this.value)" class="form-control">
			<?php
			}else if (@$_GET['hm'] && @$_GET['hs']) {
			?>
			<select onchange="sorting('<?php echo "$host$php_self?ets=pc&hm=$_GET[hm]&hs=$_GET[hs]&sort=";?>'+this.value)" class="form-control">
			<?php
			}else if (isset($_GET['brand'])) {
			?>
			<select onchange="sorting('<?php echo "$host$php_self?ets=pc&brand=$_GET[brand]&sort=";?>'+this.value)" class="form-control">
			<?php
			}else{
			?>
			<select onchange="sorting('<?php echo "$host$php_self?ets=pc&sort=";?>'+this.value)" class="form-control">
			<?php
			}
			?>
				<option value="terbaru" <?php if (@$_GET['sort']=="terbaru"){echo "selected";}?>>Produk Terbaru</option>
				<option value="terpopuler" <?php if (@$_GET['sort']=="terpopuler"){echo "selected";}?>>Produk Terpopuler</option>
				<option value="termahal" <?php if (@$_GET['sort']=="termahal"){echo "selected";}?>>Produk Termahal</option>
				<option value="termurah" <?php if (@$_GET['sort']=="termurah"){echo "selected";}?>>Produk Termurah</option>
				<option value="diskon" <?php if (@$_GET['sort']=="diskon"){echo "selected";}?>>Diskon Tertinggi</option>
			</select>
		</span>
		<span class="pull-right">
			<?php
			include_once("../fungsi-produk.php");
			if (@$_GET['sort'] && @$_GET['brand'] && @$_GET['hm'] && @$_GET['hs'] && @$_GET['halaman']) {
				viewtype("?ets=pc&sort=$_GET[sort]&brand=$_GET[brand]&hm=$_GET[hm]&hs=$_GET[hs]&halaman=$_GET[halaman]");
			}else if (@$_GET['sort'] && @$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
				viewtype("?ets=pc&sort=$_GET[sort]&brand=$_GET[brand]&hm=$_GET[hm]&hs=$_GET[hs]");
			}else if (@$_GET['sort'] && @$_GET['brand'] && @$_GET['halaman']) {
				viewtype("?ets=pc&sort=$_GET[sort]&brand=$_GET[brand]&halaman=$_GET[halaman]");
			}else if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs'] && @$_GET['halaman']) {
				viewtype("?ets=pc&brand=$_GET[brand]&hm=$_GET[hm]&hs=$_GET[hs]&halaman=$_GET[halaman]");
			}else if (@$_GET['sort'] && @$_GET['hm'] && @$_GET['hs'] && @$_GET['halaman']) {
				viewtype("?ets=pc&sort=$_GET[sort]&hm=$_GET[hm]&hs=$_GET[hs]&halaman=$_GET[halaman]");
			}else if (@$_GET['sort'] && @$_GET['brand']) {
				viewtype("?ets=pc&sort=$_GET[sort]&brand=$_GET[brand]");
			}else if (@$_GET['sort'] && @$_GET['halaman']) {
				viewtype("?ets=pc&sort=$_GET[sort]&halaman=$_GET[halaman]");
			}else if (@$_GET['sort'] && @$_GET['hm'] && @$_GET['hs']) {
				viewtype("?ets=pc&sort=$_GET[sort]&hm=$_GET[hm]&hs=$_GET[hs]");
			}else if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
				viewtype("?ets=pc&brand=$_GET[brand]&hm=$_GET[hm]&hs=$_GET[hs]");
			}else if (@$_GET['brand'] && @$_GET['halaman']) {
				viewtype("?ets=pc&brand=$_GET[brand]&halaman=$_GET[halaman]");
			}else if (@$_GET['halaman'] && @$_GET['hm'] && @$_GET['hs']) {
				viewtype("?ets=pc&halaman=$_GET[halaman]&hm=$_GET[hm]&hs=$_GET[hs]");
			}else if (@$_GET['sort']) {
				viewtype("?ets=pc&sort=$_GET[sort]");
			}else if (@$_GET['brand']) {
				viewtype("?ets=pc&brand=$_GET[brand]");
			}else if (@$_GET['hm'] && @$_GET['hs']) {
				viewtype("?ets=pc&hm=$_GET[hm]&hs=$_GET[hs]");
			}else if (@$_GET['halaman']) {
				viewtype("?ets=pc&halaman=$_GET[halaman]");
			}else{
				viewtype("?ets=pc");
			}
			?>
		</span>
	</span>
	<span class="clearfix"></span>
</div>

<div class="clearfix"></div><br>

<div class="well well-small" style="background:white;">
	<div class="row" id="isi">
		<div id='x'></div>
		<span id="error"></span>
		<ul class="nav nav-pills ul-margin" style="list-style:none;" id="main-isi">
			<?php

			if (isset($_GET['brand'])) {
				//mendapatkan jumlah total baris pada table produk
				$record_produk = mysqli_query($conn,"SELECT COUNT('nomor') FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2'");
				//total data yang ditampilkan per-halaman
				$hlm = 16;
				//menghitung total halaman
				$total_hlm = mysqli_result($record_produk, 0, 0);
				//membulatkan total halaman
				$tampil_hlm = ceil($total_hlm / $hlm);
				//jika ada GET maka tampilkan halaman bersangkutan, jika tidak ada GET maka halaman 1
				$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
				//limit dimulai dari baris ke $start_record
				$start_record = ($halaman - 1) * $hlm;
				if (@$_GET['hm'] && $_GET['hs'] && @$_GET['sort']) {
					if ($_GET['sort'] == "terpopuler") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' AND harga_diskon >= '".$_GET['hm']."' AND harga_diskon <= '".$_GET['hs']."' ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else if ($_GET['sort'] == "termahal") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' AND harga_diskon >= '".$_GET['hm']."' AND harga_diskon <= '".$_GET['hs']."' ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else if ($_GET['sort'] == "termurah") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' AND harga_diskon >= '".$_GET['hm']."' AND harga_diskon <= '".$_GET['hs']."' ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else if ($_GET['sort'] == "diskon") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' AND harga_diskon >= '".$_GET['hm']."' AND harga_diskon <= '".$_GET['hs']."' ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' AND harga_diskon >= '".$_GET['hm']."' AND harga_diskon <= '".$_GET['hs']."' ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}
				}else if (@$_GET['hm'] && @$_GET['hs']) {
					$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' AND harga_diskon >= '".$_GET['hm']."' AND harga_diskon <= '".$_GET['hs']."' ORDER BY nomor DESC LIMIT $start_record,$hlm");
				}else if (@$_GET['sort']) {
					if (@$_GET['sort'] == "terpopuler") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "termahal") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "termurah") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "diskon") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' ORDER BY nomor ASC LIMIT $start_record,$hlm");
					}
				}else{
					$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_brand = '".$_GET['brand']."' AND no_kategori = '2' ORDER BY nomor DESC LIMIT $start_record,$hlm");
				}
			}else if(@$_GET['hm'] && @$_GET['hs']) {
				$price1 = $_GET['hm'];
				$price2 = $_GET['hs'];
				//mendapatkan jumlah total baris pada table produk
				$record_produk = mysqli_query($conn,"SELECT COUNT('nomor') FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2");
				//total data yang ditampilkan per-halaman
				$hlm = 16;
				//menghitung total halaman
				$total_hlm = mysqli_result($record_produk, 0, 0);
				//membulatkan total halaman
				$tampil_hlm = ceil($total_hlm / $hlm);
				//jika ada GET maka tampilkan halaman bersangkutan, jika tidak ada GET maka halaman 1
				$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
				//limit dimulai dari baris ke $start_record
				$start_record = ($halaman - 1) * $hlm;
				if (@$_GET['brand'] && @$_GET['sort']) {
					if (@$_GET['sort'] == "terpopuler") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "termahal") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "termurah") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "diskon") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}
				}else if (@$_GET['brand']) {
					$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY nomor DESC LIMIT $start_record,$hlm");
				}else if (@$_GET['sort']) {
					if (@$_GET['sort'] == "terpopuler") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "termahal") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "termurah") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else if (@$_GET['sort'] == "diskon") {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}
				}else{
					$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY nomor DESC LIMIT $start_record,$hlm");
				}
			}else if(@$_GET['sort']) {
				$price1 = @$_GET['hm'];
				$price2 = @$_GET['hs'];
				//mendapatkan jumlah total baris pada table produk
				$record_produk = mysqli_query($conn,"SELECT COUNT('nomor') FROM produk WHERE no_kategori = '2'");
				//total data yang ditampilkan per-halaman
				$hlm = 16;
				//menghitung total halaman
				$total_hlm = mysqli_result($record_produk, 0, 0);
				//membulatkan total halaman
				$tampil_hlm = ceil($total_hlm / $hlm);
				//jika ada GET maka tampilkan halaman bersangkutan, jika tidak ada GET maka halaman 1
				$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
				//limit dimulai dari baris ke $start_record
				$start_record = ($halaman - 1) * $hlm;
				if (@$_GET['sort'] == "terpopuler") {
					if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['brand']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND no_brand = '".$_GET['brand']."' ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' ORDER BY dilihat DESC LIMIT $start_record,$hlm");
					}
				}else if (@$_GET['sort'] == "termahal") {
					if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['brand']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND no_brand = '".$_GET['brand']."' ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' ORDER BY harga_diskon DESC LIMIT $start_record,$hlm");
					}
				}else if (@$_GET['sort'] == "termurah") {
					if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else if (@$_GET['brand']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND no_brand = '".$_GET['brand']."' ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else if (@$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' ORDER BY harga_diskon ASC LIMIT $start_record,$hlm");
					}
				}else if (@$_GET['sort'] == "diskon") {
					if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['brand']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND no_brand = '".$_GET['brand']."' ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' ORDER BY diskon DESC LIMIT $start_record,$hlm");
					}
				}else{
					if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 AND no_brand = '".$_GET['brand']."' ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['brand']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND no_brand = '".$_GET['brand']."' ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}else if (@$_GET['hm'] && @$_GET['hs']) {
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' AND harga_diskon >= $price1 AND harga_diskon <= $price2 ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}else{
						$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' ORDER BY nomor DESC LIMIT $start_record,$hlm");
					}
				}
			}else{
				//mendapatkan jumlah total baris pada table produk
				$record_produk = mysqli_query($conn,"SELECT COUNT('nomor') FROM produk WHERE no_kategori = '2'");
				//total data yang ditampilkan per-halaman
				$hlm = 16;
				//menghitung total halaman
				$total_hlm = mysqli_result($record_produk, 0, 0);
				//membulatkan total halaman
				$tampil_hlm = ceil($total_hlm / $hlm);
				//jika ada GET maka tampilkan halaman bersangkutan, jika tidak ada GET maka halaman 1
				$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
				//limit dimulai dari baris ke $start_record
				$start_record = ($halaman - 1) * $hlm;
				$sql_pc = mysqli_query($conn,"SELECT*FROM produk WHERE no_kategori = '2' ORDER BY nomor DESC LIMIT $start_record,$hlm");
			}

			while ($pc = mysqli_fetch_array($sql_pc)) {
				
				if (empty($pc['diskon']) || $pc['diskon'] == 0) {
					//mendapatkan panjang karakter harga
					if (strlen($pc['harga']) == 6) {
						$harga_d1 = substr($pc['harga'], 3,3);
						$harga_d2 = substr($pc['harga'], 0,3).".";
						$harga_d3 = "";
					}else if(strlen($pc['harga']) == 7) {
						$harga_d1 = substr($pc['harga'], 4,3);
						$harga_d2 = substr($pc['harga'], 1,3).".";
						$harga_d3 = substr($pc['harga'], 0,1).".";
					}else if(strlen($pc['harga']) >= 8) {
						$harga_d1 = substr($pc['harga'], 5,3);
						$harga_d2 = substr($pc['harga'], 2,3).".";
						$harga_d3 = substr($pc['harga'], 0,2).".";
					}
					//harga diskon
					$harga1 = "";
					$harga2 = "";
					$harga3 = "";
					$diskon = '';
				}else{
					//mendapatkan panjang karakter harga
					if (strlen($pc['harga']) == 6) {
						$harga1 = substr($pc['harga'], 3,3);
						$harga2 = substr($pc['harga'], 0,3).".";
						$harga3 = "Rp ";
					}else if(strlen($pc['harga']) == 7) {
						$harga1 = substr($pc['harga'], 4,3);
						$harga2 = substr($pc['harga'], 1,3).".";
						$harga3 = "Rp ".substr($pc['harga'], 0,1).".";
					}else if(strlen($pc['harga']) >= 8) {
						$harga1 = substr($pc['harga'], 5,3);
						$harga2 = substr($pc['harga'], 2,3).".";
						$harga3 = "Rp ".substr($pc['harga'], 0,2).".";
					}
					//mendapatkan panjang karakter harga diskon
					if (strlen($pc['harga_diskon']) == 6) {
						$harga_d1 = substr($pc['harga_diskon'], 3,3);
						$harga_d2 = substr($pc['harga_diskon'], 0,3).".";
						$harga_d3 = "";
					}else if(strlen($pc['harga_diskon']) == 7) {
						$harga_d1 = substr($pc['harga_diskon'], 4,3);
						$harga_d2 = substr($pc['harga_diskon'], 1,3).".";
						$harga_d3 = substr($pc['harga_diskon'], 0,1).".";
					}else if(strlen($pc['harga_diskon']) >= 8) {
						$harga_d1 = substr($pc['harga_diskon'], 5,3);
						$harga_d2 = substr($pc['harga_diskon'], 2,3).".";
						$harga_d3 = substr($pc['harga_diskon'], 0,2).".";
					}
					$diskon = '<span class="badge">'.$pc['diskon'].'%<br>OFF</span>';
				}

				if (strlen($pc['nama_produk']) > 45) {
					$produk_name = substr($pc['nama_produk'], 0,45)." ...";
				}else{
					$produk_name = $pc['nama_produk'];
				}

				//mengambil data dari table vote_star
				$sql_rating   = mysqli_query($conn,"SELECT * FROM vote_star WHERE nmr_produk = '".$pc['nomor']."'");
				$rating 	  = mysqli_fetch_array($sql_rating);
				if ($rating['value'] == "" && $rating['counter'] == "") {
					$rate_result = 0;
				}else{
					$rate_result  = (round($rating['value'] / $rating['counter'],1)) * 20;
				}
				
				//menentukan Rating Star pada produk
				if ($rate_result == 0) {
					$rs = '<div class="product-rating"><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
				}else if ($rate_result <= 20) {
					$rs = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
				}else if($rate_result <= 40) {
					$rs = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
				}else if($rate_result <= 60) {
					$rs = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
				}else if($rate_result <= 80) {
					$rs = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>';
				}else if($rate_result >= 100) {
					$rs = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> </div>';
				}

				//menentukan jumlah rating
				if ($rating['counter'] == "") {
					$counter = 0;
				}else{
					$counter = $rating['counter'];
				}

				//link ke detil produk
				$produk_detil = $host."/detil-produk/?k=".$pc['no_kategori']."&b=".$pc['no_brand']."&p=".$pc['nomor'];

				//memecah nama-nama gambar pada database
				$cut_img = explode(",", $pc['gambar_produk']);

				//menge-cek ketersediaan stok produk
				if ($pc['stok'] > 0) {
					$stoks = "<font color='lime'><b>Tersedia</b></font>";
				}else{
					$stoks = "<font color='red'><b>Kosong</b></font>";
				}

				//mengambil nama brand dari table brand berdasarkan nomor brand
				$sql_brand = mysqli_query($conn,"SELECT * FROM brand WHERE nomor = '".$pc['no_brand']."'");
				$brand 	   = mysqli_fetch_assoc($sql_brand);
			?>
			<?php
			if (@$_GET['viewType'] == "listView") {
			?>
			<li class="col-md-12">
				<table class="table product-box-new">
					<tr>
					<td style="padding:0px;">
					<a href="<?php echo $produk_detil;?>" title="<?php echo $pc['nama_produk']; ?>">
						<table>
						<tr>
						<td width="220">
							<a href="<?php echo $produk_detil;?>">
							<img src="<?php echo $host."/image/produk/".$cut_img[0];?>" alt="image" class="img-responsive" style="width:100%;" />
							</a>
						</td>
						<td width="432">
							<p><?php echo $produk_name; ?></p>
							<span style="font-size:13px;">
							<?php
							$length = strlen($pc['info']);
							$info1 = substr($pc['info'], 0,20);
							$info2 = substr($pc['info'], 20,$length);
							echo $info1.": ";
							echo strip_tags($info2);
							?></span>
						</td>
						</tr>
						</table>
					</a>
					</td>
					<td style="vertical-align:middle;padding-left:10px;" width="140" align="center">
						<div style="text-decoration:line-through;color:#A5A5A5;font-size:13px;"><?php echo $harga3.$harga2.$harga1; ?></div>
						<div style="margin-bottom:5px;color:red;font-weight:bold;">Rp <?php echo $harga_d3.$harga_d2.$harga_d1; ?></div>
						<div><?php echo $diskon; ?></div><br>
						<?php
						if ($pc['stok'] == 0) {
							echo '<a data-target="#beli'.$pc['nomor'].'" data-toggle="modal" class="btn btn-block">BELI SEKARANG</a>';
						}else{
						?>
						<a data-target="#beli<?php echo $pc['nomor'];?>" data-toggle="modal" class="btn btn-block" onclick="addProduk('<?php echo $pc['nomor'];?>','<?php echo $sesi_email;?>','<?php echo $pc['harga_diskon'];?>','<?php echo $pc['stok'];?>','<?php echo $sesi_ip;?>')">BELI SEKARANG</a>
						<?php
						}
						?>
						<form action="../lanjut-ke-pembayaran.php" method="post">
						<div id="beli<?php echo $pc['nomor'];?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg" style="margin-top:80px;">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
										<center><h3 class="hub"><b>EraTekno-Shop</b></h3></center>
									</div>
									<div class="modal-body">
										<table>
											<thead>
											<tr style="font-weight:bold;font-size:18px;">
												<td align="center">Produk</td>
												<td align="center">Nama Produk</td>
												<td align="center">Harga</td>
												<td align="center">Kuantitas</td>
												<td align="center">Subtotal</td>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td width="150" align="center" style="padding-left:15px;">
													<img src="<?php echo $host."/image/produk/".$cut_img[0];?>">
												</td>
												<td width="260" style="padding-right:5px;">
													<strong><?php echo ucfirst($pc['nama_produk']); ?></strong><br>
													Brand: <?php echo ucfirst($brand['nama']); ?><br><br>
													<?php
													if (isset($_SESSION['email'])) {
													?>
													<a href="<?php echo $host.$request_uri;?>" class="a-hover" onclick="addWishlist('<?php echo $pc['nomor'];?>');">Tambahkan ke Wishlist</a>
													<?php
													}else{
													?>
													<a href="#" class="a-hover" data-toggle="tooltip" data-placement="bottom" title="Anda harus login terlebih dahulu">Tambahkan ke Wishlist</a>
													<?php	
													}
													?>
												</td>
												<td width="180" style="padding-left:5px;" align="center">
													<table cellpadding="5" class="tabel-p">
														<tr><td style="text-decoration:line-through;color:#C3C3C3;"><?php echo $harga3.$harga2.$harga1;?></td></tr>
														<tr><td>Rp <?php echo $harga_d3.$harga_d2.$harga_d1;?></td></tr>
														<tr><td><b>Diskon <?php echo $pc['diskon'];?>%<b><td></tr>
													</table>
												</td>
												<td width="100" style="padding-left:6px;" align="center">
													<select class="form-control" name="kuantitas" id="val<?php echo $pc['nomor']; ?>" onchange="hitung('val<?php echo $pc['nomor']; ?>','<?php echo $pc['harga_diskon']; ?>','<?php echo $pc['nomor']; ?>')" style="width:70px;">
														<?php 
														for ($t=1;$t<=$pc['stok'];$t++) {
															echo "<option value='$t'>".$t."</option>";
														}
														?>
													</select>
													<input type="hidden" name="nmr_product" value="<?php echo $pc['nomor']; ?>">
													<input type="hidden" name="subtotal" value="<?php echo $pc['harga_diskon']; ?>">
												</td>
												<td align="center" width="140">
													<span id="hasil<?php echo $pc['nomor']; ?>">
													Rp <?php echo $harga_d3.$harga_d2.$harga_d1;?>
													</span>
												</td>
											</tr>
											<tr>
												<td style="border-top:solid 1px grey;padding-top:5px;">
												Stok : <font color="lime"><?php echo $stoks; ?></font>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
									<div class="modal-footer">
										<?php
										if ($pc['stok'] == 0) {
										?>
										<button class="btn btn-default" id="btn-proses" disabled="disabled"><span class="glyphicon glyphicon-shopping-cart"></span> Lanjut ke Pembayaran</button>
										<?php
										}else{
										?>
										<button class="btn btn-default" id="btn-proses" type="submit" name="bayar" value="bayar"><span class="glyphicon glyphicon-shopping-cart"></span> Lanjut ke Pembayaran</button>
										<?php
										}
										?>
										<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
									</div>
								</div>
							</div>
						</div>
						</form>
					</td>
					</tr>
				</table>
			</li>
			<?php
			}else{
			?>
			<li class="col-lg-3 col-md-3 col-sm-12">
				<div class="thumbnail product-box-new">
					<a href="<?php echo $produk_detil;?>" class="tag-disc"><?php echo $diskon; ?></a>
					<a href="<?php echo $produk_detil;?>" title="<?php echo $pc['nama_produk']; ?>"><img src="<?php echo $host."/image/produk/".$cut_img[0];?>" alt="image" class="img-responsive" />
					<p><?php echo $produk_name; ?></p></a>
					<?php echo $rs; ?>
					<small><span class="rating-pull-right mute">(<?php echo $counter; ?> rating)</span></small>
					<h6><?php echo $harga3.$harga2.$harga1; ?></h6>
					<h4><label class="label label-success">Rp <?php echo $harga_d3.$harga_d2.$harga_d1; ?></label></h4>
					<?php
					if ($pc['stok'] == 0) {
						echo '<a data-target="#beli'.$pc['nomor'].'" data-toggle="modal" class="btn btn-block">BELI SEKARANG</a>';
					}else{
					?>
					<a data-target="#beli<?php echo $pc['nomor'];?>" data-toggle="modal" class="btn btn-block" onclick="addProduk('<?php echo $pc['nomor'];?>','<?php echo $sesi_email;?>','<?php echo $pc['harga_diskon'];?>','<?php echo $pc['stok'];?>','<?php echo $sesi_ip;?>')">BELI SEKARANG</a>
					<?php
					}
					?>
					<form action="../lanjut-ke-pembayaran.php" method="post">
					<div id="beli<?php echo $pc['nomor'];?>" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg" style="margin-top:80px;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<center><h3 class="hub"><b>EraTekno-Shop</b></h3></center>
								</div>
								<div class="modal-body">
									<table>
										<thead>
										<tr style="font-weight:bold;font-size:18px;">
											<td align="center">Produk</td>
											<td align="center">Nama Produk</td>
											<td align="center">Harga</td>
											<td align="center">Kuantitas</td>
											<td align="center">Subtotal</td>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td width="150" align="center" style="padding-left:15px;">
												<img src="<?php echo $host."/image/produk/".$cut_img[0];?>">
											</td>
											<td width="260" style="padding-right:5px;">
												<strong><?php echo ucfirst($pc['nama_produk']); ?></strong><br>
												Brand: <?php echo ucfirst($brand['nama']); ?><br><br>
												<?php
												if (isset($_SESSION['email'])) {
												?>
												<a href="<?php echo $host.$request_uri;?>" class="a-hover" onclick="addWishlist('<?php echo $pc['nomor'];?>');">Tambahkan ke Wishlist</a>
												<?php
												}else{
												?>
												<a href="#" class="a-hover" data-toggle="tooltip" data-placement="bottom" title="Anda harus login terlebih dahulu">Tambahkan ke Wishlist</a>
												<?php	
												}
												?>
											</td>
											<td width="180" style="padding-left:5px;" align="center">
												<table cellpadding="5" class="tabel-p">
													<tr><td style="text-decoration:line-through;color:#C3C3C3;"><?php echo $harga3.$harga2.$harga1;?></td></tr>
													<tr><td>Rp <?php echo $harga_d3.$harga_d2.$harga_d1;?></td></tr>
													<tr><td><b>Diskon <?php echo $pc['diskon'];?>%<b><td></tr>
												</table>
											</td>
											<td width="100" style="padding-left:6px;" align="center">
												<select class="form-control" name="kuantitas" id="val<?php echo $pc['nomor']; ?>" onchange="hitung('val<?php echo $pc['nomor']; ?>','<?php echo $pc['harga_diskon']; ?>','<?php echo $pc['nomor']; ?>')" style="width:70px;">
													<?php 
													for ($t=1;$t<=$pc['stok'];$t++) {
														echo "<option value='$t'>".$t."</option>";
													}
													?>
												</select>
												<input type="hidden" name="nmr_product" value="<?php echo $pc['nomor']; ?>">
												<input type="hidden" name="subtotal" value="<?php echo $pc['harga_diskon']; ?>">
											</td>
											<td align="center" width="140">
												<span id="hasil<?php echo $pc['nomor']; ?>">
												Rp <?php echo $harga_d3.$harga_d2.$harga_d1;?>
												</span>
											</td>
										</tr>
										<tr>
											<td style="border-top:solid 1px grey;padding-top:5px;">
											Stok : <font color="lime"><?php echo $stoks; ?></font>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<?php
									if ($pc['stok'] == 0) {
									?>
									<button class="btn btn-default" id="btn-proses" disabled="disabled"><span class="glyphicon glyphicon-shopping-cart"></span> Lanjut ke Pembayaran</button>
									<?php
									}else{
									?>
									<button class="btn btn-default" type="submit" id="btn-proses" name="bayar" value="bayar"><span class="glyphicon glyphicon-shopping-cart"></span> Lanjut ke Pembayaran</button>
									<?php
									}
									?>
									<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</li>
			<?php
				}
			}
			?>
		</ul>
		<div class="clearfix"></div>
		<hr/>
<?php

//PAGING
echo "<div class='row'>";
echo "<div class='col-md-8'>";
include_once("../paging.php");
if (@$_GET['sort'] && @$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
	paging("?ets=pc&sort=$_GET[sort]&brand=$_GET[brand]&hm=$_GET[hm]&hs=$_GET[hs]",$halaman,$tampil_hlm,$tampil_hlm);
}else if (@$_GET['sort'] && @$_GET['brand']) {
	paging("?ets=pc&sort=$_GET[sort]&brand=$_GET[brand]",$halaman,$tampil_hlm,$tampil_hlm);
}else if (@$_GET['sort'] && @$_GET['hm'] && @$_GET['hs']) {
	paging("?ets=pc&sort=$_GET[sort]&hm=$_GET[hm]&hs=$_GET[hs]",$halaman,$tampil_hlm,$tampil_hlm);
}else if (@$_GET['brand'] && @$_GET['hm'] && @$_GET['hs']) {
	paging("?ets=pc&brand=$_GET[brand]&hm=$_GET[hm]&hs=$_GET[hs]",$halaman,$tampil_hlm,$tampil_hlm);
}else if (@$_GET['sort']) {
	paging("?ets=pc&sort=$_GET[sort]",$halaman,$tampil_hlm,$tampil_hlm);
}else if (@$_GET['brand']) {
	paging("?ets=pc&brand=$_GET[brand]",$halaman,$tampil_hlm,$tampil_hlm);
}else if (@$_GET['hm'] && @$_GET['hs']) {
	paging("?ets=pc&hm=$_GET[hm]&hs=$_GET[hs]",$halaman,$tampil_hlm,$tampil_hlm);
}else{
	echo "<ul class='pager'>";
	if ($halaman > 1) echo  "<li class='previous'><a href='".$_SERVER['PHP_SELF']."?ets=pc&halaman=".($halaman-1)."'><i class='glyphicon glyphicon-menu-left'></i> Prev</a></li>";

	echo "<li><ul class='pagination' style='margin:0px;'>";
	for($page = 1; $page <= $tampil_hlm; $page++)
	{
	     if ((($page >= $halaman - 3) && ($page <= $halaman + 3)) || ($page == 1) || ($page == $tampil_hlm)) 
	     {
	        if ($page == $halaman) echo "<li class='active'><a href='#'>".$page."</a></li> ";
	        else echo "<li><a href='".$_SERVER['PHP_SELF']."?ets=pc&halaman=".$page."'>".$page."</a></li>";         
	     }
	}
	echo "</ul></li>";

	if ($halaman < $tampil_hlm) echo "<li class='next'><a href='".$_SERVER['PHP_SELF']."?ets=pc&halaman=".($halaman+1)."'>Next <i class='glyphicon glyphicon-menu-right'></i></a></li>";
	echo "</ul>";
}
echo "</div>";

//PAGING SELECT
echo "<div class='col-md-4'>";
	echo "<div class='pull-right' style='margin-top:20px;margin-right:20px;'>";
		echo "Halaman: &nbsp;";
		echo "<select style='height:30px;width:55px;' onchange='paging(\"$host$php_self?ets=pc&halaman=\"+this.value);'>";

		for ($ps=1;$ps<=$tampil_hlm;$ps++) {
			if (@$_GET['halaman'] == $ps) {
				echo "<option value='$ps' selected>$ps</option>";
			}else{
				echo "<option value='$ps'>$ps</option>";
			}
		}

		echo "</select>";
	echo "</div>";
echo "</div>";
echo "</div>";
?>
	</div>
</div>
