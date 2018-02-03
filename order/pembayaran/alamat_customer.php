<?php
include_once("../../koneksi.php");

//mengambil data alamat dari table customer
if (isset($_SESSION['email'])) {
	$qry_alamat = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$mail'");
	$alamat 	= mysqli_fetch_assoc($qry_alamat);
}else{
	$qry_alamat = mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '$mail'");
	$alamat 	= mysqli_fetch_assoc($qry_alamat);
}

//mengambil data provinsi - kota - kecamatan
$qry_provinsi  = mysqli_query($conn, "SELECT * FROM master_provinsi WHERE provinsi_id = '".$alamat['provinsi']."'");
$qry_kota	   = mysqli_query($conn, "SELECT * FROM master_kokab WHERE kota_id = '".$alamat['kota']."'");
$qry_kecamatan = mysqli_query($conn, "SELECT * FROM master_kecam WHERE kecam_id = '".$alamat['kecamatan']."'");
$provinsi 	   = mysqli_fetch_assoc($qry_provinsi);
$kota 		   = mysqli_fetch_assoc($qry_kota);
$kecamatan 	   = mysqli_fetch_assoc($qry_kecamatan);

include_once("fungsi-select.php");
?>
<div class="table-responsive">
<table class="table table-condensed" width="100%">
	<tr>
		<td class="heading"><b>Alamat Tujuan</b></td>
		<td align="right" class="u-link">
			<a href="#ubah1" data-toggle="modal" data-target="#ubah1">Ubah</a>
				<div class="modal fade" id="ubah1" role="dialog" style="margin-top:40px;">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="proses-ubah-alamat.php" method="post" class="form-horizontal">
								<div class="modal-header" style="background:#F4F4F4;border-radius:10px 10px 0 0;">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
									<center><h2 class="hub"><b>Ubah Alamat</b></h2></center>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label class="control-label col-sm-3 col-sm-offset-1">Nama : </label>
										<div class="col-sm-5">
											<input type="text" name="nama" class="form-control" value="<?php echo $alamat['nama'];?>" maxlength="80" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3 col-sm-offset-1">Alamat : </label>
										<div class="col-sm-5">
											<input type="text" name="alamat" class="form-control" value="<?php echo $alamat['alamat'];?>" maxlength="125" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3 col-sm-offset-1">Provinsi : </label>
										<div class="col-sm-5">
											<?php pvs(); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3 col-sm-offset-1">Kota : </label>
										<div class="col-sm-5">
											<span id="city"></span>
											<?php kt(); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3 col-sm-offset-1">Kecamatan : </label>
										<div class="col-sm-5">
											<span id="kcmt"></span>
											<?php kcm(); ?>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3 col-sm-offset-1">No. Handphone : </label>
										<div class="col-sm-5">
											<input type="number" name="no_hp" class="form-control" value="<?php echo $alamat['no_handphone'];?>" onkeypress="return isNumberKeyAngka(event);" required>
											<input type="hidden" name="session" value="<?php echo $mail;?>">
										</div>
									</div>
								</div>
								<div class="modal-footer" style="background:#F4F4F4;border-radius:0 0 15px 15px;">
									<button class="btn btn-primary" type="submit" name="change" value="change"><span class="glyphicon glyphicon-edit"></span> Simpan</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<b><?php echo ucwords($alamat['nama']); ?></b><br>
			<?php echo $alamat['alamat']; ?><br>
			<?php echo $provinsi['provinsi_nama']." - ".$kota['kokab_nama']." - ".$kecamatan['nama_kecam']; ?><br>
			Nomor Handphone: <?php echo $alamat['no_handphone']; ?>
		</td>
	</tr>
</table>
</div>
<br>