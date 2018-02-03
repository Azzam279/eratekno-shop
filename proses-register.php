<?php
include_once("koneksi.php");
if (isset($_POST['daftar'])) {
	if (@$_POST['jkl'] != "") {
		if (@$_POST['pass'] != $_POST['pass2']) {
			echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Ketik Ulang Password!</b></div>";
		}else if(!preg_match("/^[a-zA-Z .]*$/", @$_POST['nama'])) {
			echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Nama harus berupa Alfabet/Huruf!</b></div>";
		}else if(!filter_var(@$_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email tidak valid!</b></div>";
		}else if(!ctype_alnum(@$_POST['pass'])) {
			echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Password hanya boleh berupa Huruf & Angka!</b></div>";
		}else{
			//membuat kode karakter alfanumerik
			$codelength = 25;
			$newcode_length = 0;
			while($newcode_length < $codelength){
				$x = 1;
				$y = 3;
				$part = rand($x,$y);
				if($part==1){$a=48; $b=57;}
				if($part==2){$a=65; $b=90;}
				if($part==3){$a=97; $b=122;}
				$code_part = chr(rand($a,$b));
				$newcode_length = $newcode_length + 1;
				@$newcode = $newcode.$code_part;
			}
			//mengecek apakah email sudah terdaftar atau belum
			$sql_cek = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_POST['email']."'");
			$cek 	 = mysqli_num_rows($sql_cek);
			$sql_cek2= mysqli_query($conn, "SELECT * FROM customer_sementara WHERE email = '".$_POST['email']."'");
			$cek2 	 = mysqli_num_rows($sql_cek2);
			if ($cek > 0 || $cek2 > 0) {
				echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Email sudah terdaftar!</b></div>";
			}else{
				require_once("class.phpmailer.php");
				$pass = md5("r84h".md5("qf4j9".@$_POST['pass']."jqe92")."mk27");
				$birth = $_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'];
				$sql_daftar = mysqli_query($conn,"INSERT INTO customer VALUES(
				null,
				'".$_POST['nama']."',
				'".$_POST['email']."',
				'$pass',
				'$birth',
				'".$_POST['jkl']."',
				'','','','','','',
				'$newcode','0'
				)");
				if ($sql_daftar === false) {
					echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Maaf terjadi kesalahan!</b></div>";
				}else{
					$qry_cek = mysqli_query($conn, "SELECT * FROM customer WHERE email = '".$_POST['email']."'");
					$nmr 	 = mysqli_fetch_assoc($qry_cek);
					$cek 	 = mysqli_num_rows($qry_cek);
					$nama 	 = $_POST['nama'];
					$email 	 = $_POST['email'];
					if ($cek == 1) {
						$sendmail = new PHPMailer();
						$sendmail->From = 'azzam@eratekno-shop.16mb.com';
						$sendmail->FromName = 'Eratekno-Shop';
						$sendmail->addAddress($email,$nama);
						$sendmail->addReplyTo('azzam@eratekno-shop.16mb.com','Azzam');
						$sendmail->Subject = 'Email aktivasi: Aktifkan akun Eratekno Anda melalui Email ini!';
						$sendmail->Body = '<a href="http://eratekno-shop.16mb.com/"><img src="http://eratekno-shop.16mb.com/image/era-tekno-lg.png"></a><br><br>
						Terima kasih atas kepercayaan Anda bergabung sebagai member di eratekno-shop.16mb.com! Silakan klik tombol di bawah ini untuk mengaktifkan akun Anda:<br><br>
							<a href="http://eratekno-shop.16mb.com/?ak='.$nmr['nmr_customer'].'&kd='.$newcode.'" style="padding:10px;background:#FFAE12;color:white;text-decoration:none;font-weight:bold;">Aktifkan & Belanja Sekarang</a><br><br><br>
							Jika tombol di atas tidak mengarahkan ke halaman baru, copy URL di bawah ini ke browser Anda:<br>
							<a href="http://eratekno-shop.16mb.com/?ak='.$nmr['nmr_customer'].'&kd='.$newcode.'">http://eratekno-shop.16mb.com/?ak='.$nmr['nmr_customer'].'&kd='.$newcode.'</a>
							<br><br>Jika Anda memiliki pertanyaan lebih lanjut, hubungi kami melalui email: azzam@eratekno-shop.16mb.com<br/><br/><b>Selamat bergabung & selamat berbelanja!</b><br/><a href="Eratekno-shop.16mb.com" style="color:orange;text-decoration:none;font-weight:bold;">Eratekno-shop.16mb.com</a>';
						$sendmail->isHTML(true);

						if($sendmail->Send()){
							echo "<div class='alert alert-success'><b><font color='orange'>Daftar Sukses!</font> Silakan cek email Anda untuk melakukan Aktivasi Email.<br>Kami baru saja mengirimkan email konfirmasi ke alamat email <font color='#55AAFF'>$email</font></b></div>";
						}else{
							echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Maaf, terjadi kesalahan. Aktifasi Email tidak dapat dikirim</b> ".$sendmail->ErrorInfo."</div>";
						}
					}else{
						echo "<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span> <b>Maaf terjadi kesalahan! Silakan coba lagi.</b></div>";
					}
				}
			}
		}
	}else{
		echo "<div class='alert alert-warning'><span class='glyphicon glyphicon-alert'></span> <b>Anda belum mengisi Jenis Kelamin!</b></div>";
	}
}
?>