<?php
if (isset($_SESSION['email']) && isset($_SESSION['pass'])) {
	//mengambil data photo dari database
	include_once("koneksi.php");
	$sql_photo = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_SESSION['email']."'");
	$get_photo = mysqli_fetch_assoc($sql_photo);
	if ($get_photo['photo'] == "") {
		$foto = $host."/image/avatar_2x.png";
	}else{
		$foto = $host."/customer/photo/".$get_photo['photo'];
	}

	echo "
	<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> Akun <span class='caret'></span></a>";
	echo '
	<ul class="dropdown-menu" role="menu" id="dropdown-acc">
		<li>
	        <div class="navbar-content">
	            <div class="row">
	                <div class="col-md-5">
	                    <img src="'.$foto.'"
	                        alt="Alternate Text" class="img-responsive" />
	                    <p class="text-center small">
	                        <a href="#upload_gb" data-toggle="modal" data-target="#upload_gb">Change Photo</a></p>
	                </div>
	                <div class="col-md-7">
	                    <span>'.ucfirst($_SESSION['nama']).'</span>
	                    <p class="text-muted small">
	                        '.$_SESSION['email'].'</p>
	                    <div class="divider">
	                    </div>
	                    <a href="'.$host.'/customer/" class="btn btn-default btn-sm">Panel Akun</a>
	                    <a href="'.$host.'/customer/?cst=pesanan-saya" class="btn btn-default btn-sm">Pesanan Saya</a>
	                    <a href="'.$host.'/customer/?cst=wishlist-saya" class="btn btn-default btn-sm">Wishlist</a>
	                </div>
	            </div>
	        </div>
	        <div class="navbar-footer">
	            <div class="navbar-footer-content">
	                <div class="row">
	                    <div class="col-md-6">
	                        <a href="#ganti_pw" data-toggle="modal" data-target="#ganti_pw" class="btn btn-default btn-sm">Change Passowrd</a>
	                    </div>
	                    <div class="col-md-6">
	                        <a href="'.$host.'/customer/logout.php" class="btn btn-default btn-sm pull-right"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </li>
    </ul>
	';
?>
<!-- Form modal ubah password customer BEGIN -->
<div class="modal fade" id="ganti_pw" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	<div class="modal-dialog" style="margin-top:80px;">
		<form action="<?php echo "$host/customer/proses-ubah-password.php";?>" method="post" class="form-horizontal">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel2"><b>Ubah Password</b></h4>
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
	        <button type="submit" class="btn btn-primary" name="change" value="change">Ubah</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	    </form>
  	</div>
</div>
<!-- Form modal ubah password customer END -->

<!-- Form modal upload foto customer BEGIN -->
<div class="modal fade" id="upload_gb" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="margin-top:80px;">
		<form action="<?php echo "$host/customer/upload-foto.php";?>" method="post" class="form-horizontal" enctype="multipart/form-data">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel3"><b>Upload Photo</b></h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group">
	        	<label class="control-label col-sm-4">Upload Foto : </label>
	        	<div class="col-sm-6">
	        		<input type="file" name="upload_foto" class="form-control" required>
	        		<input type="hidden" name="nmr_foto" value="<?php echo $_SESSION['nomor'];?>">
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-default" name="upload" value="upload">
	        <i class="glyphicon glyphicon-upload"></i> Upload
	        </button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	    </form>
  	</div>
</div>
<!-- Form modal upload foto customer END -->
<?php
}else{
?>

<a href="#login" data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-user"></span> Login</a>
	<div class="modal fade" id="login" role="dialog" style="margin-top:40px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php echo $host."/proses-login.php"; ?>" method="post" class="form-horizontal">
					<div class="modal-header" style="background:#F4F4F4;border-radius:10px 10px 0 0;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						<center><h2 class="hub"><i class="glyphicon glyphicon-log-in"></i> <b>Sign In</b></h2></center>
					</div>
					<div class="modal-body" style="margin-bottom:25px;">
						<div class="form-group" style="padding:8px 14px; margin-bottom:0;">
							<input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
						</div>
						<div class="form-group" style="padding:8px 14px; margin-bottom:0;">
							<input type="password" name="pass" class="form-control" placeholder="Masukkan Password Anda" required>
						</div>
						<a href="<?php echo $host."/lupa_password.php"; ?>" class="pull-right anchor" style="margin-top:10px;">Forget Password?</a>		
					</div>
					<div class="modal-footer" style="background:#F4F4F4;border-radius:0 0 15px 15px;">
						<button class="btn btn-default" type="submit" name="login" value="login"><b>Login</b></button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
}
?>

			