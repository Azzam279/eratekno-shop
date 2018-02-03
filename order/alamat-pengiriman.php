<h2>&nbsp;&nbsp;&nbsp;ALAMAT PENGIRIMAN <span class="pull-right" style="font-size:13px;"><font color="red">*</font> wajib diisi</span></h2><hr/>
<?php
include_once("$doc/koneksi.php");

if (isset($_POST['lanjut'])) {
	if (!preg_match("/^[\w .]*$/", $_POST['alamat'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Alamat harus berupa Alfabet/Angka!</b></div>";
	}else if (!preg_match("/^[0-9]*$/", $_POST['hp'])) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>No Handphone harus berupa Angka!</b></div>";
	}else if (strlen($_POST['hp']) > 13) {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>No Handphone maksimal 13 digit angka!</b></div>";
	}else if (@$_POST['provinsi']=="" || @$_POST['kota']=="" || @$_POST['kecamatan']=="") {
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Semua kolom input harus di isi!</b></div>";
	}else{
		if (isset($_SESSION['email'])) {
			$sql_insert = mysqli_query($conn,"UPDATE customer SET alamat = '".trim($_POST['alamat'])."', provinsi = '".$_POST['provinsi']."', kota = '".$_POST['kota']."', kecamatan = '".$_POST['kecamatan']."', no_handphone = '".$_POST['hp']."' WHERE email = '$mail'");
			if ($sql_insert === false) {
				echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Terjadi kesalahan! Silakan coba lagi.</b></div>";
			}else{
				//echo "<script>window.location = '$host/order/pembayaran/';</script>";
				header("location: $host/order/pembayaran/");
			}	
		}else{
			$sql_insert = mysqli_query($conn,"UPDATE customer_sementara SET alamat = '".trim($_POST['alamat'])."', provinsi = '".$_POST['provinsi']."', kota = '".$_POST['kota']."', kecamatan = '".$_POST['kecamatan']."', no_handphone = '".$_POST['hp']."' WHERE email = '$mail'");
			if ($sql_insert === false) {
				echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Terjadi kesalahan! Silakan coba lagi.</b></div>";
			}else{
				//echo "<script>window.location = '$host/order/pembayaran/';</script>";
				header("location: $host/order/pembayaran/");
			}
		}
	}
}

if (isset($_SESSION['email'])) {
	$sql_val = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$mail'");
	$get_val = mysqli_fetch_array($sql_val);
}else{
	$sql_val = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '$mail'");
	$get_val = mysqli_fetch_array($sql_val);
}
?>
<form action="" class="form-horizontal" method="post">
	<div class="form-group">
		<label class="control-label col-sm-3">Alamat <font color="red">*</font></label>
		<div class="col-sm-5">
			<textarea name="alamat" class="form-control" rows="4" placeholder="Contoh: Jl.kemuning ujung no.17 RT.009 RW.002" required><?php if(isset($get_val['alamat'])){echo $get_val['alamat'];} ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Provinsi <font color="red">*</font></label>
		<div class="col-sm-5">
			<select name="provinsi" class="form-control" onchange="city(this.value);" required>
				<option value="">-Pilih Provinsi-</option>
				<?php
				$sql_p = mysqli_query($conn, "SELECT * FROM master_provinsi ORDER BY provinsi_id ASC");
				while ($provinsi = mysqli_fetch_array($sql_p)) {
					echo "<option value='$provinsi[provinsi_id]'>$provinsi[provinsi_nama]</option>";
				} 
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Kota <font color="red">*</font></label>
		<div class="col-sm-5">
			<span id="kota"></span>
			<select name="kota" class="form-control" disabled="disabled" onchange="kecam(this.value)" id="del_kota" required>
				<option value="">-Pilih Kota-</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Kecamatan <font color="red">*</font></label>
		<div class="col-sm-5">
			<span id="kecamatan"></span>
			<select name="kecamatan" class="form-control" disabled="disabled" id="del_kecamatan" required>
				<option value="">-Pilih Kecamatan-</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">No. Handphone <font color="red">*</font></label>
		<div class="col-sm-5">
			<input type="number" name="hp" class="form-control" placeholder="08123456789" onkeypress="return isNumberKeyAngka(event)" <?php if(isset($get_val['no_handphone'])){echo "value=".$get_val['no_handphone'];}?> required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
			<button type="submit" name="lanjut" value="lanjut" class="btn btn-default btn-lg btn-order">LANJUTKAN <span class="glyphicon glyphicon-hand-right"></span></button>
		</div>
	</div>
</form>