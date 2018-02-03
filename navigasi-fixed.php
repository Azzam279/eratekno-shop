<?php
//validasi login: jika customer belum aktivasi email 
if (isset($_GET['warning']) || @$_GET['warning']=="aktivasi"){ 
?>
<div id="dialog-overlay"></div>
<div id='dialog-box'>
    Anda belum melakukan aktivasi email!<br><br>
    <a href="<?php echo $host;?>" class="btn btn-danger btn-sm">
    <i class='glyphicon glyphicon-remove-circle'></i> Close</a>
</div>
<script>
      $('#dialog-box').fadeIn();
      $('#dialog-overlay').fadeTo("normal", 0.4);
     //Tutup kotak dialog saat #dialog-overlay diklik
     $('#dialog-overlay').click(function() {
          window.location = '<?php echo $host; ?>';
     });
</script>
<?php
//validasi login: jika email atau password salah
}else if (isset($_GET['wrong']) || @$_GET['wrong']=="salah") {
?>
<div id="dialog-overlay"></div>
<div id='dialog-box'>
    Email atau Password salah!<br><br>
    <a href="<?php echo $host;?>" class="btn btn-danger btn-sm">
    <i class='glyphicon glyphicon-remove-circle'></i> Close</a>
</div>
<script>
      $('#dialog-box').fadeIn();
      $('#dialog-overlay').fadeTo("normal", 0.4);
     //Tutup kotak dialog saat #dialog-overlay diklik
     $('#dialog-overlay').click(function() {
          window.location = '<?php echo $host; ?>';
     });
</script>
<?php
}
?>
<!-- Navigasi Bar Fixed BEGIN -->
<div class="navbar navbar-default menu-utama" id="nav" role="banner">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myMenu">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="<?php echo $host;?>" class="navbar-brand" style="padding:0 0 0 25px;">
			<div style="width:180px;height:50px;"></div>
			<img src="<?php echo "$host/image/ets-title-md.png";?>" id="brand-img" class="img-responsive" alt="title-erateknoshop">
		</a>
	</div>

	<?php
	if (isset($_SESSION['email']) || isset($_COOKIE['customer'])) {
		include_once("koneksi.php");
		if (isset($_SESSION['email'])) {
			$cst 	  = "customer = '".$_SESSION['email']."'";
			$total_id = "email = '".$_SESSION['email']."'";
		}else if (isset($_SESSION['x'])) {
			$cst 	  = "customer = '".$_SESSION['x']."'";
			$total_id = "email = '".$_SESSION['x']."'";
		}else{
			$cst 	  = "cst_ip = '".$_COOKIE['customer']."'";
			$total_id = "ip = '".$_COOKIE['customer']."'";
		}

		$sql_item  = mysqli_query($conn,"SELECT * FROM troli WHERE $cst");
		$get_item  = mysqli_num_rows($sql_item);
		$item 	   = $get_item;

		$sql_total = mysqli_query($conn,"SELECT * FROM total_harga WHERE $total_id");
		$get_total = mysqli_fetch_array($sql_total);
		$cek_total = mysqli_num_rows($sql_total);
		
		if ($cek_total > 0) {
			$sql_hitung = mysqli_query($conn,"SELECT SUM(troli.subtotal) AS sub FROM troli INNER JOIN produk ON troli.$cst AND produk.stok > 0 AND troli.nmr_produk = produk.nomor");
			$get_hitung = mysqli_fetch_array($sql_hitung);
			$count = $get_hitung['sub'];
			//jika total subtotal pd table troli kurang dari total pd table total_harga maka update table total_harga dgn nilai terbaru
			if ($count < $get_total['total']) {
				$time = time()+(86400*7);
				mysqli_query($conn,"UPDATE total_harga SET total = '$count', tgl = '$time' WHERE $total_id");
			}

			$total = "Rp ".number_format($get_total['total'],0,",",".");
		}else{
			$total = 0;
		}
	}else{
		$item 	   = 0;
		$total 	   = 0;
	}
	?>

	<div class="collapse navbar-collapse" id="myMenu">
		<form action="<?php echo "$host/produk/pencarian/";?>" method="get" class="navbar-form navbar-left" role="search" style="padding-left:55px;">
			<div class="form-group">
				<input type="text" name="cari" class="form-control" placeholder="Search?" size="50" style="border-radius:13px 0 0 13px">
			</div>
			<button type="submit" class="btn btn-info" style="border-radius:0 13px 13px 0"><span class="glyphicon glyphicon-search"></span></button>
		</form>
		<ul class="user-menu nav navbar-nav pull-right">
			<li><a href="<?php echo $host; ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li class="dropdown"><?php include_once("login.php"); ?></li>
			<?php if (empty($_SESSION['email']) && empty($_SESSION['pass'])) { ?>
			<li><a href="<?php echo $host."/register.php"; ?>"><span class="glyphicon glyphicon-registration-mark"></span> Daftar</a></li>
			<?php }?>
			<li><a href="<?php echo $host."/contact.php"; ?>"><span class="glyphicon glyphicon-envelope"></span> Hubungi Kami</a></li>
			<?php
			//jika keranjang tidak kosong maka akan mengarah ke troli
			if ($total != 0 || $total != "") {
			?>
			<li><a href="<?php echo $host."/troli/"; ?>"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $item;?> - Item(s) <span class="label label-warning"><?php echo $total;?></span></a></li>
			<?php
			}else{
			?>
			<li><a href="javascript:void(0)" class="muncul"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $item;?> - Item(s) <span class="label label-warning"><?php echo $total;?></span></a>
				<div id="dialog-overlay"></div>
				<div id='dialog-box'>
				    Troli Anda Kosong!<br>Silakan Berbelanja.<br><br>
				    <button class="btn btn-default btn-alert-box tutup">
				    <i class='fa fa-shopping-cart fa-2x'></i> LANJUTKAN BELANJA
				    </button>
				</div>
				<script>
				$(function() {
				     //Tampilkan kotak dialog saat .muncul diklik
				     $('.muncul').click(function() {
				          $('#dialog-box').fadeIn();
				          $('#dialog-overlay').fadeTo("normal", 0.4);
				     });
				     //Tutup kotak dialog saat .tutup diklik
				     $('.tutup').click(function() {
				          $('#dialog-box').fadeOut();
				          $('#dialog-overlay').hide();
				     });
				     //Tutup kotak dialog saat #dialog-overlay diklik
				     $('#dialog-overlay').click(function() {
				          $('#dialog-box').fadeOut();
				          $('#dialog-overlay').hide();
				     });
				});
				</script>
			<?php
			}
			?>
			</li>
		</ul>
	</div>
</div>
<!-- Navigasi Bar Fixed END -->