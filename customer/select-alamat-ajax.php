<?php
if (isset($_POST['pick_city'])) {
	include_once("../koneksi.php");
	$sql_k = mysqli_query($conn, "SELECT * FROM master_kokab WHERE provinsi_id = '".$_POST['pick_city']."'");
	$qry = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_POST['sesi']."'");
	$get = mysqli_fetch_assoc($qry);

	echo '<select name="kota" class="form-control" onchange="pilihKecamatan(this.value,\''.$_POST['sesi'].'\')" required>';

		if (@$_POST['pick_city'] != "") {
			while ($kota = mysqli_fetch_array($sql_k)) {
				if ($get['kota'] == $kota['kota_id']) {
					echo "<option value='$kota[kota_id]' selected>$kota[kokab_nama]</option>";
				}else{
					echo "<option value='$kota[kota_id]'>$kota[kokab_nama]</option>";
				}
			}
		}else{
			echo '<option value="">--Pilih Kota--</option>';
			echo "<script>$('#kcmt').html(\"<select name='kecamatan' class='form-control' required><option value=''>--Pilih Kecamatan--</option></select>\")</script>";
		}

	echo '</select>';

	echo "<script>$('#kcmt').html(\"<select name='kecamatan' id='hpus_kec' class='form-control' disabled='disabled' required><option value='0'>--Pilih Kecamatan--</option></select>\")</script>";
}

if (isset($_POST['pick_kcm'])) {
	include_once("../koneksi.php");
	$sql_c = mysqli_query($conn, "SELECT * FROM master_kecam WHERE kota_id = '".$_POST['pick_kcm']."'");
	$qry2 = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_POST['sesi2']."'");
	$get2 = mysqli_fetch_assoc($qry2);

	echo '<select name="kecamatan" class="form-control" required>';

		if (@$_POST['pick_kcm'] != "") {
			while ($kecam = mysqli_fetch_array($sql_c)) {
				if ($get2['kecamatan'] == $kecam['kecam_id']) {
					echo "<option value='$kecam[kecam_id]'>$kecam[nama_kecam]</option>";
				}else{
					echo "<option value='$kecam[kecam_id]'>$kecam[nama_kecam]</option>";
				}
			}
		}else{
			echo '<option value="">--Pilih Kecamatan--</option>';
		}

	echo '</select>';
}
?>