<?php
include_once("../koneksi.php");
$sql_detil_p   = mysqli_query($conn,"SELECT*FROM produk WHERE nomor = '".$_GET['p']."'");
$detil_p 	   = mysqli_fetch_assoc($sql_detil_p);

if (empty($detil_p['diskon']) || $detil_p['diskon'] == 0) {
	//mendapatkan panjang karakter harga
	if (strlen($detil_p['harga']) == 6) {
		$harga_d1 = substr($detil_p['harga'], 3,3);
		$harga_d2 = substr($detil_p['harga'], 0,3).".";
		$harga_d3 = "";
	}else if(strlen($detil_p['harga']) == 7) {
		$harga_d1 = substr($detil_p['harga'], 4,3);
		$harga_d2 = substr($detil_p['harga'], 1,3).".";
		$harga_d3 = substr($detil_p['harga'], 0,1).".";
	}else if(strlen($detil_p['harga']) >= 8) {
		$harga_d1 = substr($detil_p['harga'], 5,3);
		$harga_d2 = substr($detil_p['harga'], 2,3).".";
		$harga_d3 = substr($detil_p['harga'], 0,2).".";
	}
	//harga diskon
	$harga1 = "";
	$harga2 = "";
	$harga3 = "";
	$diskon = '';
}else{
	//mendapatkan panjang karakter harga
	if (strlen($detil_p['harga']) == 6) {
		$harga1 = substr($detil_p['harga'], 3,3);
		$harga2 = substr($detil_p['harga'], 0,3).".";
		$harga3 = "Rp ";
	}else if(strlen($detil_p['harga']) == 7) {
		$harga1 = substr($detil_p['harga'], 4,3);
		$harga2 = substr($detil_p['harga'], 1,3).".";
		$harga3 = "Rp ".substr($detil_p['harga'], 0,1).".";
	}else if(strlen($detil_p['harga']) >= 8) {
		$harga1 = substr($detil_p['harga'], 5,3);
		$harga2 = substr($detil_p['harga'], 2,3).".";
		$harga3 = "Rp ".substr($detil_p['harga'], 0,2).".";
	}
	//mendapatkan panjang karakter harga diskon
	if (strlen($detil_p['harga_diskon']) == 6) {
		$harga_d1 = substr($detil_p['harga_diskon'], 3,3);
		$harga_d2 = substr($detil_p['harga_diskon'], 0,3).".";
		$harga_d3 = "";
	}else if(strlen($detil_p['harga_diskon']) == 7) {
		$harga_d1 = substr($detil_p['harga_diskon'], 4,3);
		$harga_d2 = substr($detil_p['harga_diskon'], 1,3).".";
		$harga_d3 = substr($detil_p['harga_diskon'], 0,1).".";
	}else if(strlen($detil_p['harga_diskon']) >= 8) {
		$harga_d1 = substr($detil_p['harga_diskon'], 5,3);
		$harga_d2 = substr($detil_p['harga_diskon'], 2,3).".";
		$harga_d3 = substr($detil_p['harga_diskon'], 0,2).".";
	}
	$diskon = '<span class="badge">'.$detil_p['diskon'].'%<br>OFF</span>';
}

//memecah nama-nama gambar pada database
$cut_img = explode(",", $detil_p['gambar_produk']);
//menghitung jumlah gambar yg telah dipecah
$count_img = count($cut_img);

//mengambil data brand dari database
$sql_brand = mysqli_query($conn,"SELECT * FROM brand WHERE nomor = '".$detil_p['no_brand']."'");
$brand_p   = mysqli_fetch_assoc($sql_brand);
?>
<div class="well well-small" style="background: #fff;">
	<div class="row detil">
		<div class="col-md-6 col-sm-6" style="padding-left:0px;padding-right:0px;">
			<a href="#" class="thumbnail md-tb">
			<img id="zoom_01" src="<?php echo $host."/image/produk-medium/".$cut_img[0]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[0]; ?>">
			<span class="tag-disc-detil"><?php echo $diskon; ?></span></a>
			<ul class="small-tb" id="gallery_01">
				<?php
				if ($count_img == 1) {
					?>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[0]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[0]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[0]; ?>"></a>
					</li>
					<?php
				}else if ($count_img == 2) {
					?>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[0]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[0]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[0]; ?>"></a>
					</li>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[1]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[1]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[1]; ?>"></a>
					</li>
					<?php
				}else if ($count_img == 3) {
					?>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[0]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[0]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[0]; ?>"></a>
					</li>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[1]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[1]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[1]; ?>"></a>
					</li>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[2]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[2]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[2]; ?>"></a>
					</li>
					<?php
				}else{
					?>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[0]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[0]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[0]; ?>"></a>
					</li>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[1]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[1]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[1]; ?>"></a>
					</li>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[2]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[2]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[2]; ?>"></a>
					</li>
					<li class="col-md-1 col-sm-1">
						<a href="#" class="thumbnail" data-image="<?php echo $host."/image/produk-medium/".$cut_img[3]; ?>" data-zoom-image="<?php echo $host."/image/produk-large/".$cut_img[3]; ?>"><img id="zoom_01" src="<?php echo $host."/image/produk/".$cut_img[3]; ?>"></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<div class="col-md-6 col-sm-6">
			<h3><strong><?php echo ucwords($detil_p['nama_produk']); ?></strong></h3>
			<p>Brand: <b><?php echo ucwords($brand_p['nama']); ?></b></p>
			<ul class='star-rating'>
			  <li class="current-rating" id="current-rating"><!-- will show current rating --></li>
			  <span id="ratelinks">
			  <li><a href="javascript:void(0)" title="1 star out of 5" class="one-star">1.<?php echo $detil_p['nomor'];?></a></li>
			  <li><a href="javascript:void(0)" title="2 stars out of 5" class="two-stars">2.<?php echo $detil_p['nomor'];?></a></li>
			  <li><a href="javascript:void(0)" title="3 stars out of 5" class="three-stars">3.<?php echo $detil_p['nomor'];?></a></li>
			  <li><a href="javascript:void(0)" title="4 stars out of 5" class="four-stars">4.<?php echo $detil_p['nomor'];?></a></li>
			  <li><a href="javascript:void(0)" title="5 stars out of 5" class="five-stars">5.<?php echo $detil_p['nomor'];?></a></li>
			  </span>
			</ul>
			<br/>
			<?php
			if (isset($_SESSION['email'])) {
			?>
			<span id="wishlist"><button type="button" class="btn btn-link" id="del_wish" onclick="add_wishlist('<?php echo $_GET['p'];?>');">Add to Wishlist</button></span>
			<?php
			}else{
			?>
			<button type="button" class="btn btn-link" disabled="disabled">Add to Wishlist</button>
			<?php	
			}
			?>
			<br/>
			<h5 style="text-decoration: line-through">Harga Normal: <?php echo $harga3.$harga2.$harga1; ?></h5>
			<h4><strong>Harga : Rp. <?php echo $harga_d3.$harga_d2.$harga_d1; ?></strong></h4><br>
			<?php
			if (isset($_SESSION['email'])) {
				$mail     = $_SESSION['email'];
				$mail2 	  = "0";
				$customer = "customer = '$mail'";
				$email    = "email = '$mail'";
			}else if (isset($_SESSION['x'])) {
				$mail     = $_SESSION['x'];
				$mail2 	  = $_COOKIE['bantuan'];
				$customer = "customer = '$mail'";
				$email    = "email = '$mail'";
			}else{
				$mail     = "0";
				$mail2 	  = isset($_COOKIE['customer']) ? $_COOKIE['customer'] : $_SESSION['ip'];
				$customer = "cst_ip = '$mail2'";
				$email    = "ip = '$mail2'";
			}

			//jika button Add di klik
			if (@$_POST['add']) {
				if (isset($_SESSION['email'])) {
					//jika ada session email maka buat cookie nomor customer
					setcookie($_SESSION['nomor'],$_SESSION['email'],time()+(86400*7),"/");
				}else{
					//jika cookie bantuan ada maka setcookie customer dgn nilai cookie bantuan
					if (isset($_COOKIE['bantuan'])) {
						setcookie("customer",$_COOKIE['bantuan'],time()+(86400*7),"/");
					//jika tidak ada, maka buat 2 cookie dibawah ini
					}else{
						setcookie("customer",$_SESSION['ip'],time()+(86400*7),"/");
						setcookie("bantuan",$_SESSION['ip'],time()+(86400*365),"/");
					}
				}

				include_once("../koneksi.php");
				$sql_cek = mysqli_query($conn,"SELECT * FROM troli WHERE nmr_produk = '".$_GET['p']."' AND $customer");
				$cek 	 = mysqli_num_rows($sql_cek);
				$time = time()+(86400*7);
				//jika produk yang bersangkutan sudah ada di table troli, maka lakukan update data 
				if ($cek > 0) {
					$sub = $detil_p['harga_diskon'] * $_POST['jml_barang'];
					mysqli_query($conn,"UPDATE troli SET kuantitas = '".$_POST['jml_barang']."', subtotal = '$sub', tgl = '$time' WHERE nmr_produk = '".$_GET['p']."' AND $customer");
					echo "<div class='alert alert-success'>Add to Cart <i class='glyphicon glyphicon-ok'></i></div>";
					//refresh halaman dlm 2.5 detik
					?>
					<script>
					var hosts = "<?php echo $host;?>";
					var k2 	  = "<?php echo $_GET['k'];?>";
					var b2	  = "<?php echo $_GET['b'];?>";
					var p2 	  = "<?php echo $_GET['p'];?>";
					setTimeout('window.location=hosts+\'/detil-produk/?k=\'+k2+\'&b=\'+b2+\'&p=\'+p2',2500);
					</script>
					<?php
				//jika tidak ada, maka lakukan insert data baru
				}else{
					$add_sub = $_POST['jml_barang'] * $detil_p['harga_diskon'];
					mysqli_query($conn,"INSERT INTO troli VALUES(null,'".$_GET['p']."','$mail','$mail2','".$_POST['jml_barang']."','$add_sub','$time')");
					echo "<div class='alert alert-success'>Add to Cart <i class='glyphicon glyphicon-ok'></i></div>";
					//refresh halaman dlm 2.5 detik
					?>
					<script>
					var hosts = "<?php echo $host;?>";
					var k2 	  = "<?php echo $_GET['k'];?>";
					var b2	  = "<?php echo $_GET['b'];?>";
					var p2 	  = "<?php echo $_GET['p'];?>";
					setTimeout('window.location=hosts+\'/detil-produk/?k=\'+k2+\'&b=\'+b2+\'&p=\'+p2',2500);
					</script>
					<?php
				}

				$sql_troli = mysqli_query($conn,"SELECT SUM(subtotal) AS sub FROM troli WHERE $customer");
				$get_troli = mysqli_fetch_assoc($sql_troli);
				$subtotal = $get_troli['sub'];
				
				$sql_total = mysqli_query($conn,"SELECT * FROM total_harga WHERE $email");
				$cek_total = mysqli_num_rows($sql_total);
				//jika email customer sudah ada di table total_harga, maka lakukan update data saja
				if ($cek_total > 0) {
					mysqli_query($conn,"UPDATE total_harga SET total = '$subtotal', tgl = '$time' WHERE $email");
				//jika tidak ada, maka lakukan insert data baru
				}else{
					mysqli_query($conn,"INSERT INTO total_harga VALUES(null,'$mail','$mail2','$subtotal','$time')");
				}

			//kondisi jika button Beli diklik
			}else if (@$_POST['beli']) {
				if (isset($_SESSION['email'])) {
					//jika ada session email maka buat cookie nomor customer
					setcookie($_SESSION['nomor'],$_SESSION['email'],time()+(86400*7),"/");
				}else{
					//jika cookie bantuan ada maka setcookie customer dgn nilai cookie bantuan
					if (isset($_COOKIE['bantuan'])) {
						setcookie("customer",$_COOKIE['bantuan'],time()+(86400*7),"/");
					//jika tidak ada, maka buat 2 cookie dibawah ini
					}else{
						setcookie("customer",$_SESSION['ip'],time()+(86400*7),"/");
						setcookie("bantuan",$_SESSION['ip'],time()+(86400*365),"/");
					}
				}

				include_once("../koneksi.php");
				$sql_cek = mysqli_query($conn,"SELECT * FROM troli WHERE nmr_produk = '".$_GET['p']."' AND $customer");
				$cek 	 = mysqli_num_rows($sql_cek);
				$time = time()+(86400*7);
				//jika produk yang bersangkutan sudah ada di table troli, maka lakukan update data 
				if ($cek > 0) {
					$sub = $detil_p['harga_diskon'] * $_POST['jml_barang'];
					mysqli_query($conn,"UPDATE troli SET kuantitas = '".$_POST['jml_barang']."', subtotal = '$sub', tgl = '$time' WHERE nmr_produk = '".$_GET['p']."' AND $customer");
					echo "<div class='alert alert-success'>Add to Cart <i class='glyphicon glyphicon-ok'></i></div>";
				//jika tidak ada, maka lakukan insert data baru
				}else{
					$add_sub = $_POST['jml_barang'] * $detil_p['harga_diskon'];
					mysqli_query($conn,"INSERT INTO troli VALUES(null,'".$_GET['p']."','$mail','$mail2','".$_POST['jml_barang']."','$add_sub','$time')");
					echo "<div class='alert alert-success'>Add to Cart <i class='glyphicon glyphicon-ok'></i></div>";
				}

				//menghitung total subtotal
				$sql_troli = mysqli_query($conn,"SELECT SUM(subtotal) AS sub FROM troli WHERE $customer");
				$get_troli = mysqli_fetch_assoc($sql_troli);
				$subtotal = $get_troli['sub'];
				
				$sql_total = mysqli_query($conn,"SELECT * FROM total_harga WHERE $email");
				$cek_total = mysqli_num_rows($sql_total);
				//jika email customer sudah ada di table total_harga, maka lakukan update data saja
				if ($cek_total > 0) {
					mysqli_query($conn,"UPDATE total_harga SET total = '$subtotal', tgl = '$time' WHERE $email");
				//jika tidak ada, maka lakukan insert data baru
				}else{
					mysqli_query($conn,"INSERT INTO total_harga VALUES(null,'$mail','$mail2','$subtotal','$time')");
				}

				//jika ada session email maka eksekusi script dibawah ini
				if (isset($_SESSION['email'])) {
					//untuk mengarahkan ke proses order barang
					$host = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";
					$sql_beli = mysqli_query($conn,"SELECT*FROM customer WHERE $email");
					$beli = mysqli_fetch_assoc($sql_beli);
					if ($beli['alamat']=="" || $beli['provinsi']=="" || $beli['kota']=="" || $beli['kecamatan']=="" || $beli['no_handphone']=="") {
						echo "<script>window.location = '$host/order/'</script>";
					}else{
						echo "<script>window.location = '$host/order/pembayaran'</script>";
					}
				//jika tidak ada, maka eksekusi script yang dibawah ini
				}else{
					echo "<script>window.location = '$host/order/checkout.php'</script>";
				}
			}
			?>
			<form action="" method="post" class="form-inline">
				<div class="form-group">
					<label class="control-label">Qty: </label>
					<select type="text" name="jml_barang" class="form-control">
						<?php
						for ($t=1;$t<=$detil_p['stok'];$t++) {
							echo "<option value='$t'>".$t."</option>";
						}
						?>
					</select>
				</div>
				<?php
				if ($detil_p['stok'] == 0) {
				?>
				<button type="button" class="btn btn-default" data-toggle="popover" title="Maaf!" data-content="Maaf, Stok barang ini sedang kosong" data-placement="right" data-container="body" data-trigger="focus"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button>
				<button type="button" class="btn btn-success" data-toggle="popover" title="Maaf!" data-content="Maaf, Stok barang ini sedang kosong" data-placement="top" data-container="body" data-trigger="focus">BELI</button>
				<?php
				}else{
				?>
				<button type="submit" value="add" name="add" class="btn btn-default"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button>
				<button type="submit" value="beli" name="beli" class="btn btn-success">BELI</button>
				<?php
				}
				?>
			</form>
			<br/><hr/>
			<h4><strong>Stok : <?php echo $detil_p['stok']; ?></strong></h4>	
		</div>
	</div>
</div>