<div class="row profile">
	<div class="col-md-12">
		<div class="profile-sidebar">
			<!-- SIDEBAR USERPIC -->
			<?php
			if ($get_alamat['photo'] == "") {
				$photo = $host."/image/avatar_2x.png";
			}else{
				$photo = $host."/customer/photo/".$get_alamat['photo'];
			}
			?>
			<div class="profile-userpic">
				<img src="<?php echo $photo; ?>" class="img-responsive" alt="">
			</div>
			<!-- END SIDEBAR USERPIC -->
			<!-- SIDEBAR USER TITLE -->
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo ucfirst($_SESSION['nama']); ?>
				</div>
				<div class="profile-usertitle-job">
					Customer
				</div>
			</div>
			<!-- END SIDEBAR USER TITLE -->
			<!-- SIDEBAR BUTTONS
			<div class="profile-userbuttons">
				<button type="button" class="btn btn-success btn-sm">Follow</button>
				<button type="button" class="btn btn-danger btn-sm">Message</button>
			</div> -->
			<!-- END SIDEBAR BUTTONS -->
			<!-- SIDEBAR MENU -->
			<?php
			if (empty($_GET['cst'])) {$a = "class='active'";}else{$a = "";}
			if (@$_GET['cst']=="info-akun") {$b = "class='active'";}else{$b = "";}
			if (@$_GET['cst']=="pesanan-saya") {$c = "class='active'";}else{$c = "";}
			if (@$_GET['cst']=="wishlist-saya") {$d = "class='active'";}else{$d = "";}
			if (@$_GET['cst']=="info-alamat") {$e = "class='active'";}else{$e = "";}
			?>

			<div class="profile-usermenu">
				<ul class="nav nav-client">
					<li <?php echo $a;?>>
						<a href="<?php echo "$host/customer/"; ?>">
						<i class="glyphicon glyphicon-home"></i>
						Panel Kontrol Akun </a>
					</li>
					<li <?php echo $b;?>>
						<a href="<?php echo "$host/customer/?cst=info-akun"; ?>">
						<i class="glyphicon glyphicon-user"></i>
						Informasi Akun </a>
					</li>
					<li <?php echo $e;?>>
						<a href="<?php echo "$host/customer/?cst=info-alamat"; ?>">
						<i class="glyphicon glyphicon-user"></i>
						Informasi Alamat </a>
					</li>
					<li <?php echo $c;?>>
						<a href="<?php echo "$host/customer/?cst=pesanan-saya"; ?>">
						<i class="glyphicon glyphicon-shopping-cart"></i>
						Pesanan Saya </a>
					</li>
					<li <?php echo $d;?>>
						<a href="<?php echo "$host/customer/?cst=wishlist-saya"; ?>">
						<i class="glyphicon glyphicon-folder-open"></i>
						Wishlist Saya </a>
					</li>
					<li>
						<a href="<?php echo $host."/customer/logout.php"; ?>">
						<i class="glyphicon glyphicon-log-out"></i>
						Logout </a>
					</li>
				</ul>
			</div>
			<!-- END MENU -->
		</div>
	</div>
</div>