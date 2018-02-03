<?php
echo '<div class="panel-heading">';
echo '<h4><b>';
echo "SLIDER";
echo '</b></h4>';
echo '</div>';

echo '<div class="panel-body">';

include_once("../koneksi.php");
include_once("fungsi.php");

$sql_value = mysqli_query($conn, "SELECT*FROM slider ORDER BY nmr_gambar ASC");

echo "<fieldset>";
echo "<legend><h2>Gambar Slider</h2></legend>";
$slideshow = "../image/carousel/";
if(is_dir($slideshow)){
	if($gambar=opendir($slideshow)){
		$nama = 0;
		$no = 0;
		while($detil=readdir($gambar)){
			if($detil!="." && $detil!=".."){
				while ($val = mysqli_fetch_assoc($sql_value)) {
				$nama+=1;
				$no+=1;
				echo "
				<img src='../image/carousel/$nama.jpg' style='width:100px;height:300px;width:300px;' class='img-responsive col-md-offset-3'><br>
				<small class='col-md-offset-4'><i>Dimension 1140x600 min</i></small><div class='clearfix'></div><br>
				<form action='' method='post' enctype='multipart/form-data' class='form-horizontal'>
					<div class='form-group'>
						<div class='col-md-offset-3 col-md-5'>
							<input type='file' name='gb_slide$no' class='form-control'>
							<input type='hidden' name='folder' value='$slideshow'>
							<input type='hidden' name='nama$no' value='$nama'>
							<input type='hidden' name='gbr$no' value='$val[gambar]'>
						</div>
					</div>
					<div class='form-group'>
						<label class='control-label col-md-3'>Keterangan : </label>
						<div class='col-md-5'>
							<textarea name='ket$no' class='form-control' row='4'>$val[keterangan]</textarea>
						</div>
					</div>
					<div class='form-group'> 
						<div class='col-md-offset-3 col-md-3'>
							<button type='submit' name='gb_btn$no' value='gb_btn$no' class='btn btn-default'>
							<span class='glyphicon glyphicon-upload'></span> Upload
							</button>
						</div>
					</div>
				</form><br>
				";

					if (@$_POST['gb_btn'.$no]) {

						if ($_FILES['gb_slide'.$no]['name'] != "") {
							move_uploaded_file($_FILES['gb_slide'.$no]['tmp_name'], $_POST['folder'].$_POST['nama'.$no].".jpg");
							$gb = $_POST['nama'.$no].".jpg";
						}else{
							$gb = $_POST['gbr'.$no];
						}
						

						$sql = mysqli_query($conn, "UPDATE slider SET gambar= '".$gb."', keterangan = '".$_POST['ket'.$no]."' WHERE nmr_gambar = '$no' ");
						if ($sql === false) {
							die('Perintah SQL Salah: ' . mysqli_error($sql));
						}else{
							?>
							<script>setTimeout('window.location=\'?azm=gambar_carousel\'',2000);</script>
							<?php
						}
					}
				}
			}
		}
	}
}
echo "</fieldset>";

echo "</div>";
?>