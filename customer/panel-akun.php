<?php
echo "<div class='hub'>Panel Kontrol Akun</div><hr/>";
echo "<b>Halo ".ucfirst($_SESSION['nama'])."</b>";
echo "<p>Dari Panel Kontrol Akun, Anda dapat melihat detail akun dan memperbarui informasi akun Anda.<br>
	Pilih link di bawah ini untuk melihat atau mengubah informasi.</p><br>";

echo "
		<div class='panel-akun'>
			<b>Informasi Kontak</b><hr style='margin:10px;' />
			$get_alamat[nama]<br>
			$_SESSION[email]<br><br>
			<a href='#ubah_pw' data-toggle='modal' data-target='#ubah_pw'>Ganti kata sandi</a>
			<div class='pull-right'><a href='$host/customer/?cst=info-akun'>Ubah</a></div>
		</div>
		<br>
		<div class='panel-akun'>
			<b>Alamat</b><hr style='margin:10px;' />
			$get_alamat[alamat]<br>
			$get_provinsi[provinsi_nama] - $get_kota[kokab_nama] - $get_kecam[nama_kecam]<br>
			$get_alamat[no_handphone]
			<div class='clearfix'></div>
			<div class='pull-right'><a href='$host/customer/?cst=info-alamat'>Ubah Alamat</a></div>
			<div class='clearfix'></div>
		</div>
";
?>
<div class="modal fade" id="ubah_pw" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="margin-top:80px;">
		<form action="proses-ubah-password.php" method="post" class="form-horizontal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><b>Ubah Password</b></h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group">
	        	<label class="control-label col-sm-4">Password Baru : </label>
	        	<div class="col-sm-6">
	        		<input type="password" name="pass" class="form-control" placeholder="Masukkan Password Baru" required>
	        	</div>
	        </div>
	        <div class="form-group">
	        	<label class="control-label col-sm-4">Ketik Ulang Password : </label>
	        	<div class="col-sm-6">
	        		<input type="password" name="pass2" class="form-control" placeholder="Ketik Ulang Password Baru" required>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" name="ganti" value="ganti">Ubah</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	    </form>
  	</div>
</div>