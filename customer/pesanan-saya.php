<?php
echo "<div class='hub'>Pesanan Saya</div><hr/>";

include_once("../koneksi.php");
include_once("../fungsi/fungsi.php");
include_once("../fungsi/fungsi_harga.php");
?>
<div class="well well-small" style="background: #fff;">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#pesanan" data-toggle="tab"><b>Pesanan Saat Ini</b></a></li>
				<li><a href="#batal" data-toggle="tab"><b>Pesanan Batal</b></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="pesanan">
					<br>
					<p><?php include_once("pesanan-saat-ini.php"); ?></p>
				</div>
				<div class="tab-pane fade" id="batal">
					<br>
					<?php include_once("pesanan-batal.php"); ?>
				</div>
			</div>
		</div>
	</div>
</div>