<div class="well well-small" style="background: #fff;">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#deskripsi" data-toggle="tab">Deskripsi</a></li>
				<li><a href="#info" data-toggle="tab">Spesifikasi</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="deskripsi">
					<br>
					<p><?php echo $detil_p['deskripsi']; ?></p>
				</div>
				<div class="tab-pane fade" id="info">
					<br>
					<?php echo $detil_p['info']; ?>
				</div>
			</div>
		</div>
	</div>
</div>