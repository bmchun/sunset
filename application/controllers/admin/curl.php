<?php
function getFn($uri)
{

	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $uri );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$re = curl_exec ( $ch );
	//var_dump($uri,$data,$re);exit;
	curl_close ( $ch );
	return $re;
}
?>