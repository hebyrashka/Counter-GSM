<?php 
$extra_dir;

if ( $directory_lvl == 0 ) {
	$extra_dir = "";
}
if ( $directory_lvl != 0 ) {
	for ( $i = 0; $i < $directory_lvl; $i++ ) { 
		$extra_dir .= "../";
	}
}
?>