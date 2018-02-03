<?php
function katFung($kat,$name,$tabel,$no,$no2){
	//konek database
	include("../koneksi.php");

	if($kat==""){
		$katFung = mysqli_query($conn, "SELECT*FROM $tabel");
		echo '<select name="'.$name.'" class="form-control" onchange="edit_brands(this.value ,\''.$no.'\',\''.$no2.'\')">';
			while($katFung2 = mysqli_fetch_assoc($katFung)){
			echo '<option value="'.$katFung2['nomor'].'">'.ucwords($katFung2['nama']).'</option>';
			}
		echo '</select>';
	}else{
		$katFung3 = mysqli_query($conn, "SELECT*FROM $tabel");
		echo '<select name="'.$name.'" class="form-control" onchange="edit_brands(this.value ,\''.$no.'\',\''.$no2.'\')">';
		while($katFung4 = mysqli_fetch_assoc($katFung3)){
			if($kat==$katFung4['nomor']){
				echo '<option value="'.$katFung4['nomor'].'" selected="selected">'.ucwords($katFung4['nama']).'</option>';
			}else{
				echo '<option value="'.$katFung4['nomor'].'">'.ucwords($katFung4['nama']).'</option>';
			}
		}
		echo '</select>';
	}
}

function redirect($halaman){
	echo "<script>window.location='$halaman'</script>";
}

function upload_img_resize($width,$height,$dir,$file,$no) {
	//direktori gambar
   $vdir_upload = $dir;
   $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"][''.$no.''];

   //nama gambar/file
   $gb_name = $_FILES[''.$file.'']["name"][''.$no.''];

   //Simpan gambar dalam ukuran sebenarnya
   move_uploaded_file($_FILES[''.$file.'']["tmp_name"][''.$no.''], $dir.$_FILES[''.$file.'']["name"][''.$no.'']);

   //identitas file asli
   $im_src = imagecreatefromjpeg($vfile_upload);
   $src_width = imageSX($im_src);
   $src_height = imageSY($im_src);

   //Set ukuran gambar hasil perubahan
   $dst_width = $width;
   $dst_height = $height;
   $height_medium = (376/$src_width)*$src_height;

   //proses perubahan ukuran
   $im = imagecreatetruecolor($dst_width,$dst_height);
   $im2 = imagecreatetruecolor(376,$height_medium);
   $im3 = imagecreatetruecolor(800,800);
   imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
   imagecopyresampled($im2, $im_src, 0, 0, 0, 0, 376, $height_medium, $src_width, $src_height);
   imagecopyresampled($im3, $im_src, 0, 0, 0, 0, 800, 800, $src_width, $src_height);

   //Simpan gambar
   imagejpeg($im,$vdir_upload . $gb_name,100);
   imagejpeg($im2,"../image/produk-medium/" . $gb_name,100);
   imagejpeg($im3,"../image/produk-large/" . $gb_name,100);
   
   //Hapus gambar di memori komputer
   //imagedestroy($im_src);
   //imagedestroy($im);
   //$remove_small = unlink("$vfile_upload");
}

function img_upload($gambar){
	$total_file = count(@$_FILES[''.$gambar.'']['tmp_name']);
	for($tf=0; $tf<$total_file; $tf++){
		$tmp_file = $_FILES[''.$gambar.'']['tmp_name'][$tf];
		upload_img_resize(196,156,"../image/produk/",$gambar,$tf);
	}
}
?>