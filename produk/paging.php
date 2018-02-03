<?php
function paging($link,$halaman,$tampil_hlm,$tampil_hlm2) {
	$host = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";
	$php_self = $_SERVER['PHP_SELF'];
	
	echo "<ul class='pager'>";
	if ($halaman > 1) echo  "<li class='previous'><a href='".$host.$php_self.$link."&halaman=".($halaman-1)."'><i class='glyphicon glyphicon-menu-left'></i> Prev</a></li>";

	echo "<li><ul class='pagination' style='margin:0px;'>";
	for($page = 1; $page <= $tampil_hlm; $page++)
	{
	     if ((($page >= $halaman - 3) && ($page <= $halaman + 3)) || ($page == 1) || ($page == $tampil_hlm)) 
	     {
	        if ($page == $halaman) echo "<li class='active'><a href='#'>".$page."</a></li> ";
	        else echo "<li><a href='".$host.$php_self.$link."&halaman=".$page."'>".$page."</a></li>";         
	     }
	}
	echo "</ul></li>";

	if ($halaman < $tampil_hlm) echo "<li class='next'><a href='".$host.$php_self.$link."&halaman=".($halaman+1)."'>Next <i class='glyphicon glyphicon-menu-right'></i></a></li>";
	echo "</ul>";	
}
?>