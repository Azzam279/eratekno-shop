<?php
echo "<center><div class='hub'>Informasi Akun</div></center><hr/>";

//mengambil tahun dari tanggal lahir
$cut_thn = substr($get_alamat['tgl_lahir'], 0,4);
//mengambil bulan dari tanggal lahir
$cut_bln = substr($get_alamat['tgl_lahir'], 5,2);
//mengambil tanggal dari tanggal lahir
$cut_tgl = substr($get_alamat['tgl_lahir'], 8,2);
?>
<div class="row">
<div style="border:solid 2px #F4F4F4;border-radius:8px;padding:15px;" class="col-md-8 col-md-offset-2">
	
	<?php
	if (isset($_POST['save'])) {
		if (!preg_match("/^[a-zA-Z .]*$/", $_POST['nama'])) {
			echo "<div class='alert alert-warning'><i class='glyphicon glyphicon-alert'></i>  Nama harus berupa huruf!</div>";
		}else{
			if (strlen($_POST['bulan']) == 1) {$bln = "0".$_POST['bulan'];}else{$bln = $_POST['bulan'];}
			if (strlen($_POST['tanggal']) == 1) {$date = "0".$_POST['tanggal'];}else{$date = $_POST['tanggal'];}
			$birth = $_POST['tahun']."-".$bln."-".$date;
			$sql_save = mysqli_query($conn, "UPDATE customer SET nama = '".trim($_POST['nama'])."', tgl_lahir = '$birth', jenis_kelamin = '".$_POST['jkl']."' WHERE email = '".$_SESSION['email']."'");
			if ($sql_save === false) {
				echo "<div class='alert alert-danger'><i class='glyphicon glyphicon-alert'></i>  Maaf! Terjadi kesalahan. Silakan coba lagi.</div>";
			}else{
				echo "<div class='alert alert-success'><i class='glyphicon glyphicon-ok'></i>  Updated!</div>";
				?>
				<script>setTimeout('window.location=\'?cst=info-akun\'',2000);</script>
				<?php
			}
		}
	}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']."?cst=info-akun");?>" method="post" class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-sm-3">Email : </label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="<?php echo $get_alamat['email'];?>" disabled="disabled">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Nama : </label>
			<div class="col-sm-8">
				<input type="text" name="nama" class="form-control" value="<?php echo $get_alamat['nama'];?>" maxlength="80" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Jenis Kelamin : </label>
			<div class="col-sm-4">
				<select name="jkl" class="form-control" required>
					<?php
					if ($get_alamat['jenis_kelamin'] == "Laki-laki") {
						echo "<option value='Laki-laki' selected>Laki-laki</option>";
						echo "<option value='Perempuan'>Perempuan</option>";
					}else{
						echo "<option value='Laki-laki'>Laki-laki</option>";
						echo "<option value='Perempuan' selected>Perempuan</option>";
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Tanggal Lahir : </label>
			<div class="col-md-8">
				<select name="tahun" style="height:35px;width:90px;" required>
	        		<?php
	        		for ($t=1945;$t<=2015;$t++) {
	        			if ($cut_thn == $t) {
	        				echo "<option value='$t' selected>$t</option>";
	        			}else{
	        				echo "<option value='$t'>$t</option>";
	        			}
	        		}
	        		?>
	        	</select>
	        	<select name="bulan" style="height:35px;width:120px;" required>
	        		<?php
	        		$arr_bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	        		foreach ($arr_bulan as $key_bln => $val_bln) {
	        			$key = $key_bln+1;
	        			if ($cut_bln == $key) {
	        				echo "<option value='$key' selected>$val_bln</option>";
	        			}else{
	        				echo "<option value='$key'>$val_bln</option>";
	        			}
	        		}
	        		?>
	        	</select>
	        	<select name="tanggal" style="height:35px;width:50px;" required>
	        		<?php
	        		$tgl = 1;
	        		while ($tgl <= 31) {
	        			if ($cut_tgl == $tgl) {
	        				echo "<option value='$tgl' selected>$tgl</option>";
	        				$tgl++;
	        			}else{
							echo "<option value='$tgl'>$tgl</option>";
	        				$tgl++;
	        			}
	        		}
	        		?>
	        	</select>
			</div>
		</div>
		<br>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" name="save" value="save" class="btn btn-default">
				<span class="glyphicon glyphicon-ok"></span> SIMPAN
				</button>
			</div>
		</div>
	</form>
</div>
<div class="clearfix"></div>
</div>