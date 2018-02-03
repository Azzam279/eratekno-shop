<?php

function viewtype($link1) {
	$host = "http://".$_SERVER['HTTP_HOST']."/Eratekno-Shop";
	$php_self = $_SERVER['PHP_SELF'];
	echo '
	<a href="'.$host.$php_self.$link1.'&viewType=gridView" class="btn btn-default" style="margin:8px 5px 0 0;"><i class="glyphicon glyphicon-th"></i></a>
	<a href="'.$host.$php_self.$link1.'&viewType=listView" class="btn btn-default" style="margin:8px 5px 0 0;"><i class="glyphicon glyphicon-th-list"></i></a>
	';
}

?>