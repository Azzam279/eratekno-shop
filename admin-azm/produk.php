<?php
echo '<div class="panel-heading">';
echo '<h4><b>';
echo "PRODUK";
echo '</b></h4>';
echo '</div>';

echo '<div class="panel-body">';

include_once("$doc/koneksi.php");
include_once("$doc/fungsi/fungsi.php");
include_once("fungsi.php");

if (@$_POST['tambah']) {
	$harga_diskon = $_POST['harga_produk'] - ($_POST['harga_produk'] * ("0.".$_POST['diskon_produk'])); //hitung diskon
	
	//proses upload file gambar
	$count1 = count($_FILES['gambar_produk']['tmp_name']);
	if ($count1 == 1) {
		img_upload("gambar_produk");
		$img = $_FILES['gambar_produk']['name'][0];
	}else if($count1 == 2) {
		img_upload("gambar_produk");
		$img = $_FILES['gambar_produk']['name'][0].",".$_FILES['gambar_produk']['name'][1];
	}else if($count1 == 3) {
		img_upload("gambar_produk");
		$img = $_FILES['gambar_produk']['name'][0].",".$_FILES['gambar_produk']['name'][1].",".$_FILES['gambar_produk']['name'][2];
	}else if($count1 == 4) {
		img_upload("gambar_produk");
		$img = $_FILES['gambar_produk']['name'][0].",".$_FILES['gambar_produk']['name'][1].",".$_FILES['gambar_produk']['name'][2].",".$_FILES['gambar_produk']['name'][3];
	}else{
		echo "<script>alert('Maximal Upload 4 File!')</script>";
		return false;
	}

	//mengganti karakter ' dan " dengan tanda \' dan \" agar tidak error
	$nama = str_replace("'","\'",str_replace("\"","\"",$_POST['nama_produk']));
	$desc = str_replace("'","\'",str_replace("\"","\"",nl2br($_POST['desc_produk'])));
	$info = str_replace("'","\'",str_replace("\"","\"",nl2br($_POST['info_produk'])));

	//query utk memasukkan data produk ke database
	$sql = mysqli_query($conn, "INSERT INTO produk VALUES(null,'$nama','$img','$desc','$info','".$_POST['kat_produk']."','".$_POST['brand_produk']."','".$_POST['harga_produk']."','".$_POST['diskon_produk']."','$harga_diskon','".$_POST['stok_produk']."','".time()."','0','0')");
	//proses mengInput data ke database
	if ($sql === false) {
		die('Terjadi error! '.mysqli_error($sql));//jika terjadi error
	}else{
		echo "<div class='alert alert-success' role='alert'><span class='glyphicon glyphicon-ok'></span> <b>Data Berhasil di-Input!</b></div>";//jika sukses
		?>
		<script>setTimeout('window.location=\'?azm=produk\'',1500);</script>
		<?php
	}
}
?>
<button id="tampil_form" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Tambah Produk Baru</button><br>

<!-- Form Tambah Produk BEGIN -->
<div id="input_produk">
<center>
<legend><h2>Input Produk Baru</h2></legend>
<fieldset>
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-sm-3">Nama Produk : </label>
			<div class="col-sm-5">
				<input type="text" name="nama_produk" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Gambar Produk : </label>
			<div class="col-sm-3">
				<input type="file" name="gambar_produk[]" class="form-control" multiple required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Deskripsi Produk : </label>
			<div class="col-sm-5">
				<textarea name="desc_produk" class="form-control" rows="8" required></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Info Produk : </label>
			<div class="col-sm-5">
				<textarea name="info_produk" class="form-control" rows="8" required></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Kategori Produk : </label>
			<div class="col-sm-3">
				<select name="kat_produk" class="form-control" onchange="brands(this.value)">
					<?php
					$qry_kat = mysqli_query($conn, "SELECT*FROM kategori");
					while ($kat = mysqli_fetch_assoc($qry_kat)) {
						echo "<option value='$kat[nomor]'>".ucwords($kat['nama'])."</option>";
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Brand Produk : </label>
			<div class="col-sm-3">
				<span id="brand"></span>
				<select name="brand_produk" class="form-control" disabled="disabled" id="sel_brand">
					<option value="0">-Brand-</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Harga Produk : </label>
			<div class="col-sm-3">
				<input type="number" name="harga_produk" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Diskon Produk : </label>
			<div class="col-sm-1">
				<input type="number" name="diskon_produk" class="form-control" value="0" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Stok Produk : </label>
			<div class="col-sm-2">
				<input type="number" name="stok_produk" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3"></label>
			<div class="col-sm-5">
				<button type="submit" name="tambah" value="tambah" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> Tambah</button>
				<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Batal</button>
			</div>
		</div>
	</form>
</fieldset>
</center>
<hr/>
</div>
<!-- Form Tambah Produk END -->

<br>

<!-- ************************************************************************************************************* -->

<!-- Tabel Isi Produk BEGIN -->
<?php
$hlm = 5;
$record_produk = mysqli_query($conn, "SELECT COUNT(nomor) FROM produk");
$total_hlm = mysqli_result($record_produk, 0,0);
$tampil_hlm = ceil($total_hlm / $hlm);

$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
$start_record = ($halaman - 1) * $hlm;

$sql_produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY nomor DESC LIMIT $start_record,$hlm");
?>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<tr>
		<thead>
			<th>Nama Produk</th>
			<th>Gambar Produk</th>
			<th>Deskripsi Produk</th>
			<th>Info Produk</th>
			<th>Kategori</th>
			<th>Brand</th>
			<th>Harga</th>
			<th>Diskon</th>
			<th>Harga Diskon</th>
			<th>Stok</th>
			<th>Tanggal</th>
			<th>Dilihat</th>
			<th>Terjual</th>
			<th></th>
			<th></th>
		</thead>
	</tr>
	<tr>
		<tbody>
			<?php
			while ($show_produk = mysqli_fetch_assoc($sql_produk)) {
				echo "
				<tr>
					<td>".substr($show_produk['nama_produk'],0,20)."</td>
					<td>".substr($show_produk['gambar_produk'],0,30)."</td>
					<td>".substr($show_produk['deskripsi'],0,30)."</td>
					<td>".substr($show_produk['info'],0,30)."</td>";

				$sql_kat = mysqli_query($conn, "SELECT*FROM kategori WHERE nomor = '".$show_produk['no_kategori']."'");
				while ($show_kat = mysqli_fetch_assoc($sql_kat)) {
					echo "
					<td>$show_kat[nama]</td>
					";
				}
				$sql_brand = mysqli_query($conn, "SELECT*FROM brand WHERE nomor = '".$show_produk['no_brand']."'");
				while ($show_brand = mysqli_fetch_assoc($sql_brand)) {
					echo "
					<td>$show_brand[nama]</td>
					";
				}
				echo "
					<td>Rp.$show_produk[harga]</td>
					<td>$show_produk[diskon]%</td>
					<td>Rp.$show_produk[harga_diskon]</td>
					<td>$show_produk[stok]</td>
					<td>".date("d-m-Y H:i:s",$show_produk['tgl'])."</td>
					<td>$show_produk[dilihat]</td>
					<td>$show_produk[terjual]</td>
					<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#mdl_Ubah".$show_produk['nomor']."'><span class='glyphicon glyphicon-edit'></span> Ubah</button>";
				?>
<!-- Form Ubah Produk BEGIN -->
<div class="modal fade" id="mdl_Ubah<?php echo $show_produk['nomor']; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel"><b>Ubah Produk</b></h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Nama Produk : </label>
					<div class="col-sm-5">
						<input type="text" name="unama_produk" class="form-control" value="<?php echo $show_produk['nama_produk']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Gambar Produk : </label>
					<div class="col-sm-4">
						<input type="file" name="ugambar_produk[]" class="form-control" multiple>
						<input type="hidden" name="ugb_produk" value="<?php echo $show_produk['gambar_produk']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Deskripsi Produk : </label>
					<div class="col-sm-5">
						<textarea name="udesc_produk" class="form-control" rows="8"><?php echo $show_produk['deskripsi']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Info Produk : </label>
					<div class="col-sm-5">
						<textarea name="uinfo_produk" class="form-control" rows="8"><?php echo $show_produk['info']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Kategori Produk : </label>
					<div class="col-sm-3">
						<?php katFung($show_produk['no_kategori'],"ukat_produk","kategori",$show_produk['no_brand'],$show_produk['nomor']); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Brand Produk : </label>
					<div class="col-sm-3">
						<span id="e_brand<?php echo $show_produk['nomor'];?>"></span>
						<select name="ubrand_produk" class="form-control" id="e_sel_brand<?php echo $show_produk['nomor'];?>">
							<?php
							$qry_b = mysqli_query($conn, "SELECT*FROM brand WHERE kategori = '".$show_produk['no_kategori']."'");
							while ($brn = mysqli_fetch_assoc($qry_b)) {
								if ($brn['nomor'] == $show_produk['no_brand']) {
									echo "<option value='$brn[nomor]' selected>".ucwords($brn['nama'])."</option>";
								}else{
									echo "<option value='$brn[nomor]'>".ucwords($brn['nama'])."</option>";
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Harga Produk : </label>
					<div class="col-sm-3">
						<input type="number" name="uharga_produk" class="form-control" value="<?php echo $show_produk['harga']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Diskon Produk : </label>
					<div class="col-sm-2">
						<?php
						if ($show_produk['diskon']<10 && $show_produk['diskon']!=0) {
							$discon = "0".$show_produk['diskon'];
						}else{
							$discon = $show_produk['diskon'];
						}
						?>
						<input type="number" name="udiskon_produk" class="form-control" value="<?php echo $discon; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-1">Stok Produk : </label>
					<div class="col-sm-2">
						<input type="number" name="ustok_produk" class="form-control" value="<?php echo $show_produk['stok']; ?>">
						<input type="hidden" name="no" value="<?php echo $show_produk['nomor']; ?>">
						<input type="hidden" name="dilihat" value="<?php echo $show_produk['dilihat']; ?>">
						<input type="hidden" name="terjual" value="<?php echo $show_produk['terjual']; ?>">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" name="ubah" value="ubah">Ubah</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
		</form>
	</div>
</div>
<!-- Form Ubah Produk END -->
				<?php				
				echo "
					</td>
					<td><a href='".$_SERVER['PHP_SELF']."?azm=produk&hapus=$show_produk[nomor]' class='btn btn-danger' onclick='return confirm(\"Yakin Ingin Hapus Data?\")'><span class='glyphicon glyphicon-remove'></span> Hapus</a></td>
				</tr>
				";
			}

//script utk Edit data produk
if (isset($_POST['ubah'])) {
	$folder = "../image/produk/"; //folder gambar produk
	$uharga_diskon = $_POST['uharga_produk'] - ($_POST['uharga_produk'] * ("0.".$_POST['udiskon_produk'])); //hitung diskon

	//mengganti karakter ' dan " dengan tanda \' dan \" agar tidak error
	$unama = str_replace("'","\'",str_replace("\"","\"",$_POST['unama_produk']));
	$udesc = str_replace("'","\'",str_replace("\"","\"",nl2br($_POST['udesc_produk'])));
	$uinfo = str_replace("'","\'",str_replace("\"","\"",nl2br($_POST['uinfo_produk'])));

	//memindah gambar ke folder /image/produk/
	$count = count($_FILES['ugambar_produk']['tmp_name']);
	if(!empty($_FILES['ugambar_produk']['tmp_name'][0])){
		img_upload("ugambar_produk");
		if ($count == 1) {
			$img_nama = $_FILES['ugambar_produk']['name'][0];
		}else if($count == 2) {
			$img_nama = $_FILES['ugambar_produk']['name'][0].",".$_FILES['ugambar_produk']['name'][1];
		}else if($count == 3) {
			$img_nama = $_FILES['ugambar_produk']['name'][0].",".$_FILES['ugambar_produk']['name'][1].",".$_FILES['ugambar_produk']['name'][2];
		}else if($count == 4) {
			$img_nama = $_FILES['ugambar_produk']['name'][0].",".$_FILES['ugambar_produk']['name'][1].",".$_FILES['ugambar_produk']['name'][2].",".$_FILES['ugambar_produk']['name'][3];
		}else{
			echo "<script>alert('Maksimal hanya 4 file gambar!'); window.location= 'index.php?azm=produk';</script>";
		}
	}else{
		$img_nama = $_POST['ugb_produk'];
	}

	//query utk update data
	$sql_edit = mysqli_query($conn, "UPDATE produk SET nama_produk = '$unama', gambar_produk = '$img_nama', deskripsi = '$udesc', info = '$uinfo', no_kategori = '".$_POST['ukat_produk']."', no_brand = '".$_POST['ubrand_produk']."', harga = '".$_POST['uharga_produk']."', diskon = '".$_POST['udiskon_produk']."', harga_diskon = '$uharga_diskon', stok = '".$_POST['ustok_produk']."', tgl = '".time()."', dilihat = '".$_POST['dilihat']."', terjual = '".$_POST['terjual']."' WHERE nomor = '".$_POST['no']."'");

	if ($sql_edit === false) {
		die('Terjadi error! '.mysqli_error($sql_edit));//jika terjadi error
	}else{
		echo "<script>alert('Data Berhasil di-Edit!')</script>"; //jika sukses
		echo "<script>window.location='index.php?azm=produk'</script>";
	}
}			

//script Hapus data produk
if (isset($_GET['hapus'])) {
	$sql_delete = mysqli_query($conn, "DELETE FROM produk WHERE nomor = '".$_GET['hapus']."'");
	if ($sql_delete === false) {
		die('Perintah SQL Salah: ' . mysqli_error($sql_delete));//jika terjadi error
	}else{
		echo "<script>window.location='index.php?azm=produk'</script>"; //jika sukses
	}
}
			?>
		</tbody>
	</tr>
</table>
</div>
<!-- Tabel Isi Produk END -->

<div style='clear:both;'></div>
<div class="clearfix"></div>
<hr/>
<?php
//PAGING
echo "<ul class='pager'>";
if ($halaman > 1) echo  "<li class='previous'><a href='".$_SERVER['PHP_SELF']."?azm=produk&halaman=".($halaman-1)."'>&lt;&lt; Prev</a></li>";

echo "<li><ul class='pagination' style='margin:0px;'>";
for($page = 1; $page <= $tampil_hlm; $page++)
{
     if ((($page >= $halaman - 3) && ($page <= $halaman + 3)) || ($page == 1) || ($page == $tampil_hlm)) 
     {
        if ($page == $halaman) echo "<li class='active'><a href='#'>".$page."</a></li> ";
        else echo "<li><a href='".$_SERVER['PHP_SELF']."?azm=produk&halaman=".$page."'>".$page."</a></li>";         
     }
}
echo "</ul></li>";

if ($halaman < $tampil_hlm) echo "<li class='next'><a href='".$_SERVER['PHP_SELF']."?azm=produk&halaman=".($halaman+1)."'>Next &gt;&gt;</a></li>";
echo "</ul>";

echo '</div>';
?>

