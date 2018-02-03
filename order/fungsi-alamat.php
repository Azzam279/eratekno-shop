<?php
if (isset($_POST['kota'])) {
	include_once("../koneksi.php");
	$sql_k = mysqli_query($conn, "SELECT * FROM master_kokab WHERE provinsi_id = '".$_POST['kota']."'");

	echo '<select name="kota" class="form-control" onchange="kecam(this.value)" required>';

		if (@$_POST['kota'] != "") {
			while ($kota = mysqli_fetch_array($sql_k)) {
				echo "<option value='$kota[kota_id]'>$kota[kokab_nama]</option>";
			}
		}else{
			echo '<option value="">Pilih Provinsi yang bener Coeg!</option>';
			echo "<script>$('#kecamatan').html(\"<select name='kecamatan' class='form-control' required><option value=''>Pilih Kota yang bener Coeg!</option></select>\")</script>";
		}

	echo '</select>';

	echo "<script>$('#kecamatan').html(\"<select  id='hpus_kec' class='form-control' disabled='disabled' required><option value=''>--Pilih Kecamatan--</option></select>\")</script>";
}

if (isset($_POST['kecam'])) {
	include_once("../koneksi.php");
	$sql_c = mysqli_query($conn, "SELECT * FROM master_kecam WHERE kota_id = '".$_POST['kecam']."'");

	echo '<select name="kecamatan" class="form-control" required>';

		if (@$_POST['kecam'] != "") {
			while ($kecam = mysqli_fetch_array($sql_c)) {
				echo "<option value='$kecam[kecam_id]'>$kecam[nama_kecam]</option>";
			}
		}else{
			echo '<option value="">Pilih Kota yang bener Coeg!</option>';
		}

	echo '</select>';
}
?>