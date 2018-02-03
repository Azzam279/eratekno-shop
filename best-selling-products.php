<!-- Best Selling Products -->
<div class="well well-small" style="padding:5px auto;background:white;">
	<div class="row-fluid">
		<div id="best_produk" class="carousel slide" data-ride="carousel" data-interval="3500">
			<h4 class="title">
				<span class="pull-left"><span class="text"><span class="line">Produk <strong>Terlaris</strong></span></span></span>
				<span class="pull-right">
					<a class="left button" href="#best_produk" data-slide="prev"></a>
					<a class="right button" href="#best_produk" data-slide="next"></a>
				</span>
			</h4>
			<div class="row carousel-inner">
				<div class="item active">
					<ul class="dtl-products">
					<?php
$sql_related = mysqli_query($conn,"SELECT * FROM produk ORDER BY terjual DESC LIMIT 0,4");

while ($detail = mysqli_fetch_assoc($sql_related)) {

if (empty($detail['diskon']) || $detail['diskon'] == 0) {
	//mendapatkan panjang karakter harga
	if (strlen($detail['harga']) == 6) {
		$harga_d_1 = substr($detail['harga'], 3,3);
		$harga_d_2 = substr($detail['harga'], 0,3).".";
		$harga_d_3 = "";
	}else if(strlen($detail['harga']) == 7) {
		$harga_d_1 = substr($detail['harga'], 4,3);
		$harga_d_2 = substr($detail['harga'], 1,3).".";
		$harga_d_3 = substr($detail['harga'], 0,1).".";
	}else if(strlen($detail['harga']) >= 8) {
		$harga_d_1 = substr($detail['harga'], 5,3);
		$harga_d_2 = substr($detail['harga'], 2,3).".";
		$harga_d_3 = substr($detail['harga'], 0,2).".";
	}
	//harga diskon
	$harga1 = "";
	$harga2 = "";
	$harga3 = "";
	$diskon = '';
}else{
	//mendapatkan panjang karakter harga
	if (strlen($detail['harga']) == 6) {
		$harga1 = substr($detail['harga'], 3,3);
		$harga2 = substr($detail['harga'], 0,3).".";
		$harga3 = "Rp ";
	}else if(strlen($detail['harga']) == 7) {
		$harga1 = substr($detail['harga'], 4,3);
		$harga2 = substr($detail['harga'], 1,3).".";
		$harga3 = "Rp ".substr($detail['harga'], 0,1).".";
	}else if(strlen($detail['harga']) >= 8) {
		$harga1 = substr($detail['harga'], 5,3);
		$harga2 = substr($detail['harga'], 2,3).".";
		$harga3 = "Rp ".substr($detail['harga'], 0,2).".";
	}
	//mendapatkan panjang karakter harga diskon
	if (strlen($detail['harga_diskon']) == 6) {
		$harga_d_1 = substr($detail['harga_diskon'], 3,3);
		$harga_d_2 = substr($detail['harga_diskon'], 0,3).".";
		$harga_d_3 = "";
	}else if(strlen($detail['harga_diskon']) == 7) {
		$harga_d_1 = substr($detail['harga_diskon'], 4,3);
		$harga_d_2 = substr($detail['harga_diskon'], 1,3).".";
		$harga_d_3 = substr($detail['harga_diskon'], 0,1).".";
	}else if(strlen($detail['harga_diskon']) >= 8) {
		$harga_d_1 = substr($detail['harga_diskon'], 5,3);
		$harga_d_2 = substr($detail['harga_diskon'], 2,3).".";
		$harga_d_3 = substr($detail['harga_diskon'], 0,2).".";
	}
	$diskon = '<span class="badge">'.$detail['diskon'].'%<br>OFF</span>';
}

if (strlen($detail['nama_produk']) > 45) {
	$produk_name = substr($detail['nama_produk'], 0,45)." ...";
}else{
	$produk_name = $detail['nama_produk'];
}

//mengambil data dari table vote_star
$sql_rating   = mysqli_query($conn,"SELECT * FROM vote_star WHERE nmr_produk = '".$detail['nomor']."'");
$rating 	  = mysqli_fetch_array($sql_rating);
//jika rating kosong
if ($rating['value'] == "" && $rating['counter'] == "") {
	$rate_result = 0;
//jika ada rating
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

//link produk detail
$produk_detil = $host."/detil-produk/?k=".$detail['no_kategori']."&b=".$detail['no_brand']."&p=".$detail['nomor'];

//memecah nama-nama gambar pada database
$ex_img = explode(",", $detail['gambar_produk']);
//menghitung jumlah gambar yg telah dipecah
$total_img = count($ex_img);					
					?>
						<li class="col-md-3 col-sm-3">
							<div class="product-box">
								<a href="<?php echo $produk_detil;?>" class="tag-disc"><?php echo $diskon; ?></a>
								<a href="<?php echo $produk_detil;?>"><img alt="" src="<?php echo $host."/image/produk/".$ex_img[0];?>">
								<p><?php echo $produk_name; ?></p></a>
								<?php echo $rs; ?>
								<small><span class="mute">(<?php echo $counter; ?> rating)</span></small>
								<h6><?php echo $harga3.$harga2.$harga1; ?></h6>
								<h4><label class="label label-success">Rp <?php echo $harga_d_3.$harga_d_2.$harga_d_1; ?></label></h4>
							</div>
						</li>
<?php 
}
?>
					</ul>
				</div>
				<div class="item">
					<ul class="dtl-products">
					<?php
$sql_related2 = mysqli_query($conn,"SELECT * FROM produk ORDER BY terjual DESC LIMIT 4,4");

while ($detail2 = mysqli_fetch_assoc($sql_related2)) {

if (empty($detail2['diskon']) || $detail2['diskon'] == 0) {
	//mendapatkan panjang karakter harga
	if (strlen($detail2['harga']) == 6) {
		$harga_d_1_1 = substr($detail2['harga'], 3,3);
		$harga_d_2_2 = substr($detail2['harga'], 0,3).".";
		$harga_d_3_3 = "";
	}else if(strlen($detail2['harga']) == 7) {
		$harga_d_1_1 = substr($detail2['harga'], 4,3);
		$harga_d_2_2 = substr($detail2['harga'], 1,3).".";
		$harga_d_3_3 = substr($detail2['harga'], 0,1).".";
	}else if(strlen($detail2['harga']) >= 8) {
		$harga_d_1_1 = substr($detail2['harga'], 5,3);
		$harga_d_2_2 = substr($detail2['harga'], 2,3).".";
		$harga_d_3_3 = substr($detail2['harga'], 0,2).".";
	}
	//harga diskon
	$harga1_1 = "";
	$harga2_2 = "";
	$harga3_3 = "";
	$diskon2 = '';
}else{
	//mendapatkan panjang karakter harga
	if (strlen($detail2['harga']) == 6) {
		$harga1_1 = substr($detail2['harga'], 3,3);
		$harga2_2 = substr($detail2['harga'], 0,3).".";
		$harga3_3 = "Rp ";
	}else if(strlen($detail2['harga']) == 7) {
		$harga1_1 = substr($detail2['harga'], 4,3);
		$harga2_2 = substr($detail2['harga'], 1,3).".";
		$harga3_3 = "Rp ".substr($detail2['harga'], 0,1).".";
	}else if(strlen($detail2['harga']) >= 8) {
		$harga1_1 = substr($detail2['harga'], 5,3);
		$harga2_2 = substr($detail2['harga'], 2,3).".";
		$harga3_3 = "Rp ".substr($detail2['harga'], 0,2).".";
	}
	//mendapatkan panjang karakter harga diskon
	if (strlen($detail2['harga_diskon']) == 6) {
		$harga_d_1_1 = substr($detail2['harga_diskon'], 3,3);
		$harga_d_2_2 = substr($detail2['harga_diskon'], 0,3).".";
		$harga_d_3_3 = "";
	}else if(strlen($detail2['harga_diskon']) == 7) {
		$harga_d_1_1 = substr($detail2['harga_diskon'], 4,3);
		$harga_d_2_2 = substr($detail2['harga_diskon'], 1,3).".";
		$harga_d_3_3 = substr($detail2['harga_diskon'], 0,1).".";
	}else if(strlen($detail2['harga_diskon']) >= 8) {
		$harga_d_1_1 = substr($detail2['harga_diskon'], 5,3);
		$harga_d_2_2 = substr($detail2['harga_diskon'], 2,3).".";
		$harga_d_3_3 = substr($detail2['harga_diskon'], 0,2).".";
	}
	$diskon2 = '<span class="badge">'.$detail2['diskon'].'%<br>OFF</span>';
}

if (strlen($detail2['nama_produk']) > 45) {
	$produk_name2 = substr($detail2['nama_produk'], 0,45)." ...";
}else{
	$produk_name2 = $detail2['nama_produk'];
}

//mengambil data dari table vote_star
$sql_rating2   = mysqli_query($conn,"SELECT * FROM vote_star WHERE nmr_produk = '".$detail2['nomor']."'");
$rating2 	   = mysqli_fetch_array($sql_rating2);
//jika rating kosong
if ($rating2['value'] == "" && $rating2['counter'] == "") {
	$rate_result2 = 0;
//jika ada rating
}else{
	$rate_result2 = (round($rating2['value'] / $rating2['counter'],1)) * 20;
}

//menentukan Rating Star pada produk
if ($rate_result2 == 0) {
	$rs2 = '<div class="product-rating"><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if ($rate_result2 <= 20) {
	$rs2 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result2 <= 40) {
	$rs2 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result2 <= 60) {
	$rs2 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result2 <= 80) {
	$rs2 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result2 >= 100) {
	$rs2 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> </div>';
}

//menentukan jumlah rating
if ($rating2['counter'] == "") {
	$counter2 = 0;
}else{
	$counter2 = $rating2['counter'];
}

//link produk detail
$produk_detil2 = $host."/detil-produk/?k=".$detail2['no_kategori']."&b=".$detail2['no_brand']."&p=".$detail2['nomor'];

//memecah nama-nama gambar pada database
$ex_img2 = explode(",", $detail2['gambar_produk']);
//menghitung jumlah gambar yg telah dipecah
$total_img2 = count($ex_img2);
					?>
						<li class="col-md-3 col-sm-3">
							<div class="product-box">
								<a href="<?php echo $produk_detil2;?>" class="tag-disc"><?php echo $diskon2; ?></a>
								<a href="<?php echo $produk_detil2;?>"><img alt="" src="<?php echo $host."/image/produk/".$ex_img2[0];?>">
								<p><?php echo $produk_name2; ?></p></a>
								<?php echo $rs2; ?>
								<small><span class="mute">(<?php echo $counter2; ?> rating)</span></small>
								<h6><?php echo $harga3_3.$harga2_2.$harga1_1; ?></h6>
								<h4><label class="label label-success">Rp <?php echo $harga_d_3_3.$harga_d_2_2.$harga_d_1_1; ?></label></h4>
							</div>
						</li>
						<?php
}
						?>
					</ul>
				</div>
				<div class="item">
					<ul class="dtl-products">
					<?php
$sql_related3 = mysqli_query($conn,"SELECT * FROM produk ORDER BY terjual DESC LIMIT 8,4");

while ($detail3 = mysqli_fetch_assoc($sql_related3)) {

if (empty($detail3['diskon']) || $detail3['diskon'] == 0) {
	//mendapatkan panjang karakter harga
	if (strlen($detail3['harga']) == 6) {
		$harga_d_1_1_1 = substr($detail3['harga'], 3,3);
		$harga_d_2_2_2 = substr($detail3['harga'], 0,3).".";
		$harga_d_3_3_3 = "";
	}else if(strlen($detail3['harga']) == 7) {
		$harga_d_1_1_1 = substr($detail3['harga'], 4,3);
		$harga_d_2_2_2 = substr($detail3['harga'], 1,3).".";
		$harga_d_3_3_3 = substr($detail3['harga'], 0,1).".";
	}else if(strlen($detail3['harga']) >= 8) {
		$harga_d_1_1_1 = substr($detail3['harga'], 5,3);
		$harga_d_2_2_2 = substr($detail3['harga'], 2,3).".";
		$harga_d_3_3_3 = substr($detail3['harga'], 0,2).".";
	}
	//harga diskon
	$harga1_1_1 = "";
	$harga2_2_2 = "";
	$harga3_3_3 = "";
	$diskon3 = '';
}else{
	//mendapatkan panjang karakter harga
	if (strlen($detail3['harga']) == 6) {
		$harga1_1_1 = substr($detail3['harga'], 3,3);
		$harga2_2_2 = substr($detail3['harga'], 0,3).".";
		$harga3_3_3 = "Rp ";
	}else if(strlen($detail3['harga']) == 7) {
		$harga1_1_1 = substr($detail3['harga'], 4,3);
		$harga2_2_2 = substr($detail3['harga'], 1,3).".";
		$harga3_3_3 = "Rp ".substr($detail3['harga'], 0,1).".";
	}else if(strlen($detail3['harga']) >= 8) {
		$harga1_1_1 = substr($detail3['harga'], 5,3);
		$harga2_2_2 = substr($detail3['harga'], 2,3).".";
		$harga3_3_3 = "Rp ".substr($detail3['harga'], 0,2).".";
	}
	//mendapatkan panjang karakter harga diskon
	if (strlen($detail3['harga_diskon']) == 6) {
		$harga_d_1_1_1 = substr($detail3['harga_diskon'], 3,3);
		$harga_d_2_2_2 = substr($detail3['harga_diskon'], 0,3).".";
		$harga_d_3_3_3 = "";
	}else if(strlen($detail3['harga_diskon']) == 7) {
		$harga_d_1_1_1 = substr($detail3['harga_diskon'], 4,3);
		$harga_d_2_2_2 = substr($detail3['harga_diskon'], 1,3).".";
		$harga_d_3_3_3 = substr($detail3['harga_diskon'], 0,1).".";
	}else if(strlen($detail3['harga_diskon']) >= 8) {
		$harga_d_1_1_1 = substr($detail3['harga_diskon'], 5,3);
		$harga_d_2_2_2 = substr($detail3['harga_diskon'], 2,3).".";
		$harga_d_3_3_3 = substr($detail3['harga_diskon'], 0,2).".";
	}
	$diskon3 = '<span class="badge">'.$detail3['diskon'].'%<br>OFF</span>';
}

if (strlen($detail3['nama_produk']) > 45) {
	$produk_name3 = substr($detail3['nama_produk'], 0,45)." ...";
}else{
	$produk_name3 = $detail3['nama_produk'];
}

//mengambil data dari table vote_star
$sql_rating3   = mysqli_query($conn,"SELECT * FROM vote_star WHERE nmr_produk = '".$detail3['nomor']."'");
$rating3	   = mysqli_fetch_array($sql_rating3);
//jika rating kosong
if ($rating3['value'] == "" && $rating3['counter'] == "") {
	$rate_result3 = 0;
//jika ada rating
}else{
	$rate_result3 = (round($rating3['value'] / $rating3['counter'],1)) * 20;
}

//menentukan Rating Star pada produk
if ($rate_result3 == 0) {
	$rs3 = '<div class="product-rating"><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if ($rate_result3 <= 20) {
	$rs3 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result3 <= 40) {
	$rs3 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result3 <= 60) {
	$rs3 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result3 <= 80) {
	$rs3 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>';
}else if($rate_result3 >= 100) {
	$rs3 = '<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> </div>';
}

//menentukan jumlah rating
if ($rating3['counter'] == "") {
	$counter3 = 0;
}else{
	$counter3 = $rating3['counter'];
}

//link produk detail
$produk_detil3 = $host."/detil-produk/?k=".$detail3['no_kategori']."&b=".$detail3['no_brand']."&p=".$detail3['nomor'];

//memecah nama-nama gambar pada database
$ex_img3 = explode(",", $detail3['gambar_produk']);
//menghitung jumlah gambar yg telah dipecah
$total_img3 = count($ex_img3);
					?>
						<li class="col-md-3 col-sm-3">
							<div class="product-box">
								<a href="<?php echo $produk_detil3;?>" class="tag-disc"><?php echo $diskon3; ?></a>
								<a href="<?php echo $produk_detil3;?>"><img alt="" src="<?php echo $host."/image/produk/".$ex_img3[0];?>">
								<p><?php echo $produk_name3; ?></p></a>
								<?php echo $rs3; ?>
								<small><span class="mute">(<?php echo $counter3; ?> rating)</span></small>
								<h6><?php echo $harga3_3_3.$harga2_2_2.$harga1_1_1; ?></h6>
								<h4><label class="label label-success">Rp <?php echo $harga_d_3_3_3.$harga_d_2_2_2.$harga_d_1_1_1; ?></label></h4>
							</div>
						</li>
						<?php
}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>