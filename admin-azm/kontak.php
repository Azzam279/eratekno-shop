<?php
echo '<div class="panel-heading">';
echo '<h4><b>';
echo "KONTAK";
echo '</b></h4>';
echo '</div>';

echo '<div class="panel-body">';

include_once("../koneksi.php");
include_once("../fungsi/fungsi.php");

$hlm = 10;
$baris_kontak = mysqli_query($conn,"SELECT COUNT('nmr_kontak') FROM kontak");
$result = mysqli_result($baris_kontak, 0,0);
$haltam = ceil($result/$hlm);

$halaman = (isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1);
$start = ($halaman - 1) * $hlm;

$sql_kontak = mysqli_query($conn,"SELECT*FROM kontak ORDER BY nmr_kontak DESC LIMIT $start, $hlm");
?>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default widget">
            <div class="panel-heading" style="height:40px;">
                <span class="glyphicon glyphicon-envelope" style="float:left;margin-right:9px;"></span> 
                <h3 class="panel-title" style="float:left;">
                    Total Kontak</h3>
                <span class="label label-info" style="float:right;">
                    <?php echo $result; ?></span>
            </div>

            <div class="panel-body">
                <ul class="list-group">
                	<?php
                	while ($kontak = mysqli_fetch_assoc($sql_kontak)) {
                	?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="../image/avatar_2x.png" class="img-circle img-responsive" alt="" />
                            </div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <?php echo ucwords($kontak['subjek']);?>
                                    <div class="mic-info">
                                        By: <a href="#"><?php echo $kontak['nama'];?></a> on <?php echo date("d-M-Y",$kontak['tgl']);?>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <?php echo $kontak['pesan'];?>
                                </div>
                                <div class="action">
                                    <a href="<?php echo "index.php?azm=kontak&hapus=$kontak[nmr_kontak]";?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin Hapus?')" data-toggle="tooltip" data-placement="bottom" title="Hapus Pesan Ini">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                	}
                    ?>
                </ul>
                <!--<a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>-->
            </div>
        </div>
    </div>
</div>

<?php
echo "<ul class='pager'>";
if ($halaman > 1) echo  "<li class='previous'><a href='".$_SERVER['PHP_SELF']."?azm=kontak&halaman=".($halaman-1)."'>&lt;&lt; Prev</a></li>";

echo "<li><ul class='pagination' style='margin:0px;'>";
for($page = 1; $page <= $haltam; $page++)
{
     if ((($page >= $halaman - 3) && ($page <= $halaman + 3)) || ($page == 1) || ($page == $haltam)) 
     {
        if ($page == $halaman) echo "<li class='active'><a href='#'>".$page."</a></li> ";
        else echo "<li><a href='".$_SERVER['PHP_SELF']."?azm=kontak&halaman=".$page."'>".$page."</a></li>";         
     }
}
echo "</ul></li>";

if ($halaman < $haltam) echo "<li class='next'><a href='".$_SERVER['PHP_SELF']."?azm=kontak&halaman=".($halaman+1)."'>Next &gt;&gt;</a></li>";
echo "</ul>";

if (isset($_GET['hapus'])) {
	include_once("fungsi.php");
	$sql_del = mysqli_query($conn,"DELETE FROM kontak WHERE nmr_kontak = '".$_GET['hapus']."'");
    if ($sql_del === false) {
        die("Terjadi error: ".mysqli_error($sql_del));
    }else{
        redirect("index.php?azm=kontak");
    }
}

echo '</div>';

?>