<?php 
include_once("../fungsi/variable.php");

if (empty($_SESSION['admin']) && empty($_SESSION['sid'])) {
	header("location: login-admin.php");
}else{
	include_once("$doc/koneksi.php");
	$time = time();
	mysqli_query($conn, "DELETE FROM troli WHERE customer = '0' AND tgl < $time");
	mysqli_query($conn, "DELETE FROM total_harga WHERE email = '0' AND tgl < $time");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrator | EraTekno-Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo $host."/asset/css/bootstrap.min.css";?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $host."/admin-azm/css/jquery-ui.min.css";?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $host."/admin-azm/css/style-admin.css";?>">
	<link rel="shortcut icon" href="<?php echo $host."/image/erateknoshop.png"; ?>">
	<script scr="<?php echo $host."/asset/js/respond.js";?>"></script>
</head>
<body>

	<?php include_once("header.php"); ?>	

	<div class="container-fluid main-container">

  		<?php include_once("sidebar.php"); ?>

  		<?php include_once("content.php"); ?>

  		<?php include_once("footer.php"); ?>
  	</div>

<script src="<?php echo $host."/asset/js/jquery.js";?>"></script>
<script src="<?php echo $host."/admin-azm/js/jquery-ui.min.js";?>"></script>
<script src="<?php echo $host."/asset/js/bootstrap.min.js";?>"></script>
<script src="<?php echo $host."/admin-azm/js/js-admin.js";?>"></script>
</body>
</html>

<?php
}
?>