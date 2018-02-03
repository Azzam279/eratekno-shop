<?php

function breadcrumbs($nama,$link){
	echo "<div class='pull-right hidden-xs hidden-sm' id='breadcrumbz'>
			<ol class='breadcrumb'>
				<li style='vertical-align:middle;'><a href='$link'><i class='fa fa-home fa-2x'></i></a> <i class='glyphicon glyphicon-menu-right' style='vertical-align:37%;'></i></li>
				<li class='active'>".strtoupper($nama)."</li>
			</ol></div>
		";
}

function breadcrumbs2($nama1,$nama2,$link1,$link2){
	echo "<div class='pull-right hidden-xs hidden-sm' id='breadcrumbz'>
			<ol class='breadcrumb'>
				<li style='vertical-align:middle;'><a href='$link1'><i class='fa fa-home fa-2x'></i></a></li>
				<li> <i class='glyphicon glyphicon-menu-right'></i> <a href='$link2'>".strtoupper($nama1)."</a> <i class='glyphicon glyphicon-menu-right'></i></li>
				<li class='active'>".strtoupper($nama2)."</li>
			</ol></div>
		";
}

function breadcrumbs3($nama1,$nama2,$nama3,$link1,$link2,$link3){
	echo "<div class='pull-right hidden-xs hidden-sm' id='breadcrumbz'>
			<ol class='breadcrumb'>
				<li style='vertical-align:middle;'><a href='$link1'><i class='fa fa-home fa-2x'></i></a></li>
				<li> <i class='glyphicon glyphicon-menu-right'></i> <a href='$link2'>".strtoupper($nama1)."</a></li>
				<li> <i class='glyphicon glyphicon-menu-right'></i> <a href='$link3'>".strtoupper($nama2)."</a> <i class='glyphicon glyphicon-menu-right'></i></li>
				<li class='active'>".strtoupper($nama3)."</li>
			</ol></div>
		";
}

function breadcrumbs4($nama1,$nama2,$nama3,$nama4,$link1,$link2,$link3,$link4){
	echo "<div class='pull-right hidden-xs hidden-sm' id='breadcrumbz'>
			<ol class='breadcrumb'>
				<li style='vertical-align:middle;'><a href='$link1'><i class='fa fa-home fa-2x'></i></a></li>
				<li> <i class='glyphicon glyphicon-menu-right'></i> <a href='$link2'>".strtoupper($nama1)."</a></li>
				<li> <i class='glyphicon glyphicon-menu-right'></i> <a href='$link3'>".strtoupper($nama2)."</a></li>
				<li> <i class='glyphicon glyphicon-menu-right'></i> <a href='$link4'>".strtoupper($nama3)."</a> <i class='glyphicon glyphicon-menu-right'></i></li>
				<li class='active'>".strtoupper($nama4)."</li>
			</ol></div>
		";
}

//contoh penggunaan mysqli_result
function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}
?>