<?php

function getExtension($file) {
  $pos = strrpos($file, '.');
  if($pos===false){
    return false;
  } else {  
    return substr($file, $pos+1);
  }
}
$pos = strrpos("http://softontherocks.blogspot.com/2013/07/obtener-la-extension-de-un-fichero-con.html", ".");
echo "$pos<br>";
echo getExtension("http://softontherocks.blogspot.com/2013/07/obtener-la-extension-de-un-fichero-con.html");


?>