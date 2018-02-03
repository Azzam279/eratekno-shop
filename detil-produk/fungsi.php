<?php
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
$sql_rating   = "SELECT * FROM vote_star WHERE nmr_produk = '".$detail['nomor']."'";
$query_rating = $connect->query($sql_rating);
$rating 	  = $query_rating->fetch_array();
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

$produk_detil = $host."/detil-produk/?k=".$detail['no_kategori']."&p=".$detail['nomor'];
?>