<?php
if (@$_POST['i'] == "inet_b") {
	echo "
		<select name='m-ibank' class='form-control' style='width:225px;margin-top:5px;'>
			<option value=''>-- Pilih Opsi Pembayaran --</option>
			<option value='BCA KlikPay'>BCA KlikPay</option>
			<option value='KlikBCA'>KlikBCA</option>
			<option value='Mandiri Clickpay'>Mandiri Clickpay</option>
		</select>
		<div class='clearfix'></div><br>";
	echo "<img src='images/BCAKlikPay.jpg'>&nbsp;";
	echo "<img src='images/klikbca.jpg'>&nbsp;";
	echo "<img src='images/mandiri_clickpay_logo.png'>";
}

if (@$_POST['v'] == "visa") {
	echo "
		<select name='m-kredit' class='form-control' style='width:225px;margin-top:5px;'>
			<option value=''>-- Pilih Opsi Pembayaran --</option>
			<option value='BCA Kartu Kredit'>BCA Kartu Kredit</option>
			<option value='BRI Kartu Kredit'>BRI Kartu Kredit</option>
			<option value='BNI Kartu Kredit'>BNI Kartu Kredit</option>
			<option value='BNI Kartu Kredit'>BNI Debit Online</option>
			<option value='Mandiri Kartu Kredit'>Mandiri Kartu Kredit</option>
			<option value='Mandiri Kartu Kredit'>Mandiri Debit Online</option>
			<option value='Visa Kartu Kredit'>VISA Kartu Kredit</option>
			<option value='Kartu Kredit Lainnya'>Kartu Kredit Lainnya</option>
		</select><br>";
	echo "<img src='images/BCA-small.png'>&nbsp;";
	echo "<img src='images/BRI-small.png'>&nbsp;";
	echo "<img src='images/BNI-small.png'>&nbsp;";
	echo "<img src='images/Mandiri-small.png'>&nbsp;";
	echo "<img src='images/mega-small.png'>&nbsp;";
	echo "<img src='images/visa.png'>&nbsp;";
	echo "<img src='images/mastercard.jpg'>";
}

if (@$_POST['t'] == "transfer") {
	echo "<br><span style='float:left;margin-top:9px;padding-right:20px;font-size:12px;font-weight:bold;font-family:san-serif;'>Tranfer ke : </span>
		<select name='m-trans' class='form-control' style='width:225px;margin-top:5px;float:left;' onclick='klik_trans();' onblur='hide_ket();' required>
			<option value=''>-- Pilih Bank --</option>
			<option value='Bank BCA'>Bank BCA</option>
			<option value='Bank BRI'>Bank BRI</option>
			<option value='Bank BNI'>Bank BNI</option>
			<option value='Bank Mandiri'>Bank Mandiri</option>
		</select>
		<div class='clearfix'></div>
		<div id='show-ket' style='font-size:11px;'><br>Selesaikan pembayaran transfer dalam waktu 24 jam untuk menghindari pembatalan transaksi secara otomatis.</div>
		<br>";
	echo "<img src='images/BCA-small.png'>&nbsp;";
	echo "<img src='images/BRI-small.png'>&nbsp;";
	echo "<img src='images/BNI-small.png'>&nbsp;";
	echo "<img src='images/Mandiri-small.png'>";
}

?>