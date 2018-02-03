<div class="well well-small" style="background:white;">
	<h4 style="margin-left:10px;">Brand</h4>
	<ul class="nav nav-pills nav-stacked">
	<?php
	$sql = mysqli_query($conn,"SELECT * FROM brand WHERE kategori = '3' ORDER BY nama ASC");

	while($b = mysqli_fetch_assoc($sql)) {

		//mendapatkan total brand dari tiap nama brand
		$qry_brand = mysqli_query($conn,"SELECT no_brand FROM produk WHERE no_brand = '".$b['nomor']."'");
		$jml_brand = mysqli_num_rows($qry_brand);

		if (isset($_GET['brand'])) {
			if ($_GET['brand'] == $b['nomor']) {
				$brand = "class='active'";
			}else{
				$brand = "";
			}
		}else{
			$brand = "";
		}

		if (@$_GET['sort'] && @$_GET['hm'] && @$_GET['hs'] && @$_GET['viewType']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&hm='.$_GET['hm'].'&hs='.$_GET['hs'].'&sort='.$_GET['sort'].'&brand='.$b['nomor'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else if (@$_GET['sort'] && @$_GET['viewType']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&sort='.$_GET['sort'].'&brand='.$b['nomor'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else if (@$_GET['viewType'] && @$_GET['hm'] && @$_GET['hs']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&hm='.$_GET['hm'].'&hs='.$_GET['hs'].'&viewType='.$_GET['viewType'].'&brand='.$b['nomor'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else if (@$_GET['sort'] && @$_GET['hm'] && @$_GET['hs']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&hm='.$_GET['hm'].'&hs='.$_GET['hs'].'&sort='.$_GET['sort'].'&brand='.$b['nomor'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else if (@$_GET['sort']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&sort='.$_GET['sort'].'&brand='.$b['nomor'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else if (@$_GET['hm'] && @$_GET['hs']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&hm='.$_GET['hm'].'&hs='.$_GET['hs'].'&brand='.$b['nomor'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else if (@$_GET['viewType']) {
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&viewType='.$_GET['viewType'].'&brand='.$b['nomor'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}else{
			echo '
			<li '.$brand.'><a href="'.$host.$php_self.'?ets=smartphone&brand='.$b['nomor'].'"><span class="glyphicon glyphicon-chevron-right"></span> '.ucwords($b['nama']).' <small>('.$jml_brand.')</small></a></li>
			';
		}
	}
	?>
	</ul>
</div>

<div class="well well-small" style="background:white;">
	<h4 style="margin-left:10px;">Harga</h4>
	<ul class="nav nav-pills nav-stacked">
	<?php
		if (isset($_GET['hm']) && isset($_GET['hs'])) {
			if ($_GET['hm'] == 1500000 && $_GET['hs'] == 4500000) {
				$harga1 = "class='active'";
			}else if ($_GET['hm'] == 5350000 && $_GET['hs'] == 7800000) {
				$harga2 = "class='active'";
			}else if ($_GET['hm'] == 9800000 && $_GET['hs'] == 11000000) {
				$harga3 = "class='active'";
			}else if ($_GET['hm'] == 13000000 && $_GET['hs'] == 15950000) {
				$harga4 = "class='active'";
			}else if ($_GET['hm'] == 20500000 && $_GET['hs'] == 99999999) {
				$harga5 = "class='active'";
			}
			
		}

		if(@$_GET['sort'] && @$_GET['brand'] && @$_GET['halaman'] && @$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['brand'] && @$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['brand'] && @$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['brand']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['brand'] && @$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['brand'] && @$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['viewType'] && @$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if (@$_GET['sort']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['brand']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&brand='.$_GET['brand'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&brand='.$_GET['brand'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&brand='.$_GET['brand'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&brand='.$_GET['brand'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&brand='.$_GET['brand'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else{
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?ets=smartphone&hm=1500000&hs=4500000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1.500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?ets=smartphone&hm=5350000&hs=7800000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?ets=smartphone&hm=9800000&hs=11000000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?ets=smartphone&hm=13000000&hs=15950000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?ets=smartphone&hm=20500000&hs=99999999"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}
	?>
	</ul>
</div>
