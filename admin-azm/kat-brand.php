<?php
include_once("../koneksi.php");
if (@$_POST['b']) {
	$sql_brandz = mysqli_query($conn,"SELECT*FROM brand WHERE kategori = '".$_POST['b']."'");
	echo '<select name="brand_produk" class="form-control">';
		while($brand = mysqli_fetch_assoc($sql_brandz)){
			echo '<option value="'.$brand['nomor'].'">'.ucwords($brand['nama']).'</option>';
		}
	echo '</select>';
}

if (isset($_POST['edit_b'])) {
	$sql_brandz2 = mysqli_query($conn,"SELECT*FROM brand WHERE kategori = '".$_POST['edit_b']."'");
	echo '<select name="ubrand_produk" class="form-control">';
		while($brand2 = mysqli_fetch_assoc($sql_brandz2)){
			if ($brand2['nomor'] == $_POST['no']) {
				echo '<option value="'.$brand2['nomor'].'" selected>'.ucwords($brand2['nama']).'</option>';
			}else{
				echo '<option value="'.$brand2['nomor'].'">'.ucwords($brand2['nama']).'</option>';
			}
		}
	echo '</select>';
}

?>