<!-- SlideShow BEGIN -->
<div class="well" style="padding:0px;background-color:white;">
	<div class="carousel slide" data-ride="carousel" id="slideHome">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#slideHome" data-slide-to="0" class="active"></li>
			<li data-target="#slideHome" data-slide-to="1"></li>
			<li data-target="#slideHome" data-slide-to="2"></li>
			<li data-target="#slideHome" data-slide-to="3"></li>
		</ol>

		<?php
		include_once("config.php");
		$sql_slider = "SELECT * FROM slider ORDER BY nmr_gambar ASC";
		$query_slider = $connect->query($sql_slider);
		?>
		<!-- Pembungkus SlideShow -->
		<div class="carousel-inner" role="listbox">
			<?php
			while ($slider = $query_slider->fetch_assoc()) {
			?>
			<div class="item active" style="background-image:url(image/carousel/1.jpg)">
				<div class="carousel-caption">
					<h4 class="animation animated-item-1"><?php echo $slider['judul']; ?></h4>
					<p class="animation animated-item-2"><?php echo $slider['keterangan']; ?></p>
				</div>
			</div>
			<div class="item" style="background-image:url(image/carousel/2.jpg)">
				<div class="carousel-caption">
					<h4 class="animation animated-item-1"><?php echo $slider['judul']; ?></h4>
					<p class="animation animated-item-2"><?php echo $slider['keterangan']; ?></p>
				</div>
			</div>
			<div class="item" style="background-image:url(image/carousel/3.jpg)">
				<div class="carousel-caption">
					<h4 class="animation animated-item-1"><?php echo $slider['judul']; ?></h4>
					<p class="animation animated-item-2"><?php echo $slider['keterangan']; ?></p>
				</div>
			</div>
			<div class="item" style="background-image:url(image/carousel/4.jpg)">
				<div class="carousel-caption">
					<h4 class="animation animated-item-1"><?php echo $slider['judul']; ?></h4>
					<p class="animation animated-item-2"><?php echo $slider['keterangan']; ?></p>
				</div>
			</div>
			<?php
			}
			?>
		</div>

		<!-- Controls -->
		<a href="#slideHome" class="left carousel-control" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a href="#slideHome" class="right carousel-control" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<!-- SlideShow END -->