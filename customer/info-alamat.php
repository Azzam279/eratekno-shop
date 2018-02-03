<?php
echo "<center><div class='hub'>Informasi Alamat</div></center><hr/>";
include_once("fungsi-select.php");

$sql_alamat = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
$alamat 	= mysqli_fetch_assoc($sql_alamat);

//proses update alamat
if (isset($_POST['simpan'])) {
	if (!preg_match("/^[\w .]*$/", $_POST['alamat'])) {
		echo "<script>alert('Alamat harus berupa Huruf/Angka!');</script>";
		echo "<script>window.location='$host/customer/?cst=info-alamat';</script>";
	}else if (strlen($_POST['no_hp']) > 13) {
		echo "<script>alert('No Handphone maksimal 13 digit angka!');</script>";
		echo "<script>window.location='$host/customer/?cst=info-alamat';</script>";
	}else if (empty($_POST['alamat']) || empty($_POST['no_hp']) || $_POST['kecamatan']==0) {
		echo "<script>alert('Semua kolom input harus di-isi!');</script>";
		echo "<script>window.location='$host/customer/?cst=info-alamat';</script>";
	}else{
		$sql_update = mysqli_query($conn, "UPDATE customer SET alamat = '".trim($_POST['alamat'])."', provinsi = '".$_POST['provinsi']."', kota = '".$_POST['kota']."', kecamatan = '".$_POST['kecamatan']."', no_handphone = '".$_POST['no_hp']."' WHERE email = '".$_SESSION['email']."'");
		if ($sql_update === false) {
			die("Maaf, terjadi error: ".mysqli_error($sql_update));
		}else{
			echo "<script>window.location='$host/customer/?cst=info-alamat';</script>";
		}
	}
}
?>
<div class="row">
<div style="border:solid 2px #F4F4F4;border-radius:8px;padding:15px;" class="col-md-8 col-md-offset-2">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?cst=info-alamat");?>" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-4">Alamat : </label>
			<div class="col-sm-7">
				<textarea name="alamat" rows="6" class="form-control" required><?php echo $alamat['alamat'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4">Provinsi : </label>
			<div class="col-sm-6">
				<?php pvs(); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4">Kota : </label>
			<div class="col-sm-6">
				<span id="city"></span>
				<?php kt(); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4">Kecamatan : </label>
			<div class="col-sm-6">
				<span id="kcmt"></span>
				<?php kcm(); ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4">No. Handphone : </label>
			<div class="col-sm-5">
				<input type="number" name="no_hp" class="form-control" value="<?php echo $alamat['no_handphone'];?>" onkeypress="return isNumberKeyAngka(event);" required>
			</div>
		</div>
		<br>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-5">
				<button class="btn btn-default" type="submit" value="simpan" name="simpan"><b>SIMPAN ALAMAT INI</b></button>
			</div>
		</div>
	</form>
</div>
</div>