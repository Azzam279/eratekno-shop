<?php
require_once("class.phpmailer.php");
$sendmail = new PHPMailer();
$sendmail->From = 'azzam@eratekno-shop.16mb.com';
$sendmail->FromName = 'Eratekno-Shop';
$sendmail->addAddress('muhammad.azzam2579@gmail.com','Customer');
$sendmail->addReplyTo('azzam@eratekno-shop.16mb.com','Azzam');
$sendmail->Subject = 'Email aktivasi: Aktifkan akun Eratekno Anda melalui Email ini!';
$sendmail->Body = '<a href="http://eratekno-shop.16mb.com/"><img src="http://eratekno-shop.16mb.com/image/era-tekno-lg.png"></a><br><br>
Terima kasih atas kepercayaan Anda bergabung sebagai member di eratekno-shop.16mb.com! Silakan klik link di bawah ini untuk mengaktifkan akun Anda:<br><br>
	<a href="http://eratekno-shop.16mb.com/?ak=$nmr[nmr_customer]&kd=$newcode" style="padding:10px;background:#FFAE12;color:white;text-decoration:none;font-weight:bold;">Aktifkan & Belanja Sekarang</a><br><br><br>
	Jika tombol di atas tidak mengarahkan ke halaman baru, copy URL di bawah ini ke browser Anda:<br>
	<a href="http://eratekno-shop.16mb.com/?ak=$nmr[nmr_customer]&kd=$newcode">http://eratekno-shop.16mb.com/?ak=$nmr[nmr_customer]&kd=$newcode</a>
	<br><br>Jika Anda memiliki pertanyaan lebih lanjut, hubungi kami melalui email: azzam@eratekno-shop.16mb.com<br/><br/><b>Selamat bergabung & selamat berbelanja!</b><br/><a href="Eratekno.16mb.com" style="color:orange;text-decoration:none;font-weight:bold;">Eratekno.16mb.com</a>';
$sendmail->isHTML(true);

if (!$sendmail->Send()) {
	echo "Gagal kirim bro! :( " . $sendmail->ErrorInfo;
}else{
	echo "Berhasil kirim gan! :D";
}

/*
$to = "s4git4rius2@gmail.com";
$subject = "Testing Doang";
$message = "<html><body>
			<a href='http://eratekno-shop.16mb.com/'><img src='http://eratekno-shop.16mb.com/image/ets-title.png'></a><br><br>
			Kepada Customer .,<br><br>
			Dengan ini kami informasikan bahwa Eratekno-shop.16mb.com telah menerima pemesanan Anda. Berikut kami sertakan detail pemesanan:<br><br>
			<table>
			<tr><td>Nomor Pesanan</td><td>:</td><td>715883</td></tr>
			<tr><td>Tanggal Pemesanan</td><td>:</td>17/06/2015</tr>
			<tr><td>Status</td><td>:</td><td>Menunggu Pembayaran</td></tr>
			<table>

			Bila Anda telah teregistrasi menjadi member di Eratekno-shop.16mb.com, Anda dapat melihat status pemesanan melalui kolom Pesanan Saya. 
			</body></html>";
$header = "To: s4git4rius2@gmail.com"."From: EraTekno-Shop <azzam@eratekno-shop.16mb.com>\n"."MIME-Version: 1.0\n"."Content-type: text/html; charset=iso-8859-1";

$sent_mail = mail($to,$subject,$message,$header);
echo $sent_mail ? "Berhasil kirim" : "Gagal kirim";*/
?>