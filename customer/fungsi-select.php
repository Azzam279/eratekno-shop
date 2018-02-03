<?php
function pvs() {
require dirname(__FILE__)."/koneksi.php";
$qry = mysqli_query($conn,"SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
$get = mysqli_fetch_assoc($qry);
$sql_p = mysqli_query($conn,"SELECT * FROM master_provinsi");
echo "<select name='provinsi' class='form-control' id='pro' onchange='pilihKota(this.value,\"$_SESSION[email]\")'>";

while ($x = mysqli_fetch_assoc($sql_p)) {
	if ($x['provinsi_id'] == $get['provinsi']) {
		echo "<option value='".$x['provinsi_id']."' selected>".$x['provinsi_nama']."</option>";
	}else{
		echo "<option value='".$x['provinsi_id']."'>".$x['provinsi_nama']."</option>";
	}
}
echo "</select>";
}

function kt() {
require dirname(__FILE__)."/koneksi.php";
$qry = mysqli_query($conn,"SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
$get = mysqli_fetch_assoc($qry);
$sql_k = mysqli_query($conn,"SELECT * FROM master_kokab");
echo "<div id='ko'>";
echo "<select class='form-control' disabled='disabled'>";
while ($y = mysqli_fetch_assoc($sql_k)) {
	if ($y['kota_id'] == $get['kota']) {
		echo "<option value='".$y['kota_id']."' selected>".$y['kokab_nama']."</option>";
	}else{
		echo "<option value='".$y['kota_id']."'>".$y['kokab_nama']."</option>";
	}
}
echo "</select>";
echo "<input type='hidden' value='".$get['kota']."' name='kota'>";
echo "</div>";
}

function kcm() {
require dirname(__FILE__)."/koneksi.php";
$qry = mysqli_query($conn,"SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
$get = mysqli_fetch_assoc($qry);
$sql_kc= mysqli_query($conn,"SELECT * FROM master_kecam WHERE kota_id = '".$get['kota']."'");
echo "<div id='kec'>";
echo "<select class='form-control' disabled='disabled'>";
while ($z = mysqli_fetch_assoc($sql_kc)) {
	if ($z['kecam_id'] == $get['kecamatan']) {
		echo "<option value='".$z['kecam_id']."' selected>".$z['nama_kecam']."</option>";
	}else{
		echo "<option value='".$z['kecam_id']."'>".$z['nama_kecam']."</option>";
	}
}
echo "</select>";
echo "<input type='hidden' value='".$get['kecamatan']."' name='kecamatan'>";
echo "</div>";
}
?>