<?php
$hasil = $_POST['content'] * $_POST['content2'];

if (strlen($hasil) == 6) {
	$cut3 = "";
	$cut2 = substr($hasil, 3,3);
	$cut1 = "Rp ".substr($hasil, 0,3).".";
}else if (strlen($hasil) == 7) {
	$cut3 = substr($hasil, 4,3);
	$cut2 = substr($hasil, 1,3).".";
	$cut1 = "Rp ".substr($hasil, 0,1).".";
}else if (strlen($hasil) == 8) {
	$cut3 = substr($hasil, 5,3);
	$cut2 = substr($hasil, 2,3).".";
	$cut1 = "Rp ".substr($hasil, 0,2).".";
}else if (strlen($hasil) == 9) {
	$cut3 = substr($hasil, 6,3);
	$cut2 = substr($hasil, 3,3).".";
	$cut1 = "Rp ".substr($hasil, 0,3).".";
}else if (strlen($hasil) >= 10) {
	$cut3 = "";
	$cut2 = "";
	$cut1 = "Kebanyakan Coeg! Emang ada duitnya?";
}

if (empty($_POST['content']) || $_POST['content'] == 0) {
	echo "Rp 0";
}else{
	echo $cut1.$cut2.$cut3;
}
 
?>