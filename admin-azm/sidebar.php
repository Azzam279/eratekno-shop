<div class="col-md-2 sidebar">
	<div class="row">
		<!-- uncomment code for absolute positioning tweek see top comment in css -->
		<div class="absolute-wrapper"></div>
		<!-- Menu -->
		<div class="side-menu">
			<nav class="navbar navbar-default" role="navigation" style="margin-bottom:0px;">
				<!-- Main Menu -->
				<div class="side-menu-container">
					<ul class="nav navbar-nav">
						<?php
						if (@$_GET['azm']=="produk") {$a="class='active'";}else{$a="";}
						//if (@$_GET['azm']=="order-produk") {$b="class='active'";}else{$b="";}
						if (@$_GET['azm']=="gambar_carousel") {$c="class='active'";}else{$c="";}
						if (@$_GET['azm']=="kontak") {$d="class='active'";}else{$d="";}
						if (empty($_GET['azm'])) {$e="class='active'";}else{$e="";}
						?>
						<li <?php echo $e;?>><a href="<?php echo $host."/admin-azm/"; ?>"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
						<li <?php echo $a;?>><a href="?azm=produk"><span class="glyphicon glyphicon-plus"></span> Produk</a></li>
						<li class="panel panel-default" id="dropdown">
							<a href="#order" data-toggle="collapse"><span class="glyphicon glyphicon-shopping-cart"></span> Orderan <i class="caret"></i></a>
							<div id="order" class="panel-collapse collapse">
								<div class="panel-body">
									<ul class="nav navbar-nav">
										<li><a href="?azm=order-produk">Customer Tetap</a></li>
										<li><a href="?azm=order-produk&cst=sementara">Customer Sementara</a></li>
									</ul>
								</div>
							</div>
						</li>
						<li <?php echo $c;?>><a href="?azm=gambar_carousel"><span class="glyphicon glyphicon-picture"></span> Slider</a></li>
						<li <?php echo $d;?>><a href="?azm=kontak"><span class="glyphicon glyphicon-envelope"></span> Kontak</a></li>

						<!-- Dropdown
						<li class="panel panel-default" id="dropdown">
							<a data-toggle="collapse" href="#dropdown-lvl1">
								<span class="glyphicon glyphicon-user"></span> Sub Level <span class="caret"></span>
							</a>-->

							<!-- Dropdown level 1 
							<div id="dropdown-lvl1" class="panel-collapse collapse">
								<div class="panel-body">
									<ul class="nav navbar-nav">
										<li><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>
										<li><a href="#">Link</a></li>-->

										<!-- Dropdown level 2 
										<li class="panel panel-default" id="dropdown">
											<a data-toggle="collapse" href="#dropdown-lvl2">
												<span class="glyphicon glyphicon-off"></span> Sub Level <span class="caret"></span>
											</a>
											<div id="dropdown-lvl2" class="panel-collapse collapse">
												<div class="panel-body">
													<ul class="nav navbar-nav">
														<li><a href="#">Link</a></li>
														<li><a href="#">Link</a></li>
														<li><a href="#">Link</a></li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>-->
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</div>  		
</div>