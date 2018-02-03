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

		if(@$_GET['sort'] && @$_GET['halaman'] && @$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&sort='.$_GET['sort'].'&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['sort'] && @$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&sort='.$_GET['sort'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['viewType'] && @$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&viewType='.$_GET['viewType'].'&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if (@$_GET['sort']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&sort='.$_GET['sort'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['halaman']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&halaman='.$_GET['halaman'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else if(@$_GET['viewType']) {
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1,500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999&viewType='.$_GET['viewType'].'"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}else{
			echo '
			<li '.@$harga1.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=1500000&hs=4500000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 1.500K - Rp 4,500K</a></li>
			<li '.@$harga2.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=5350000&hs=7800000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 5,350K - Rp 7,800K</a></li>
			<li '.@$harga3.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=9800000&hs=11000000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 9,800K - Rp 11,000K</a></li>
			<li '.@$harga4.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=13000000&hs=15950000"><span class="glyphicon glyphicon-chevron-right"></span> Rp 13,000K - Rp 15,950K</a></li>
			<li '.@$harga5.'><a href="'.$host.$php_self.'?cari='.$_GET['cari'].'&hm=20500000&hs=99999999"><span class="glyphicon glyphicon-chevron-right"></span> Rp 20,500K - Lebih</a></li>
			';
		}
	?>
	</ul>
</div>
