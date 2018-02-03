<?php
if(@$_GET['do']=='rate'){
	// do rate
	rate();
}else if(@$_GET['do']=='getrate'){
	//$nmr = $_GET['p'];
	include_once("../koneksi.php");
	$sql = mysqli_query($conn,"SELECT * FROM vote_star WHERE nmr_produk = '".$_GET['nmr']."'");
	$rs = mysqli_fetch_array($sql);
	// set width of star
	$rating = (round($rs['value'] / $rs['counter'],1)) * 20; 
	echo $rating;
}


// function to insert rating
function rate(){
include_once("../koneksi.php");
	$x	  = explode(".", $_GET['rating']);
	//$text = strip_tags($_GET['rating']);

	$sql_cek = mysqli_query($conn,"SELECT * FROM vote_star WHERE nmr_produk = '".$x[1]."' ");
	$cek = mysqli_num_rows($sql_cek);

	if ($cek == 0) {
		mysqli_query($conn,"INSERT INTO vote_star VALUES(null,'1','".$x[0]."','".$x[1]."')");
	}else{
		$update = mysqli_query($conn,"UPDATE vote_star SET counter = counter + 1, value = value + ".$x[0].", nmr_produk = ".$x[1]." WHERE nmr_produk = '".$x[1]."' ");
 
		if (@mysql_affected_rows() == 0) {
			$insert = mysqli_query($conn,"INSERT INTO vote_star (nmr_star,counter,value,nmr_produk) VALUES (null,'1','".$x[0]."','".$x[1]."')");
		}
	}
}

?>