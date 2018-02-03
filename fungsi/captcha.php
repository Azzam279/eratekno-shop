<?php
$angka1 = rand(0,9);
$angka2 = rand(0,9);
$operator = "tambah kurang kali";
$mtk = explode(" ", $operator);
$nmr = rand(0,2);
if($mtk[$nmr] == "tambah"){
	$hasil1 = $angka1 + $angka2;
	$acak = $angka1." + ".$angka2." = ?";
}else if($mtk[$nmr] == "kurang"){
	$hasil1 = $angka1 - $angka2;
	$acak = $angka1." - ".$angka2." = ?";
}else if($mtk[$nmr] == "kali"){
	$hasil1 = $angka1 * $angka2;
	$acak = $angka1." x ".$angka2." = ?";
}
?>